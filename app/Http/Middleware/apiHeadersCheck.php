<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class apiHeadersCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        if(!in_array($request->headers->get('accept'), ['application/json', 'Application/Json']))
            return response()->json(['message' => 'Unauthenticated.'], 401);

        return $next($request);
    }
}
