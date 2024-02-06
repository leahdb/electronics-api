<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Responses\Dashboard\DashboardResponse;
use App\Http\Responses\Dashboard\GeneralErrorResponse;
use App\Http\Responses\Dashboard\ValidationErrorResponse;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shopProductCategories = ProductCategory::query()->get()->toArray();
        if ($request->has('nested')) {
            $shopProductCategories = CategoryHelper::getNested($shopProductCategories, ProductCategory::ATTR_PARENT_CATEGORY_ID);
        }

        return DashboardResponse::new(['data' => $shopProductCategories])->json();
    }

    /**
     * create form dependencies
     */
    public function create(Request $request)
    {
        return DashboardResponse::new()->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, ProductCategory::getStoreValidationRules(), ProductCategory::getCustomErrorMessages());

        if ($validator->fails()) {
            return ValidationErrorResponse::new($validator->errors())->json();
        }

        $productCategory = ProductCategory::query()->create($data);
        $productCategory->save();

        $resource = new ProductCategoryResource($productCategory);
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
        $productCategory = ProductCategory::query()->find($id);
        if (!$productCategory instanceof ProductCategory) {
            return GeneralErrorResponse::new('data not found')->json();
        }
        return DashboardResponse::new([
            'data' => new ProductCategoryResource($productCategory)
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
        return DashboardResponse::new()->json();
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
        $validator = Validator::make($data, ProductCategory::getUpdateValidationRules(), ProductCategory::getCustomErrorMessages());

        if ($validator->fails()) {
            return ValidationErrorResponse::new($validator->errors())->json();
        }

        $productCategory = new ProductCategory();
        $data = $request->only($productCategory->getFillable());
        $productCategory = ProductCategory::query()->find($id);
        try {
            $productCategory->update($data);
            return DashboardResponse::new([
                'data' => new ProductCategoryResource($productCategory)
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
        $status = ProductCategory::query()->whereIn('id', $ids)->delete();
        return DashboardResponse::new()->json();
    }
}
