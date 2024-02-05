<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ShopUserResource;
use App\Http\Responses\Dashboard\DashboardResponse;
use App\Http\Responses\Dashboard\GeneralErrorResponse;
use App\Http\Responses\Dashboard\ValidationErrorResponse;
use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class shopUserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shopID = auth()->user()->shop->id;
        $perPage = $request->has('perPage') ? $request->get('perPage') : 10;

        $builder = ShopUser::query()->orderByDesc('created_at');

        // @TODO we can do optional WHERE filtering conditions here

        $paginator = $builder->paginate($perPage)->appends(request()->query());
        $paginationData = $paginator->toArray();
        $paginationData['data'] = ShopUserResource::collection($paginator->items())->toArray($request);

        $fields = array('fields' => [
            ['key' => '', 'label' => 'Picture', 'type' => 'image', 'src' => ''],
            ['key' => '', 'label' => '', 'type' => 'link', 'href' => '/admin/-/view/:id'],
            ['key' => '', 'label' => '', 'type' => 'text'],
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
        $validator = Validator::make($data, ShopUser::getStoreValidationRules(), ShopUser::getCustomErrorMessages());

        if ($validator->fails()) {
            return ValidationErrorResponse::new($validator->errors())->json();
        }

        $shopUser = ShopUser::query()->create($data);
        $shopUser->save();

        $resource = new ShopUserResource($shopUser);
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
        $shopUser = ShopUser::query()->find($id);
        if (!$shopUser instanceof ShopUser) {
            return GeneralErrorResponse::new('data not found')->json();
        }
        return DashboardResponse::new([
            'data' => new ShopUserResource($shopUser)
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
        $validator = Validator::make($data, ShopUser::getUpdateValidationRules(), ShopUser::getCustomErrorMessages());

        if ($validator->fails()) {
            return ValidationErrorResponse::new($validator->errors())->json();
        }

        $shopUser = new ShopUser();
        $data = $request->only($shopUser->getFillable());
        $shopUser = ShopUser::query()->find($id);
        try {
            $shopUser->update($data);
            return DashboardResponse::new([
                'data' => new ShopUserResource($shopUser)
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
        $status = ShopUser::query()->whereIn('id', $ids)->delete();
        return DashboardResponse::new()->json();
    }
}
