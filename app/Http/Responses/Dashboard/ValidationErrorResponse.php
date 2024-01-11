<?php

namespace App\Http\Responses\Dashboard;

use Illuminate\Http\JsonResponse;

class ValidationErrorResponse implements IDashboardResponse
{
    protected $responseData = array();

    public function __construct($errors)
    {
        $this->responseData = array(
            'status' => 'error',
            'type' => 'validation',
            'validations' => $errors,
        );
    }

    public function json(): JsonResponse
    {
        return response()->json($this->responseData);
    }

  public static function new($errors)
  {
    return new self($errors);
  }
}
