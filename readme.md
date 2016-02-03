# Privat

Private is a very simple password gate for a Laravel project.
It is meant for websites in a staging state.

## Usage

### Install with composer

<code>composer require dvlpp/privat</code>

### Add Privat Service Provider

Add the following line in the <code>providers</code> section of your <code>config/app.php</code> file:

<code>\Dvlpp\Privat\PrivatServiceProvider::class</code>

### Add Privat middleware in your project

Add the following line at the end of the <code>$middleware</code> array of the <code>app/Http/Kernel</code> file:

<code>\Dvlpp\Privat\PrivatMiddleware::class</code>

### Set Privat config

First create the privat config file:

<code>php artisan vendor:publish --provider="Dvlpp\Privat\PrivatServiceProvider"</code>

And then edit the new <code>/config/privat.php</code> accordingly (nothing fancy);
or, even better, add this keys in your <code>.env</code> file:

- PRIVAT_RESTRICTED=true
- PRIVAT_PASSWORD=mypassword

### License

[WTFPL](https://en.wikipedia.org/wiki/WTFPL)
