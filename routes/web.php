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

// Route::view('/', 'frontend.index');


Route::post('/login', [AdminController::class, 'login']);
Route::post('/user/login', [UserController::class, 'checkLogin']);
Route::post('/user/login/instant', [UserController::class, 'checkLoginInstant']);
Route::post('/user/login/favourite', [UserController::class, 'checkLoginFavourite']);
Route::post('/user/registration', [UserController::class, 'registration']);
Route::get('/user/registration',[UserController::class, 'show']);

Route::get('/', [MainCategoryController::class, 'getMain']);
Route::get('/product/info/{id}', [ProductController::class, 'productInfo']);
Route::get('/get/sub/category/{id}', [SubCategoryController::class, 'findSub']);

Route::get('/get/tiny/category/{id}', [TinyCategoryController::class, 'findTiny']);

Route::get('/product/filter/{id}',[MainCategoryController::class, 'getAll']);
Route::get('/product/search/{id}', [ProductController::class, 'searchTop']);
Route::get('/search/result', [ProductController::class, 'searchResult']);



Route::group(['middleware' => ['admin']], function () {

    Route::view('/admin', 'backend.index');
    Route::get('/super/login', [AdminController::class, 'index']);
    Route::get('admin/logout', [AdminController::class, 'logout']);

    Route::get('admin/add/category', [MainCategoryController::class, 'create']);
    Route::post('/admin/main/category', [MainCategoryController::class, 'store']);
    Route::get('/admin/show/category', [MainCategoryController::class, 'index']);
    Route::post('/admin/main/update', [MainCategoryController::class, 'update']);

    Route::post('admin/sub/category', [SubCategoryController::class, 'store']);
    Route::get('/admin/find/sub/{id}', [SubCategoryController::class, 'findSub']);
    Route::get('/admin/edit/sub/{id}', [SubCategoryController::class, 'edit']);
    Route::post('/admin/sub/update', [SubCategoryController::class, 'update']);

    Route::post('admin/tiny/category', [TinyCategoryController::class, 'store']);
    Route::get('/admin/find/tiny/{id}', [TinyCategoryController::class, 'findTiny']);
    Route::get('/admin/edit/tiny/{id}', [TinyCategoryController::class, 'edit']);
    Route::post('/admin/tiny/update', [TinyCategoryController::class, 'update']);

    Route::get('/admin/add/product', [ProductController::class, 'create']);
    Route::post('/admin/product/store', [ProductController::class, 'store']);
    Route::get('/admin/product/show', [ProductController::class, 'index']);
    Route::get('/admin/find/cat/{id}', [ProductController::class, 'findCat']);
    Route::get('/admin/find/price/{id}', [ProductController::class, 'findPrice']);
    Route::get('/admin/find/product/{id}', [ProductController::class, 'findProduct']);
    Route::get('/admin/change/status/{id}', [ProductController::class, 'changeStatus']);
    Route::get('/admin/get/product/{id}', [ProductController::class, 'getProduct']);
    Route::get('/admin/edit/product/{id}', [ProductController::class, 'show']);
    Route::post('/admin/product/update/{id}', [ProductController::class, 'update']);


    Route::post('/admin/store/price', [PriceController::class, 'store']);
    Route::get('/admin/add/price', [PriceController::class, 'index']);
    Route::post('/admin/update/price', [PriceController::class, 'updatePrice']);
    Route::get('/admin/find/price_table/{id}', [PriceController::class, 'findPrice']);


});
Route::group(['middleware' => ['user']], function () {
    Route::get('/login', [UserController::class, 'login']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('user/rated', [RatingController::class, 'index']);
    Route::post('user/store/rating',[RatingController::class, 'store']);
    Route::get('user/favourite', [FavouriteController::class, 'index']);
    Route::post('user/add/favourite',[FavouriteController::class, 'store']);
    Route::delete('user/remove/favourite/{id}',[FavouriteController::class, 'destroy']);
    Route::get('user/load/product/info/{id}',[ProductController::class, 'load']);
    Route::get('user/profile',[UserController::class, 'index']);
    // Route::post('/user/edit/profile/{id}',[UserController::class,'update']);
    Route::post('/user/change/password/{id}',[UserController::class, 'update_password']);


    Route::post('/user/change/fullname/{id}',[UserController::class, 'update_fullname']);
    Route::post('/user/change/username/{id}',[UserController::class, 'update_username']);
    Route::post('/user/change/email/{id}',[UserController::class, 'update_email']);
    Route::post('/user/change/phone/{id}',[UserController::class, 'update_phone']);
    Route::post('/user/change/gender/{id}',[UserController::class, 'update_gender']);
    Route::post('/user/change/address/{id}',[UserController::class, 'update_address']);
    Route::post('/user/change/image/{id}',[UserController::class, 'update_image']);
    Route::post('/user/remove/account/{id}',[UserController::class, 'remove_account']);
});
