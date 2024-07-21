<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\AboutController;
use App\Http\Controllers\Api\Admin\OfferController;
use App\Http\Controllers\Api\Admin\FeatureController;
use App\Http\Controllers\Api\Admin\ReviewController;
use App\Http\Controllers\Api\Admin\SettingController;
use App\Http\Controllers\Api\Admin\CategoriesController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\OurTeamController;
use App\Http\Controllers\Api\Admin\CouponConrtoller;
use App\Http\Controllers\Api\Admin\DashboardController;

use App\Http\Controllers\Api\website\HomeController;
use App\Http\Controllers\Api\website\CartController;
use App\Http\Controllers\Api\website\BlogController;
use App\Http\Controllers\Api\website\SingleProductController;
use App\Http\Controllers\Api\website\AboutUsController;
use App\Http\Controllers\Api\website\ContactUsController;
use App\Http\Controllers\Api\website\OrderController;
use App\Http\Controllers\Api\website\ProfileController;
use App\Http\Controllers\Api\website\AddressController;



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




Route::group(['prefix' => 'auth'],function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('emailVerification', [VerificationController::class, 'emailVerification']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/refresh', [LoginController::class, 'refresh']);
    Route::post('/forgetPassword', [ResetPasswordController::class, 'forgetPassword']);
    Route::post('/resetPassword', [ResetPasswordController::class, 'resetPassword']);
});

Route::group([ 'middleware' => ('user_type:admin')],function(){
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('offer', OfferController::class);
    Route::apiResource('feature', FeatureController::class);
    Route::apiResource('review', ReviewController::class);
    Route::apiResource('setting', SettingController::class);
    Route::apiResource('aboutus', AboutController::class);
    Route::apiResource('service', ServiceController::class);
    Route::get('/newslatter',[DashboardController::class,'latterEmail']);
    Route::apiResource('product', ProductController::class);
    Route::put('recommended',[ProductController::class,'changeRecommend']);
    Route::apiResource('sliders',SliderController::class);
    Route::apiResource('ourTeam',OurTeamController::class);
    Route::apiResource('coupon',CouponConrtoller::class);
});

Route::group(['middleware' => ('user_type:user')],function(){
    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart', [CartController::class, 'add']);
    Route::delete('cart/{itemId}', [CartController::class, 'remove']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders/create', [OrderController::class, 'create']);
    Route::post('/like',[HomeController::class,'likeProduct']);
    Route::get('/coupon',[HomeController::class,'showdiscounts']);
    Route::post('/search',[HomeController::class,'search']);
    Route::get('profile',[ProfileController::class, 'index']);
    Route::post('profile',[ProfileController::class, 'create']);
    Route::get('myordercurrent',[ProfileController::class, 'current']);
    Route::get('myordercompleted',[ProfileController::class, 'completed']);
    Route::get('myordercanceled',[ProfileController::class, 'canceled']);
    Route::get('mywallet',[ProfileController::class,'myWallet']);
    Route::get('myfavorite',[ProfileController::class,'myFavorite']);
    Route::apiResource('address', AddressController::class);
});

Route::group([ 'prefix' => ('home')],function(){
    Route::get('/',[HomeController::class,'index']);
    Route::get('view_all_weekly_Offer',[HomeController::class,'viewAllWeeklyOffer']);

});
Route::group([ 'prefix' => ('aboutUs')],function(){
    Route::get('/',[AboutUsController::class,'index']);
    Route::get('/viewAllTeam',[AboutUsController::class,'viewAllMembers']);

});
Route::group([ 'prefix' => ('contactUs')],function(){
    Route::get('/',[ContactUsController::class,'index']);
    Route::post('/send',[ContactUsController::class,'send']);

});
Route::group([ 'prefix' => ('blogs')],function(){
    Route::get('/',[BlogController::class,'index']);
    Route::post('/readmore',[BlogController::class,'reedMore']);

});
Route::group([ 'prefix' => ('singleproduct')],function(){
    Route::get('/{id}',[SingleProductController::class,'index']);
    Route::post('/color',[SingleProductController::class,'color']);

});
