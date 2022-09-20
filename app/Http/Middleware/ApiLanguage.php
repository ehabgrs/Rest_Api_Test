<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
		$app_languages = ['ar','en','es'];
		
		app()->setLocale('en');
		
		if( isset($request->lang) && in_array($request->lang, $app_languages) ) {
			app()->setLocale($request->lang);
		}
        return $next($request);
    }
}
