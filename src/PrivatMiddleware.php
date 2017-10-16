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
        if(
            config("privat.restricted")
            && !session()->has("privat_key")
            && !$this->shouldPassThrough($request)
        ) {
            session()->put('url.intended', $request->url());
            return redirect('/privat');
        }

        return $next($request);
    }

    protected function shouldPassThrough($request)
    {
        if($request->is('privat')) {
            return true;
        }

        foreach ((array)config('privat.except') as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }
}