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

Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');
 
Route::group(['prefix'=>'/','middleware' => 'auth'], function () {

	Route::group(['prefix' => 'book'], function () {
    	Route::get('/', 'BookController@getIndex')->name('book.home');
    	Route::get('/delete/{id}', 'BookController@getDelete')->name('book.delete');
    	Route::get('/destroy/{id}', 'BookController@doDelete')->name('book.delete.post');
    	Route::get('/create', 'BookController@getCreate')->name('book.create');
    	Route::post('/create', 'BookController@postCreate')->name('book.create.post');
    	Route::get('/update/{id}', 'BookController@getUpdate')->name('book.update');
    	Route::post('/update/{id}', 'BookController@postUpdate')->name('book.update.post');
	});

	Route::group(['prefix' => 'author'], function () {
    	Route::get('/', 'AuthorController@getIndex')->name('author.home');
    	Route::get('/delete/{id}', 'AuthorController@getDelete')->name('author.delete');
    	Route::get('/destroy/{id}', 'AuthorController@doDelete')->name('author.delete.post');
    	Route::get('/create', 'AuthorController@getCreate')->name('author.create');
    	Route::post('/create', 'AuthorController@postCreate')->name('author.create.post');
    	Route::get('/update/{id}', 'AuthorController@getUpdate')->name('author.update');
    	Route::post('/update/{id}', 'AuthorController@postUpdate')->name('author.update.post');
	});

	Route::group(['prefix' => 'author.category'], function () {
    	Route::get('/', 'AuthorCategoryController@getIndex')->name('author.category.home');
    	Route::get('/delete/{id}', 'AuthorCategoryController@getDelete')->name('author.category.delete');
    	Route::get('/destroy/{id}', 'AuthorCategoryController@doDelete')->name('author.category.delete.post');
    	Route::get('/create', 'AuthorCategoryController@getCreate')->name('author.category.create');
    	Route::post('/create', 'AuthorCategoryController@postCreate')->name('author.category.create.post');
    	Route::get('/update/{id}', 'AuthorCategoryController@getUpdate')->name('author.category.update');
    	Route::post('/update/{id}', 'AuthorCategoryController@postUpdate')->name('author.category.update.post');
	});

	Route::group(['prefix' => 'category'], function (){
		Route::get('/', 'CategoryController@getIndex')->name('category.home');
		Route::get('/delete/{id}', 'CategoryController@getDelete')->name('category.delete');
		Route::get('/destroy{id}', 'CategoryController@DoDelete')->name('category.delete.post');
		Route::get('/create', 'CategoryController@getCreate')->name('category.create');
		Route::post('/create', 'CategoryController@PostCreate')->name('category.create.post');
		Route::get('/update/{id}', 'CategoryController@getUpdate')->name('category.update');
		Route::post('/update/{id}', 'CategoryController@postUpdate')->name('category.update.post');
	});

	Route::group(['prefix' => 'uacl'], function () {
		Route::group(['prefix' => 'group'], function () {
			Route::get('/', 'UACL\GroupController@getIndex')->name('uacl.group.index');
	    	Route::get('/delete/{id}', 'UACL\GroupController@getDelete')->name('uacl.group.delete');
	    	Route::get('/destroy/{id}', 'UACL\GroupController@doDelete')->name('uacl.group.do-delete');
	    	Route::get('/create', 'UACL\GroupController@getCreate')->name('uacl.group.create');
	    	Route::post('/create', 'UACL\GroupController@postCreate')->name('uacl.group.create.post');
	    	Route::get('/update/{id}', 'UACL\GroupController@getUpdate')->name('uacl.group.update');
	    	Route::post('/update/{id}', 'UACL\GroupController@postUpdate')->name('uacl.group.update.post');
		});

		Route::group(['prefix' => 'user'], function () {
			Route::get('/', 'UACL\UserController@getIndex')->name('uacl.user.index');
	    	Route::get('/delete/{id}', 'UACL\UserController@getDelete')->name('uacl.user.delete');
	    	Route::get('/destroy/{id}', 'UACL\UserController@doDelete')->name('uacl.user.delete.post');
	    	Route::get('/create', 'UACL\UserController@getCreate')->name('uacl.user.create');
	    	Route::post('/create', 'UACL\UserController@postCreate')->name('uacl.user.create.post');
	    	Route::get('/update/{id}', 'UACL\UserController@getUpdate')->name('uacl.user.update');
	    	Route::post('/update/{id}', 'UACL\UserController@postUpdate')->name('uacl.user.update.post');
		});
	});

	Route::group(['prefix' => '/'], function () {
    	Route::get('/', 'DashboardController@getIndex')->name('home');
    	Route::get('/delete/{id}', 'DashboardController@getDelete')->name('user_book.delete');
    	Route::get('/destroy/{id}', 'DashboardController@doDelete')->name('user_book.delete.post');
    	Route::get('/create', 'DashboardController@getCreate')->name('user_book.create');
    	Route::post('/create', 'DashboardController@postCreate')->name('user_book.create.post');
    	Route::get('/update/{id}', 'DashboardController@getUpdate')->name('user_book.update');
    	Route::post('/update/{id}', 'DashboardController@postUpdate')->name('user_book.update.post');
	});
 
    Route::get('logout', 'AuthController@logout')->name('logout');
});