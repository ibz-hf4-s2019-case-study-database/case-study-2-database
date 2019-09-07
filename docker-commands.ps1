docker network create market --driver bridge

docker run --rm --network market --dns=1.1.1.1 -dit -p 80:80 -v $PSScriptRoot\src:/var/www/html php:7.3-apache 