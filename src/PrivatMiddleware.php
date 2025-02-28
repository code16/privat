<?php

namespace Code16\Privat;

use Closure;

class PrivatMiddleware
{
    public function handle($request, Closure $next)
    {
        $isPrivatProtected = $this->isPrivatProtected($request);

        if (!$isPrivatProtected && $this->isPrivatUrl($request)) {
            return redirect('/');
        }

        if ($isPrivatProtected && !$this->isPrivatUrl($request)) {
            if ($this->hasWaitingPage()) {
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

    protected function isPrivatProtected($request): bool
    {
        return config('privat.enabled')
            && !session()->has('privat_key')
            && !$this->shouldPassThrough($request);
    }

    protected function hasWaitingPage(): bool
    {
        return !!config('privat.waiting_view');
    }

    protected function shouldPassThrough($request): bool
    {
        if ($this->hasWaitingPage() && $request->is('privat_waiting')) {
            return true;
        }

        if (array_any(
            explode(',', config('privat.except.hosts', '')),
            fn($exceptedHost) => $request->getHttpHost() == $exceptedHost
        )) {
            return true;
        }

        foreach (explode(',', config('privat.except.urls', '')) as $exceptedUrl) {
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