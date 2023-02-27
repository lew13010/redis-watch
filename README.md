# Redis Watch Project
This project aims at doing technology watch on Redis, configuration and registration of sessions and cache in Redis in a Symfony project.

## Installation

For start the project, simply run the command `docker-compose up -d` at the root of the project.

Enter the `redis_symfony` container with command `docker exec -it redis_symfony bash;`.

Install the dependencies with `composer install` in container.

Apply migrations with `sf doctrine:migrations:migrate`

Run project on `http://redis-watch.loc:8010`