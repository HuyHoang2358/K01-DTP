<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\PositionType;
use App\Models\TargetReconnaissance;
use App\Models\Task;
use App\Models\User;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class TaskController extends Controller
{
    use RespondsWithHttpStatus;

    public function index(?string $task_type = null): JsonResponse
    {
        if (!$task_type){
            $tasks = Task::with('users')->get();
            return $this->success("", $tasks, 200);
        }

        if ($task_type == 'protect')
            $tasks = Task::where('type', '=', $task_type)->with('route')->get();
        else
            $tasks =Task::where('type', '=', $task_type)->with(['targetReconnaissances'])->get();
        return $this->success("", $tasks, 200);
    }

    public function addTargetReconnaissance(Request $request): JsonResponse
    {
        $input = $request->all();
        $task = Task::find($input["task_id"]);
        $user = User::find($input["user_id"]);

        if ($task && $user){
            $user->tasks()->attach($input["task_id"]);
        }
        $position_type = PositionType::find($input["position_type_id"]);

        if(!$task || !$position_type || !$user)
            return $this->failure("Task or position type or user not found", 404);

        $position = Position::create([
            "latitude" => $input["position"]["latitude"],
            "longitude" => $input["position"]["longitude"],
            "height" => $input["position"]["height"],
        ]);
        $targetReconnaissance = TargetReconnaissance::create([
            "task_id" => $input["task_id"],
            "position_id" => $position->id,
            "position_type_id" => $input["position_type_id"],
            "status" => $input["status"],
            "user_id" => $input["user_id"],
            "description" => $input["description"],
            "documents" => $input["documents"],
        ]);

        return $this->success("Target Reconnaissance created", $targetReconnaissance, 200);
    }

    public function deleteTargetReconnaissance($id): JsonResponse
    {
        $targetReconnaissance = TargetReconnaissance::find($id);
        if(!$targetReconnaissance)
            return $this->failure("Target Reconnaissance not found", 404);
        $targetReconnaissance->delete();
        return $this->success("Target Reconnaissance deleted", null, 200);
    }
}
