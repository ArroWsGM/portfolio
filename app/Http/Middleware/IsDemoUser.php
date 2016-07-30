<?php

namespace App\Http\Middleware;

use Closure;

class IsDemoUser
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

        //dd($user->email);

        if($user && $user->email != 'demo@demo.demo')
            return $next($request);
        
        if ($request->ajax() || $request->wantsJson())
            return response()->json(['error' => 'You do not have permission to do this']);
        else
            return back()->with('msg_error', 'You do not have permission to do this');
    }
}
