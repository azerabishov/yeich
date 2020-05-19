<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::post('/email/resend', 'Api\VerificationController@resend')->name('verification.resend')->middleware('auth:api');
Route::post('/email/verify', 'Api\VerificationController@verify')->name('verification.verify')->middleware('auth:api');
Route::post('/user/email', 'Api\UserController@updateEmail')->middleware('auth:api');
Route::post('/user/password', 'Api\UserController@newPassword')->middleware('auth:api');
Route::post('user/image-upload', 'Api\UserController@imageUpload')->middleware('auth:api');



Route::get('restaurant/{id}', 'Api\RestaurantController@restaurantDetail');
Route::get('offers','Api\OfferController@getOffers');
Route::post('restaurant/filter','Api\FilterController@filter');
Route::get('rating/{id}','Api\RestaurantController@getRatingDetail');
Route::post('rooms','Api\RestaurantController@getRooms');


Route::post('collection/add', 'Api\CollectionController@add')->middleware('auth:api');
Route::post('collection/update', 'Api\CollectionController@update')->middleware('auth:api');
Route::post('collections', 'Api\CollectionController@get')->middleware('auth:api');
Route::post('save/{id}', 'Api\RestaurantController@addToCollection')->middleware('auth:api');
Route::post('save/{id}/remove', 'Api\RestaurantController@removeFromCollection')->middleware('auth:api');



Route::post('reservation','Api\ReservationController@reservationIndexPage')->middleware('auth:api');
Route::post('reservation/check','Api\ReservationController@check')->middleware('auth:api');
Route::post('reservation/reserv','Api\ReservationController@reserv')->middleware('auth:api');

