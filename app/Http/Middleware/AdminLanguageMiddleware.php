<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class AdminLanguageMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale');
        if (in_array($locale, config('app.supported_locales'), true)) {
            App::setLocale($locale);
            URL::defaults(['locale' => $locale]);
            session(['locale' => $locale]); // Store the locale in session
        }
        
        return $next($request);
    }
}
