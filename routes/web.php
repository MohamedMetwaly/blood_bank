<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix' => 'admin'], function (){

    Route::get('resetPassword','UserController@GetEmail')->name('resetPassword');
    Route::post('resetPassword','UserController@SendEmail')->name('postResetPassword');

    Route::get('newPassword','UserController@ResetPassword')->name('newPassword');
    Route::post('newPassword','UserController@NewPassword')->name('postNewPassword');

    Route::group(['middleware' => ['auth','auto-check-permission']],function(){

        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('governorate','GovernorateController');
        Route::resource('category','CategoryController');
        Route::resource('city','CityController');
        Route::resource('post','PostController');
        Route::resource('contact','ContactController');
        Route::resource('role','RoleController');
        Route::resource('setting','SettingController');
        Route::resource('client','ClientController');
        Route::post('active/{id}','ClientController@active');
        Route::resource('donation','DonationController');
        Route::resource('user','UserController');
        Route::get('changePassword','UserController@changePassword')->name('changePassword');
        Route::post('changePassword','UserController@changePasswordSave')->name('postChangePassword');
        Route::post('search','ClientController@search');
    });

});

Route::group(['prefix' => 'user', 'namespace' => 'client'], function (){

    Route::group(['middleware' => 'check-auth'],function (){

        Route::get('signup','AuthController@GetRegister');
        Route::post('signup','AuthController@PostRegister');
        Route::get('signin','AuthController@GetLogin');
        Route::post('signin','AuthController@PostLogin');
        Route::get('resetPassword','AuthController@GetEmail');
        Route::post('resetPassword','AuthController@SendEmail');
        Route::get('newPassword','AuthController@ResetPassword')->name('userNewPassword');
        Route::post('newPassword','AuthController@NewPassword');

    });

    Route::get('/','MainController@index')->name('homepage');
    Route::get('article/{id}','MainController@ArticleDetail');
    Route::get('articles','MainController@AllPost');
    Route::get('donations','MainController@Donations');
    Route::get('donation/{id}','MainController@DonationDetail');
    Route::get('about','MainController@AboutUs');
    Route::get('contact','MainController@GetContact');
    Route::post('contact','MainController@PostContact');

    Route::group(['middleware' => 'auth:client'], function (){
        Route::get('donation','MainController@GetDonation');
        Route::post('donation','MainController@DonationRequest');
        Route::post('toggle','MainController@TogglePost');
        Route::get('signout','AuthController@Logout');
    });

});
