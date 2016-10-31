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
Route::get('api/atributes/selectNumber/{id}/{tama}',['as'=>'atribut_find', 'uses'=>'AtributesController@selectNumber']);
Route::get('api/stores/','AtributesController@selest');
//END ALMACENES ROUTES
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
 Route::get('api/brands/validar/{text}',['as'=>'brand_find', 'uses'=>'BrandsController@validaBrandname']);
//END ALMACENES ROUTES
Route::get('api/detpres/paginatep/{id}','DetPresController@paginatep');
Route::get('api/detpres/find/{id}','DetPresController@find');
Route::get('api/detpres/{id}','DetPresController@select');
Route::get('api/detpresPresentation/search/{id?}',['as'=>'person_search', 'uses'=>'DetPresController@searchPresentations']);
Route::get('api/detpres/all','DetPresController@all');
//END ALMACENES ROUTES
Route::get('api/equiv/all','EquivController@all');
Route::get('api/equiv/traer/{id}','EquivController@equivalencias');
Route::get('api/equivs/find/{id}','EquivController@find');
//END ALMACENES ROUTES
Route::get('materials',['as'=>'warehouse','uses'=>'MaterialsController@index']);
Route::get('materials/create',['as'=>'warehouse_create','uses'=>'MaterialsController@index']);
Route::get('materials/edit/{id?}', ['as' => 'atribut_edit', 'uses' => 'MaterialsController@index']);
Route::get('materials/form-create',['as'=>'atribut_form_create','uses'=>'MaterialsController@form_create']);
Route::get('materials/form-edit',['as'=>'atribut_form_edit','uses'=>'MaterialsController@form_edit']);
Route::get('api/materials/all',['as'=>'atribut_all', 'uses'=>'MaterialsController@all']);
Route::get('api/materials/paginate/',['as' => 'atribut_paginate', 'uses' => 'MaterialsController@paginatep']);
Route::post('api/materials/create',['as'=>'atribut_create', 'uses'=>'MaterialsController@create']);
Route::put('api/materials/edit',['as'=>'atribut_edit', 'uses'=>'MaterialsController@edit']);
Route::post('api/materials/destroy',['as'=>'atribut_destroy', 'uses'=>'MaterialsController@destroy']);
Route::get('api/materials/search/{q?}',['as'=>'atribut_search', 'uses'=>'MaterialsController@search']);
Route::get('api/materials/find/{id}',['as'=>'atribut_find', 'uses'=>'MaterialsController@find']);

Route::get('materials/form-preDolar',['as'=>'atribut_form_create','uses'=>'MaterialsController@form_preDolar']);
Route::get('materials/preDolar',['as'=>'atribut_create', 'uses'=>'MaterialsController@index']);
Route::post('api/PreDolar/create',['as'=>'atribut_create', 'uses'=>'MaterialsController@preDolar']);
Route::get('materials/form-listPreciDolar','MaterialsController@form_listPreciDolar');
Route::get('materials/listPreciDolar','MaterialsController@index');
Route::get('api/preDolar/paginate/',['as' => 'atribut_paginate', 'uses' => 'MaterialsController@paginatep2']);
Route::get('materials/editPreDolar/{id?}', ['as' => 'atribut_edit', 'uses' => 'MaterialsController@index']);
Route::get('materials/form-editPreDolar',['as'=>'atribut_form_edit','uses'=>'MaterialsController@form_editPreDolar']);
Route::get('api/preDolar/find/{mes}',['as'=>'atribut_form_edit','uses'=>'MaterialsController@editPaginar']);
Route::put('api/updatePreDolar/edit',['as'=>'atribut_edit', 'uses'=>'MaterialsController@editPredolar']);
//END ALMACENES ROUTES
Route::post('api/reports1/{cant}',['as'=>'person_search', 'uses'=>'ProductsController@reports']);

