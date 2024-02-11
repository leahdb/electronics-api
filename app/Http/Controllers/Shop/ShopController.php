<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Responses\Dashboard\DashboardResponse;
use App\Http\Responses\Dashboard\GeneralErrorResponse;
use App\Http\Responses\Dashboard\ValidationErrorResponse;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{

    public function index(Request $request)
    {
        //$productBuilder = Product::query()->with(['images', 'category']);


        // Pagination logic remains the same
        // $paginator = $productBuilder->paginate($perPage, ['*'], 'page', $currentPage)->appends(request()->query());

        // $paginationData = $paginator->toArray();
        
        // $paginationData['data'] = ProductResource::collection($paginator->items())->toArray($request);

        // Existing code for fetching categories
        $categories = ProductCategory::all();

        $nestedCategories = [];

        foreach ($categories as $category) {
            if ($category->parent_category_id === null) {
                $nestedCategories[$category->title] = [];

                foreach ($categories as $subcategory) {
                    if ($subcategory->parent_category_id === $category->id) {
                        $nestedCategories[$category->title][] = [
                            'id' => $subcategory->id,
                            'title' => $subcategory->title,
                            'description' => $subcategory->description,
                            'slug' => $subcategory->slug,
                        ];
                    }
                }
            }
        }

        $paginationData = [];

        $paginationData['categories'] = $nestedCategories;

        return DashboardResponse::new($paginationData)->json();
    }
}