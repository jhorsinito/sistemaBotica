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

Route::get('/', 'Layout\LayoutController@index');

Route::get('/login', function () {
    return view('login');
});

Route::get('/test', function() {
    event(new \Salesfly\Events\SomeEvent());
    return 'event fired';
});

Route::get('/vista-redis', function() {
   return view('test');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('users/create',['as'=>'user_create','uses'=>'Auth\AuthController@indexU']);
Route::get('users/edit/{id?}', ['as' => 'user_edit', 'uses' => 'Auth\AuthController@indexU']);
Route::get('users/form-create',['as'=>'user_form_create','uses'=>'Auth\AuthController@form_create']);
Route::get('users/form-edit',['as' => 'user_form_edit','uses' => 'Auth\AuthController@form_edit']);
Route::get('users',['as'=>'user','uses'=>'Auth\AuthController@indexU']);
Route::get('api/users/all',['as'=>'user_all', 'uses'=>'Auth\AuthController@all']);
Route::get('api/users/paginate/',['as' => 'user_paginate', 'uses' => 'Auth\AuthController@paginate']);
Route::post('api/users/create',['as'=>'user_create', 'uses'=>'Auth\AuthController@postRegister']);
Route::put('api/users/edit',['as'=>'user_edit', 'uses'=>'Auth\AuthController@edit']);
Route::post('api/users/destroy',['as'=>'user_destroy', 'uses'=>'Auth\AuthController@destroy']);
Route::get('api/users/search/{q?}',['as'=>'user_search', 'uses'=>'Auth\AuthController@search']);
Route::get('api/users/find/{id}',['as'=>'user_find', 'uses'=>'Auth\AuthController@find']);
Route::get('api/users/stores',['as' => 'user_stores_select','uses' => 'Auth\AuthController@store_select']);
//END

//PERSONS ROUTES
Route::get('persons',['as'=>'person','uses'=>'PersonsController@index']);
Route::get('persons/create',['as'=>'person_create','uses'=>'PersonsController@index']);
Route::get('persons/edit/{id?}', ['as' => 'person_edit', 'uses' => 'PersonsController@index']);
Route::get('persons/form-create',['as'=>'person_form_create','uses'=>'PersonsController@form_create']);
Route::get('persons/form-edit',['as'=>'person_form_edit','uses'=>'PersonsController@form_edit']);
Route::get('api/persons/all',['as'=>'person_all', 'uses'=>'PersonsController@all']);
Route::get('api/persons/paginate/',['as' => 'person_paginate', 'uses' => 'PersonsController@paginatep']);
Route::post('api/persons/create',['as'=>'person_create', 'uses'=>'PersonsController@create']);
Route::put('api/persons/edit',['as'=>'person_edit', 'uses'=>'PersonsController@edit']);
Route::post('api/persons/destroy',['as'=>'person_destroy', 'uses'=>'PersonsController@destroy']);
Route::get('api/persons/search/{q?}',['as'=>'person_search', 'uses'=>'PersonsController@search']);
Route::get('api/persons/find/{id}',['as'=>'person_find', 'uses'=>'PersonsController@find']);
//END PERSONS ROUTES

//CUSTOMERS ROUTES
Route::get('customers',['as'=>'person','uses'=>'CustomersController@index']);
Route::get('customers/create',['as'=>'person_create','uses'=>'CustomersController@index']);
Route::get('customers/edit/{id?}', ['as' => 'person_edit', 'uses' => 'CustomersController@index']);
Route::get('customers/form-create',['as'=>'person_form_create','uses'=>'CustomersController@form_create']);
Route::get('customers/form-edit',['as'=>'person_form_edit','uses'=>'CustomersController@form_edit']);
Route::get('api/customers/all',['as'=>'person_all', 'uses'=>'CustomersController@all']);
Route::get('api/customers/paginate/',['as' => 'person_paginate', 'uses' => 'CustomersController@paginatep']);
Route::post('api/customers/create',['as'=>'person_create', 'uses'=>'CustomersController@create']);
Route::put('api/customers/edit',['as'=>'person_edit', 'uses'=>'CustomersController@edit']);
Route::post('api/customers/destroy',['as'=>'person_destroy', 'uses'=>'CustomersController@destroy']);
Route::get('api/customers/search/{q?}',['as'=>'person_search', 'uses'=>'CustomersController@search']);
Route::get('api/customers/find/{id}',['as'=>'person_find', 'uses'=>'CustomersController@find']);
//END CUSTOMERS ROUTES
