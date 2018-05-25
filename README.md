# Random Reviews

## Requires

* `php` >= 7.1
    * `php-mysql`
    * `php-xml`
* `composer` >= 1.6.5
* `mysql` >= 5.7.22

## Running

In the project directory, run:

```bash
composer install
```
Then edit the `.env` file and set the `DATABASE_URL` variable to the location of a database.

Then run these commands:

```bash
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```
