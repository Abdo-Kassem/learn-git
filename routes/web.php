<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\PagesController;


Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{
        
    Route::view('/','Frontend.index')->name('home');

    Route::get('/home',function() {
        return redirect()->to('/');
    })->name('home');


    Route::get('/privacy-policy',[PagesController::class, 'privacyPolicy']);
    Route::get('/contact-us',[PagesController::class, 'contactPage']);
    Route::get('/about',[PagesController::class, 'about']);


    Route::group(['prefix' => 'my_account'] , function(){
        Route::get('/delete' , [AccountController::class,'index'])->name('frontend.my-account.index');
        Route::post('/check-account' , [AccountController::class,'check_account'])->name('frontend.my-account.check');
        Route::delete('/delete' , [AccountController::class,'delete_account'])->name('frontend.my-account.delete');
    });

});
