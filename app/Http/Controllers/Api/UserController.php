<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use RespondsWithHttpStatus;

    public function index(): JsonResponse
    {
        return $this->success("", User::with('position')->get(), 200);

    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $position = Position::create([
            'latitude' => $input['latitude'] ?? 0,
            'longitude' => $input['longitude'] ?? 0,
            'height' => $input['height'] ?? 0
        ]);
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'avatar_path' => $input['avatar_path'] ?? "/images/BCA/police.jpg",
            'position_id' => $position->id,
            'password' => bcrypt($input['password']) ?? bcrypt('123456'),
            'status' => 'active',
            'code' => $input['code']
        ]);
        return response()->json($user, 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();
        $user = User::find($id);
        if (!$user)
            return response()->json(['message' => 'User not found'], 404);

        $position = $user->position;
        $position->update([
            'latitude' => $input['latitude'] ?? $position->latitude,
            'longitude' => $input['longitude'] ?? $position->longitude,
            'height' => $input['height'] ?? $position->height
        ]);

        $user->update([
            'name' => $input['name'] ?? $user->name,
            'avatar_path' => $input['avatar_path'] ?? $user->avatar_path,
            'status' => $input['status'] ?? $user->status,
            'code' => $input['code'] ?? $user->code
        ]);

        return response()->json($user, 200);
    }


    public function destroy($id): JsonResponse
    {
        $user = User::find($id);
        if (!$user)
            return response()->json(['message' => 'User not found'], 404);
        $user->delete();
        return response()->json(['message' => 'User deleted'], 200);
    }

}
