# Privat

Private is a very simple password gate for a Laravel project.
It is meant for websites in a staging state.

## Usage

### Install with composer

<code>composer require dvlpp/privat</code>

### Add Privat middleware in your project

Add the following line at the end of the $middleware array of the app/Http/Kernel file:

<code>\Dvlpp\Privat\PrivatMiddleware::class</code>

### Set Privat config

