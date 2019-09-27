<?php

namespace Code16\Privat;

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
        $isPrivateProtected = $this->isPrivatProtected($request);

        if(!$isPrivateProtected && $this->isPrivatUrl($request)) {
            return redirect('/');
        }

        if($isPrivateProtected && !$this->isPrivatUrl($request)) {
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

        foreach(explode(",", config('privat.except.hosts', "")) as $exceptedHost) {
            if($request->getHttpHost() == $exceptedHost) {
                return true;
            }
        }

        foreach(explode(",", config('privat.except.urls', "")) as $exceptedUrl) {
            if ($exceptedUrl !== '/') {
                $exceptedUrl = trim($exceptedUrl, '/');
            }

            if ($request->is($exceptedUrl)) {
                return true;
            }
        }

        return false;
    }
}