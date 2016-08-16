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





//UBIGEOS ROUTES
    Route::get('ubigeos', ['as' => 'person', 'uses' => 'UbigeosController@index']);
    Route::get('ubigeos/create', ['as' => 'person_create', 'uses' => 'UbigeosController@index']);
    Route::get('ubigeos/edit/{id?}', ['as' => 'person_edit', 'uses' => 'UbigeosController@index']);
    Route::get('ubigeos/form-create', ['as' => 'person_form_create', 'uses' => 'UbigeosController@form_create']);
    Route::get('ubigeos/form-edit', ['as' => 'person_form_edit', 'uses' => 'UbigeosController@form_edit']);
    Route::get('api/ubigeos/all', ['as' => 'person_all', 'uses' => 'UbigeosController@all']);
    Route::get('api/ubigeos/paginate/', ['as' => 'person_paginate', 'uses' => 'UbigeosController@paginatep']);
    Route::post('api/ubigeos/create', ['as' => 'person_create', 'uses' => 'UbigeosController@create']);
    Route::put('api/ubigeos/edit', ['as' => 'person_edit', 'uses' => 'UbigeosController@edit']);
    Route::post('api/ubigeos/destroy', ['as' => 'person_destroy', 'uses' => 'UbigeosController@destroy']);
    Route::get('api/ubigeos/search/{q?}', ['as' => 'person_search', 'uses' => 'UbigeosController@search']);
    Route::get('api/ubigeos/find/{id}', ['as' => 'person_find', 'uses' => 'UbigeosController@find']);

    Route::get('api/ubigeos/validar/{text}','UbigeosController@validarCodigo');
    Route::get('api/ubigeoDepartamento/all', ['as' => 'person_all', 'uses' => 'UbigeosController@ubigeoDepartament']); 
//END CATEGORIAS ROUTES

//UBIGEOS ROUTES
    Route::get('acreditadoras', ['as' => 'person', 'uses' => 'AcreditadorasController@index']);
    Route::get('acreditadoras/create', ['as' => 'person_create', 'uses' => 'AcreditadorasController@index']);
    Route::get('acreditadoras/edit/{id?}', ['as' => 'person_edit', 'uses' => 'AcreditadorasController@index']);
    Route::get('acreditadoras/form-create', ['as' => 'person_form_create', 'uses' => 'AcreditadorasController@form_create']);
    Route::get('acreditadoras/form-edit', ['as' => 'person_form_edit', 'uses' => 'AcreditadorasController@form_edit']);
    Route::get('api/acreditadoras/all', ['as' => 'person_all', 'uses' => 'AcreditadorasController@all']);
    Route::get('api/acreditadoras/paginate/', ['as' => 'person_paginate', 'uses' => 'AcreditadorasController@paginatep']);
    Route::post('api/acreditadoras/create', ['as' => 'person_create', 'uses' => 'AcreditadorasController@create']);
    Route::put('api/acreditadoras/edit', ['as' => 'person_edit', 'uses' => 'AcreditadorasController@edit']);
    Route::post('api/acreditadoras/destroy', ['as' => 'person_destroy', 'uses' => 'AcreditadorasController@destroy']);
    Route::get('api/acreditadoras/search/{q?}', ['as' => 'person_search', 'uses' => 'AcreditadorasController@search']);
    Route::get('api/acreditadoras/find/{id}', ['as' => 'person_find', 'uses' => 'AcreditadorasController@find']);
//END CATEGORIAS ROUTES
