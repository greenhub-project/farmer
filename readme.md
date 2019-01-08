# GreenHub Farmer

[![Build Status](https://travis-ci.org/greenhub-project/farmer.svg?branch=develop)](https://travis-ci.org/greenhub-project/farmer)

> GreenHub's back-end and web dashboard module

## Requirements

-   [PHP](http://php.net/) 7.2+
-   MariaDB database
-   [Composer](https://getcomposer.org/) - Installs package dependencies
-   [NodeJS](https://nodejs.org/en/) - Provides NPM to install node packages
-   [Yarn](https://yarnpkg.com/lang/en/) - Provides a fast, reliable and secure node package manager.

## Installation

-   Clone or download this repository.
-   Copy `.env.example` as `.env` and fill the options

    > **Note**: This project sends e-mails. Therefore, ensure that the e-mail driver is specified.

-   Install project dependencies:

```
composer install
yarn install
```

-   Generate application key:

```
php artisan key:generate
```

-   Migrate and seed the database:

```
php artisan migrate
php artisan db:seed
```

-   Build assets (e.g. in development environment)

```
yarn dev
```

-   Start local server

```
php artisan serve
```

## License

GreenHub Farmer module is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
