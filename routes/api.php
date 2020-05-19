<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//deal with user operation
Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::post('/password/email', 'Api\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'Api\ResetPasswordController@reset');
Route::post('/email/resend', 'Api\VerificationController@resend')->name('verification.resend');
Route::post('/email/verify', 'Api\VerificationController@verify')->name('verification.verify');
Route::put('/user/{id}/email', 'Api\UserController@updateEmail')->middleware('auth:api');
Route::put('/user/{id}/password', 'Api\UserController@newPassword')->middleware('auth:api');
Route::post('user/{id}/image-upload', 'Api\UserController@imageUpload');



//deal with reataurant operations
Route::get('restaurant/{id}', 'Api\RestaurantController@restaurantDetail');
Route::get('offers','Api\OfferController@getOffers');
Route::post('restaurant/filter','Api\RestaurantController@filter');
Route::get('rating/{id}','Api\RestaurantController@getRatingDetail');
Route::post('rooms','Api\RestaurantController@getRooms');


//deal wiith collection and save operations
Route::post('add_collection', 'Api\CollectionController@addCollection')->middleware('auth:api');
Route::post('collections', 'Api\CollectionController@getCollection')->middleware('auth:api');
Route::post('save/{id}', 'Api\RestaurantController@addToCollection')->middleware('auth:api');
Route::post('save/{id}/remove', 'Api\RestaurantController@removeFromCollection')->middleware('auth:api');
Route::post('reserv','Api\ReservationController@reservationIndexPage');
Route::post('reservet','Api\ReservationController@reservation');
Route::post('oldu','Api\ReservationController@makeReservation');

