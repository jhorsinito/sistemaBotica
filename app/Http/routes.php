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

   //PRODUCTS ROUTES
Route::get('productos',['as'=>'product','uses'=>'ProductosController@index']);
Route::get('productos/create',['as'=>'product_create','uses'=>'ProductosController@index']);
Route::get('productos/edit/{id?}', ['as' => 'product_edit', 'uses' => 'ProductosController@index']);
Route::get('productos/form-create',['as'=>'product_form_create','uses'=>'ProductosController@form_create']);
Route::get('productos/form-edit',['as'=>'product_form_edit','uses'=>'ProductosController@form_edit']);
Route::get('api/productos/all',['as'=>'product_all', 'uses'=>'ProductosController@all']);
Route::get('api/productos/paginate/',['as' => 'product_paginate', 'uses' => 'ProductosController@paginate']);
Route::get('api/productos/pag',['as' => 'prod_pag', 'uses' => 'ProductosController@pag']);
Route::post('api/productos/create',['as'=>'product_create', 'uses'=>'ProductosController@create']);
Route::put('api/productos/edit',['as'=>'product_edit', 'uses'=>'ProductosController@edit']);
Route::post('api/productos/destroy',['as'=>'product_destroy', 'uses'=>'ProductosController@destroy']);
Route::get('api/productos/disableprod/{id}',['as'=>'product_disabled', 'uses'=>'ProductosController@disableprod']);
Route::get('api/productos/search/{q?}',['as'=>'product_search', 'uses'=>'ProductosController@search']);
Route::get('api/productName/search/{q?}',['as'=>'product_search', 'uses'=>'ProductosController@searchProducts']);
Route::get('api/productaddVariant/search/{q?}',['as'=>'product_search', 'uses'=>'ProductosController@searchProductAddVariant']);
Route::get('api/productos/find/{id}',['as'=>'person_find', 'uses'=>'ProductosController@find']);
Route::get('api/productos/marcas',['as' => 'products_brands_select','uses' => 'ProductosController@brands_select']);
Route::get('api/productos/materials',['as' => 'products_materials_select','uses' => 'ProductosController@materials_select']);
Route::get('api/productos/types',['as' => 'products_types_select','uses' => 'ProductosController@types_select']);
Route::get('api/productos/stations',['as' => 'products_stations_select','uses' => 'ProductosController@stations_select']);
Route::get('productos/show/{id?}',['as' => 'products_show_by_id','uses' => 'ProductosController@index']);
Route::get('productos/view-show','ProductosController@show');
Route::get('api/productos/autocomplit/','ProductosController@autocomplit');
Route::get('api/productos/autocomplit2/','ProductosController@getAutocomplit2');
Route::get('api/productos/select','ProductosController@selectProducts');
Route::get('api/productos/validar/{text}','ProductosController@validarNombre');
//---------------------
Route::get('api/productsSearchsku/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductosController@searchsku']);
Route::get('api/productos/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductosController@misDatos']);
Route::get('api/productsVariantes/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductosController@misDatosVariantes']);
Route::get('api/productsFavoritos/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductosController@favoritos']);
Route::get('api/buquedarapida/misDatos/{store?}/{were?}/{q?}/{type?}/{marcas?}/{product?}/',['as'=>'person_find', 'uses'=>'ProductosController@variantsAllInventary']);
//---------------------
 
//END PRODUCTS ROUTES
//VARIANTS ROUTES
Route::get('api/variants/variant/{id}',['as' => 'variant_byproduct_id', 'uses' => 'VariantsController@variant']);
Route::get('api/variants/variants/{id}',['as' => 'variants_byproduct_id', 'uses' => 'VariantsController@variants']);
Route::get('api/variants/autocomplit/{sku}','VariantsController@traer_por_Sku');
Route::get('api/variants/Paginar_por_Variante','VariantsController@Paginar_por_Variante');
Route::get('api/variants/paginatep/{id}/{var}','VariantsController@paginatep');
Route::get('api/variants/selectTalla/{id}/{taco}','VariantsController@selectTalla');
Route::get('api/variants/selectStocksTalla/{id}/{taco}/{alma}','VariantsController@selectStocksTalla');
Route::get('api/variants/selectStocksTallaSinTaco/{id}/{alma}','VariantsController@selectStocksTallaSinTaco');
Route::get('api/variantname/search/{q?}',['as' => 'variant_byproduct_id', 'uses' => 'VariantsController@searchCodigo']);
//END VARIANTS ROUTES

//Presentations routes
Route::get('api/presentaciones/findVariant/{id}','PresentacionesController@findVariant');
Route::get('api/presentaciones/all',['as'=>'presentation_all', 'uses'=>'PresentacionesController@all']);
Route::get('api/presentations_base/all',['as'=>'presentation_base_all', 'uses'=>'PresentacionesController@all_base']);
Route::get('api/presentaciones/all_by_base/{id}',['as'=>'presentation_by_base_all', 'uses'=>'PresentacionesController@all_by_base']);
Route::post('api/presentaciones/create',['as'=>'presentation_create', 'uses'=>'PresentacionesController@create']);
//End prese routes

//route::controller('/', 'Layout\proban@prob'); 
Route::get('marcas',['as'=>'brand','uses'=>'MarcasController@index']);
 Route::get('marcas/create',['as'=>'brand_create','uses'=>'MarcasController@index']);
 Route::get('marcas/edit/{id?}', ['as' => 'brand_edit', 'uses' => 'MarcasController@index']);
 Route::get('marcas/form-create',['as'=>'brand_form_create','uses'=>'MarcasController@form_create']);
 Route::get('marcas/form-edit',['as'=>'brand_form_edit','uses'=>'MarcasController@form_edit']);
 Route::get('api/marcas/all',['as'=>'brand_all', 'uses'=>'MarcasController@all']);
 Route::get('api/marcas/paginate/',['as' => 'brand_paginate', 'uses' => 'MarcasController@paginatep']);
 Route::post('api/marcas/create',['as'=>'brand_create', 'uses'=>'MarcasController@create']);
 Route::put('api/marcas/edit',['as'=>'brand_edit', 'uses'=>'MarcasController@edit']);
 Route::post('api/marcas/destroy',['as'=>'brand_destroy', 'uses'=>'MarcasController@destroy']);
 Route::get('api/marcas/search/{q?}',['as'=>'brand_search', 'uses'=>'MarcasController@search']);
 Route::get('api/marcas/find/{id}',['as'=>'brand_find', 'uses'=>'MarcasController@find']);
 Route::get('api/marcas/validar/{text}',['as'=>'brand_find', 'uses'=>'MarcasController@validaBrandname']);
 //END STORE ROUTES
