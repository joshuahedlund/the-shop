## TheShop

TheShop is an e-commerce portal that allows users to manage products, inventory, and orders. It is written in PHP/Laravel, MySQL, and AngularJS.

## Set Up

Add .env file with database credentials

> DB_CONNECTION=mysql
>
> DB_HOST=
>
> DB_PORT=
>
> DB_DATABASE=
>
> DB_USERNAME=
>
> DB_PASSWORD=

Set up APP_KEY in .env

> php artisan key:generate 

Run database migrations

> php artisan migrate

Start server:

> php artisan serve

Visit on `localhost:8000`

## TODO

1) Database: Get rid of that plaintext password field! Audit/Determine expected value ranges to optimize fields by size.

2) UI: Make prettier. Make sure responsive. Move inlines to JS / CSS (Sass) files.

3) Feature Roadmap: Develop product and order pages.
