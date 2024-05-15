<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ObjectCategory;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ObjectCategoryController extends Controller
{
    use RespondsWithHttpStatus;
    public function index(): JsonResponse
    {
        $objectCategories = ObjectCategory::all();
        return $this->success("", $objectCategories, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $objectCategory = ObjectCategory::create([
            "name" => $input["name"],
            "slug" => $input["slug"],
            "description" => $input["description"],
            "parent_id" => $input["parent_id"]
        ]);

        return $this->success("", $objectCategory, 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $objectCategory = ObjectCategory::find($id);
        if (!$objectCategory)
            $this->failure("No found object category", $objectCategory, 404);
        $input = $request->all();
        $objectCategory->update([
            "name" => $input["name"],
            "slug" => $input["slug"],
            "description" => $input["description"],
            "parent_id" => $input["parent_id"]
        ]);

        return $this->success("", $objectCategory, 200);
    }

    public function destroy($id): JsonResponse
    {
        $objectCategory = ObjectCategory::find($id);
        if (!$objectCategory)
            $this->failure("No found object category", $objectCategory, 404);
        $objectCategory->delete();
        return $this->success("Delete successfully", "", 200);
    }

}
