<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
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
        // Auth::logout();
        // return redirect(route('login'));
        
        if (auth()->id()) {

            $user = User::where('id', auth()->id())->first();

            if ($user->email == $user->isAdmin()) {
                return $next($request);
            }

            return redirect(route('client.dashboard'));
        }
        
        return redirect(route('home'));
    }
}
