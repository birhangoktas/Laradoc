<?php

use App\Http\Controllers\RouteController;
use App\Http\Controllers\AdminRouteController;
use App\Http\Controllers\DoctorRouteController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\RootGetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Public -> Get

Route::get('/',[RouteController::class,'welcome']);
Route::get('/kayit-ol',[RouteController::class,'userregister']);
Route::get('/giris-yap',[RouteController::class,'loginview']);
Route::get('/doktorluk-basvurusu',[RouteController::class,'doctorregister']);
Route::get('/doktor-giris',[RouteController::class,'doctorlogin']);
Route::get('/doktorlar',[RouteController::class,'doctorlist']);
Route::get('/yonetici',[RouteController::class,'rootloginview']);

Route::get('/doktor/{doctor_name}/{doctor_abour}/{user_id}',[RouteController::class,'doctorexamined'])->name('doctorexamined');
Route::get('/saat-ayarla/{date}',[RouteController::class,'hoursetting']);

Route::get('auth/linkedin', 'Auth\LoginController@redirectToLinkedin');
Route::get('auth/linkedin/callback', 'Auth\LoginController@handleLinkedinCallback');

// Public -> Post
Route::post('/doctorcommentsave/{doctor_id}/{my_id}',[RouteController::class,'doctorcommentsave'])->name('doctorcommentsave');
Route::post('/doctor-register',[RouteController::class,'doctorregistersave'])->name('doctorregistersave');
Route::post('/doctor-login',[RouteController::class,'doctorloginsave'])->name('doctorloginsave');
Route::post('/user-save',[RouteController::class,'usersave'])->name('usersave');
Route::post('/user-login',[RouteController::class,'userlogin'])->name('userlogin');
Route::post('/root-login',[RouteController::class,'rootlogin'])->name('rootlogin');
Route::post('/user-invoice',[RouteController::class,'userinvoicesave'])->name('userinvoicesave');


Route::group(['middleware' => ['doctorsecurity'], 'prefix' => '/dr'], function () {
    
    //doctorsecurity -> Get
    Route::get('/',[DoctorRouteController::class,'welcome']);
    Route::get('/ilan-olustur',[DoctorRouteController::class,'doctorproject']);
    Route::get('/islem-gecmisi',[DoctorRouteController::class,'doctorhistory']);
    Route::get('/kazanclarim',[DoctorRouteController::class,'myearning']);
    Route::get('/ayarlar',[DoctorRouteController::class,'doctorsetting']);

    
    //doctorsecurity -> Post
    Route::post('/doctorpasswordupdate',[DoctorRouteController::class,'doctorpasswordupdate'])->name('doctorpasswordupdate');
    Route::post('/doctorprofilupdate',[DoctorRouteController::class,'doctorprofilupdate'])->name('doctorprofilupdate');
    Route::post('/doctorupdate/{user_id}',[DoctorRouteController::class,'doctorupdate'])->name('doctorupdate');
    Route::post('/invocie-save',[DoctorRouteController::class,'invoicesave'])->name('invoicesave');
    Route::post('/drcheckout',[DoctorRouteController::class,'drcheckout'])->name('drcheckout');
    Route::post('/doctorcreatesave',[DoctorRouteController::class,'doctorcreatesave'])->name('doctorcreatesave');
});
Route::group(['middleware' => ['rootsecurity'], 'prefix' => '/root'], function () {
    // Root -> GET
    Route::get('/',[RootGetController::class,'welcome']);
    Route::get('/doktorlar',[RootGetController::class,'doctorlist']);
    Route::get('/doktor/{name}/{job}/{user_id}',[RootGetController::class,'doctorhome'])->name('doctorhome');
    Route::get('/destek-talepleri',[RootGetController::class,'supports']);
    Route::get('/yanitlar',[RootGetController::class,'supporthome']);
    // Root -> POST
    Route::post('/doctor-update/{user_id}',[RootGetController::class,'rootdoctorupdate'])->name('rootdoctorupdate');
    Route::post('/support-save',[RootGetController::class,'supportsave'])->name('supportsave');

    //Root -> active
    Route::get('/doctor-active/{id}',[RootGetController::class,'doctoractive'])->name('doctoractive');
    Route::get('/project-active/{id}',[RootGetController::class,'projectactive'])->name('projectactive');
    

});
Route::group(['middleware' => ['adminsecurity'], 'prefix' => '/admin'], function () {

    //Admin -> GET
    Route::get('/',[AdminRouteController::class,'welcome']);
    Route::get('/destek-talebi',[AdminRouteController::class,'feedback']);
    Route::get('/destek-talebim',[AdminRouteController::class,'myfeedback']);
    Route::get('/islem-gecmisi',[AdminRouteController::class,'adminhistoryview']);
    Route::get('/islem-gecmisi/{order_id}',[AdminRouteController::class,'doctoraddmoney'])->name('doctoraddmoney');
    Route::get('/ayarlar',[AdminRouteController::class,'adminsetting']);

    //Admin -> POST
    Route::post('/feedbacksave',[AdminRouteController::class,'feedbacksave'])->name('feedbacksave');
    Route::post('/passwordupdate',[AdminRouteController::class,'passwordupdate'])->name('passwordupdate');
    Route::post('/profilupdate',[AdminRouteController::class,'profilupdate'])->name('profilupdate');
    

});

Route::post('/dr/dpayment/{user_id}',[CreditCardController::class,'dpayment'])->name('dpayment');
Route::post('/doctorbuy/{user_id}/{my_id}',[CreditCardController::class,'doctorbuy'])->name('doctorbuy');
Route::post('/threedoctorbuy/{doctor_user_id}/{my_user_id}/{doctor_date}/{doctor_time}/{doctor_message}',[CreditCardController::class,'threedoctorbuy'])->name('threedoctorbuy');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