Route::get('products',['as'=>'product','uses'=>'ProductsController@index']);
Route::get('products/create',['as'=>'product_create','uses'=>'ProductsController@index']);
Route::get('products/edit/{id?}', ['as' => 'product_edit', 'uses' => 'ProductsController@index']);
Route::get('products/form-create',['as'=>'product_form_create','uses'=>'ProductsController@form_create']);
Route::get('products/form-edit',['as'=>'product_form_edit','uses'=>'ProductsController@form_edit']);
Route::get('api/products/all',['as'=>'product_all', 'uses'=>'ProductsController@all']);
Route::get('api/products/paginate/',['as' => 'product_paginate', 'uses' => 'ProductsController@paginate']);
Route::get('api/products/pag',['as' => 'prod_pag', 'uses' => 'ProductsController@pag']);
Route::post('api/products/create',['as'=>'product_create', 'uses'=>'ProductsController@create']);
Route::put('api/products/edit',['as'=>'product_edit', 'uses'=>'ProductsController@edit']);
Route::post('api/products/destroy',['as'=>'product_destroy', 'uses'=>'ProductsController@destroy']);
Route::get('api/products/disableprod/{id}',['as'=>'product_disabled', 'uses'=>'ProductsController@disableprod']);

Route::get('api/products/search/{q?}',['as'=>'product_search', 'uses'=>'ProductsController@search']);
Route::get('api/productName/search/{q?}',['as'=>'product_search', 'uses'=>'ProductsController@searchProducts']);
Route::get('api/productaddVariant/search/{q?}',['as'=>'product_search', 'uses'=>'ProductsController@searchProductAddVariant']);

Route::get('api/products/find/{id}',['as'=>'person_find', 'uses'=>'ProductsController@find']);
Route::get('api/products/brands',['as' => 'products_brands_select','uses' => 'ProductsController@brands_select']);
Route::get('api/products/materials',['as' => 'products_materials_select','uses' => 'ProductsController@materials_select']);
Route::get('api/products/types',['as' => 'products_types_select','uses' => 'ProductsController@types_select']);
Route::get('api/products/stations',['as' => 'products_stations_select','uses' => 'ProductsController@stations_select']);
Route::get('products/show/{id?}',['as' => 'products_show_by_id','uses' => 'ProductsController@index']);
Route::get('products/view-show','ProductsController@show');
Route::get('api/products/autocomplit/','ProductsController@autocomplit');
Route::get('api/products/autocomplit2/','ProductsController@getAutocomplit2');
Route::get('api/products/select','ProductsController@selectProducts');

Route::get('api/products/validar/{text}','ProductsController@validarNombre');
Route::get('api/productsCodigo/validar/{text}','ProductsController@validarCodigo');
//---------------------
Route::get('api/productsSearchsku/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductsController@searchsku']);
Route::get('api/products/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductsController@misDatos']);
Route::get('api/productsVariantes/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductsController@misDatosVariantes']);
Route::get('api/productsFavoritos/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductsController@favoritos']);
Route::get('api/buquedarapida/misDatos/{store?}/{were?}/{q?}/{type?}/{brand?}/{product?}/',['as'=>'person_find', 'uses'=>'ProductsController@variantsAllInventary']);

Route::get('api/TraerModelos/all',['as'=>'presentation_all', 'uses'=>'ProductsController@TraerModelos']);

//END ALMACENES ROUTES
Route::get('api/stocks/find/{id}/{id1}','StocksController@find');
Route::put('api/stocks/edit/','StocksController@edit');
Route::get('api/stocks/traerstock/{product_id}','StocksController@traerStock');
Route::get('api/stocks/verStockActual/{var}/{almacen}','StocksController@verStockActual');

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

Route::get('api/typeName/search/{q?}',['as'=>'type_search', 'uses'=>'TypesController@searchType']);

