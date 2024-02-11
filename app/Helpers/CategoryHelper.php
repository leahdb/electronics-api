<?php

namespace App\Helpers;

class CategoryHelper
{

    public static function getNested($data, $parentAttr, $childIdAttr = 'id')
    {
        $map = array();
        foreach ($data as $category) {
            // @TODO clean this style hack later
            if (!$category[$parentAttr]) {
                $category['children'] = array();
                $map[$category[$childIdAttr]] = $category;
            }
        }

        foreach ($data as $category) {
            if ($category[$parentAttr]) {
                $map[$category[$parentAttr]]['children'][] = $category;
            }
        }

        return array_values($map);
    }

}
