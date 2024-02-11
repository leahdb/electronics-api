<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Helpers\CategoryHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductResource;
use App\Http\Responses\Dashboard\DashboardResponse;
use App\Http\Responses\Dashboard\GeneralErrorResponse;
use App\Http\Responses\Dashboard\ValidationErrorResponse;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->has('perPage') ? $request->get('perPage') : 10;

        $builder = Product::query()->with('images');

        if ($request->has('search')) {
            $search = $request->get('search');
            $builder->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('brand_name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        $paginator = $builder->orderByDesc('created_at')->paginate($perPage)->appends(request()->query());

        $paginationData = $paginator->toArray();
        
        $paginationData['data'] = ProductResource::collection($paginator->items())->toArray($request);

        $fields = array('fields' => [
            ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
            ['key' => 'name', 'label' => 'Title', 'type' => 'text'],
            ['key' => 'brand_name', 'label' => 'Brand', 'type' => 'text'],
            ['key' => 'price', 'label' => 'Price', 'type' => 'text'],
            ['key' => 'stock_quantity', 'label' => 'Stock', 'type' => 'text'],
            ['key' => 'actions', 'label' => 'Actions', 'type' => 'buttons', 'buttons' => ['edit', 'delete']],
        ]);
        $responseData = array_merge($paginationData, $fields);
        return DashboardResponse::new($responseData)->json();
    }

    /**
     * create form dependencies
     */
    public function create(Request $request)
    {
        $categories = ProductCategory::all()->toArray();
        $nestedCategories = CategoryHelper::getNested($categories, ProductCategory::ATTR_PARENT_CATEGORY_ID);

        $selectBoxCategories = array();
        foreach ($nestedCategories as $parentCategory) {
            if(isset($parentCategory['id'])){
                $selectBoxCategories[] = array(
                    'value' => $parentCategory['id'],
                    'category_id' => $parentCategory['id'],
                    'label' => $parentCategory['title'],
                );

                if (!isset($parentCategory['children'])) {
                    continue;
                }

                foreach ($parentCategory['children'] as $childCategory) {
                    $selectBoxCategories[] = array(
                        'value' => $childCategory['id'],
                        'category_id' => $childCategory['id'],
                        'label' => '_' . $childCategory['title'],
                    );
                }
            }
            
        }

        return DashboardResponse::new([
            'categories' => $selectBoxCategories
        ])->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->except(['image', 'images']);
        $validator = Validator::make($data, Product::getStoreValidationRules(), Product::getCustomErrorMessages());

        if ($validator->fails()) {
            return ValidationErrorResponse::new($validator->errors())->json();
        }

        $product = Product::query()->create($data);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imagePath = $imageFile->store('uploads/product_image', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        if ($request->hasFile('images') && !empty($request->file('images'))){

            $productId = $product->id;
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads/product_images', 'public');
                $productImage = new ProductImage();

                $productImage->product_id = $productId;
                $productImage->image = $path;

                $productImage->save();
            }
        }

        $product = $product->fresh();
        $images = $product->images;

        $resource = new ProductResource($product);
        $resource->additional(['images' => $images]);
        return DashboardResponse::new([
            'data' => $resource
        ])->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * edit form dependencies
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        $product = Product::query()->with('images')->find($id);
        
        if (!($product instanceof Product)) {
            return GeneralErrorResponse::new('Product Not Found')->json();
        }

        $resource = new ProductResource($product);

        $categories = ProductCategory::all()->toArray();
        $nestedCategories = CategoryHelper::getNested($categories, ProductCategory::ATTR_PARENT_CATEGORY_ID);

        $selectBoxCategories = array();
        foreach ($nestedCategories as $parentCategory) {
            if(isset($parentCategory['id'])){
                $selectBoxCategories[] = array(
                    'value' => $parentCategory['id'],
                    'category_id' => $parentCategory['id'],
                    'label' => $parentCategory['title'],
                );

                if (!isset($parentCategory['children'])) {
                    continue;
                }

                foreach ($parentCategory['children'] as $childCategory) {
                    $selectBoxCategories[] = array(
                        'value' => $childCategory['id'],
                        'category_id' => $childCategory['id'],
                        'label' => '_' . $childCategory['title'],
                    );
                }
            }
            
        }

        return DashboardResponse::new([
            'data' => $resource->toArray($request),
            'categories' => $selectBoxCategories,
        ])->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, Product::getUpdateValidationRules(), Product::getCustomErrorMessages());

        if ($validator->fails()) {
            return ValidationErrorResponse::new($validator->errors())->json();
        }

        $product = new Product();
        $data = $request->only($product->getFillable());

        $product = Product::query()->with('images')->find($id);

        if ($request->has('removedImages')) {
            $removedImages = explode(',', request('removedImages'));
            foreach ($removedImages as $imageId) {
                $image = $product->images->where('id', $imageId)->first();
                if ($image) {
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('image') && isset($data['image'])) {
            $imageFile = $data['image'];
            $imagePath = $imageFile->store('uploads/product_image', 'public');
            $product->image = $imagePath;
        }

        unset($data['image']);

        if ($request->hasFile('images') && !empty($request->file('images'))){

            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads/product_images', 'public');
                $productImage = new ProductImage();
                $productImage->product_id = $id;
                $productImage->image = $path;
                $productImage->save();
            }
        }

        try {
            $product->update($data);
            return DashboardResponse::new([
                'data' => new ProductResource($product)
            ])->json();
        } catch (\Exception $e) {
            return GeneralErrorResponse::new($e->getMessage())->json();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $ids = array($id);
        if ($request->has('ids')) {
            $ids = explode(',', $request->get('ids'));
        }
        $status = Product::query()->whereIn('id', $ids)->delete();
        return DashboardResponse::new()->json();
    }
}
