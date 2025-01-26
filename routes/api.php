<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\MemberController;


Route::group(['namespace' => 'Api','prefix'=>'v1','middleware' => 'api'], function(){

    
    Route::get('home-members', [FrontendController::class, 'members'])->name('members');
    Route::get('product/{id}', [FrontendController::class, 'details'])->name('product');
    Route::get('livesearch', [FrontendController::class, 'livesearch'])->name('livesearch');
    Route::get('/member-details/{id}', [FrontEndController::class, 'singleDetails'])->name('member.details');
     
    Route::get('/division', [FrontEndController::class, 'getDivision']);
    Route::get('/districts', [FrontEndController::class, 'getDistricts']);
    Route::get('/upazila', [FrontEndController::class, 'getUpazilas']);
    
    //=============== pages =======================//
     
    Route::get('/page/', [FrontEndController::class, 'page']);
    Route::get('/page-details/{slug}', [FrontEndController::class, 'pageDetails']);
     
    //=============== register & login =======================//
    
    Route::get('/member/registration/info', [FrontEndController::class, 'register'])->name('member.register');
    Route::post('/member/register-post', [MemberController::class, 'register'])->name('member_register');
    Route::get('/member/register-missing', [FrontEndController::class, 'registermissingpage'])->name('member.registermissing');
    Route::post('/member/register-missing-post', [MemberController::class, 'registermissingstore'])->name('member_registermissing');
    Route::get('/member/verify', [MemberController::class, 'memberVerifyForm'])->name('verify_form');
    Route::post('/member/login', [MemberController::class, 'login'])->name('member.login');

    Route::post('/resend/code/', [MemberController::class, 'resendcode'])->name('resendcode');
    Route::get('member/forgetpassword', [MemberController::class, 'forgotpassword'])->name('member.forgotpass');
    Route::post('member/forgetsubmit', [MemberController::class, 'forgotsubmit'])->name('member.forgotsubmit');

    Route::get('member/passwordreset', [MemberController::class, 'passresetpage'])->name('member.passresetpage');
    Route::post('member/passresetverify', [MemberController::class, 'passResetVerify'])->name('member.passresetverify');
    Route::get('member/profile-info/{id}', [MemberController::class, 'getProfileInfo']);
    
    Route::group(['namespace' => 'Api','prefix'=>'v1','middleware' =>'auth.jwt'], function(){
        Route::get('member/login-check', [MemberController::class, 'logincheck']);
        Route::post('member/logout', [MemberController::class, 'logout']);
        Route::get('member/profile', [MemberController::class, 'profile']);
        Route::post('member/change-password', [MemberController::class, 'change_password'])->name('change_password');
        Route::post('member/profile-update', [MemberController::class, 'profile_update'])->name('profile_update');
        Route::get('member/orders', [MemberController::class, 'orders']);
        // Route::get('member/profile-info/{id}', [MemberController::class, 'getProfileInfo']);
    });
     
});



