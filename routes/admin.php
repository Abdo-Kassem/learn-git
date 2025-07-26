<?php

use App\Http\Controllers\Admin\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ComplaintsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\InstallationSubscriptionController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;


Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{

    // All Routes Here..
    Route::group(['prefix' => 'admin'] , function(){

        // Auth Routes ...
        Route::get('/login' , [AdminAuthController::class , 'login'])->name('admin.login')->middleware('RedirectIfAuthAdmin');
        Route::post('/doLogin' , [AdminAuthController::class , 'doLogin'])->name('admin.doLogin');
        Route::any('/logout' , [AdminAuthController::class , 'logout'])->name('admin.logout');
        // Reset Password Routes ..
        Route::get('/forgot/password' , [AdminAuthController::class , 'forgot_password'])->name('admin.forgot_password');
        Route::post('/forgot/password/post' , [AdminAuthController::class , 'forgot_password_post'])->name('admin.forgot_password_post');
        Route::get('/reset/password/{token}' , [AdminAuthController::class , 'reset_password'])->name('admin.reset_password');
        Route::post('/reset/password/post/{token}' , [AdminAuthController::class , 'reset_password_post'])->name('admin.reset_password_post');
    
        // Start Authenticated Routes .... ...
        Route::group(['middleware' => 'admin'] , function(){
            
            // Dashboard Route ..
            Route::get('/dashboard' , [AdminAuthController::class,'index'])->name('admin.index');
            
            // Profile Routes ..
            Route::get('/profile' , [AdminProfileController::class,'index'])->name('admin.profile');
            Route::post('profile/update' , [AdminProfileController::class,'update'])->name('admin.profile.update');

            // Admins Routes ..
            Route::group(['prefix' => 'admins'], function(){
                Route::get('/' , [AdminController::class,'index'])->name('admin.admins.index');
                Route::get('/create' , [AdminController::class,'create'])->name('admin.admins.create');
                Route::post('/store' , [AdminController::class,'store'])->name('admin.admins.store');
                Route::get('/show/{admin}' , [AdminController::class,'show'])->name('admin.admins.show');
                Route::get('/edit/{admin}' , [AdminController::class,'edit'])->name('admin.admins.edit');
                Route::put('/update/{admin}' , [AdminController::class,'update'])->name('admin.admins.update');
                Route::delete('/destroy/{admin}' , [AdminController::class,'destroy'])->name('admin.admins.destroy');
                Route::get('/activation/{admin}' , [AdminController::class,'activation'])->name('admin.admins.activation');            
            });

            Route::group(['prefix' => 'users'], function(){
                Route::get('/' , [UserController::class,'index'])->name('admin.users.index');
                Route::get('/create' , [UserController::class,'create'])->name('admin.users.create');
                Route::post('/store' , [UserController::class,'store'])->name('admin.users.store');
                Route::get('/show/{user}' , [UserController::class,'show'])->name('admin.users.show');
                Route::get('/edit/{user}' , [UserController::class,'edit'])->name('admin.users.edit');
                Route::put('/update/{user}' , [UserController::class,'update'])->name('admin.users.update');
                Route::delete('/destroy/{user}' , [UserController::class,'destroy'])->name('admin.users.destroy');
                Route::get('/activation/{user}' , [UserController::class,'activation'])->name('admin.users.activation');
                Route::patch('/add-badge', [UserController::class, 'addBadge'])->name('admin.users.add-badge');
            });

            Route::group(['prefix' => 'categories'], function(){
                Route::get('/' , [CategoryController::class,'index'])->name('admin.categories.index');
                Route::get('/create' , [CategoryController::class,'create'])->name('admin.categories.create');
                Route::post('/store' , [CategoryController::class,'store'])->name('admin.categories.store');
                Route::get('/show/{category}' , [CategoryController::class,'show'])->name('admin.categories.show');
                Route::get('/edit/{category}' , [CategoryController::class,'edit'])->name('admin.categories.edit');
                Route::put('/update/{category}' , [CategoryController::class,'update'])->name('admin.categories.update');
                Route::delete('/destroy/{category}' , [CategoryController::class,'destroy'])->name('admin.categories.destroy');
                Route::get('/activation/{category}' , [CategoryController::class,'activation'])->name('admin.categories.activation');
            });

            Route::resource('subcategories', SubCategoryController::class);

            Route::group(['prefix' => 'locations'], function() {
                Route::resource('/cities', CityController::class)->except('show');
                Route::resource('/cities/areas', AreaController::class)->except('show');
            });

            Route::group(['prefix' => 'products'], function(){
                Route::get('/' , [ProductController::class,'index'])->name('admin.products.index');
                Route::get('/create' , [ProductController::class,'create'])->name('admin.products.create');
                Route::post('/store' , [ProductController::class,'store'])->name('admin.products.store');
                Route::get('/show/{product}' , [ProductController::class,'show'])->name('admin.products.show');
                Route::get('/edit/{product}' , [ProductController::class,'edit'])->name('admin.products.edit');
                Route::put('/update/{product}' , [ProductController::class,'update'])->name('admin.products.update');
                Route::delete('/destroy/{product}' , [ProductController::class,'destroy'])->name('admin.products.destroy');
                Route::get('/activation/{product}' , [ProductController::class,'activation'])->name('admin.products.activation');

                // ajax routes. 
                Route::get('/delete-single-image' , [ProductController::class,'deleteSingleImage'])->name('admin.products.delete-single-image');
                Route::get('/edit-single-image' , [ProductController::class,'editSingleImage'])->name('admin.products.edit-single-image');
                Route::get('/add-single-image' , [ProductController::class,'addSingleImage'])->name('admin.products.add-single-image');
                Route::post('/store-single-image' , [ProductController::class,'storeSingleImage'])->name('admin.products.store-single-image');
                Route::post('/update-single-image' , [ProductController::class,'updateSingleImage'])->name('admin.products.update-single-image');
                Route::get('/get-areas' , [ProductController::class,'areasByCityId'])->name('admin.products.get-areas.by-city_id');

            });

            Route::resource('packages', PackageController::class);

            Route::group(['prefix' => 'installation-subscriptions'], function() {
                Route::get('/', [InstallationSubscriptionController::class, 'index'])->name('admin.installation-subscriptions.index');
                Route::delete('/destroy/{subscription}', [InstallationSubscriptionController::class, 'destroy'])->name('admin.installation-subscriptions.destroy');
            });

            Route::group(['prefix' => 'complaints'], function() {
                Route::get('/', [ComplaintsController::class, 'index'])->name('admin.complaints.index');
                Route::delete('/destroy/{complaint}', [ComplaintsController::class, 'destroy'])->name('admin.complaints.destroy');
            });

            Route::group(['prefix' => 'brands'], function(){
                Route::get('/' , [BrandController::class,'index'])->name('admin.brands.index');
                Route::get('/create' , [BrandController::class,'create'])->name('admin.brands.create');
                Route::post('/store' , [BrandController::class,'store'])->name('admin.brands.store');
                Route::get('/edit/{brand}' , [BrandController::class,'edit'])->name('admin.brands.edit');
                Route::put('/update/{brand}' , [BrandController::class,'update'])->name('admin.brands.update');
                Route::delete('/destroy/{brand}' , [BrandController::class,'destroy'])->name('admin.brands.destroy');
                Route::get('/activation/{brand}' , [BrandController::class,'activation'])->name('admin.brands.activation');
            });

            Route::group(['prefix' => 'ratings'], function() {
                Route::get('/', [RatingController::class, 'index'])->name('admin.ratings.index');
                Route::get('/show/{rating}', [RatingController::class, 'show'])->name('admin.ratings.show');
                Route::delete('/destroy/{rating}', [RatingController::class, 'destroy'])->name('admin.ratings.destroy');
            });

            Route::resource('sliders', SliderController::class)->except('show');
            
            Route::group(['prefix' => 'pages'], function() {
                Route::group(['prefix' => 'contact-us'], function() {
                    Route::get('/', [ContactController::class, 'index'])->name('admin.pages.contacts.index');
                    Route::get('/show/{contact}', [ContactController::class, 'show'])->name('admin.pages.contacts.show');
                    Route::delete('/destroy/{contact}', [ContactController::class, 'destroy'])->name('admin.pages.contacts.destroy');
                });

                Route::group(['prefix' => 'privacy-policy'], function() {
                    Route::get('/', [PrivacyPolicyController::class, 'index'])->name('admin.pages.privacy-policy.index');
                    Route::put('/update/{privacyPolicy}', [PrivacyPolicyController::class, 'update'])->name('admin.pages.privacy-policy.update');
                });

                Route::group(['prefix' => 'about'], function() {
                    Route::get('/', [AboutController::class, 'index'])->name('admin.pages.about.index');
                    Route::put('/update/{about}', [AboutController::class, 'update'])->name('admin.pages.about.update');
                });

                Route::group(['prefix' => 'app-setting'], function() {
                    Route::get('/', [AppSettingController::class, 'index'])->name('admin.pages.setting.index');
                    Route::put('/update/{appSetting}', [AppSettingController::class, 'update'])->name('admin.pages.setting.update');
                });
            });

        });

    });

});


