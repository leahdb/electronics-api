<?php

namespace App\Helpers;
use App\Http\Responses\Dashboard\DashboardResponse;
use App\Http\Responses\Dashboard\GeneralErrorResponse;
use App\Models\ShopUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegistrationHelper
{

    protected $request;
    protected $data;
    protected $hasValidationErrors;
    protected $validationErrors;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->data = $request->all();
        $this->hasValidationErrors = false;
        $this->validationErrors = array();
    }

    public function register(): void
    {
        $this->validate();
        if ($this->hasValidationErrors) {
            return;
        }
        $shopUser = $this->createShopUser();
    }

    public function getLoginToken()
    {
        $credentials = array(
            'email' => $this->data['email'],
            'password' => $this->data['password'],
        );

        $token = false;
        try {
            $token = auth('shop')->attempt($credentials, ['guard' => 'shop']);
        } catch (Exception $e) {
            Log::error("PostRegistrationLogin Error", $this->data);
        }

        return $token;
    }

    public function validate()
    {
        $requestValidationRules = array(
            'full_name' => 'required',
            'email' => 'required',
            'phone_number_cc' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
        );

        $validator = Validator::make($this->data, $requestValidationRules);
        if ($validator->fails()) {
            $this->hasValidationErrors = true;
            $this->validationErrors = $validator->errors();
            return $this;
        }

        $validator = Validator::make($this->data, ShopUser::getStoreValidationRules());
        if ($validator->fails()) {
            $this->hasValidationErrors = true;
            $this->validationErrors = $validator->errors();
            return $this;
        }

        return $this;
    }

    public function createShopUser()
    {
        $user = new ShopUser([
            'full_name' => $this->data['full_name'],
            'email' => $this->data['email'],
            'phone_number_cc' => $this->data['phone_number_cc'],
            'phone_number' => $this->data['phone_number'],
            'password' => Hash::make($this->data['password']),
        ]);

        $user->save();

        $user->assignRole(ShopUser::ROLE_SHOP_CLIENT);

        return $user;
    }

    public function hasErrors() {
        return $this->hasValidationErrors;
    }

    public function getErrors() {
        return $this->validationErrors;
    }

}
