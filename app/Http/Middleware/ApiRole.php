<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user()->hasRole(explode('|', $role)))
            throw new ApiException(403, 'Forbidden for you');
        return $next($request);
    }
}
