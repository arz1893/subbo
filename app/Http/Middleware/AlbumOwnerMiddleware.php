<?php

namespace App\Http\Middleware;

use Closure;

class AlbumOwnerMiddleware
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
        $user = $request->user();
        $album = $request->route('album');
        if($album->user_id != $user->id) {
            return redirect()->back();
        }
        return $next($request);
    }
}
