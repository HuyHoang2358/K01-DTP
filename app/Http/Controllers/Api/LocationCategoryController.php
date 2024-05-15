<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PositionType;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationCategoryController extends Controller
{
    use RespondsWithHttpStatus;

    public function index(): JsonResponse
    {
        $locationCategories = PositionType::all();
        return $this->success("", $locationCategories, 200);
    }
}
