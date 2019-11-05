<?php

use Illuminate\Http\Request;
//use Illuminate\Routing\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'namespace' => 'api'], function(){
	Route::get('governorates','MainController@governorates');
	Route::get('cities','MainController@cities');
	Route::post('register','AuthController@register');
	Route::post('login','AuthController@login');
    Route::post('reset-password','AuthController@resetPassword');
    Route::post('new-password','AuthController@newPassword');
	Route::post('remove-token','AuthController@removeToken');
	Route::group(['middleware' => 'auth:api'], function(){
		Route::get('search-posts','MainController@searchPosts');
		Route::post('post-details','MainController@postDetails');
		Route::get('categories','MainController@categories');
		Route::get('settings','MainController@settings');
		Route::post('contacts','MainController@contacts');
		Route::get('profile','MainController@profile');
		Route::post('profile/edit','MainController@editProfile');
		Route::get('notification','MainController@getNotificationSettings');
		Route::post('notification-edit','MainController@editNotificationSettings');
        Route::get('favourites-list','MainController@getFavourites');
        Route::post('favourites-toggle','MainController@setFavourites');
		Route::get('notifications','MainController@notifications');
        Route::post('donation-create','MainController@donationRequestCreate');
        Route::get('search-donations','MainController@searchDonations');
        Route::post('donation-details','MainController@donationDetails');
		Route::post('register-token','AuthController@registerToken');
	});
});
