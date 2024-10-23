<?php

namespace App\Http\Middleware;

use App\Models\Personnel;
use Closure;
use Illuminate\Http\Request;

class APITokenPersonnel
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
        $tokenHeader = $request->header('Authorization');
        if ($tokenHeader && Personnel::where('api_token', '=', $tokenHeader)->exists()) {
          return $next($request);
        } else {
          return response()->json([
            'message' => 'Not a valid API Personnel request.',
          ]);
        }
    }
}
