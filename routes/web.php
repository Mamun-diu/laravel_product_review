<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TinyCategoryController;

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

Route::post('/login', [AdminController::class, 'login']);
Route::post('/user/login', [UserController::class, 'checkLogin']);
Route::post('/user/registration', [UserController::class, 'registration']);



Route::group(['middleware' => ['admin']], function () {

    Route::view('/admin', 'backend.index');
    Route::get('/super/login', [AdminController::class, 'index']);
    Route::get('admin/logout', [AdminController::class, 'logout']);
    Route::get('admin/add/category', [MainCategoryController::class, 'create']);
    Route::post('/admin/main/category', [MainCategoryController::class, 'store']);
    Route::post('admin/sub/category', [SubCategoryController::class, 'store']);
    Route::post('admin/tiny/category', [TinyCategoryController::class, 'store']);
    Route::get('/admin/find/sub/{id}', [SubCategoryController::class, 'findSub']);
    Route::get('/admin/find/tiny/{id}', [TinyCategoryController::class, 'findTiny']);
    Route::get('/admin/add/product', [ProductController::class, 'create']);
    Route::post('/admin/product/store', [ProductController::class, 'store']);
    Route::get('/admin/product/show', [ProductController::class, 'index']);
    Route::get('/admin/add/price', [PriceController::class, 'index']);
    Route::get('/admin/find/product/{id}', [ProductController::class, 'findProduct']);
    Route::post('/admin/store/price', [PriceController::class, 'store']);
});
Route::group(['middleware' => ['user']], function () {
    Route::get('/login', [UserController::class, 'login']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('user/rated', [RatingController::class, 'index']);
    Route::get('user/favourite', [FavouriteController::class, 'index']);
});
