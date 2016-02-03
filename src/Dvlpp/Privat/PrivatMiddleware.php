<?php

namespace Dvlpp\Privat;

class PrivatMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if(!$request->is('privat')
            && config("privat.restricted")
            && !session()->has("privat_key")) {

            session()->put('url.intended', $request->url());
            return redirect('/privat');
        }

        return $next($request);
    }
}