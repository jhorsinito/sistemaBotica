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
Route::get('/melvin/{nombre?}', function($nom='Alexis'){
	//return make("hola mundo");
	return 'hola '.$nom;
});
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

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

//PERSONS ROUTES
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
//END PERSONS ROUTES

//STORE ROUTES
Route::get('stores',['as'=>'store','uses'=>'StoresController@index']);
Route::get('stores/create',['as'=>'store_create','uses'=>'StoresController@index']);
Route::get('stores/edit/{id?}', ['as' => 'store_edit', 'uses' => 'StoresController@index']);
Route::get('stores/form-create',['as'=>'store_form_create','uses'=>'StoresController@form_create']);
Route::get('stores/form-edit',['as'=>'store_form_edit','uses'=>'StoresController@form_edit']);
Route::get('api/stores/all',['as'=>'store_all', 'uses'=>'StoresController@all']);
Route::get('api/stores/paginate/',['as' => 'store_paginate', 'uses' => 'StoresController@paginatep']);
Route::post('api/stores/create',['as'=>'store_create', 'uses'=>'StoresController@create']);
Route::put('api/stores/edit',['as'=>'store_edit', 'uses'=>'StoresController@edit']);
Route::post('api/stores/destroy',['as'=>'store_destroy', 'uses'=>'StoresController@destroy']);
Route::get('api/stores/search/{q?}',['as'=>'store_search', 'uses'=>'StoresController@search']);
Route::get('api/stores/find/{id}',['as'=>'store_find', 'uses'=>'StoresController@find']);
//route::controller('/', 'Layout\proban@prob');
Route::get('brands',['as'=>'brand','uses'=>'BrandsController@index']);
 Route::get('brands/create',['as'=>'brand_create','uses'=>'BrandsController@index']);
 Route::get('brands/edit/{id?}', ['as' => 'brand_edit', 'uses' => 'BrandsController@index']);
 Route::get('brands/form-create',['as'=>'brand_form_create','uses'=>'BrandsController@form_create']);
 Route::get('brands/form-edit',['as'=>'brand_form_edit','uses'=>'BrandsController@form_edit']);
 Route::get('api/brands/all',['as'=>'brand_all', 'uses'=>'BrandsController@all']);
 Route::get('api/brands/paginate/',['as' => 'brand_paginate', 'uses' => 'BrandsController@paginatep']);
 Route::post('api/brands/create',['as'=>'brand_create', 'uses'=>'BrandsController@create']);
 Route::put('api/brands/edit',['as'=>'brand_edit', 'uses'=>'BrandsController@edit']);
 Route::post('api/brands/destroy',['as'=>'brand_destroy', 'uses'=>'BrandsController@destroy']);
 Route::get('api/brands/search/{q?}',['as'=>'brand_search', 'uses'=>'BrandsController@search']);
 Route::get('api/brands/find/{id}',['as'=>'brand_find', 'uses'=>'BrandsController@find']);
 //END STORE ROUTES
Route::get('types',['as'=>'store','uses'=>'TypesController@index']);
Route::get('types/create',['as'=>'type_create','uses'=>'TypesController@index']);
Route::get('types/edit/{id?}', ['as' => 'type_edit', 'uses' => 'TypesController@index']);
Route::get('types/form-create',['as'=>'type_form_create','uses'=>'TypesController@form_create']);
Route::get('types/form-edit',['as'=>'type_form_edit','uses'=>'TypesController@form_edit']);
Route::get('api/types/all',['as'=>'type_all', 'uses'=>'TypesController@all']);
Route::get('api/types/paginate/',['as' => 'type_paginate', 'uses' => 'TypesController@paginatep']);
Route::post('api/types/create',['as'=>'type_create', 'uses'=>'TypesController@create']);
Route::put('api/types/edit',['as'=>'type_edit', 'uses'=>'TypesController@edit']);
Route::post('api/types/destroy',['as'=>'type_destroy', 'uses'=>'TypesController@destroy']);
Route::get('api/types/search/{q?}',['as'=>'type_search', 'uses'=>'TypesController@search']);
Route::get('api/types/find/{id}',['as'=>'type_find', 'uses'=>'TypesController@find']);
/*
Route::get('brands',['as'=>'brand','uses'=>'BrandsController@index']);
Route::get('brands/create',['as'=>'brand_create','uses'=>'BrandsController@index']);
Route::get('brands/edit/{id?}', ['as' => 'brand_edit', 'uses' => 'BrandsController@index']);
Route::get('api/brands/paginate/',['as' => 'brands_paginate', 'uses' => 'BrandsController@paginatep']);
*/
Route::get('atributes',['as'=>'atribut','uses'=>'AtributesController@index']);
Route::get('atributes/create',['as'=>'atribut_create','uses'=>'AtributesController@index']);
Route::get('atributes/edit/{id?}', ['as' => 'atribut_edit', 'uses' => 'AtributesController@index']);
Route::get('atributes/form-create',['as'=>'atribut_form_create','uses'=>'AtributesController@form_create']);
Route::get('atributes/form-edit',['as'=>'atribut_form_edit','uses'=>'AtributesController@form_edit']);
Route::get('api/atributes/all',['as'=>'atribut_all', 'uses'=>'AtributesController@all']);
Route::get('api/atributes/paginate/',['as' => 'atribut_paginate', 'uses' => 'AtributesController@paginatep']);
Route::post('api/atributes/create',['as'=>'atribut_create', 'uses'=>'AtributesController@create']);
Route::put('api/atributes/edit',['as'=>'atribut_edit', 'uses'=>'AtributesController@edit']);
Route::post('api/atributes/destroy',['as'=>'atribut_destroy', 'uses'=>'AtributesController@destroy']);
Route::get('api/atributes/search/{q?}',['as'=>'atribut_search', 'uses'=>'AtributesController@search']);
Route::get('api/atributes/find/{id}',['as'=>'atribut_find', 'uses'=>'AtributesController@find']);


Route::get('api/stores/','AtributesController@selest');