<?php

namespace App\Controller;

use Psr\Cache\CacheItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    #[Route('/external', name: 'external')]
    public function external(HttpClientInterface $client, CacheInterface $cache): Response
    {
        $data = $cache->get('mixes_data', function (CacheItemInterface $cacheItem) use ($client) {
            $cacheItem->expiresAfter(86400);
            $url = 'https://api-adresse.data.gouv.fr/search/?q=20%20Avenue%20de%20S%C3%A9gur%2075007%20Paris&type=housenumber&autocomplete=1';
            $response = $client->request('GET', $url);

            return $response->toArray();
        });

        return $this->render('default/external.html.twig', [
            'data' => $data
        ]);
    }
}
