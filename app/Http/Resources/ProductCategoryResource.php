<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $attrs = parent::toArray($request);
        $attrs[ProductCategory::ATTR_IMAGE] = cdnasset($attrs[ProductCategory::ATTR_IMAGE]);
        return $attrs;
    }
}
