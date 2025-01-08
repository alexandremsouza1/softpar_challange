<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskAssigneeController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\UserAchievementController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;



Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

// Rotas para Category
Route::middleware('auth:sanctum')->prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{category}', [CategoryController::class, 'show']);
    Route::put('/{category}', [CategoryController::class, 'update']);
    Route::delete('/{category}', [CategoryController::class, 'destroy']);
});

// Rotas para Task
Route::middleware('auth:sanctum')->prefix('task')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::get('/delayed', [TaskController::class, 'delayed']);
    Route::post('/', [TaskController::class, 'store']);
    Route::get('/{task}', [TaskController::class, 'show']);
    Route::put('/{task}', [TaskController::class, 'update']);
    Route::delete('/{task}', [TaskController::class, 'destroy']);
});

// Rotas para Subtask
Route::middleware('auth:sanctum')->prefix('subtask')->group(function () {
    Route::get('/', [SubtaskController::class, 'index']);
    Route::post('/', [SubtaskController::class, 'store']);
    Route::get('/{subtask}', [SubtaskController::class, 'show']);
    Route::put('/{subtask}', [SubtaskController::class, 'update']);
    Route::delete('/{subtask}', [SubtaskController::class, 'destroy']);
});

// Rotas para TaskAssignee
// Route::middleware('auth:sanctum')->prefix('task-assignee')->group(function () {
//     Route::get('/', [TaskAssigneeController::class, 'index']);
//     Route::post('/', [TaskAssigneeController::class, 'store']);
//     Route::get('/{taskAssignee}', [TaskAssigneeController::class, 'show']);
//     Route::put('/{taskAssignee}', [TaskAssigneeController::class, 'update']);
//     Route::delete('/{taskAssignee}', [TaskAssigneeController::class, 'destroy']);
// });

// Rotas para Achievement
Route::middleware('auth:sanctum')->prefix('achievement')->group(function () {
    Route::get('/', [AchievementController::class, 'index']);
    Route::post('/', [AchievementController::class, 'store']);
    Route::get('/{achievement}', [AchievementController::class, 'show']);
    Route::put('/{achievement}', [AchievementController::class, 'update']);
    Route::delete('/{achievement}', [AchievementController::class, 'destroy']);
});

// Rotas para UserAchievement
Route::middleware('auth:sanctum')->prefix('user-achievement')->group(function () {
    Route::get('/', [UserAchievementController::class, 'index']);
    Route::post('/', [UserAchievementController::class, 'store']);
    Route::get('/{userAchievement}', [UserAchievementController::class, 'show']);
    Route::put('/{userAchievement}', [UserAchievementController::class, 'update']);
    Route::delete('/{userAchievement}', [UserAchievementController::class, 'destroy']);
});
