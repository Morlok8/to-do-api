<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $taskList = Task::all();
        return response()->json($taskList);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $this->validate_data($request);

        $task = Task::create($data);

        return response()->json([
            "message" => "A new task is added"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $task = Task::find($id);

        if(!empty($task))
        {
            return response()->json($task);
        }
        else
        {
            return response()->json([
                "message" => "Task not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        if(Task::where('id', $id)->exists()){
            $data = $this->validate_data($request);

            Task::where('id', $id)->update($data);

            return response()->json([
                "message" => $id." task is updated"
            ], 201);
        }
        else{
            return response()->json([
                "message" => "Task not found"
            ]. 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        if(Task::where('id', $id)->exists()){
            $task = Task::destroy($id); 
            return response()->json([
                "message" => "Task deleted"
            ], 201);
        }
        else{
            return response()->json([
                "message" => "Task not found"
            ], 404);
        }
    }

    /**
     * function to validate incoming task data
     * the field "status" accepts only "pending", "in work", "completed" and "canceled" values
     */
    protected function validate_data(Request $request): array
    {
        $request->mergeIfMissing(['status' => 'in work']);

        $data = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'status' => 'string|in:pending,in work,completed,canceled',
        ]);

        return $data;
    } 
}
