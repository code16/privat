<?php

namespace Code16\Privat\Tests;

use Illuminate\Support\Facades\Route;

class PrivatTest extends TestCase
{

    /** @test */
    public function we_get_the_form_page_when_privat_is_on()
    {
        $this->app['config']->set('privat.restricted', true);

        $this->followingRedirects()
            ->get('/')
            ->assertSee(trans("privat::ui.form_title"));
    }

    /** @test */
    public function an_incorrect_password_send_us_back_to_the_form_page()
    {
        $this->app['config']->set('privat.restricted', true);
        $this->app['config']->set('privat.password', 'aaa');

        $this->post('/privat', ["password" => "bbb"])
            ->assertRedirect('/privat');
    }

    /** @test */
    public function we_can_access_the_site_with_the_correct_password()
    {
        $this->app['config']->set('privat.restricted', true);
        $this->app['config']->set('privat.password', 'aaa');

        $this->post('/privat', ["password" => "aaa"])
            ->assertRedirect('/');

        $this->followingRedirects()
            ->get('/')
            ->assertDontSee(trans("privat::ui.form_title"));
    }

    /** @test */
    public function we_can_access_the_website_when_privat_is_off()
    {
        $this->app['config']->set('privat.restricted', false);

        $this->followingRedirects()
            ->get('/')
            ->assertDontSee(trans("privat::ui.form_title"));
    }

    /** @test */
    public function we_cant_see_the_privat_form_when_privat_is_off()
    {
        $this->app['config']->set('privat.restricted', false);

        $this->followingRedirects()
            ->get('/privat')
            ->assertDontSee(trans("privat::ui.form_title"));
    }

    /** @test */
    public function we_get_the_waiting_page_when_privat_is_on_and_we_defined_a_waiting_page()
    {
        $this->app['config']->set([
            'privat' => [
                'restricted' => true,
                'waiting_view' => 'test::waiting'
            ]
        ]);

        $this->app['view']->addNamespace("test", __DIR__ . '/fixtures/views');

        $this->followingRedirects()
            ->get('/')
            ->assertSee('Waiting page');
    }

    /** @test */
    public function we_get_the_privat_form_even_with_a_waiting_page_on_the_privat_url()
    {
        $this->app['config']->set([
            'privat' => [
                'restricted' => true,
                'waiting_view' => 'test::waiting'
            ]
        ]);

        $this->followingRedirects()
            ->get('/privat')
            ->assertSee(trans("privat::ui.form_title"));
    }

    /** @test */
    public function we_dont_get_the_waiting_page_when_privat_is_off()
    {
        $this->app['config']->set([
            'privat' => [
                'restricted' => false,
                'waiting_view' => 'test::waiting'
            ]
        ]);

        $this->followingRedirects()
            ->get('/')
            ->assertDontSee('Waiting page');
    }

    /** @test */
    public function we_cant_reach_get_the_waiting_page_when_privat_is_off()
    {
        $this->app['config']->set([
            'privat' => [
                'restricted' => false,
                'waiting_view' => 'test::waiting'
            ]
        ]);

        $this->followingRedirects()
            ->get('/privat_waiting')
            ->assertDontSee(trans("privat::ui.form_title"));
    }

    /** @test */
    public function we_can_exclude_urls_from_privat()
    {
        $this->app['config']->set([
            'privat' => [
                'restricted' => true,
                'except' => [
                    'urls' => '/test,/test2'
                ]
            ]
        ]);

        Route::get('/test', function() { return ""; });
        Route::get('/test2', function() { return ""; });
        Route::get('/test3', function() { return ""; });

        $this->get('/')->assertRedirect('/privat');
        $this->get('/test')->assertStatus(200);
        $this->get('/test2')->assertStatus(200);
        $this->get('/test3')->assertRedirect('/privat');
    }

    /** @test */
    public function we_can_exclude_hosts_from_privat()
    {
        $this->app['config']->set([
            'privat' => [
                'restricted' => true,
                'except' => [
                    'hosts' => 'opened.test,opened2.test'
                ]
            ]
        ]);

        Route::get('/', function() { return ""; });

        $this->get('http://localhost')->assertRedirect("/privat");
        $this->get('http://some-host.com')->assertRedirect("/privat");
        $this->get('http://opened.test')->assertStatus(200);
        $this->get('http://opened2.test')->assertStatus(200);
    }
}