# Privat

Private is a very simple password gate for a Laravel project.
It is meant for websites in a staging state.

## Usage

### Install with composer

<code>composer require dvlpp/privat</code>

### Add Privat Service Provider

Add the following line in the 'provider' section of your config/app.php file:

<code>\Dvlpp\Privat\PrivatServiceProvider::class</code>

### Add Privat middleware in your project

Add the following line at the end of the $middleware array of the app/Http/Kernel file:

<code>\Dvlpp\Privat\PrivatMiddleware::class</code>

### Set Privat config

First create the privat config file:

<code>php artisan vendor:publish --provider="Dvlpp\Privat\PrivatServiceProvider"</code>

And then edit the new <code>/config/privat.php</code> accordingly (nothing fancy),
or even better: add this keys in your .env file:

- PRIVAT_RESTRICTED
- PRIVAT_PASSWORD

