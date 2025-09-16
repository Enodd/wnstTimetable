<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $supportedLocales = config('app.supported_languages');
        $locale = $request->route('locale') ?? null;
        if ($locale && in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
            return $next($request);
        }
        $preferredLocale = $request->getPreferredLanguage($supportedLocales);
        $locale = $preferredLocale ?? config('app.fallback_locale');
        return redirect()->to("/{$locale}");
    }
}
