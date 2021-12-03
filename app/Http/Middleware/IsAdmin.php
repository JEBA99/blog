<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class IsAdmin
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
        // ddd(User::find($request->post->user_id)->is_admin);
        if(User::find($request->post->user_id)->is_admin == 0) {
            // ddd("Inside middleware");
            return redirect('/');
        }
        return $next($request);
    }
}
