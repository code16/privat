<?php

namespace Code16\Privat\Controllers;

class PrivatWaitingController
{

    public function index()
    {
        if (!config("privat.waiting_view")) {
            return redirect("/");
        }

        return view(config("privat.waiting_view"));
    }
}