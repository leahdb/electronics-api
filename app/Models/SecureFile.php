<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SecureFile extends Model
{
    public const ATTR_CREATED_AT = 'created_at';
	public const ATTR_FILE_DESCRIPTION = 'file_description';
    public const ATTR_FILE_NAME = 'file_name';
    public const ATTR_FILE_PATH = 'file_path';
	public const ATTR_ID = 'id';
	public const ATTR_TOKEN = 'token';
	public const ATTR_UPDATED_AT = 'updated_at';

    protected $table = 'secure_files';

    protected $fillable = array(
        self::ATTR_CREATED_AT,
		self::ATTR_FILE_DESCRIPTION,
        self::ATTR_FILE_NAME,
        self::ATTR_FILE_PATH,
		self::ATTR_ID,
		self::ATTR_TOKEN,
		self::ATTR_UPDATED_AT,
    );


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

    }

    public static function getStoreValidationRules()
    {
        return array(

        );
    }

    public static function getUpdateValidationRules()
    {
        return array(

        );
    }

    public static function getCustomErrorMessages()
    {
        return array(

        );
    }
}
