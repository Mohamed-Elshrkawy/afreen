<?php

use App\Http\Controllers\Api\Admin\OfferController;
use App\Http\Controllers\Api\Admin\FeatureController;
use App\Http\Controllers\Api\Admin\ReviewController;
use App\Http\Controllers\Api\Admin\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\website\HomeController;
use App\Http\Controllers\Api\website\CartController;
use App\Http\Controllers\Api\Admin\CategoriesController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\SliderController;


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
Route::apiResource('setting', SettingController::class);
// Route::apiResource('about_us', AboutController::class);
Route::get('/newslatter',[DashboardController::class,'latterEmail']);
Route::apiResource('product', ProductController::class);
Route::put('recommended',[ProductController::class,'changeRecommend']);
Route::apiResource('categories', CategoriesController::class);




Route::group(['prefix' => 'auth'],function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group([ 'middleware' => ('user_type:admin')],function(){
    Route::get('/home',[DashboardController::class,'index']);

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


