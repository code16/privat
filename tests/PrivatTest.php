<?php

class PrivatTest extends TestCase
{
    protected $baseUrl = 'http://localhost:1234';

    /** @test */
    public function we_get_the_form_page_when_privat_is_on()
    {
        $this->app['config']->set('privat.restricted', true);

        $this->visit('/')
            ->see(trans("privat::ui.form_title"));
    }

    /** @test */
    public function an_incorrect_password_send_us_back_to_the_form_page()
    {
        $this->app['config']->set('privat.restricted', true);
        $this->app['config']->set('privat.password', 'aaa');

        $this->post('/privat', ["password" => "bbb"]);

        $this->assertRedirectedTo('/privat');
    }

    /** @test */
    public function we_can_access_the_site_with_the_correct_password()
    {
        $this->app['config']->set('privat.restricted', true);
        $this->app['config']->set('privat.password', 'aaa');

        $this->post('/privat', ["password" => "aaa"]);

        $this->assertRedirectedTo('/');

        $this->visit('/')
            ->dontSee(trans("privat::ui.form_title"));
    }

    /** @test */
    public function we_can_access_the_website_when_privat_is_off()
    {
        $this->app['config']->set('privat.restricted', false);

        $this->visit('/')
            ->dontSee(trans("privat::ui.form_title"));
    }


    /** @test */
    public function we_cant_see_the_privat_form_when_privat_is_off()
    {
        $this->app['config']->set('privat.restricted', false);

        $this->visit('/privat')
            ->dontSee(trans("privat::ui.form_title"));
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

        $this->visit('/')
            ->see('Waiting page');
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

        $this->visit('/privat')
            ->see(trans("privat::ui.form_title"));
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

        $this->visit('/')
            ->dontSee('Waiting page');
    }
}