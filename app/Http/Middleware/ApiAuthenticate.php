<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class ApiAuthenticate
{

    /**
     * Routes that should skip handle.
     *
     * @var array
     */
    protected $except = [
        'login',
    ];

    /**
     * Determine if the request has a URI that should pass through.
     *
     * @param Request $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }
            if ($request->route()->getName() == $except) {
                return true;
            }
        }

        return false;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->inExceptArray($request)) {
            if (!JWTAuth::getToken()) {
                return getThrowCatch('Unauthorized', 'Dont have any provided token', Response::HTTP_UNAUTHORIZED);
            }

            try {
                JWTAuth::parseToken()->authenticate();
            } catch (\Throwable $th) {
                return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_UNAUTHORIZED);
            }
        }
        return $next($request);
    }
}
