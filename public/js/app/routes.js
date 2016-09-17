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


              //-----------------------------
                .when('/productos', {
                  templateUrl: '/js/app/productos/views/index.html',
                  controller: 'ProductoController'
                            })
                .when('/productos/create',{
                  templateUrl:'/productos/form-create',
                  controller: 'ProductoController'
                            })
                .when('/productos/edit/:id',{
                  templateUrl:'/productos/form-edit',
                  controller: 'ProductoController'
                          })
                  //-----------------------------

                .otherwise({
                    redirectTo: '/'
                });

            $locationProvider.html5Mode(true);
        }]);

})();
