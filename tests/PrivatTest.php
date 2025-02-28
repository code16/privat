<?php

use Code16\Privat\PrivatMiddleware;
use Code16\Privat\Tests\TestCase;
use Illuminate\Support\Facades\Route;

uses(TestCase::class);

beforeEach(function () {
    config()->set('privat.enabled', true);
});

test('we get the form page when privat is on', function () {
    $this->get('/')->assertRedirect('/privat');
});

test('an incorrect password send us back to the form page', function () {
    config()->set('privat.password', 'aaa');

    $this->post('/privat', ['password' => 'bbb'])
        ->assertRedirect('/privat');
});

test('we can access the site with the correct password', function () {
    config()->set('privat.password', 'aaa');

    $this->post('/privat', ['password' => 'aaa'])
        ->assertRedirect('/');

    $this->get('/')->assertStatus(200);
});

test('we can access the website when privat is off', function () {
    config()->set('privat.enabled', false);

    $this->get('/')->assertStatus(200);
});

test('we get the waiting page when privat is on and we defined a waiting page', function () {
    config()->set('privat.waiting_view', 'test::waiting');

    $this->app['view']->addNamespace('test', __DIR__ . '/fixtures/views');

    $this->followingRedirects()
        ->get('/')
        ->assertSee('Waiting page');
});

test('we get the privat form even with a waiting page on the privat url', function () {
    config()->set('privat.waiting_view', 'test::waiting');

    $this->get('/privat')
        ->assertSee(trans('privat::ui.form_title'));
});

test('we dont get the waiting page when privat is off', function () {
    config()->set('privat.enabled', false);
    config()->set('privat.waiting_view', 'test::waiting');

    $this->get('/')
        ->assertStatus(200);
});

test('we cant reach get the waiting page when privat is off', function () {
    config()->set('privat.enabled', false);
    config()->set('privat.waiting_view', 'test::waiting');

    $this->get('/privat_waiting')
        ->assertRedirect('/');
});

test('we can exclude urls from privat', function () {
    config()->set('privat.except.urls', '/test,/test2');

    Route::middleware(PrivatMiddleware::class)->get('/test', fn () => '');
    Route::middleware(PrivatMiddleware::class)->get('/test2', fn () => '');
    Route::middleware(PrivatMiddleware::class)->get('/test3', fn () => '');

    $this->get('/')->assertRedirect('/privat');
    $this->get('/test')->assertStatus(200);
    $this->get('/test2')->assertStatus(200);
    $this->get('/test3')->assertRedirect('/privat');
});

test('we can exclude hosts from privat', function () {
    config()->set('privat.except.hosts', 'opened.test,opened2.test');

    Route::middleware(PrivatMiddleware::class)->get('/', fn () => '');

    $this->get('http://localhost')->assertRedirect('/privat');
    $this->get('http://some-host.com')->assertRedirect('/privat');
    $this->get('http://opened.test')->assertStatus(200);
    $this->get('http://opened2.test')->assertStatus(200);
});

test('we redirect to homepage on a privat url if privat is off', function () {
    config()->set('privat.enabled', false);

    $this->get('/privat')->assertRedirect('/');
});

test('we redirect to homepage on a privat excluded host', function () {
    config()->set('privat.except.hosts', 'opened.test');

    $this->get('http://opened.test/privat')->assertRedirect('/');
});
