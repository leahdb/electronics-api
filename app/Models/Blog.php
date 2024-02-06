<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{

    public const ATTR_BODY = 'body';
	public const ATTR_CREATED_AT = 'created_at';
	public const ATTR_DASHBOARD_USER_ID = 'dashboard_user_id';
	public const ATTR_ID = 'id';
	public const ATTR_IMAGE = 'image';
	public const ATTR_PUBLISH_DATE = 'publish_date';
	public const ATTR_SLUG = 'slug';
	public const ATTR_TITLE = 'title';
	public const ATTR_UPDATED_AT = 'updated_at';

    protected $table = 'blogs';

    protected $fillable = array(
        self::ATTR_BODY,
		self::ATTR_CREATED_AT,
		self::ATTR_DASHBOARD_USER_ID,
		self::ATTR_ID,
		self::ATTR_IMAGE,
		self::ATTR_PUBLISH_DATE,
		self::ATTR_SLUG,
		self::ATTR_TITLE,
		self::ATTR_UPDATED_AT,
    );


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
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
