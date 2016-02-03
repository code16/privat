# Privat

Private is a very simple password protection for Laravel projects.
It's useful for websites in a staging state.

![Screenshot](http://i.imgur.com/jz7TTmS.png)

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

## How does it work

Quite simple: if the given password is correct, Privat sets a session property,
and look for it on each request. So, obviously, Privat won't work on
non session based systems (an API for instance).

## License

[WTFPL](https://en.wikipedia.org/wiki/WTFPL)
