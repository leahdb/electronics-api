<?php

namespace App\Http\Middleware;

use App\Http\Responses\Dashboard\GeneralErrorResponse;
use App\Models\ShopdUser;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        if ($this->auth->guard('shop')->guest()) {
            // Retrieve JWT from the HttpOnly cookie
            $jwt = $request->cookie('shop_jwt');
            if (!$jwt) {
                return response()->json(['status' => 'error', 'message' => 'please login again']);
            }
            $request->headers->set('Authorization', 'Bearer ' . $jwt);
        }

        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
