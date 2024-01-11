<?php

namespace App\Http\Responses\Dashboard;

use Illuminate\Http\JsonResponse;

interface IDashboardResponse
{
    public function json(): JsonResponse;
}
