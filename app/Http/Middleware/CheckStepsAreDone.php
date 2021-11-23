<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use function PHPUnit\Framework\once;

class CheckStepsAreDone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (!Cookie::get('has-done-step-1')
                || !Cookie::get('has-done-step-2')
                || !Cookie::get('has-done-step-3')) {
                return redirect(RouteServiceProvider::STEPS);
            }
        }

        return $next($request);
    }
}
