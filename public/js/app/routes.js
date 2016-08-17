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
                
                //------------------
                //RUTES UBIGEOS
                .when('/ubigeos', {
                    templateUrl: '/js/app/ubigeos/views/index.html',
                    controller: 'UbigeoController'
                })
                .when('/ubigeos/create',{
                    templateUrl:'/ubigeos/form-create',
                    controller: 'UbigeoController'
                })
                .when('/ubigeos/edit/:id',{
                    templateUrl:'/ubigeos/form-edit',
                    controller: 'UbigeoController'
                }) 
                //------------------
                //RUTES ACREDITADORAS
                .when('/acreditadoras', {
                    templateUrl: '/js/app/acreditadoras/views/index.html',
                    controller: 'AcreditadoraController'
                })
                .when('/acreditadoras/create',{
                    templateUrl:'/acreditadoras/form-create',
                    controller: 'AcreditadoraController'
                })
                .when('/acreditadoras/edit/:id',{
                    templateUrl:'/acreditadoras/form-edit',
                    controller: 'AcreditadoraController'
                }) 
                //------------------
                //RUTES ACREDITADORAS
                .when('/motivoVentas', {
                    templateUrl: '/js/app/motivoVentas/views/index.html',
                    controller: 'MotivoVentaController'
                })
                .when('/motivoVentas/create',{
                    templateUrl:'/motivoVentas/form-create',
                    controller: 'MotivoVentaController'
                })
                .when('/motivoVentas/edit/:id',{
                    templateUrl:'/motivoVentas/form-edit',
                    controller: 'MotivoVentaController'
                }) 
                //------------------
                //RUTES ACREDITADORAS
                .when('/bancos', {
                    templateUrl: '/js/app/bancos/views/index.html',
                    controller: 'BancoController'
                })
                .when('/bancos/create',{
                    templateUrl:'/bancos/form-create',
                    controller: 'BancoController'
                })
                .when('/bancos/edit/:id',{
                    templateUrl:'/bancos/form-edit',
                    controller: 'BancoController'
                }) 
                //------------------
                .otherwise({
                    redirectTo: '/'
                });
                
            $locationProvider.html5Mode(true);
        }]);

})();
