<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateSignature
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasValidSignature()) {
            return redirect('/');
        }

        return $next($request);
    }
}
