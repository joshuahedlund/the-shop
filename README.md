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

1) Get rid of that plaintext password field!

2) Clean up UI.

3) Develop product and order pages.
