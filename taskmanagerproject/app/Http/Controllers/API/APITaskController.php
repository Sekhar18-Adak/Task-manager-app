<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TaskManager;
use App\Jobs\mailingsend;

class APITaskController extends Controller
{
    public function create(Request $request)
    {
        $data = new TaskManager();
        $data->Task_Description = $request->input('Task_Description');
        $data->Task_Owner = $request->input('Task_Owner');
        $data->Task_Owner_Email = $request->input('Task_Owner_Email');
        $data->Task_Eta = $request->input('Task_Eta');
        $data->Task_Status = $request->input('Task_Status');

        if ($data->save()) {
            // Queue Email if Email Exists
            if (!empty($data->Task_Owner_Email)) {
                mailingsend::dispatch($data->Task_Owner_Email, 'Task Created', 'Your task has been added successfully.');
            }
            
            return response()->json(["message" => "Task created successfully"], 201);
        }

        return response()->json(["message" => "Something went wrong"], 500);
    }

    public function index()
    {
        return TaskManager::all();
    }

    public function Getbyid($id)
    {
        $task = TaskManager::find($id);
        if (!$task) {
            return response()->json(["message" => "Task not found"], 404);
        }

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = TaskManager::find($id);
        if (!$task) {
            return response()->json(["message" => "Task not found"], 404);
        }

        // Update task fields
        $task->Task_Description = $request->input('Task_Description', $task->Task_Description);
        $task->Task_Owner = $request->input('Task_Owner', $task->Task_Owner);
        $task->Task_Owner_Email = $request->input('Task_Owner_Email', $task->Task_Owner_Email);
        $task->Task_Eta = $request->input('Task_Eta', $task->Task_Eta);
        $task->Task_Status = $request->input('Task_Status', $task->Task_Status);

        if ($task->save()) {
            // Queue Email if Email Exists
            if (!empty($task->Task_Owner_Email)) {
                mailingsend::dispatch($task->Task_Owner_Email, 'Task Updated', 'Your task has been updated successfully.');
            }

            return response()->json(["message" => "Task updated successfully"], 200);
        }

        return response()->json(["message" => "Failed to update task"], 500);
    }

    public function markasdone($id)
    {
        $task = TaskManager::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->Task_Status = 1; // Mark as completed
        $task->save();

        // Queue Email if Email Exists
        if (!empty($task->Task_Owner_Email)) {
            mailingsend::dispatch($task->Task_Owner_Email, 'Task Completed', 'Your task has been marked as completed.');
        }

        return response()->json(['message' => 'Task marked as completed successfully']);
    }

    public function delete($id)
    {
        $task = TaskManager::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        // Confirm deletion
        $deletedTask = TaskManager::find($id);
        if ($deletedTask) {
            return response()->json(['message' => 'Failed to delete task'], 500);
        }

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
