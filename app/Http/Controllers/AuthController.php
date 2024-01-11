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
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login(Request $request) {
        //return view('auth.login');
        return true;
    }


    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), ShopUser::getLoginValidationRules(), ShopUser::getValidationCustomMessages());

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'messages' => $validator->errors()]);
        }

        $isLoggedIn = Auth::guard('shop')->attempt($request->only([ShopUser::ATTR_EMAIL, ShopUser::ATTR_PASSWORD]));

        if (!$isLoggedIn) {
            return redirect()->back()->withErrors();
        }

        $request->session()->regenerate();

        $user = Auth::guard('shop')->user();

        //return redirect()->action([HomeController::class, 'index']);
        return true;

    }


    public function logout(Request $request) {
        Auth::guard('shop')->logout();
        return redirect()->action([self::class, 'login']);
    }
}
