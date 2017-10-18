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
        if(!$this->isPrivatUrl($request) && $this->isPrivatProtected($request)) {

            if($this->hasWaitingPage()) {
                return redirect('/privat_waiting');
            }

            session()->put('url.intended', $request->url());

            return redirect('/privat');
        }

        return $next($request);
    }

    protected function isPrivatUrl($request)
    {
        return $request->is('privat');
    }

    /**
     * @param $request
     * @return bool
     */
    protected function isPrivatProtected($request)
    {
        return config("privat.restricted")
            && !session()->has("privat_key")
            && !$this->shouldPassThrough($request);
    }

    /**
     * @return bool
     */
    protected function hasWaitingPage()
    {
        return !!config("privat.waiting_view");
    }

    /**
     * @param $request
     * @return bool
     */
    protected function shouldPassThrough($request)
    {
        if($this->hasWaitingPage() && $request->is("privat_waiting")) {
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