<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    public const ATTR_ID = 'id';
	public const ATTR_NAME = 'name';
	public const ATTR_BRAND_NAME = 'brand_name';
    public const ATTR_SLUG = 'slug';
	public const ATTR_DESCRIPTION = 'description';
	public const ATTR_IMAGE = 'image';
	public const ATTR_INDEX = 'index';
	public const ATTR_PRICE = 'price';
	public const ATTR_STOCK_QUANTITY = 'stock_quantity';
	public const ATTR_PRODUCT_CATEGORY_ID = 'product_category_id';
	public const ATTR_MOQ = 'moq';
	public const ATTR_CREATED_AT = 'created_at';
	public const ATTR_UPDATED_AT = 'updated_at';

    protected $table = 'products';

    protected $fillable = array(
        self::ATTR_ID,
		self::ATTR_NAME,
		self::ATTR_BRAND_NAME,
        self::ATTR_SLUG,
		self::ATTR_DESCRIPTION,
		self::ATTR_IMAGE,
		self::ATTR_INDEX,
		self::ATTR_PRICE,
		self::ATTR_STOCK_QUANTITY,
		self::ATTR_PRODUCT_CATEGORY_ID,
		self::ATTR_MOQ,
		self::ATTR_CREATED_AT,
		self::ATTR_UPDATED_AT,
    );

    protected $with = array('images', 'category');


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
        
    }

    public function category()
	{
		return $this->belongsTo(ProductCategory::class, self::ATTR_PRODUCT_CATEGORY_ID);
	}

    public function images()
    {
        return $this->hasMany(ProductImage::class, ProductImage::ATTR_PRODUCT_ID);
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
