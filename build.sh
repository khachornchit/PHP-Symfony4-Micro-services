#!/bin/sh
docker-compose build
docker-compose up -d
docker-compose exec php bash