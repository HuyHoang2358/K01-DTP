<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\address;
use App\Models\cityModel;
use App\Models\CityObject;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CityObjectController extends Controller
{
    public function index(): JsonResponse
    {

        return response()->json(CityObject::all(), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $address = Address::create(['name'=>$input['address'] ?? "" ]);
        $position = Position::create([
                'latitude'=>$input['latitude'],
                'longitude'=>$input['longitude'],
                'height'=>$input['height']]
        );
        $cityModel = CityModel::create([
            'name' => $input['city_model_name'],
            'model_code' => $input['city_model_code'],
            'texture_model_url' => $input['city_model_texture_model_url'],
            'no_texture_model_url' => $input['city_model_no_texture_model_url'],
            'object_category_id' => $input['object_category_id'],
            'scale' => $input['city_model_scale'],
            'pitch' => $input['city_model_pitch'],
            'heading' => $input['city_model_heading'],
            'roll' => $input['city_model_roll'],
        ]);

        $cityObject = CityObject::create([
            'name' => $input['name'],
            'description' => $input['description'] ?? "",
            'city_id' => $input['city_id'],
            'address_id' => $address->id,
            'position_id' => $position->id,
            'start_date'=> null,
            'end_date' => null,
            'city_model_id' => $cityModel->id,
            'is_show_name' => $input['is_show_name'],
            'name_height' => $input['name_height'],
        ]);
        return response()->json($cityObject, 200);
    }
}