//END STORE ROUTES
Route::get('variants/create/{product_id}',['as'=>'variant_create','uses'=>'VariantsController@index']);
Route::get('variants/edit/{id?}', ['as' => 'variant_edit', 'uses' => 'VariantsController@index']);
Route::get('variants/form-create',['as'=>'variant_form_create','uses'=>'VariantsController@form_create']);
Route::get('variants/form-edit',['as'=>'variant_form_edit','uses'=>'VariantsController@form_edit']);
Route::post('api/variants/create',['as'=>'variant_create', 'uses'=>'VariantsController@create']);
Route::put('api/variants/edit',['as'=>'variant_edit', 'uses'=>'VariantsController@edit']);
Route::post('api/variants/destroy',['as'=>'variant_destroy', 'uses'=>'VariantsController@destroy']);
Route::get('api/variants/select','VariantsController@select');
Route::get('api/variants/findVariant/{id}','VariantsController@findVariant');
Route::get('api/variants/paginate/','VariantsController@paginatep');
Route::get('api/variants/find/{id}','VariantsController@find');
Route::get('api/variants/getAttr/{id}','VariantsController@getAttr');
Route::get('api/getVariantid/getAttr/{q}','VariantsController@getVariantid');
Route::put('api/variants/editFavorito/','VariantsController@editFavoritos');
Route::get('api/variants/disablevar/{id}',['as'=>'variant_disabled', 'uses'=>'VariantsController@disablevar']);

Route::get('api/variants/variant/{id}',['as' => 'variant_byproduct_id', 'uses' => 'VariantsController@variant']);
Route::get('api/variants/variants/{id}',['as' => 'variants_byproduct_id', 'uses' => 'VariantsController@variants']);
Route::get('api/variants/autocomplit/{sku}','VariantsController@traer_por_Sku');
Route::get('api/variants/Paginar_por_Variante','VariantsController@Paginar_por_Variante');
Route::get('api/variants/paginatep/{id}/{var}','VariantsController@paginatep');
Route::get('api/variants/selectTalla/{id}/{taco}','VariantsController@selectTalla');
Route::get('api/variants/selectStocksTalla/{id}/{taco}/{alma}','VariantsController@selectStocksTalla');
Route::get('api/variants/selectStocksTallaSinTaco/{id}/{alma}','VariantsController@selectStocksTallaSinTaco');

Route::get('api/variantname/search/{q?}',['as' => 'variant_byproduct_id', 'uses' => 'VariantsController@searchCodigo']);
//=============
Route::get('api/presentations/findVariant/{id}','PresentationsController@findVariant');
Route::get('api/presentations/all',['as'=>'presentation_all', 'uses'=>'PresentationsController@all']);
Route::get('api/presentations_base/all',['as'=>'presentation_base_all', 'uses'=>'PresentationsController@all_base']);
Route::get('api/presentations/all_by_base/{id}',['as'=>'presentation_by_base_all', 'uses'=>'PresentationsController@all_by_base']);
Route::post('api/presentations/create',['as'=>'presentation_create', 'uses'=>'PresentationsController@create']);
//=============================================================
//PERSONS ROUTES
    Route::get('tipoProductos', ['as' => 'person', 'uses' => 'TipoProductosController@index']);
    Route::get('tipoProductos/create', ['as' => 'person_create', 'uses' => 'TipoProductosController@index']);
    Route::get('tipoProductos/edit/{id?}', ['as' => 'person_edit', 'uses' => 'TipoProductosController@index']);
    Route::get('tipoProductos/form-create', ['as' => 'person_form_create', 'uses' => 'TipoProductosController@form_create']);
    Route::get('tipoProductos/form-edit', ['as' => 'person_form_edit', 'uses' => 'TipoProductosController@form_edit']);
    Route::get('api/tipoProductos/all', ['as' => 'person_all', 'uses' => 'TipoProductosController@all']);
    Route::get('api/tipoProductos/paginate/', ['as' => 'person_paginate', 'uses' => 'TipoProductosController@paginatep']);
    Route::post('api/tipoProductos/create', ['as' => 'person_create', 'uses' => 'TipoProductosController@create']);
    Route::put('api/tipoProductos/edit', ['as' => 'person_edit', 'uses' => 'TipoProductosController@edit']);
    Route::post('api/tipoProductos/destroy', ['as' => 'person_destroy', 'uses' => 'TipoProductosController@destroy']);
    Route::get('api/tipoProductos/search/{q?}', ['as' => 'person_search', 'uses' => 'TipoProductosController@search']);
    Route::get('api/tipoProductos/find/{id}', ['as' => 'person_find', 'uses' => 'TipoProductosController@find']);
    Route::get('api/buscarProducto/recuperarDosDato/{dato1?}/{dato2?}', ['as' => 'person_all', 'uses' => 'ProductsController@buscarProducto']);
