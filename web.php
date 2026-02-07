<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']);
Route::post('/task', [TaskController::class, 'store']);
Route::put('/task/{id}/update', [TaskController::class, 'update']);

Route::get('/task/{id}/delete', [TaskController::class, 'destroy']);
