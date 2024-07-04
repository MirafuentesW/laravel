<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('todo', function () {
    return "Hello";
});
Route::get('todotest', [TaskController::class, 'index']);
Route::post('todotest', [TaskController::class, 'store']);
Route::get('todotest/{id}', [TaskController::class, 'show']);
Route::get('todotest/{id}/edit', [TaskController::class, 'edit']);
Route::put('todotest/{id}/update', [TaskController::class, 'update']);
Route::delete('todotest/{id}/delete', [TaskController::class, 'destroy']);
