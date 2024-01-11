<?php

namespace App\Http\Middleware;

use App\Models\ShopUser;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserRoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        //$allowedRoles = $roles;

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'please login']);
        }

        // foreach ($allowedRoles as $role) {
        //     /* @var ShopUser $user */
        //     if ($user->hasRole($role)) {
        //         return $next($request);
        //     }
        // }

        // return response()->json(['status' => 'error', 'message' => 'you require different a role for this action']);


        if ($user->hasRole(...$roles)) {
            return response()->json(['status' => 'error', 'message' => 'you require different a role for this action']);
        }

        return $next($request);

    }

}
