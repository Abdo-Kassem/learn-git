<?php

use App\Http\Controllers\APIs\V1\ComplaintsController;
use App\Http\Controllers\APIs\V1\ContactController;
use App\Http\Controllers\APIs\V1\PackageController;
use App\Http\Controllers\APIs\V1\ProductController;
use App\Http\Controllers\APIs\V1\CategoryController;
use App\Http\Controllers\APIs\Auth\FcmController;
use App\Http\Controllers\APIs\Auth\LogoutController;
use App\Http\Controllers\APIs\V1\ProfileController;
use App\Http\Controllers\APIs\V1\RatingController;
use App\Http\Controllers\APIs\V1\SubscripeController;
use App\Http\Controllers\APIs\V1\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIs\Auth\LoginController;
use App\Http\Controllers\APIs\Auth\RegisterController;
use App\Http\Controllers\APIs\Auth\UpdatePasswordController;
use App\Http\Controllers\APIs\Auth\VerifyAccountController;
use App\Http\Controllers\APIs\V1\BrandController;
use App\Http\Controllers\APIs\V1\LikesController;
use App\Http\Controllers\APIs\V1\LocationController;
use App\Http\Controllers\APIs\V1\PagesController;
use App\Http\Controllers\APIs\V1\SearchController;
use App\Http\Controllers\APIs\V1\SubcategoryController;

Route::get('test-fcm', [SearchController::class, 'test']);

Route::group(['middleware' => 'api'], function () {
    
    Route::group(['prefix' => 'auth'], function() {

        Route::post('/register', [RegisterController::class, 'register']);
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LogoutController::class, 'logout'])->middleware('jwt.verify');    
    
    
        Route::post('/check-email-before-register', [RegisterController::class, 'checkEmailBeforeRegister']);
        Route::post('/check-phone-before-register', [RegisterController::class, 'checkPhoneBeforeRegister']);
    
    
        Route::post('/resend-code', [VerifyAccountController::class, 'resendCode']);
        Route::post('/account-verification', [VerifyAccountController::class, 'accountVerification']);
    
        Route::post('/forget-password', [UpdatePasswordController::class, 'forgetPassword']);
        Route::post('/password-otp-verification', [UpdatePasswordController::class, 'otpVerification']);
        Route::post('/reset-password', [UpdatePasswordController::class, 'resetPassword']);
    
        Route::group(['middleware' => 'jwt.verify'], function() {
            Route::patch('/update-fcm-token', [FcmController::class, 'updateFcmToken']);
            Route::patch('/update-prefered-language', [ProfileController::class, 'updatePreferedLanguage']);
        });
    
    });


    Route::group(['prefix' => 'v1'] , function(){ 
    
        Route::group(['middleware' => 'jwt.verify'] , function() {

            Route::post('user/update-profile', [ProfileController::class, 'updateProfile']);
            Route::get('user/delete-account', [ProfileController::class, 'destroyAccount']);
            Route::post('user/update-avatar', [ProfileController::class, 'updateAvatar']);

            Route::get('rates', [UserController::class, 'getRating']);

            Route::group(['prefix' => 'products'] , function(){
                Route::post('store', [ProductController::class, 'store']);
                Route::post('update', [ProductController::class, 'update']);
                Route::get('delete', [ProductController::class, 'delete']);
                Route::get('mark-sold', [ProductController::class, 'markAsSold']);
                Route::post('add-like', [LikesController::class, 'addLike']);
                Route::get('add-view', [ProductController::class, 'addView']);
                Route::post('send-feedback', [RatingController::class, 'addRating']);
                Route::post('send-complaint', [ComplaintsController::class, 'sendComplaint']);
                Route::get('delete-product-image', [ProductController::class, 'deleteSingleImage']);
                Route::get('all-liked-by-user', [UserController::class, 'getAllLikedProductsForUser']);
            });

            Route::group(['prefix' => 'subscriptions'], function() {
                Route::post('/product-package', [SubscripeController::class, 'subscripeInPackage']);
            });

        });
        

        Route::group(['prefix' => 'products'], function() {
            Route::get('/',[ProductController::class,'getAllProducts']);
            Route::get('/featured-products',[ProductController::class,'getFeaturedProducts']);
            Route::get('/get',[ProductController::class,'getProduct']);
            Route::get('/by-brand',[BrandController::class,'getProductsByBrand']);
            Route::get('/search',[SearchController::class,'search']);
            Route::get('get-all-by-user', [UserController::class, 'getAllProductsForUser']);
            Route::get('/packages', [PackageController::class, 'index']);
        });

        Route::get('subcategories/products',[SubcategoryController::class, 'getProducts']);


        Route::get('categories',[CategoryController::class,'index']);
        Route::get('brands',[BrandController::class,'index']);  

        Route::group(['prefix' => 'locations'], function() {
            Route::get('/cities', [LocationController::class, 'cities']);
            Route::get('/areas', [LocationController::class, 'areas']);
            Route::get('/areas/{city}', [LocationController::class, 'areasByCityId']);
        });


        Route::group(['prefix' => 'pages'], function() {
            Route::get('/sliders', [PagesController::class, 'sliders']);
            Route::get('/privacy-policy', [PagesController::class, 'privacyPolicy']);
            Route::get('/about', [PagesController::class, 'about']);
            Route::get('/app-setting', [PagesController::class, 'appSetting']);
            Route::post('/contact',[ContactController::class,'send']);
        });
        
    /*
        // All Brands Routes .
        Route::group(['prefix' => 'brands'] , function(){
            Route::get('/',[BrandController::class,'index']);
        });
        */
    });

});
