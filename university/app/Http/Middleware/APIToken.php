<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIToken
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
      if ($tokenHeader && Student::where('api_token', '=', $tokenHeader)->exists()) {
        return $next($request);
      } else {
        return response()->json([
          'message' => 'Not a valid API Student request.',
        ]);
      }
    }
}
