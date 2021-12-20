<?php

namespace App\Http\Middleware;

use Cache;
use Closure;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-'. Auth::user()->id, true, $expiresAt);

            User::where('id',Auth::user()->id)->update(['last_seen' => now()]);
        }

        return $next($request);
    }
}
