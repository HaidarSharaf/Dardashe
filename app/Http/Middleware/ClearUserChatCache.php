<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClearUserChatCache
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->routeIs('chat*')) {
            return $next($request);
        }

        if (auth()->check()) {
            Cache::forget('user_in_chat_' . auth()->id());
        }

        return $next($request);
    }
}
