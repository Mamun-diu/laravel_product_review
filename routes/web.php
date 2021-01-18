<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'frontend.index');


// Route::get('admin/login', [AdminController::class, 'index']);
Route::post('/login', [AdminController::class, 'login']);

Route::post('/user/login', [UserController::class, 'checkLogin']);
Route::post('/user/registration', [UserController::class, 'registration']);

Route::get('/favourite', [UserController::class, 'favourite']);

Route::group(['middleware' => ['admin']], function () {
    Route::view('/admin', 'backend.index');
    Route::get('/admin/login', [AdminController::class, 'index']);

    Route::get('/logout', [AdminController::class, 'logout']);
});
Route::group(['middleware' => ['user']], function () {
    Route::get('/login', [UserController::class, 'login']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/rated', [UserController::class, 'rated']);
});
