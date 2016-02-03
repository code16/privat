<?php

Route::get('/privat/form', function() {
    if(!config("privat.restricted")) {
        return redirect("/");
    }

    return view("privat::login");
});

Route::post('/privat/form', function(Illuminate\Http\Request $request) {
    if(!config("privat.restricted")) {
        return redirect("/");
    }

    if(config("privat.password") && $request->get("password") === config("privat.password")) {
        session()->put("privat_key", true);
        return redirect()->intended('/');
    }

    return redirect()->back()->with("message", "Invalid password");
});