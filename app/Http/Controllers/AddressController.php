<?php

namespace App\Http\Controllers;

use App\Models\address;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $address = Address::create($request->validate([
            'name' => 'required',
        ]));
        return response()->json($address, 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $address = Address::find($id);
        if (!$address)
            return response()->json(['error' => 'Address not found'], 404);

        $address->update($request->validate([
            'name' => 'required',
        ]));
        return response()->json($address, 200);
    }

    public function destroy($id): JsonResponse
    {
        $address = Address::find($id);
        if (!$address)
            return response()->json(['error' => 'Address not found'], 404);
        $address->delete();
        return response()->json(['message' => 'Address deleted successfully'], 200);
    }
}
