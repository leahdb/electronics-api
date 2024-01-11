<?php

namespace App\Http\Responses\Dashboard;

use Illuminate\Http\JsonResponse;

class DashboardResponse implements IDashboardResponse
{
    protected $responseData = array();

    public function __construct($rootLevelAttrs = array())
    {
        $this->responseData = array_merge(array(
            'status' => 'ok',
        ), $rootLevelAttrs);
    }

    public function json(): JsonResponse
    {
        return response()->json($this->responseData);
    }

    public static function new($rootLevelAttrs = array()): DashboardResponse
    {
        return new self($rootLevelAttrs);
    }
}
