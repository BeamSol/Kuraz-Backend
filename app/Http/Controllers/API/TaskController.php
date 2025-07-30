<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request) {
        if ($request->user()->role === 'admin') {
            return Task::with('user')->get();
        }
        return $request->user()->tasks;
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'in:pending,completed,in_progress',
            'priority' => 'in:low,medium,high',
            'deadline' => 'required|date',
        ]);

        return $request->user()->tasks()->create($data);
    }

    public function update(Request $request, Task $task) {
        if ($request->user()->id !== $task->user_id && $request->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $task->update($request->only('title', 'description', 'status', 'priority', 'deadline'));
        return $task;
    }

    public function destroy(Request $request, Task $task) {
        if ($request->user()->id !== $task->user_id && $request->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $task->delete();
        return response()->json(['message' => 'Deleted']);
    }

}
