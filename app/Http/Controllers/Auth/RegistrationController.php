<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\RegistrationHelper;
use App\Http\Responses\Dashboard\DashboardResponse;
use App\Http\Responses\Dashboard\GeneralErrorResponse;
use App\Http\Responses\Dashboard\ValidationErrorResponse;
use App\Models\PetProfile;
use Illuminate\Support\Facades\Validator;
use App\Models\DashboardUser;
use Illuminate\Support\Facades\Hash;
use App\Models\Shop;
use App\Models\BankAccount;
use App\Jobs\ImportShopAndUserJob;
use App\Helpers\UpdateRepresentativeInfoHelper;
use App\Helpers\UpdateBankAccountInfoHelper;
use App\Helpers\UpdateBusinessInfoHelper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class RegistrationController extends Controller
{

    public function register(Request $request)
    {
        $registrationHelper = new RegistrationHelper($request);
        $registrationHelper->register();

        if ($registrationHelper->hasErrors()) {
            return ValidationErrorResponse::new($registrationHelper->getErrors())->json();
        }

        $token = $registrationHelper->getLoginToken();
        if (!$token) {
            return GeneralErrorResponse::new('Could not login')->json();
        }

        $cookie = cookie('dashboard_jwt', $token, config('jwt.ttl'), '/', null, true, true, 'None');

        return DashboardResponse::new([
            'message' => 'Registration data has been saved successfully.',
            'token' => $token,
        ])->json()->withCookie($cookie);
    }
}
