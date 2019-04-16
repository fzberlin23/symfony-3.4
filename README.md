# Symfony 3.4 + React

A little Symfony 3.4 application + a Tic Tac Toe game written in React

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them

```
docker + docker-compose
```

### Installing

```
git clone git@github.com:fzberlin23/symfony-3.4.git .
docker-compose up -d
docker exec -it vegas-php-dev bash
composer install
Visit http://localhost:8001
```

### Babel

```
npx babel --watch symfony/web/src/ --out-dir symfony/web/js/ --presets react-app/prod
```
