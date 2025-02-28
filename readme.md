# Privat

[![Latest Version on Packagist](https://img.shields.io/packagist/v/code16/privat.svg?style=flat-square)](https://packagist.org/packages/code16/privat)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/code16/privat/Tests?label=tests)
[![Total Downloads](https://img.shields.io/packagist/dt/code16/privat.svg?style=flat-square)](https://packagist.org/packages/code16/privat)

Privat is a very simple password protection for Laravel projects. It's useful for websites in a staging state.

![Screenshot](https://imgur.com/a/UsJtuF2)

## Usage

### Install with composer

```sh
composer require code16/privat
```

### Configure Privat via .env keys

```sh
PRIVAT_ENABLED=true
PRIVAT_PASSWORD=mypassword
```

## Advanced usage

### Choose impacted middleware groups

By default, Privat will protect the `web` middleware group. If you want to impact other groups, you can tweak the corresponding .env key:

```sh
PRIVAT_MIDDLEWARE_GROUP=web,admin
```

### Handle exceptions

You can exclude some hosts or URLs from Privat:

```sh
PRIVAT_EXCEPTED_URLS="/login,/admin"
PRIVAT_EXCEPTED_HOSTS="admin.mywebsite.com"
```

### Waiting page

If you need to present a public waiting page, set the waiting page view name in the `PRIVAT_WAITING_VIEW` env key:

```sh
PRIVAT_WAITING_VIEW="demo.waiting"
```

From then, all requests without the Privat registration will be redirected to `/privat_waiting` which will render the configured view, except `/privat`, which will still present the Privat form.

### Publish the config file

Of course, you can publish the config file instead of using env variables (even if we think it’s more convenient for such a tool):

```sh
php artisan vendor:publish --provider="Code16\Privat\PrivatServiceProvider"
```

## How does it work

Quite simple: if the given password is correct, Privat sets a session property, and look for it on each request. So, obviously, Privat won't work on non session based systems (an API for instance).

## License

MIT
