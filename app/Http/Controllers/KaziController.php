<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;


class KaziController extends Controller
{
    public function store(Request $request)
{
    $this->validate($request, [
        'title' => 'required|string|max:255',
        'description' => 'string',
        'completed' => 'boolean',
    ]);

    $task = Task::create($request->all());

    return response()->json(['message' => 'Task created successfully', 'id' => $task->id], Response::HTTP_CREATED);
}

public function index()
{
    $tasks = Task::all();

    return response()->json(['tasks' => $tasks], Response::HTTP_OK);
}


public function update(Request $request, $id)
{
    $this->validate($request, [
        'title' => 'string|max:255',
        'description' => 'string',
        'completed' => 'boolean',
    ]);

    $task = Task::find($id);

    if (!$task) {
        return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
    }

    // Update only the fields that are present in the request data
    if ($request->has('title')) {
        $task->title = $request->input('title');
    }

    if ($request->has('description')) {
        $task->description = $request->input('description');
    }

    if ($request->has('completed')) {
        $task->completed = $request->input('completed');
    }

    $task->save();

    return response()->json(['message' => 'Task updated successfully'], Response::HTTP_OK);
}


public function delete($id)
{
    $task = Task::find($id);

    if (!$task) {
        return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
    }

    $task->delete();

    return response()->json(['message' => 'Task deleted successfully'], Response::HTTP_OK);
}
}
