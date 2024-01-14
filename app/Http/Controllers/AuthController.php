<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ShopUserResource;
use App\Http\Responses\Dashboard\DashboardResponse;
use App\Http\Responses\Dashboard\GeneralErrorResponse;
use App\Http\Responses\Dashboard\ValidationErrorResponse;
use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;


class AuthController extends Controller
{

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), ShopUser::getLoginValidationRules(), ShopUser::getValidationCustomMessages());

        if ($validator->fails()) {
            $response = new ValidationErrorResponse($validator->errors());
            return $response->json();
        }

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = auth('shop')->attempt($credentials, ['guard' => 'shop'])) {
                $response = new GeneralErrorResponse('Invalid credentials');
                return $response->json();
            }
        } catch (Exception $e) {
            $response = new GeneralErrorResponse('Could not login, please try again. ' . $e->getMessage());
            return $response->json();
        }

        $cookie = cookie('shop_jwt', $token, config('jwt.ttl'), '/', null, true, true, 'None');

        return DashboardResponse::new(['token' => $token])->json()->withCookie($cookie);

    }


    public function getAuthenticatedUser(Request $request)
    {
        $user = auth()->user();
        $resource = new ShopUserResource($user);
        // $response = new DashboardResponse($resource->toArray($request));
        // return $response->json();
        return DashboardResponse::new([
            'data' => [
                'user' => $resource,
                'menus' => $user->getMenus(),
                'role' => $user->getRoleNames()
            ]
        ])->json();
    }



    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        $cookie = cookie()->forget('shop_jwt');
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully logged out'
        ])->withCookie($cookie);

    }

}
