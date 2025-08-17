<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;

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


Route::get('/weight_logs/create', [WeightLogController::class, 'create']);
Route::get('/weight_logs/search', [WeightLogController::class, 'search']);
Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'goal_setting']);

Route::get('/register', [WeightLogController::class, 'register']);
Route::get('/register/step1', [WeightLogController::class, 'step1'])->name('register.step1');
Route::get('/register/step2', [WeightLogController::class, 'step2Form'])->name('register.step2.form');
Route::post('/register/step2/submit', [WeightLogController::class, 'step2Submit'])->name('register.step2.submit');
Route::get('/login', [WeightLogController::class, 'login'])->name('login');
Route::post('/login', [WeightLogController::class, 'loginSubmit'])->name('login.submit');
Route::post('/logout', [WeightLogController::class, 'logout'])->name('logout');
Route::get('/goal-setting', [WeightLogController::class, 'goal_setting'])->name('goal-setting');
Route::post('/goal-setting/save', [WeightLogController::class, 'goal_setting_save'])->name('goal-setting.save');


Route::middleware(['auth'])->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'weight_logs'])->name('weight_logs.index');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
    Route::put('/weight_logs/{id}', [WeightLogController::class, 'updateLog'])->name('weight_logs.update');
});

Route::post('/weight-goal/update', [WeightLogController::class, 'updateGoal'])->name('weight_goal.update')->middleware('auth');

Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');
Route::get('/register/step1', [WeightLogController::class, 'step1'])->name('register.step1.form');
Route::post('/register/step1', [WeightLogController::class, 'step1Submit'])->name('register.step1.submit');