<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        //admin မဟုတ်ရင်လုပ်ပိုင်ခွင့်မရှိဘူး
        if (Auth::user()->role != 'admin'){
            return abort(404);
        }

        //admin ဟုတ်ရင်ဆက်သွားမယ်

        return $next($request);
    }
}
