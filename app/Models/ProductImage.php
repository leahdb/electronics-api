<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductImage extends Model
{
    public const ATTR_ID = 'id';
	public const ATTR_PRODUCT_ID = 'product_id';
	public const ATTR_IMAGE = 'image';
	public const ATTR_CREATED_AT = 'created_at';
	public const ATTR_UPDATED_AT = 'updated_at';

    protected $table = 'product_images';

    protected $fillable = array(
        self::ATTR_ID,
		self::ATTR_PRODUCT_ID,
		self::ATTR_IMAGE,
		self::ATTR_CREATED_AT,
		self::ATTR_UPDATED_AT,
    );


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
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
