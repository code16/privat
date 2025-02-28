<?php

namespace Code16\Privat\Controllers;

class PrivatController
{
    public function create()
    {
        return view('privat::form');
    }

    public function store()
    {
        if (!config('privat.enabled')) {
            return redirect()->intended('/');
        }

        if (config('privat.password') && request()->get('password') === config('privat.password')) {
            session()->put('privat_key', true);

            return redirect()->intended('/');
        }

        return redirect()
            ->to('/privat')
            ->with('error', trans('privat::ui.invalid_password_message'));
    }
}