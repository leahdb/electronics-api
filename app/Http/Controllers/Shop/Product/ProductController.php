<?php

namespace App\Http\Controllers\Shop\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Responses\Dashboard\DashboardResponse;
use App\Http\Responses\Dashboard\GeneralErrorResponse;
use App\Http\Responses\Dashboard\ValidationErrorResponse;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\PetType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->has('perPage') ? $request->get('perPage') : 15;
        $currentPage = $request->has('page') ? $request->get('page') : 1;
        $productBuilder = Product::query()->with(['images', 'category']);

        // Existing code for fetching brands
        $brands = Product::select('brand_name')->distinct()->pluck('brand_name')->sort();

        // Extract filter and sorting options from the request
        $selectedCategories = $request->get('categories', []);
        $selectedBrands = $request->get('brands', []);
        $minPrice = $request->get('minPrice', null);
        $maxPrice = $request->get('maxPrice', null);
        $sortOption = $request->get('sort', 0);

        // Modify the product query based on filters and sorting
        if (!empty($selectedCategories)) {
            $selectedCategoriesArray = explode(',', $selectedCategories);
            $categoryIds = $this->getCategoryAndChildrenIds($selectedCategoriesArray);
            $productBuilder->whereIn('product_category_id', $categoryIds);
        }

        if (!empty($selectedBrands)) {
            // Explode the brands string into an array
            $selectedBrandsArray = explode(',', $selectedBrands);

            // Use the exploded array in the whereIn clause for brands
            $productBuilder->whereIn('brand_name', $selectedBrandsArray);
        }        


        if ($minPrice !== null) {
            $productBuilder->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $productBuilder->where('price', '<=', $maxPrice);
        }

        // Pagination logic remains the same
        $paginator = $productBuilder->paginate($perPage, ['*'], 'page', $currentPage)->appends(request()->query());

        $paginationData = $paginator->toArray();
        
        $paginationData['data'] = ProductResource::collection($paginator->items())->toArray($request);

        // Existing code for fetching categories
        $categories = ProductCategory::all();

        $nestedCategories = [];

        foreach ($categories as $category) {
            if ($category->parent_category_id === null) {
                $nestedCategories[$category->title] = [];
                $nestedCategories[$category->title][] = [
                    'id' => $category->id,
                    'title' => $category->title,
                    'description' => $category->description,
                    'slug' => $category->slug,
                ];
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

        $paginationData['categories'] = $nestedCategories;

        $paginationData['brands'] = $brands;

        return DashboardResponse::new($paginationData)->json();
    }

    private function getCategoryAndChildrenIds($selectedCategories)
    {
        $categoryIds = [];

        foreach ($selectedCategories as $selectedCategory) {
            // Add the ID of the selected category
            $categoryIds[] = $selectedCategory;

            // Fetch the children of the selected category
            $childrenIds = ProductCategory::where('parent_category_id', $selectedCategory)->pluck('id')->toArray();

            // Add the IDs of the children
            $categoryIds = array_merge($categoryIds, $childrenIds);
        }

        return array_unique($categoryIds);
    }



    public function show(Request $request, $id)
    {
        $product = Product::query()->find($id);
        if (!$product instanceof Product) {
            return GeneralErrorResponse::new('data not found')->json();
        }
        return DashboardResponse::new([
            'data' => new ProductResource($product)
        ])->json();
    }
}