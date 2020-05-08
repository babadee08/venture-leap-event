# Event Creation Service

This is a simple Symfony 4.4 based API micro-service (JSON) where you can perform the following actions

- Post an EVENT (entity) with a category and a text (which is then stored to the DB)
- Get the list of the 10 last EVENTs (timestamp, category, text)

Suggested framework was [Symfony](https://symfony.com/) 4.4

### Prerequisites

- PHP 7.2
- Composer
- Data was persisted to Sqlite

### Installing

A manual installation is needed.
- clone the repository
- change directory into the project folder
- run `composer install` to install the dependencies
- start your local web server or user `folder.test` if you have `laravel valet` installed


## Running the tests

To execute them run:
```
php bin/phpunit --debug
```

### Endpoints

The table below shows the available endpoints below and protection level

| Name            | Method      | URL                | Protected |
| ---             | ---         | ---                | ---       |
| List Categories | `GET`       | `/api/categories`  | ✘         |
| Create Category | `POST`      | `/api/categories`  | ✘         |
| Create Event    | `POST`      | `/api/events`      | ✘         |
| List Events     | `GET`       | `/api/events`      | ✘         |


## Caveats

1. Security, Validation and Logging were not properly considered in the projects.
    - I acknowledge this is not standard practices and I'm reporting this outright. It should have at least have them in place.
    
2. I used a global exception handler to for handling all exceptions, that might not be ideal also.

3. The test isn't comprehensive enough. 
    - I only created feature tests without any unit test as it covers end to end testing of the app.
