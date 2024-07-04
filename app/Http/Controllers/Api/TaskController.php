<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index() 
    {
        $tasks = Task::all();
        if($tasks -> count() > 0) {
            $data = [
                'status'=> 200,
                'task' => $tasks
            ];
            return response()->json($data, 200);
        }
        else{
            $data = [
                'status'=> 404,
                'message' => "no record found"
            ];
            return response()->json($data, 404);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required|string|max:190',
        ]);
        
        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()
            ], 422);
        }else{
            $task = Task::create([
                'task' => $request->task,
            ]);
            if($task){
                return response()->json([
                    'status' => 200,
                    'message' => 'Task created successfully',
                    'task' => $task
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }
    public function show($id)
    {
        $task = Task::find($id);
        if($task){
            return response()->json([
                'status' => 200,
                'task' => $task
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message'=> 'Task Not Found'
            ], 404);
        }
    }
    public function edit($id)
    {
        $task = Task::find($id);
        if($task){
            return response()->json([
                'status' => 200,
                'task' => $task
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message'=> 'Task Not Found'
            ], 404);
        }
    }
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required|string',
        ]);
        
        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()
            ], 422);
        }else{
            $task = Task::find($id);
            if($task){
                $task->update([
                    'task' => $request->task,
                    'status' => $request->status,
                    'created_at' => $task->created_at
                    
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Task created successfully',
                    'task' => $task
                ], 200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Something went wrong'
                ], 404);
            }
        }
    }
    public function destroy($id)
    {
        $task = Task::find($id);
        if($task){
            $task->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Task deleted successfully',
                'task' => $task
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message'=> 'Task Not Found'
            ], 404);
        }
        
    }
}
