<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('library','SectionController2');
Route::resource('admin','SectionController2@adminform');
Route::resource('library/restored/{id}/','SectionController2@restored');
Route::resource('library/deleteforever/{id}/','SectionController2@deleteforever');
Route::resource('book','bookcontroller');
Route::resource('summery','bookcontroller@summery');

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/auth/feacbook','Auth\AuthController@redirectToProvider');
Route::get('/callback','Auth\AuthController@handeProviderToCallback');
Route::resource('store','SectionController2@store');