<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;


class ShopUser extends Authenticatable implements JWTSubject
{
    use HasRoles;

    public const ROLE_SUPER_ADMIN = 'super-admin';
    public const ROLE_SHOP_CLIENT = 'shop-client';

    public const ATTR_CREATED_AT = 'created_at';
	public const ATTR_EMAIL = 'email';
	public const ATTR_FULL_NAME = 'full_name';
	public const ATTR_ID = 'id';
	public const ATTR_PASSWORD = 'password';
	public const ATTR_PHONE_NUMBER = 'phone_number';
	public const ATTR_PHONE_NUMBER_CC = 'phone_number_cc';
	public const ATTR_REMEMBER_TOKEN = 'remember_token';
	public const ATTR_UPDATED_AT = 'updated_at';

    protected $table = 'shop_users';

    protected $fillable = array(
        self::ATTR_CREATED_AT,
		self::ATTR_EMAIL,
		self::ATTR_FULL_NAME,
		self::ATTR_ID,
		self::ATTR_PASSWORD,
		self::ATTR_PHONE_NUMBER,
		self::ATTR_PHONE_NUMBER_CC,
		self::ATTR_REMEMBER_TOKEN,
		self::ATTR_UPDATED_AT,
    );

    public static function getStoreValidationRules(): array
    {
        return array(
            'full_name' => 'required',
            'email' => 'required|email|unique:shop_users,email',
            'phone_number_cc' => 'required|string|max:10',
            'phone_number' => 'required',
            'password' => 'required|string|min:8',
        );
    }

    public static function getUpdateValidationRules(): array
    {
        return array(
            self::ATTR_FULL_NAME => 'required',
            self::ATTR_EMAIL => 'required|email',
            self::ATTR_PHONE_NUMBER_FULL => 'required',
        );
    }

    public static function getLoginValidationRules(): array
    {
        return array(
            self::ATTR_EMAIL => 'required|email',
            self::ATTR_PASSWORD => 'required'
        );
    }

    public static function getValidationCustomMessages(): array
    {
        return array(
            self::ATTR_EMAIL.'.required' => 'Email is needed for authentication',
        );
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        //return [];
        return [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number_cc' => $this->phone_number_cc,
            'phone_number' => $this->phone_number,
            'roles' => $this->getRoleNames()->toArray(),
        ];
    }

    public function getMenus()
    {
        $all = config('dashboard.menus');
        $roles = $this->getRoleNames()->toArray();

        $availableMenusForUser = array();
        foreach ($all as $role => $menus) {
            if (in_array($role, $roles)) {
                $availableMenusForUser = array_merge($availableMenusForUser, $menus);
            }
        }

        return $availableMenusForUser;
    }

}

