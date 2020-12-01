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

Route::get('/','FrontendController@getHome');
Route::get('details/{id}/{slug}.html','FrontendController@getDetail');
Route::post('details/{id}/{slug}.html','FrontendController@postDetail');
Route::get('category/{id}/{slug}.html','FrontendController@getCategory');
Route::get('search','FrontendController@getSearch');
Route::group(['prefix'=>'cart'],function (){
	Route::get('add/{id}','CartController@getAdd');
	Route::get('show','CartController@getShowCart');
	Route::post('show','CartController@postShowCart');
	Route::get('update','CartController@getUpdateCart');
	Route::get('delete/{id}','CartController@getdelete');
});
Route::get('complete','CartController@GETcomplete');
Route::group(['namespace' => 'Admin'],function () {
	Route::group(['prefix'=>'login','middleware'=>'checklogin'],function () {
		Route::get('/','LoginController@getLogin');
		Route::post('/','LoginController@postLogin');

	});
	Route::get('logout','HomeController@getLogout');
	Route::group(['prefix'=>'admin',',middleware'=>'checklogout'],function () {
			Route::get('/home','HomeController@getHome');
	Route::group(['prefix'=>'category'],function () {
			Route::get('/','CategoryController@getCategory');
			Route::post('/','CategoryController@postCategory');
			Route::get('edit/{id}','CategoryController@getEditCategory');
			Route::post('edit/{id}','CategoryController@postEditCategory');
			Route::get('delete/{id}','CategoryController@getDeleteCategory');
		});

	Route::group(['prefix'=>'product'],function () {
			Route::get('/','ProductController@getProduct');
			Route::get('add/','ProductController@getAdd');
			Route::post('add/','ProductController@postAdd');
			Route::get('edit/{id}','ProductController@getEditProduct');
			Route::post('edit/{id}','ProductController@postEditProduct');
			Route::get('delete/{id}','ProductController@getDeleteProduct');
		});
	});

});