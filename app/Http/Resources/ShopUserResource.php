<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopUserResource extends JsonResource
{
    protected $attributesToDisplay = array(
        'id' => true,
        'first_name' => true,
        'last_name' => true,
    );
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $modelAttributes = parent::toArray($request);
        $resourceAttributes = array();
        foreach ($modelAttributes as $key => $value) {
            if (!isset($this->attributesToDisplay[$key])) {
                continue;
            }
            $resourceAttributes[$key] = $value;
        }
        return $resourceAttributes;
    }

}
