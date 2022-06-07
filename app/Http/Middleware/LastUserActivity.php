<?php

namespace App\Http\Middleware;

use App\Models\Session;
use App\Models\Team;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LastUserActivity
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
        if(Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(5);

            $lastSession = Session::where('user_id', '=', Auth::id())
                ->get()->last();

            if ($lastSession) {
                if (Carbon::parse($lastSession->last_activity)->addMinutes(30) < Carbon::now()) {
                    Session::create([
                        'user_id' => Auth::id(),
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->server('HTTP_USER_AGENT'),
                        'payload' => json_decode($request->getContent(), true),
                        'last_activity' => $expiresAt,
                    ]);
                } else if ($lastSession->last_activity < Carbon::now()) {
                    $lastSession->update([
                        'last_activity' => $expiresAt,
                    ]);
                }
            } else {
                Session::create([
                    'user_id' => Auth::id(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->server('HTTP_USER_AGENT'),
                    'payload' => json_decode($request->getContent(), true),
                    'last_activity' => $expiresAt,
                ]);
            }
        }
        return $next($request);
    }
}
