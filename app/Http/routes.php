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
    //PERSONS ROUTES
    Route::get('tiendas', ['as' => 'person', 'uses' => 'TiendasController@index']);
    Route::get('tiendas/create', ['as' => 'person_create', 'uses' => 'TiendasController@index']);
    Route::get('tiendas/edit/{id?}', ['as' => 'person_edit', 'uses' => 'TiendasController@index']);
    Route::get('tiendas/form-create', ['as' => 'person_form_create', 'uses' => 'TiendasController@form_create']);
    Route::get('tiendas/form-edit', ['as' => 'person_form_edit', 'uses' => 'TiendasController@form_edit']);
    Route::get('api/tiendas/all', ['as' => 'person_all', 'uses' => 'TiendasController@all']);
    Route::get('api/tiendas/paginate/', ['as' => 'person_paginate', 'uses' => 'TiendasController@paginatep']);
    Route::post('api/tiendas/create', ['as' => 'person_create', 'uses' => 'TiendasController@create']);
    Route::put('api/tiendas/edit', ['as' => 'person_edit', 'uses' => 'TiendasController@edit']);
    Route::post('api/tiendas/destroy', ['as' => 'person_destroy', 'uses' => 'TiendasController@destroy']);
    Route::get('api/tiendas/search/{q?}', ['as' => 'person_search', 'uses' => 'TiendasController@search']);
    Route::get('api/tiendas/find/{id}', ['as' => 'person_find', 'uses' => 'TiendasController@find']);
    Route::get('api/tiendasAll/all', ['as' => 'person_all', 'uses' => 'TiendasController@allTiendas']);
//END PERSONS ROUTES


 //ALMACENES ROUTES
    Route::get('almacenes', ['as' => 'almacen', 'uses' => 'AlmacenesController@index']);
    Route::get('almacenes/create', ['as' => 'almacen_create', 'uses' => 'AlmacenesController@index']);
    Route::get('almacenes/edit/{id?}', ['as' => 'almacen_edit', 'uses' => 'AlmacenesController@index']);
    Route::get('almacenes/form-create', ['as' => 'almacen_form_create', 'uses' => 'AlmacenesController@form_create']);
    Route::get('almacenes/form-edit', ['as' => 'almacen_form_edit', 'uses' => 'AlmacenesController@form_edit']);
    Route::get('api/almacenes/all', ['as' => 'almacen_all', 'uses' => 'AlmacenesController@all']);
    Route::get('api/almacenes/paginate/', ['as' => 'almacen_paginate', 'uses' => 'AlmacenesController@paginatep']);
    Route::post('api/almacenes/create', ['as' => 'almacen_create', 'uses' => 'AlmacenesController@create']);
    Route::put('api/almacenes/edit', ['as' => 'almacen_edit', 'uses' => 'AlmacenesController@edit']);
    Route::post('api/almacenes/destroy', ['as' => 'almacen_destroy', 'uses' => 'AlmacenesController@destroy']);
    Route::get('api/almacenes/search/{q?}', ['as' => 'almacen_search', 'uses' => 'AlmacenesController@search']);
    Route::get('api/almacenes/find/{id}', ['as' => 'almacen_find', 'uses' => 'AlmacenesController@find']);
//END ALMACENES ROUTES



