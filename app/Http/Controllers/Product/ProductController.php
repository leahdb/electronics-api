<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductResource;
use App\Http\Responses\Dashboard\DashboardResponse;
use App\Http\Responses\Dashboard\GeneralErrorResponse;
use App\Http\Responses\Dashboard\ValidationErrorResponse;
use App\Models\Product;
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
        $validator = Validator::make($data, Product::getStoreValidationRules(), Product::getCustomErrorMessages());

        if ($validator->fails()) {
            return ValidationErrorResponse::new($validator->errors())->json();
        }

        $product = Product::query()->create($data);
        $product->save();

        $resource = new ProductResource($product);
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
        $validator = Validator::make($data, Product::getUpdateValidationRules(), Product::getCustomErrorMessages());

        if ($validator->fails()) {
            return ValidationErrorResponse::new($validator->errors())->json();
        }

        $product = new Product();
        $data = $request->only($product->getFillable());
        $product = Product::query()->find($id);
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
