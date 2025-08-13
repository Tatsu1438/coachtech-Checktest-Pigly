<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/weight_logs', [WeightLogController::class, 'weight_logs']);
Route::get('/weight_logs/create', [WeightLogController::class, 'create']);
Route::get('/weight_logs/search', [WeightLogController::class, 'search']);
Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'goal_setting']);
Route::get('/register', [WeightLogController::class, 'register']);
Route::get('/register/step1', [WeightLogController::class, 'step1']);
Route::get('/register/step2', [WeightLogController::class, 'step2']);
Route::get('/login', [WeightLogController::class, 'login']);
Route::get('/logout', [WeightLogController::class, 'logout']);
