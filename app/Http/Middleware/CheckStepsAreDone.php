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

            if (!Cookie::get('hasDoneFirstStep')) {
                return redirect(RouteServiceProvider::FIRST_STEP);
            }


        }

        return $next($request);
    }
}
