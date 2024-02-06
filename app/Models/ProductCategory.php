<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    public const ATTR_ID = 'id';
	public const ATTR_TITLE = 'title';
	public const ATTR_SLUG = 'slug';
	public const ATTR_PARENT_CATEGORY_ID = 'parent_category_id';
	public const ATTR_CREATED_AT = 'created_at';
	public const ATTR_UPDATED_AT = 'updated_at';

    protected $table = 'product_categories';

    protected $fillable = array(
        self::ATTR_ID,
		self::ATTR_TITLE,
		self::ATTR_SLUG,
		self::ATTR_PARENT_CATEGORY_ID,
		self::ATTR_CREATED_AT,
		self::ATTR_UPDATED_AT,
    );

    public function children(): HasMany
    {
        return $this->hasMany(ProductCategory::class, self::ATTR_PARENT_CATEGORY_ID);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, self::ATTR_PARENT_CATEGORY_ID);
    }

    public function products()
    {
        return $this->hasMany(Product::class, Product::ATTR_PRODUCT_CATEGORY_ID);
    }


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
