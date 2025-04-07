<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;

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

Route::get('/',[UserController::class,'index'])->name('home');

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

Route::post('/tools', [ToolController::class, 'store'])->name('tools.store');
Route::put('/tools/{tool}', [ToolController::class, 'update'])->name('tools.update');
Route::delete('/tools/{tool}', [ToolController::class, 'destroy'])->name('tools.destroy');

Route::delete('/messages/{message}', [UserController::class, 'destroy'])->name('messages.destroy');

Route::put('/profile', [UserController::class, 'update'])->name('profile.update');