<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('/privat', function () {
        if (!config("privat.restricted")) {
            return redirect("/");
        }

        return view("privat::form");
    });

    Route::post('/privat', function (Illuminate\Http\Request $request) {
        if (!config("privat.restricted")) {
            return redirect("/");
        }

        if (config("privat.password") && $request->get("password") === config("privat.password")) {
            session()->put("privat_key", true);

            return redirect()->intended('/');
        }

        return redirect()
            ->to("/privat")
            ->with("message", trans("privat::ui.invalid_password_message"));
    });

    Route::get('/privat_waiting', function () {
        if (!config("privat.waiting_view")) {
            return redirect("/");
        }

        return view(config("privat.waiting_view"));
    });

});