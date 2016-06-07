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

\Debugbar::disable();

Route::get('/', 'Layout\LayoutController@index');

Route::get('/login', function () {
    return view('login');
});

Route::group(['middleware' => ['role','cashier']], function () {
    Route::get('/VEROLE', function () {
        return 'se ve el role';
    });
});

 
Route::get('/test', function() {
    event(new \Salesfly\Events\SomeEvent());
    return 'event fired';
});

Route::get('/vista-redis', function() {
   return view('test');
});

Route::get('status', function(){
    return response('holi', 422)
        ->header('Content-Type', 'text/html; charset=UTF-8');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::group(['middleware' => 'role'], function () {
    Route::get('users/create', ['as' => 'user_create', 'uses' => 'Auth\AuthController@indexU']);
    Route::get('users/edit/{id?}', ['as' => 'user_edit', 'uses' => 'Auth\AuthController@indexU']);
    Route::get('users/form-create', ['as' => 'user_form_create', 'uses' => 'Auth\AuthController@form_create']);
    Route::get('users/form-edit', ['as' => 'user_form_edit', 'uses' => 'Auth\AuthController@form_edit']);
    Route::get('users', ['as' => 'user', 'uses' => 'Auth\AuthController@indexU']);
});
    Route::get('api/users/all', ['as' => 'user_all', 'uses' => 'Auth\AuthController@all']);
    Route::get('api/users/paginate/', ['as' => 'user_paginate', 'uses' => 'Auth\AuthController@paginate']);

    Route::post('api/users/create', ['as' => 'user_create', 'uses' => 'Auth\AuthController@postRegister']);
    Route::put('api/users/edit', ['as' => 'user_edit', 'uses' => 'Auth\AuthController@update']);
    Route::post('api/users/destroy', ['as' => 'user_destroy', 'uses' => 'Auth\AuthController@destroy']);
    Route::get('api/users/search/{q?}', ['as' => 'user_search', 'uses' => 'Auth\AuthController@search']);
    Route::get('api/users/find/{id}', ['as' => 'user_find', 'uses' => 'Auth\AuthController@find']);
    Route::get('api/users/stores', ['as' => 'user_stores_select', 'uses' => 'Auth\AuthController@store_select']);
    Route::get('api/users/disableuser/{id}', ['as' => 'user_disabled', 'uses' => 'Auth\AuthController@disableuser']);
    Route::post('api/users/changePass', 'Auth\AuthController@changePass');
//END

//PERSONS ROUTES
    Route::get('persons', ['as' => 'person', 'uses' => 'PersonsController@index']);
    Route::get('persons/create', ['as' => 'person_create', 'uses' => 'PersonsController@index']);
    Route::get('persons/edit/{id?}', ['as' => 'person_edit', 'uses' => 'PersonsController@index']);
    Route::get('persons/form-create', ['as' => 'person_form_create', 'uses' => 'PersonsController@form_create']);
    Route::get('persons/form-edit', ['as' => 'person_form_edit', 'uses' => 'PersonsController@form_edit']);
    Route::get('api/persons/all', ['as' => 'person_all', 'uses' => 'PersonsController@all']);
    Route::get('api/persons/paginate/', ['as' => 'person_paginate', 'uses' => 'PersonsController@paginatep']);
    Route::post('api/persons/create', ['as' => 'person_create', 'uses' => 'PersonsController@create']);
    Route::put('api/persons/edit', ['as' => 'person_edit', 'uses' => 'PersonsController@edit']);
    Route::post('api/persons/destroy', ['as' => 'person_destroy', 'uses' => 'PersonsController@destroy']);
    Route::get('api/persons/search/{q?}', ['as' => 'person_search', 'uses' => 'PersonsController@search']);
    Route::get('api/persons/find/{id}', ['as' => 'person_find', 'uses' => 'PersonsController@find']);
//END PERSONS ROUTES


Route::group(['middleware' => 'role'], function () {
    Route::get('stations', ['as' => 'warehouse', 'uses' => 'StationsController@index']);
    Route::get('stations/create', ['as' => 'warehouse_create', 'uses' => 'StationsController@index']);
    Route::get('stations/edit/{id?}', ['as' => 'atribut_edit', 'uses' => 'StationsController@index']);
    Route::get('stations/form-create', ['as' => 'atribut_form_create', 'uses' => 'StationsController@form_create']);
    Route::get('stations/form-edit', ['as' => 'atribut_form_edit', 'uses' => 'StationsController@form_edit']);
});


Route::get('api/stations/all',['as'=>'atribut_all', 'uses'=>'StationsController@all']);
Route::get('api/stations/paginate/',['as' => 'atribut_paginate', 'uses' => 'StationsController@paginatep']);
Route::post('api/stations/create',['as'=>'atribut_create', 'uses'=>'StationsController@create']);
Route::put('api/stations/edit',['as'=>'atribut_edit', 'uses'=>'StationsController@edit']);
Route::post('api/stations/destroy',['as'=>'atribut_destroy', 'uses'=>'StationsController@destroy']);
Route::get('api/stations/search/{q?}',['as'=>'atribut_search', 'uses'=>'StationsController@search']);
Route::get('api/stations/find/{id}',['as'=>'atribut_find', 'uses'=>'StationsController@find']);
Route::get('api/stations/validar/{text}',['as'=>'atribut_find', 'uses'=>'StationsController@validastationname']);


//-----------------------------Promociones---------------------------
Route::get('promotions',['as'=>'person','uses'=>'PromotionsController@index']);
Route::get('promotions/create',['as'=>'person_create','uses'=>'PromotionsController@index']);
Route::get('promotions/edit/{id?}', ['as' => 'person_edit', 'uses' => 'PromotionsController@index']);
Route::get('promotions/form-create',['as'=>'person_form_create','uses'=>'PromotionsController@form_create']);
Route::get('promotions/form-edit',['as'=>'person_form_edit','uses'=>'PromotionsController@form_edit']);
Route::get('api/promotions/all',['as'=>'person_all', 'uses'=>'PromotionsController@all']);
Route::get('api/promotions/paginate/',['as' => 'person_paginate', 'uses' => 'PromotionsController@paginatep']);
Route::post('api/promotions/create',['as'=>'person_create', 'uses'=>'PromotionsController@create']);
Route::put('api/promotions/edit',['as'=>'person_edit', 'uses'=>'PromotionsController@edit']);
Route::post('api/promotions/destroy',['as'=>'person_destroy', 'uses'=>'PromotionsController@destroy']);
Route::get('api/promotions/search/{q?}',['as'=>'person_search', 'uses'=>'PromotionsController@search']);
Route::get('api/promotions/find/{id}',['as'=>'person_find', 'uses'=>'PromotionsController@find']);
Route::get('api/promotions/mostrarCostos/{id}','PromotionsController@mostrarCostos');
//--------------------------Fin Promociones--------------------
//CATEGORIAS ROUTES
    Route::get('categories', ['as' => 'person', 'uses' => 'CategoriesController@index']);
    Route::get('categories/create', ['as' => 'person_create', 'uses' => 'CategoriesController@index']);
    Route::get('categories/edit/{id?}', ['as' => 'person_edit', 'uses' => 'CategoriesController@index']);
    Route::get('categories/form-create', ['as' => 'person_form_create', 'uses' => 'CategoriesController@form_create']);
    Route::get('categories/form-edit', ['as' => 'person_form_edit', 'uses' => 'CategoriesController@form_edit']);
    Route::get('api/categories/all', ['as' => 'person_all', 'uses' => 'CategoriesController@all']);
    Route::get('api/categories/paginate/', ['as' => 'person_paginate', 'uses' => 'CategoriesController@paginatep']);
    Route::post('api/categories/create', ['as' => 'person_create', 'uses' => 'CategoriesController@create']);
    Route::put('api/categories/edit', ['as' => 'person_edit', 'uses' => 'CategoriesController@edit']);
    Route::post('api/categories/destroy', ['as' => 'person_destroy', 'uses' => 'CategoriesController@destroy']);
    Route::get('api/categories/search/{q?}', ['as' => 'person_search', 'uses' => 'CategoriesController@search']);
    Route::get('api/categories/find/{id}', ['as' => 'person_find', 'uses' => 'CategoriesController@find']);
//END CATEGORIAS ROUTES
//PRODUCTOS ROUTES
    Route::get('products', ['as' => 'person', 'uses' => 'ProductsController@index']);
    Route::get('products/create', ['as' => 'person_create', 'uses' => 'ProductsController@index']);
    Route::get('products/edit/{id?}', ['as' => 'person_edit', 'uses' => 'ProductsController@index']);
    Route::get('products/form-create', ['as' => 'person_form_create', 'uses' => 'ProductsController@form_create']);
    Route::get('products/form-edit', ['as' => 'person_form_edit', 'uses' => 'ProductsController@form_edit']);
    Route::get('api/products/all', ['as' => 'person_all', 'uses' => 'ProductsController@all']);
    Route::get('api/products/paginate/', ['as' => 'person_paginate', 'uses' => 'ProductsController@paginatep']);
    Route::post('api/products/create', ['as' => 'person_create', 'uses' => 'ProductsController@create']);
    Route::put('api/products/edit', ['as' => 'person_edit', 'uses' => 'ProductsController@edit']);
    Route::post('api/products/destroy', ['as' => 'person_destroy', 'uses' => 'ProductsController@destroy']);
    Route::get('api/products/search/{q?}', ['as' => 'person_search', 'uses' => 'ProductsController@search']);
    Route::get('api/products/find/{id}', ['as' => 'person_find', 'uses' => 'ProductsController@find']);
//END CATEGORIAS ROUTES