//END PERSONS ROUTES
    //PERSONS ROUTES
    Route::get('laboratorios', ['as' => 'person', 'uses' => 'LaboratoriosController@index']);
    Route::get('laboratorios/create', ['as' => 'person_create', 'uses' => 'LaboratoriosController@index']);
    Route::get('laboratorios/edit/{id?}', ['as' => 'person_edit', 'uses' => 'LaboratoriosController@index']);
    Route::get('laboratorios/form-create', ['as' => 'person_form_create', 'uses' => 'LaboratoriosController@form_create']);
    Route::get('laboratorios/form-edit', ['as' => 'person_form_edit', 'uses' => 'LaboratoriosController@form_edit']);
    Route::get('api/laboratorios/all', ['as' => 'person_all', 'uses' => 'LaboratoriosController@all']);
    Route::get('api/laboratorios/paginate/', ['as' => 'person_paginate', 'uses' => 'LaboratoriosController@paginatep']);
    Route::post('api/laboratorios/create', ['as' => 'person_create', 'uses' => 'LaboratoriosController@create']);
    Route::put('api/laboratorios/edit', ['as' => 'person_edit', 'uses' => 'LaboratoriosController@edit']);
    Route::post('api/laboratorios/destroy', ['as' => 'person_destroy', 'uses' => 'LaboratoriosController@destroy']);
    Route::get('api/laboratorios/search/{q?}', ['as' => 'person_search', 'uses' => 'LaboratoriosController@search']);
    Route::get('api/laboratorios/find/{id}', ['as' => 'person_find', 'uses' => 'LaboratoriosController@find']);
    Route::get('api/traerLaboratorios/all', ['as' => 'person_all', 'uses' => 'LaboratoriosController@traerLaboratorios']);
//END PERSONS ROUTES
    //PERSONS ROUTES
    Route::get('detComercialGenericos', ['as' => 'person', 'uses' => 'DetComercialGenericoController@index']);
    Route::get('detComercialGenericos/create', ['as' => 'person_create', 'uses' => 'DetComercialGenericoController@index']);
    Route::get('detComercialGenericos/edit/{id?}', ['as' => 'person_edit', 'uses' => 'DetComercialGenericoController@index']);
    Route::get('detComercialGenericos/form-create', ['as' => 'person_form_create', 'uses' => 'DetComercialGenericoController@form_create']);
    Route::get('detComercialGenericos/form-edit', ['as' => 'person_form_edit', 'uses' => 'DetComercialGenericoController@form_edit']);
    Route::get('api/detComercialGenericos/all', ['as' => 'person_all', 'uses' => 'DetComercialGenericoController@all']);
    Route::get('api/detComercialGenericos/paginate/', ['as' => 'person_paginate', 'uses' => 'DetComercialGenericoController@paginatep']);
    Route::post('api/detComercialGenericos/create', ['as' => 'person_create', 'uses' => 'DetComercialGenericoController@create']);
    Route::put('api/detComercialGenericos/edit', ['as' => 'person_edit', 'uses' => 'DetComercialGenericoController@edit']);
    Route::post('api/detComercialGenericos/destroy', ['as' => 'person_destroy', 'uses' => 'DetComercialGenericoController@destroy']);
    Route::get('api/detComercialGenericos/search/{q?}', ['as' => 'person_search', 'uses' => 'DetComercialGenericoController@search']);
    Route::get('api/detComercialGenericos/find/{id}', ['as' => 'person_find', 'uses' => 'DetComercialGenericoController@find']);
    Route::get('api/buscarGenerioco/find/{id}', ['as' => 'person_find', 'uses' => 'DetComercialGenericoController@buscarGenerioco']);
    Route::get('api/buscarComercial/find/{id}', ['as' => 'person_find', 'uses' => 'DetComercialGenericoController@buscarComercial']);
    
