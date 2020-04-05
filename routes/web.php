<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/login/facebook', 'Auth\LoginController@redirectToFacebookProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => [
    'auth'
]], function(){
 
    Route::get('/user', 'GraphController@retrieveUserProfile');
 
    Route::post('/user', 'GraphController@publishToProfile');
	
	Route::post('/page', 'GraphController@publishToPage');
 
});
Auth::routes();

Route::get('/home', 'socialmediaController@index')->name('home');
Route::get('socialmedia/index', 'socialmediaController@index')->name('socialmedia/index');
Route::get('socialmedia/create', 'socialmediaController@create');
Route::get('socialmedia/create', ['as'=> 'socialmedia.create', 'uses' => 'socialmediaController@create']);
Route::get('socialmedia/get_data', ['as'=> 'socialmedia.get_data','uses' => 'socialmediaController@get_data']);
Route::get('socialmedia/edit/{id}', ['as'=> 'socialmedia.edit','uses' => 'socialmediaController@edit']);
Route::any('socialmedia/update', ['as'=> 'socialmedia.update','uses' => 'socialmediaController@update']);
Route::get('socialmedia/create', ['as'=> 'socialmedia.create', 'uses' => 'socialmediaController@create']);
Route::post('socialmedia/store', ['uses' => 'socialmediaController@store']);
