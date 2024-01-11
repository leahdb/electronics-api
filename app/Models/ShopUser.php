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

    public const ATTR_CREATED_AT = 'created_at';
	public const ATTR_EMAIL = 'email';
	public const ATTR_FIRST_NAME = 'first_name';
	public const ATTR_ID = 'id';
	public const ATTR_LAST_NAME = 'last_name';
	public const ATTR_PASSWORD = 'password';
	public const ATTR_PHONE_NUMBER = 'phone_number';
	public const ATTR_PHONE_NUMBER_CC = 'phone_number_cc';
	public const ATTR_REMEMBER_TOKEN = 'remember_token';
	public const ATTR_UPDATED_AT = 'updated_at';

    protected $table = 'shop_users';

    protected $fillable = array(
        self::ATTR_CREATED_AT,
		self::ATTR_EMAIL,
		self::ATTR_FIRST_NAME,
		self::ATTR_ID,
		self::ATTR_LAST_NAME,
		self::ATTR_PASSWORD,
		self::ATTR_PHONE_NUMBER,
		self::ATTR_PHONE_NUMBER_CC,
		self::ATTR_REMEMBER_TOKEN,
		self::ATTR_UPDATED_AT,
    );

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
        return [];
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number_cc' => $this->phone_number_cc,
            'phone_number' => $this->phone_number,
            'roles' => $this->getRoleNames()->toArray(),
        ];
    }

}