//END PERSONS ROUTES
    //PERSONS ROUTES
    Route::get('gruposFarmacologicos', ['as' => 'person', 'uses' => 'GruposFarmacologicoController@index']);
    Route::get('gruposFarmacologicos/create', ['as' => 'person_create', 'uses' => 'GruposFarmacologicoController@index']);
    Route::get('gruposFarmacologicos/edit/{id?}', ['as' => 'person_edit', 'uses' => 'GruposFarmacologicoController@index']);
    Route::get('gruposFarmacologicos/form-create', ['as' => 'person_form_create', 'uses' => 'GruposFarmacologicoController@form_create']);
    Route::get('gruposFarmacologicos/form-edit', ['as' => 'person_form_edit', 'uses' => 'GruposFarmacologicoController@form_edit']);
    Route::get('api/gruposFarmacologicos/all', ['as' => 'person_all', 'uses' => 'GruposFarmacologicoController@all']);
    Route::get('api/gruposFarmacologicos/paginate/', ['as' => 'person_paginate', 'uses' => 'GruposFarmacologicoController@paginatep']);
    Route::post('api/gruposFarmacologicos/create', ['as' => 'person_create', 'uses' => 'GruposFarmacologicoController@create']);
    Route::put('api/gruposFarmacologicos/edit', ['as' => 'person_edit', 'uses' => 'GruposFarmacologicoController@edit']);
    Route::post('api/gruposFarmacologicos/destroy', ['as' => 'person_destroy', 'uses' => 'GruposFarmacologicoController@destroy']);
    Route::get('api/gruposFarmacologicos/search/{q?}', ['as' => 'person_search', 'uses' => 'GruposFarmacologicoController@search']);
    Route::get('api/gruposFarmacologicos/find/{id}', ['as' => 'person_find', 'uses' => 'GruposFarmacologicoController@find']);
    Route::get('api/buscarGrupoFarmaceutico/recuperarUnDato/{dato1?}', ['as' => 'person_all', 'uses' => 'GruposFarmacologicoController@buscarGrupoFarmaceutico']);
    
//END PERSONS ROUTES
    //PERSONS ROUTES
    Route::get('detGrupoFarmaceuticos', ['as' => 'person', 'uses' => 'DetGrupoFarmaceuticoVarianteController@index']);
    Route::get('detGrupoFarmaceuticos/create', ['as' => 'person_create', 'uses' => 'DetGrupoFarmaceuticoVarianteController@index']);
    Route::get('detGrupoFarmaceuticos/edit/{id?}', ['as' => 'person_edit', 'uses' => 'DetGrupoFarmaceuticoVarianteController@index']);
    Route::get('detGrupoFarmaceuticos/form-create', ['as' => 'person_form_create', 'uses' => 'DetGrupoFarmaceuticoVarianteController@form_create']);
    Route::get('detGrupoFarmaceuticos/form-edit', ['as' => 'person_form_edit', 'uses' => 'DetGrupoFarmaceuticoVarianteController@form_edit']);
    Route::get('api/detGrupoFarmaceuticos/all', ['as' => 'person_all', 'uses' => 'DetGrupoFarmaceuticoVarianteController@all']);
    Route::get('api/detGrupoFarmaceuticos/paginate/', ['as' => 'person_paginate', 'uses' => 'DetGrupoFarmaceuticoVarianteController@paginatep']);
    Route::post('api/detGrupoFarmaceuticos/create', ['as' => 'person_create', 'uses' => 'DetGrupoFarmaceuticoVarianteController@create']);
    Route::put('api/detGrupoFarmaceuticos/edit', ['as' => 'person_edit', 'uses' => 'DetGrupoFarmaceuticoVarianteController@edit']);
    Route::post('api/detGrupoFarmaceuticos/destroy', ['as' => 'person_destroy', 'uses' => 'DetGrupoFarmaceuticoVarianteController@destroy']);
    Route::get('api/detGrupoFarmaceuticos/search/{q?}', ['as' => 'person_search', 'uses' => 'DetGrupoFarmaceuticoVarianteController@search']);
    Route::get('api/detGrupoFarmaceuticos/find/{id}', ['as' => 'person_find', 'uses' => 'DetGrupoFarmaceuticoVarianteController@find']);
    Route::get('api/cargarDetGrupoFarmaceuticoVariantes/recuperarUnDato/{dato1?}', ['as' => 'person_all', 'uses' => 'DetGrupoFarmaceuticoVarianteController@cargarDetGrupoFarmaceuticoVariantes']);
    
//END PERSONS ROUTES