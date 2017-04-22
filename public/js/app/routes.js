(function(){
    angular.module('routes',[])
        .config(['$routeProvider','$locationProvider', function ($routeProvider,$locationProvider) {
            $routeProvider
            // ------------------------------------------------------

           // ------------------------------------------------------

                .when('/persons', {
                    templateUrl: '/js/app/persons/views/index.html',
                    controller: 'PersonController'
                })
                .when('/persons/create',{
                    templateUrl:'/persons/form-create',
                    controller: 'PersonController'
                })
                .when('/persons/edit/:id',{
                    templateUrl:'/persons/form-edit',
                    controller: 'PersonController'
                })
                .when('/users', {
                    templateUrl: '/js/app/users/views/index.html',
                    controller: 'UserController'
                })
                .when('/users/create',{
                    templateUrl:'/users/form-create',
                    controller: 'UserController'
                })
                .when('/users/edit/:id',{
                    templateUrl:'/users/form-edit',
                    controller: 'UserController'
                })
                //-----------------------------
                .when('/tiendas', {
                    templateUrl: '/js/app/tiendas/views/index.html',
                    controller: 'TiendaController'
                })
                .when('/tiendas/create',{
                    templateUrl:'/tiendas/form-create',
                    controller: 'TiendaController'
                })
                .when('/tiendas/edit/:id',{
                    templateUrl:'/tiendas/form-edit',
                    controller: 'TiendaController'
                })
                //-----------------------------

                    //-----------------------------
                .when('/almacenes', {
                    templateUrl: '/js/app/almacenes/views/index.html',
                    controller: 'AlmacenController'
                })
                .when('/almacenes/create',{
                    templateUrl:'/almacenes/form-create',
                    controller: 'AlmacenController'
                })
                .when('/almacenes/edit/:id',{
                    templateUrl:'/almacenes/form-edit',
                    controller: 'AlmacenController'
                })
                //-----------------------------

// ------------------------------------------------------
            .when('/atributes', {
                    templateUrl: '/js/app/atributes/views/index.html',
                    controller: 'AtributController'
                })
                .when('/atributes/create',{
                    templateUrl:'/atributes/form-create',
                    controller: 'AtributController'
                })
                .when('/atributes/edit/:id',{
                    templateUrl:'/atributes/form-edit',
                    controller: 'AtributController'
                }) 
                //----------------------------------------------------
                  .when('/materials', {
                    templateUrl: '/js/app/materials/views/index.html',
                    controller: 'MaterialsController'
                })
                .when('/materials/create',{
                    templateUrl:'/materials/form-create',
                    controller: 'MaterialsController'
                })
                .when('/materials/preDolar',{
                    templateUrl:'/materials/form-preDolar',
                    controller: 'MaterialsController'
                })
                .when('/materials/listPreciDolar',{
                    templateUrl:'/materials/form-listPreciDolar',
                    controller: 'MaterialsController'
                })
                .when('/materials/editPreDolar/:id',{
                    templateUrl:'/materials/form-editPreDolar',
                    controller: 'MaterialsController'
                }) 
                .when('/materials/edit/:id',{
                    templateUrl:'/materials/form-edit',
                    controller: 'MaterialsController'
                }) 
                //---------------------------------------------------
                .when('/stations', {
                    templateUrl: '/js/app/stations/views/index.html',
                    controller: 'StationController'
                })
                .when('/stations/create',{
                    templateUrl:'/stations/form-create',
                    controller: 'StationController'
                })
                .when('/stations/edit/:id',{
                    templateUrl:'/stations/form-edit',
                    controller: 'StationController'
                }) 
                // ------------------------------------------------------
                // ------------------------------------------------------
            .when('/types', {
                    templateUrl: '/js/app/types/views/index.html',
                    controller: 'TypeController'
                })
                .when('/types/create',{
                    templateUrl:'/types/form-create',
                    controller: 'TypeController'
                })
                .when('/types/edit/:id',{
                    templateUrl:'/types/form-edit',
                    controller: 'TypeController'
                })    

                //-------------------------------------------------------------        
             .when('/brands', {
                    templateUrl: '/js/app/brands/views/index.html',
                    controller: 'BrandController'
                })
                .when('/brands/create',{
                    templateUrl:'/brands/form-create',
                    controller: 'BrandController'
                })
                .when('/brands/edit/:id',{
                    templateUrl:'/brands/form-edit',
                    controller: 'BrandController'
                })  
                      //----------------------------------------------------------------------
                      //-------------------------------------------------
                .when('/products', {
                    templateUrl: '/js/app/products/views/index.html',
                    controller: 'ProductController'
                })
                .when('/products/create',{
                    templateUrl:'/products/form-create',
                    controller: 'ProductController'
                })
                .when('/products/edit/:id',{
                    templateUrl:'/products/form-edit',
                    controller: 'ProductController'
                })
                .when('/products/show/:id',{
                    templateUrl:'/products/view-show',
                    controller: 'ProductController'
                })
                //-----------------------------------------------
                .when('/variants/create/:product_id',{
                    templateUrl: '/variants/form-create',
                    controller: 'ProductController'
                })
                .when('/variants/edit/:id',{
                    templateUrl: '/variants/form-edit',
                    controller: 'ProductController'
                })
                
                 //-------------------------------------------------------------        
             .when('/laboratorios', {
                    templateUrl: '/js/app/laboratorios/views/index.html',
                    controller: 'LaboratorioController'
                })
                .when('/laboratorios/create',{
                    templateUrl:'/laboratorios/form-create',
                    controller: 'LaboratorioController'
                })
                .when('/laboratorios/edit/:id',{
                    templateUrl:'/laboratorios/form-edit',
                    controller: 'LaboratorioController'
                }) 

                //-------------------------------------------------------------        
             .when('/clientes', {
                    templateUrl: '/js/app/clientes/views/index.html',
                    controller: 'ClienteController'
                })
                .when('/clientes/create',{
                    templateUrl:'/clientes/form-create',
                    controller: 'ClienteController'
                })
                .when('/clientes/edit/:id',{
                    templateUrl:'/clientes/form-edit',
                    controller: 'ClienteController'
                }) 
                //------------------------------------------------------------- 
                 .when('/proveedores', {
                    templateUrl: '/js/app/proveedores/views/index.html',
                    controller: 'ProveedorController'
                })
                .when('/proveedores/create',{
                    templateUrl:'/proveedores/form-create',
                    controller: 'ProveedorController'
                })
                .when('/proveedores/edit/:id',{
                    templateUrl:'/proveedores/form-edit',
                    controller: 'ProveedorController'
                })
                

                //------------------------------------------------------------- 
                 .when('/tipoDocumentos', {
                    templateUrl: '/js/app/tipoDocumentos/views/index.html',
                    controller: 'TipoDocumentoController'
                })
                .when('/tipoDocumentos/create',{
                    templateUrl:'/tipoDocumentos/form-create',
                    controller: 'TipoDocumentoController'
                })
                .when('/tipoDocumentos/edit/:id',{
                    templateUrl:'/tipoDocumentos/form-edit',
                    controller: 'TipoDocumentoController'
                })

                //------------------------------------------------------------- 
                 .when('/comprobantes', {
                    templateUrl: '/js/app/comprobantes/views/index.html',
                    controller: 'ComprobanteController'
                })
                .when('/comprobantes/create',{
                    templateUrl:'/comprobantes/form-create',
                    controller: 'ComprobanteController'
                })
                .when('/comprobantes/edit/:id',{
                    templateUrl:'/comprobantes/form-edit',
                    controller: 'ComprobanteController'
                })

                //------------------------------------------------------------- 
                 .when('/tipoProductos', {
                    templateUrl: '/js/app/tipoProductos/views/index.html',
                    controller: 'TipoProductoController'
                })
                .when('/tipoProductos/create',{
                    templateUrl:'/tipoProductos/form-create',
                    controller: 'TipoProductoController'
                })
                .when('/tipoProductos/edit/:id',{
                    templateUrl:'/tipoProductos/form-edit',
                    controller: 'TipoProductoController'
                })

                //------------------------------------------------------------- 
                 .when('/metodoPagos', {
                    templateUrl: '/js/app/metodoPagos/views/index.html',
                    controller: 'MetodoPagoController'
                })
                .when('/metodoPagos/create',{
                    templateUrl:'/metodoPagos/form-create',
                    controller: 'MetodoPagoController'
                })
                .when('/metodoPagos/edit/:id',{
                    templateUrl:'/metodoPagos/form-edit',
                    controller: 'MetodoPagoController'
                })

                //--------------------------------------------------
                 .when('/cajas', {
                    templateUrl: '/js/app/cajas/views/index.html',
                    controller: 'CajaController'
                })
                .when('/cajas/create',{
                    templateUrl:'/cajas/form-create',
                    controller: 'CajaController'
                })
                .when('/cajas/edit/:id',{
                    templateUrl:'/cajas/form-edit',
                    controller: 'CajaController'
                })

                 //-------------------------------------------------

                .when('/ventas', {
                    templateUrl: '/js/app/ventas/views/index.html',
                    controller: 'VentaController'
                })
                .when('/ventas/create',{
                    templateUrl:'/ventas/form-create',
                    controller: 'VentaController'
                })
                .when('/ventas/edit/:id',{
                    templateUrl:'/ventas/form-edit',
                    controller: 'VentaController'
                })

                //------------------------------------------------------------- 

                .when('/compras', {
                    templateUrl: '/js/app/compras/views/index.html',
                    controller: 'CompraController'
                })
                .when('/compras/create',{
                    templateUrl:'/compras/form-create',
                    controller: 'CompraController'
                })
                .when('/compras/edit/:id',{
                    templateUrl:'/compras/form-edit',
                    controller: 'CompraController'
                })

                //------------------------------------------------------------- 


                .otherwise({
                    redirectTo: '/'
                });

            $locationProvider.html5Mode(true);
        }]);

})();