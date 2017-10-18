# Privat

Private is a very simple password protection for Laravel projects. It's useful for websites in a staging state.

![Screenshot](http://i.imgur.com/jz7TTmS.png)

## Usage

### Install with composer

    composer require code16/privat

### Add Privat Service Provider (except for Laravel 5.5+)

Add the following line in the `providers` section of your `config/app.php` file:

    \Code16\Privat\PrivatServiceProvider::class

### Add Privat middleware in your project

Add the following middleware in your project configuration. 

    \Code16\Privat\PrivatMiddleware::class

Typically, you can add it at the end of the `'web'` key in your `$middlewareGroups` array (in `app/Http/Kernel`).


### Set Privat config

First create the privat config file:

    php artisan vendor:publish --provider="Code16\Privat\PrivatServiceProvider"

And then edit the new `/config/privat.php` accordingly (nothing fancy), or even better, add this keys in your `.env` file:

- PRIVAT_RESTRICTED=true
- PRIVAT_PASSWORD=mypassword

### Exceptions

The `except` config param is meant to contain an array of excluded urls 
(those urls won't be protected by Privat).

### Waiting page

If you need to present a public waiting page, here's how: set the waiting page view name in the `waiting_view` config key (in `config/privat.php`):

    "waiting_view" => "demo.waiting"

From then, all requests without the Privat registration will be redirected to `/privat_waiting` which will render the configured view, except `/privat`, which will still present the Privat form.

## How does it work

Quite simple: if the given password is correct, Privat sets a session property, and look for it on each request. So, obviously, Privat won't work on non session based systems (an API for instance).

## License

MIT
