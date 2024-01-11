<?php

namespace App\Http\Responses\Dashboard;

use Illuminate\Http\JsonResponse;

class GeneralErrorResponse implements IDashboardResponse
{
    const TYPE_AUTH = 'auth';
    protected $responseData = array();

    public function __construct($errorMessage = 'General Error')
    {
        $this->responseData = array(
            'status' => 'error',
            'type' => 'general',
            'message' => $errorMessage
        );
    }

    public function type($type) {
        $this->responseData['type'] = $type;
        return $this;
    }

    public function json(): JsonResponse
    {
        return response()->json($this->responseData);
    }

    public static function new($errorMessage)
    {
        return new self($errorMessage);
    }
}
