<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('/privat/form', function () {
        if (!config("privat.restricted")) {
            return redirect("/");
        }

        return view("privat::form");
    });

    Route::post('/privat/form', function (Illuminate\Http\Request $request) {
        if (!config("privat.restricted")) {
            return redirect("/");
        }

        if (config("privat.password") && $request->get("password") === config("privat.password")) {
            session()->put("privat_key", true);

            return redirect()->intended('/');
        }

        return redirect()
            ->to("/privat/form")
            ->with("message", trans("privat::ui.invalid_password_message"));
    });

});