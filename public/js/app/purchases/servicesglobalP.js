(function(){
    angular.module('crudOPurchases.services',[])
        .factory('crudOPurchase',['$http', '$q','$location', function($http, $q,$location){
             $atributes={};
            function all(uri,estado)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/all/'+estado)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
            

            function paginate(uri,page)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/paginate/?page='+page).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }
            function paginateDPedido(id,uri)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/paginatep/'+id).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }

            function create(area,uri)
            {
            
                var deferred = $q.defer();
                $http.post( '/api/'+uri+'/create', area )
                    .success(function (data)
                    {
                        deferred.resolve(data);
                    })
                ;
                return deferred.promise;
            }

            function update(area,uri)
            {
                var deferred = $q.defer();
                $http.put('/api/'+uri+'/edit', area )
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }

            function destroy(area,uri)
            {
                var deferred = $q.defer();
                $http.post('/api/'+uri+'/destroy', area )
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }
            function byforeingKey(uri,fx,id){
               var deferred = $q.defer();
               $http.get('/api/'+uri+'/'+fx+'/'+id)
                .success(function(data){
                     deferred.resolve(data);
                });
                return deferred.promise;
            }
            function bytraervar(id,uri) {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/findVariant/'+id)
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }
            function traerEmpresa(id){
                var deferred = $q.defer();
                $http.get('/api/orderPurchases/mostrarEmpresa/'+id)
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }
            /*function traerCodigo() {
                var deferred = $q.defer();
                $http.get('/api/purchases/mostarUltimoagregado')
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }*/
            function byId(id,uri) {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/find/'+id)
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }

            function search(uri,query,page){
                var deferred = $q.defer();
                var result = $http.get('/api/'+uri+'/search/'+query+'/?page='+page);

                result.success(function(data){
                        deferred.resolve(data);
                });
                return deferred.promise;
            }

            function select(uri,select)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/'+select)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
            function getTallas(id,uri,taco,almacen){
                var deferred = $q.defer();
                $http.get('/api/variants/'+uri+'/'+id+'/'+taco+'/'+almacen)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
            function setAtrib(id,almacen){
                var deferred = $q.defer();
                $http.get('/api/variants/selectStocksTallaSinTaco/'+id+'/'+almacen)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
             function select2(uri,select)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/select/'+select)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
              function autocomplit(uri)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/autocomplit/')
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
              function autocomplit2(uri)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/autocomplit2/')
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
              function StockActual(uri,vari,alma)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/verStockActual/'+vari+"/"+alma)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
              function listaCashes(uri,id)
            {
                var deferred = $q.defer();
                $http.get('/api/cashHeaders/cajasActivas/'+id)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
              function autocomplitVar(uri,sku)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/autocomplit/'+sku)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
             function MostrarAtributos(id,vari)
            {
                var deferred = $q.defer();
                $http.get('api/variants/paginatep/'+id+'/'+vari).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }
             function MostrarTallas(id,taco)
            {
                var deferred = $q.defer();
                $http.get('/api/variants/selectTalla/'+id+'/'+taco).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }
            function Reportes(id,uri)
            {
                var deferred = $q.defer();
                $http.post('/api/'+uri+'/create/'+id).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }
            return {
                all: all,
                paginate: paginate,
                create:create,
                byId:byId,
                update:update,
                destroy:destroy,
                search: search,
                select:select,
                byforeingKey: byforeingKey,
                bytraervar: bytraervar,
                //traerCodigo: traerCodigo,
                traerEmpresa: traerEmpresa,
                paginateDPedido: paginateDPedido,
                autocomplit: autocomplit,
                autocomplit2: autocomplit2,
                select2: select2,
                StockActual: StockActual,
                listaCashes: listaCashes,
                autocomplitVar: autocomplitVar,
                MostrarAtributos: MostrarAtributos,
                MostrarTallas: MostrarTallas,
               getTallas: getTallas,
               setAtrib: setAtrib,
               Reportes: Reportes
            }
        }])
        .factory('socketService', function ($rootScope) {
            var host = window.location.hostname;
            //var host = '192.168.0.26';
            var socket = io.connect('http://'+host+':3001');
            return {
                on: function (eventName, callback) {
                    socket.on(eventName, function () {
                        var args = arguments;
                        $rootScope.$apply(function () {
                            callback.apply(socket, args);
                        });
                    });
                },
                emit: function (eventName, data, callback) {
                    socket.emit(eventName, data, function () {
                        var args = arguments;
                        $rootScope.$apply(function () {
                            if (callback) {
                                callback.apply(socket, args);
                            }
                        });
                    })
                }
            };
        });
})();
