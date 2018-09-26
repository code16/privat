<?php

namespace Code16\Privat\Controllers;

class PrivatController
{

    public function index()
    {
        if (!config("privat.restricted")) {
            return redirect("/");
        }

        return view("privat::form");
    }

    public function store()
    {
        if (!config("privat.restricted")) {
            return redirect("/");
        }

        if (config("privat.password") && request()->get("password") === config("privat.password")) {
            session()->put("privat_key", true);

            return redirect()->intended('/');
        }

        return redirect()
            ->to("/privat")
            ->with("message", trans("privat::ui.invalid_password_message"));
    }
}