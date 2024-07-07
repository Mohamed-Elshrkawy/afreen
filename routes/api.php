<?php

use App\Http\Controllers\Api\admin\OfferController;
use App\Http\Controllers\Api\admin\FeatureController;
use App\Http\Controllers\Api\admin\ReviewController;
use App\Http\Controllers\Api\admin\SittingController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\admin\DashboardController;
use App\Http\Controllers\Api\website\HomeController;
use App\Http\Controllers\Api\website\CartController;
use App\Http\Controllers\Api\admin\CategoriesController;
use App\Http\Controllers\Api\admin\ProductController;
use App\Http\Controllers\Api\admin\SliderController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource('offer', OfferController::class);
Route::apiResource('feature', FeatureController::class);
Route::apiResource('review', ReviewController::class);
Route::apiResource('setting', SittingController::class);
Route::get('/newslatter',[DashboardController::class,'latterEmail']);


Route::group(['prefix' => 'auth'],function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
Route::put('recommended',[ProductController::class,'changeRecommend']);

Route::group([ 'middleware' => ('user_type:admin')],function(){
    Route::get('/home',[DashboardController::class,'index']);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('sliders',SliderController::class);
});


Route::group(['middleware' => ('user_type:user')],function(){
    Route::get('/home',[HomeController::class,'index']);
    Route::post('/add_to_cart',[HomeController::class,'addTocart']);
    Route::post('/like',[HomeController::class,'likeProduct']);
    // Route::get('/offer',[HomeController::class,'showOffers']);
    Route::get('/notifcation',[HomeController::class,'showNotifications']);
    Route::get('/discount',[HomeController::class,'showDiscounts']);
    Route::get('/weeklyoffers',[HomeController::class,'showWeeklyoffer']);
    Route::get('/weeklyoffers',[HomeController::class,'showWeeklyoffer']);
    Route::get('/latestproducts',[HomeController::class,'showLatestproducts']);
    Route::get('/bestseller',[HomeController::class,'showBestseller']);
    Route::get('/highstrate',[HomeController::class,'showhighstrate']);
    Route::get('/recommended',[HomeController::class,'showrecommended']);

});
Route::group(['middleware' => ('user_type:user')],function(){
    Route::get('/cart',[CartController::class,'index']);
    Route::get('/cart',[CartController::class,'store']);
    Route::get('/cart/{id}',[CartController::class,'show']);
    Route::put('/cart/{id}',[CartController::class,'update']);
    Route::delete('/cart/{id}',[CartController::class,'destroy']);
});


