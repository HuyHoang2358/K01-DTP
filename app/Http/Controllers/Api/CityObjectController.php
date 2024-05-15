<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\address;
use App\Models\cityModel;
use App\Models\CityObject;
use App\Models\Position;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CityObjectController extends Controller
{
    use RespondsWithHttpStatus;

    public function index($city_id): JsonResponse
    {
        $cityObjects = CityObject::where('city_id','=', $city_id)
            ->with('address')->with('position')->with('cityModel')
            ->get()->toArray();
        return $this->success("", $cityObjects/*array_slice($cityObjects,0, 20)*/, 200);
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
            'is_show_name' => $input['is_show_name'] ?? 0,
            'name_height' => $input['name_height'] ?? 30,
        ]);

        return $this->success("", $cityObject, 200);
    }
}
