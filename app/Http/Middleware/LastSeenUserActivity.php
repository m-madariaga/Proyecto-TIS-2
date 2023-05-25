<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

use Auth;
use Cache;
use Carbon\Carbon;

class LastSeenUserActivity
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
        if (Auth::check()) {
            $expireTime = Carbon::now()->addMinute(1); // keep online for 1 min
            Cache::put('is_online'.Auth::user()->id, true, $expireTime);

            //Last Seen
            $user = User::find(Auth::user()->id);
            $user->last_seen = Carbon::now();
            $user->save();
        }
        return $next($request);
    }
}
