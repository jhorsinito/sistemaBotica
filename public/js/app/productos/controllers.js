(function(){
    angular.module('productos.controllers',[])
        .controller('ProductoController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log','ngProgressFactory','$rootScope','trouble','$window','$modal',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log,ngProgressFactory,$rootScope,trouble,$window,$modal){
                $scope.progressbar = ngProgressFactory.createInstance();
                /*$rootScope.$on('$routeChangeStart', function(ev,data) {
                    $scope.progressbar.start();
                });
                $rootScope.$on('$routeChangeSuccess', function(ev,data) {
                    $scope.progressbar.complete();
                });*/
               

                $scope.stockVariants = [];

                $scope.stockTemplate = 'stockTemplate.html';

                $scope.productos = [];
                $scope.producto = {};
                $scope.variant = {};
                $scope.producto.track = true;
                $scope.variant.track = true;
                $scope.producto.autogenerado = true;
                $scope.variant.autogenerado = true;
                //$scope.variant.detAtr = [];
                $scope.producto.presentaciones = [];
                $scope.variant.presentaciones = [];
                $scope.generos = [{name:'Masculino'},{name:'Femenino'}];
                $scope.errors;
                $scope.success;
                $scope.query = ''; 
                $scope.marcas = {};
                $scope.materials = {};
                $scope.types = {};
                $scope.stations = {};
                $scope.producto.estado = true;
                $scope.producto.hasVariants = true;

                $scope.presentacion = {};
                $scope.presentaciones = [];
                $scope.preAdd = {};
                $scope.presentacion.id = '1';
                //$scope.producto.presentaciones = [];
                $scope.presentacion.suppPri = 0;
                $scope.presentacion.markup = 0;
                $scope.presentacion.price = 0;
                $scope.presentacion.markupCant = 0;
                $scope.presentacion.suppPriDol = 0;

                //desctos
                $scope.presentacion.dscto = 0;
                $scope.presentacion.dsctoCant = 0;
                $scope.presentacion.pvp = 0;
                $scope.presentacion.fecIniDscto = new Date();
                $scope.presentacion.fecFinDscto = new Date();
                $scope.presentacion.dsctoRange = 0;
                $scope.presentacion.dsctoCantRange = 0;
                $scope.presentacion.pvpRange = 0;

                $scope.presentacion.cambioDolar = 3.00;
                //
                $scope.presentacion.edit = false;
                $scope.presentacion.identificador = -1;

                $scope.presentacion.activateDsctoRange = false;

                $scope.minNumber = 0;

                $scope.warehouses = [];


                $scope.variants = []; //variantes por producto_id;
                $scope.variant.fvenc = new Date();

                //$scope.producto.presentacionBase = '1';

                $scope.producto.presentation_base_object = {};
                $scope.variant.presentation_base_object = {};

                //$scope.producto.presentation_base_object = {id:1};
                $scope.enabled_presentation_button = true;
                $scope.enabled_createpresentation_button = false;

                /*
                de variants create
                 */
                $scope.categories=[{id:1,nombre:'Dama'},{id:2,nombre:'Caballero'},{id:3,nombre:'Niño'},{id:4,nombre:'Niña'}];
                $scope.variant.category= 1;
                //$log.log($scope.category);
                $scope.attributes = [];
                /*
                ./ de variants create
                 */

                $scope.calculateCambioDolar = function() {
                    //$scope.presentacion.suppPri = presentacion.suppPriDol * presentacion.cambioDolar
                    /*$scope.calculateSuppPric();*/
                    $scope.calculateSuppPricDol();
                }
                 $scope.calculateSuppPricDol1 = function() {
                    //alert("Hffola");
                    //presentacion.suppPriDol
                    //$scope.presentacion.suppPriDol = parseFloat($scope.presentacion.suppPriDol).toFixed(2);
                    $scope.calculateSuppPricDol();
                }
                $scope.calcularigv = function() {
                    $scope.calculateSuppPricIgv();
                }
                $scope.calculateSuppPricIgv = function() {
                    //alert("Hola");
                    $scope.presentacion.suppPriDol = parseFloat($scope.presentacion.sinIgv)+(parseFloat($scope.presentacion.sinIgv) * 0.18);
                    $scope.presentacion.suppPriDol = parseFloat($scope.presentacion.suppPriDol).toFixed(2);

                    $scope.presentacion.suppPri = parseFloat($scope.presentacion.suppPriDol) * parseFloat($scope.presentacion.cambioDolar);
                    $scope.presentacion.suppPri = parseFloat($scope.presentacion.suppPri).toFixed(2);
                    //$scope.presentacion.suppPriDol = parseFloat($scope.presentacion.suppPriDol).toFixed(2);
                    //tobal
                    $scope.presentacion.price = parseFloat($scope.presentacion.suppPri) + parseFloat($scope.presentacion.markup) * parseFloat($scope.presentacion.suppPri) / 100;
                    $scope.presentacion.price = parseFloat($scope.presentacion.price).toFixed(2);

                    
                    //----
                    //$scope.calculateSuppPric();
                    $scope.calculatePrice();
                }

                $scope.calculateSuppPricDol = function() {
                    $scope.presentacion.suppPri = parseFloat($scope.presentacion.suppPriDol) * parseFloat($scope.presentacion.cambioDolar);
                    $scope.presentacion.suppPri = parseFloat($scope.presentacion.suppPri).toFixed(2);
                    //$scope.presentacion.suppPriDol = parseFloat($scope.presentacion.suppPriDol).toFixed(2);
                    //tobal
                    $scope.presentacion.price = parseFloat($scope.presentacion.suppPri) + parseFloat($scope.presentacion.markup) * parseFloat($scope.presentacion.suppPri) / 100;
                    $scope.presentacion.price = parseFloat($scope.presentacion.price).toFixed(2);

                    $scope.presentacion.sinIgv = (parseFloat($scope.presentacion.suppPriDol) / 1.18);
                    $scope.presentacion.sinIgv = parseFloat($scope.presentacion.sinIgv).toFixed(2);
                    //----
                    //$scope.calculateSuppPric();
                    $scope.calculatePrice();
                }

                $scope.calculateMarkupCant = function(){
                    $scope.presentacion.price = parseFloat($scope.presentacion.suppPri) + parseFloat($scope.presentacion.markupCant);
                    $scope.presentacion.price = parseFloat($scope.presentacion.price).toFixed(2);

                    $scope.presentacion.markup = (parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.suppPri)) * 100 / parseFloat($scope.presentacion.suppPri);
                    $scope.presentacion.markup = parseFloat($scope.presentacion.markup).toFixed(2);
                    $scope.calculatePrice();
                }

                $scope.calculateSuppPric = function() {//presentacion.markup
                    //alert('holi');alert($scope.presentacion.suppPri);
                    //alert('hi');
                    //if(angular.isNumber($scope.presentacion.suppPri) && angular.isNumber($scope.presentacion.markup) && angular.isNumber($scope.presentacion.price)){
                        $scope.presentacion.price = parseFloat($scope.presentacion.suppPri) + parseFloat($scope.presentacion.markup) * parseFloat($scope.presentacion.suppPri) / 100;
                        $scope.presentacion.price = parseFloat($scope.presentacion.price).toFixed(2);
                        $scope.presentacion.suppPriDol = parseFloat($scope.presentacion.suppPri) / parseFloat($scope.presentacion.cambioDolar);
                        $scope.presentacion.suppPriDol = parseFloat($scope.presentacion.suppPriDol).toFixed(2);
                        
                        $scope.presentacion.sinIgv = (parseFloat($scope.presentacion.suppPriDol) / 1.18);
                        $scope.presentacion.sinIgv = parseFloat($scope.presentacion.sinIgv).toFixed(2);
                    $scope.calculatePrice();
                    //alert('holi');
                    //}
                };
                $scope.calculateMarkup = function() {
                    //alert('holi');
                    //if(angular.isNumber($scope.presentacion.suppPri) && angular.isNumber($scope.presentacion.markup) && angular.isNumber($scope.presentacion.price)){
                        $scope.presentacion.price = parseFloat($scope.presentacion.suppPri) + parseFloat($scope.presentacion.markup) * parseFloat($scope.presentacion.suppPri) / 100;
                        $scope.presentacion.price = parseFloat($scope.presentacion.price).toFixed(2);

                        $scope.presentacion.markupCant = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.suppPri);
                        $scope.presentacion.markupCant = parseFloat($scope.presentacion.markupCant).toFixed(2);
                        $scope.calculatePrice1();
                    //}
                };
                $scope.calculatePrice1 = function() {
                    //alert('holi');
                    //if(angular.isNumber($scope.presentacion.suppPri) && angular.isNumber($scope.presentacion.markup) && angular.isNumber($scope.presentacion.price)){
                        //$scope.presentacion.markup = (parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.suppPri)) * 100 / parseFloat($scope.presentacion.suppPri);
                        //$scope.presentacion.markup = parseFloat($scope.presentacion.markup).toFixed(2);

                    $scope.presentacion.pvp = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.dscto) * parseFloat($scope.presentacion.price) / 100;
                    $scope.presentacion.pvp = parseFloat($scope.presentacion.pvp).toFixed(2);

                    $scope.presentacion.dsctoCant = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvp);
                    $scope.presentacion.dsctoCant = parseFloat($scope.presentacion.dsctoCant).toFixed(2);

                        $scope.presentacion.markupCant = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.suppPri);
                        $scope.presentacion.markupCant = parseFloat($scope.presentacion.markupCant).toFixed(2);

                    $scope.presentacion.pvpRange = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.dsctoRange) * parseFloat($scope.presentacion.price) / 100;
                    $scope.presentacion.pvpRange = parseFloat($scope.presentacion.pvpRange).toFixed(2);

                    $scope.presentacion.dsctoCantRange = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvpRange);
                    $scope.presentacion.dsctoCantRange = parseFloat($scope.presentacion.dsctoCantRange).toFixed(2);


                    //}
                };
                $scope.calculatePrice = function() {
                    //alert('holi');
                    //if(angular.isNumber($scope.presentacion.suppPri) && angular.isNumber($scope.presentacion.markup) && angular.isNumber($scope.presentacion.price)){
                        $scope.presentacion.markup = (parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.suppPri)) * 100 / parseFloat($scope.presentacion.suppPri);
                        $scope.presentacion.markup = parseFloat($scope.presentacion.markup).toFixed(2);

                    $scope.presentacion.pvp = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.dscto) * parseFloat($scope.presentacion.price) / 100;
                    $scope.presentacion.pvp = parseFloat($scope.presentacion.pvp).toFixed(2);

                    $scope.presentacion.dsctoCant = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvp);
                    $scope.presentacion.dsctoCant = parseFloat($scope.presentacion.dsctoCant).toFixed(2);

                        $scope.presentacion.markupCant = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.suppPri);
                        $scope.presentacion.markupCant = parseFloat($scope.presentacion.markupCant).toFixed(2);

                    $scope.presentacion.pvpRange = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.dsctoRange) * parseFloat($scope.presentacion.price) / 100;
                    $scope.presentacion.pvpRange = parseFloat($scope.presentacion.pvpRange).toFixed(2);

                    $scope.presentacion.dsctoCantRange = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvpRange);
                    $scope.presentacion.dsctoCantRange = parseFloat($scope.presentacion.dsctoCantRange).toFixed(2);


                    //}
                };

                //dsctos calcular

                $scope.calculatePVP = function() {
                    $scope.presentacion.dscto = (parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvp)) * 100 / parseFloat($scope.presentacion.price);
                    $scope.presentacion.dscto = parseFloat($scope.presentacion.dscto).toFixed(2);

                    $scope.presentacion.dsctoCant = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvp);
                    $scope.presentacion.dsctoCant = parseFloat($scope.presentacion.dsctoCant).toFixed(2);
                    //$scope.presentacion.pvp = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.dscto) * parseFloat($scope.presentacion.price) / 100;
                    //$scope.presentacion.pvp = parseFloat($scope.presentacion.pvp).toFixed(2);
                }

                $scope.calculateDscto = function() {
                    //alert('holi');
                    //if(angular.isNumber($scope.presentacion.suppPri) && angular.isNumber($scope.presentacion.markup) && angular.isNumber($scope.presentacion.price)){
                    $scope.presentacion.pvp = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.dscto) * parseFloat($scope.presentacion.price) / 100;
                    $scope.presentacion.pvp = parseFloat($scope.presentacion.pvp).toFixed(2);

                    $scope.presentacion.dsctoCant = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvp);
                    $scope.presentacion.dsctoCant = parseFloat($scope.presentacion.dsctoCant).toFixed(2);
                    //}
                };
                $scope.calculateDsctoCant = function() {
                    //alert('holi');
                    //if(angular.isNumber($scope.presentacion.suppPri) && angular.isNumber($scope.presentacion.markup) && angular.isNumber($scope.presentacion.price)){
                    $scope.presentacion.pvp = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.dsctoCant);
                    $scope.presentacion.pvp = parseFloat($scope.presentacion.pvp).toFixed(2);

                    $scope.presentacion.dscto = (parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvp)) * 100 / parseFloat($scope.presentacion.price);
                    $scope.presentacion.dscto = parseFloat($scope.presentacion.dscto).toFixed(2);
                    //}
                };

                $scope.calculateDsctoRange = function() {
                    //alert('holi');
                    //if(angular.isNumber($scope.presentacion.suppPri) && angular.isNumber($scope.presentacion.markup) && angular.isNumber($scope.presentacion.price)){
                    $scope.presentacion.pvpRange = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.dsctoRange) * parseFloat($scope.presentacion.price) / 100;
                    $scope.presentacion.pvpRange = parseFloat($scope.presentacion.pvpRange).toFixed(2);

                    $scope.presentacion.dsctoCantRange = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvpRange);
                    $scope.presentacion.dsctoCantRange = parseFloat($scope.presentacion.dsctoCantRange).toFixed(2);
                    //}
                };

                $scope.calculateDsctoCantRange = function() {
                    //alert('holi');
                    //if(angular.isNumber($scope.presentacion.suppPri) && angular.isNumber($scope.presentacion.markup) && angular.isNumber($scope.presentacion.price)){
                    $scope.presentacion.pvpRange = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.dsctoCantRange);
                    $scope.presentacion.pvpRange = parseFloat($scope.presentacion.pvpRange).toFixed(2);

                    $scope.presentacion.dsctoRange = (parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvpRange)) * 100 / parseFloat($scope.presentacion.price);
                    $scope.presentacion.dsctoRange = parseFloat($scope.presentacion.dsctoRange).toFixed(2);
                    //}
                };

                $scope.calculatePVPRange = function() {
                    $scope.presentacion.dsctoRange = (parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvpRange)) * 100 / parseFloat($scope.presentacion.price);
                    $scope.presentacion.dsctoRange = parseFloat($scope.presentacion.dsctoRange).toFixed(2);

                    $scope.presentacion.dsctoCantRange = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.pvpRange);
                    $scope.presentacion.dsctoCantRange = parseFloat($scope.presentacion.dsctoCantRange).toFixed(2);
                    //$scope.presentacion.pvp = parseFloat($scope.presentacion.price) - parseFloat($scope.presentacion.dscto) * parseFloat($scope.presentacion.price) / 100;
                    //$scope.presentacion.pvp = parseFloat($scope.presentacion.pvp).toFixed(2);
                }


                //fin dsctos
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('productos',$scope.query,$scope.currentPage).then(function (data){
                        $scope.productos = data.data;
                    });
                    }else{
                        crudService.paginate('productos',$scope.currentPage).then(function (data) {
                            $scope.productos = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                //$log.log($routeParams);

                if(id)
                {
                    if($location.path() == '/productos/edit/'+$routeParams.id) {

                                crudService.paginate('productos',1).then(function (data) {
                                    $scope.productos = data.data;
                                });
                          //  if(!$scope.producto.hasVariants){
                                crudService.byforeingKey('variants','variant',id).then(function(data){
                                    $log.log(data);
                                    $scope.producto = data.producto;
                                    $scope.producto.estado = ( $scope.producto.estado == 1 );
                                    $scope.producto.hasVariants = ($scope.producto.hasVariants == 1 );
                                    $scope.producto.track = (data.track == 1 ); //de variants
                                    $scope.producto.presentaciones = data.det_pre;
                                    $scope.producto.stock = data.stock;
                                    crudService.all('warehouses').then(function (data){
                                        $scope.warehouses = data;
                                    });
                                    $scope.producto.sku = data.sku;
                                    //alert(isEmpty(data.stock));
                                    if(isEmpty(data.stock)){
                                        //alert('holi');
                                        $scope.minNumber = null ;
                                    }
                                    $scope.producto.autogenerado = false;
                                    crudService.all('presentations_base').then(function(data){
                                        //alert('holi');
                                        $scope.presentations_base = data;
                                        $log.log( $scope.presentations_base);
                                        $scope.obj = $.grep($scope.presentations_base, function(e){ return e.id == $scope.producto.presentacionBase; });
                                        $scope.producto.presentation_base_object = $scope.obj[0];
                                        if(!isEmpty($scope.obj)) {
                                            //$scope.traerPres($scope.producto.presentation_base_object.id);
                                            //$scope.changePreBase();
                                            $scope.enabled_presentation_button = false;
                                        }
                                    });

                                });
                            //}



                        crudService.select('productos', 'marcas').then(function (data) {
                            $scope.marcas = data;
                        });
                        /*=======>crudService.select('productos', 'materials').then(function (data) {
                            $scope.materials = data;
                        });
                        crudService.select('productos', 'types').then(function (data) {
                            $scope.types = data;
                        });
                        crudService.select('productos', 'stations').then(function (data) {
                            $scope.stations = data;
                        });=======>]*/



                    };

                    if($location.path() == '/productos/show/'+$routeParams.id) {
                        //alert('ok');
                        crudService.byId(id,'productos').then(function (data){
                            $scope.producto = data;
                            if($scope.producto.hasVariants == 0){
                                crudService.byforeingKey('variants','variant',$scope.producto.id).then(function(data){
                                    $scope.variant = data;
                                    $log.log('Variants,Variant:');
                                    $log.log($scope.variant);
                                })

                            }
                        });
                        $scope.variants = [];
                        crudService.byforeingKey('variants','variants',id). then(function(data)
                        {
                            $scope.variants = data;
                        })

                    };

                    if($location.path() == '/variants/edit/'+$routeParams.id) {
                        crudService.byId($routeParams.id,'variants').then(function (data)
                        {
                            //if(typeof($scope.variant.detAtr) == 'undefined')

                            //$scope.variant = data;
                            $scope.variant.category = data.category;
                            $scope.variant.codigo = data.codigo;
                            $scope.variant.created_at = data.created_at;

                            //$scope.variant.favorite: data.favorite
                            $scope.variant.id = data.id;
                            $scope.variant.imagen = data.imagen;

                            $scope.variant.nota = data.nota;
                            $scope.variant.observado = (data.observado == 1);

                            $scope.variant.producto_id = data.producto_id;
                            $scope.variant.category = parseInt(data.category);

                            $scope.variant.fvenc = new Date(data.fvenc);
                            $scope.variant.fvenc.setDate($scope.variant.fvenc.getDate()+1);
                            //var tomorrow = new Date();
                            //tomorrow.setDate(tomorrow.getDate() + 1);


                            //crudService.byId($scope.variant.producto_id, 'productos').then(function (data) {
                                //$log.log(data);
                            $scope.producto = data.producto;
                            //$scope.producto.estado = ( $scope.producto.estado == 1 );
                            //$scope.producto.hasVariants = ($scope.producto.hasVariants == 1 );
                            $scope.variant.track = (data.track == 1 ); //de variants
                            $scope.variant.presentaciones = data.det_pre;
                            $scope.variant.stock = data.stock;

                            crudService.all('warehouses').then(function (data){
                                $scope.warehouses = data;
                            });

                            $scope.variant.sku = data.sku;
                            //$scope.variant.detAtrT = data.det_atr;
                            //for (i = 0; i < data.det_atr.length; i++) {
                                //$scope.variant.detAtr[data.det_atr[i].atribute_id].descripcion = data.det_atr[i].descripcion;
                            //    $log.log('holi');
                            //}
                            //$scope.variant.
                            //alert(isEmpty(data.stock));
                            if(isEmpty(data.stock)){
                                //alert('holi');
                                $scope.minNumber = null ;
                            }
                            $scope.variant.autogenerado = false;
                                //if ($scope.producto.type) $scope.variant.codigo = $scope.producto.codigo + $scope.producto.type.nombre.charAt(0); else {
                                //    $scope.variant.codigo = $scope.producto.codigo;
                                //}
                                //espero q se llene producto y de ahi agrego Unidades por defecto
                                crudService.all('presentations_base').then(function (data) {
                                    $log.log(data);
                                    $scope.presentations_base = data;
                                    //$scope.producto.presentation_base_object
                                    //$log.log( $scope.presentaciones);
                                    $scope.variant.presentation_base_object = data[0];
                                    $scope.variant.presentacionBase = $scope.variant.presentation_base_object.id;
                                    $scope.enabled_presentation_button = false;

                                    //$scope.presentationSelect =

                                });

                            //});
                        });


                        crudService.all('atributes').then(function (data){
                            $scope.attributes = data.data;
                            $log.log($scope.attributes);
                        })

                    }


                }else{
                    crudService.paginate('productos',1).then(function (data) {
                        $scope.productos = data.data;
                        //$log.log(data.data);
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    if($location.path() == '/productos/create') {
                        crudService.paginate('productos',1).then(function (data) {
                        $scope.productos = data.data;
                        });
                        crudService.select('productos', 'marcas').then(function (data) {
                            $scope.marcas = data;
                        });
                        /*crudService.select('productos', 'materials').then(function (data) {
                            $scope.materials = data;
                        });
                        crudService.select('productos', 'types').then(function (data) {
                            $scope.types = data;
                        });
                        crudService.select('productos', 'stations').then(function (data) {
                            $scope.stations = data;
                        });*/
                        crudService.all('warehouses').then(function (data){
                            $scope.warehouses = data;
                            //alert('h');

                        });
                        crudService.all('presentations_base').then(function(data){
                            //alert('holi');
                            $scope.presentations_base = data;
                            $log.log($scope.presentations_base);
                            //$scope.producto.presentation_base_object
                            //$log.log( $scope.presentaciones);
                            $scope.producto.presentation_base_object = data[0];
                            $scope.producto.presentacionBase = $scope.producto.presentation_base_object.id;
                            $scope.enabled_presentation_button = false;

                            //$scope.presentationSelect =

                        });
                    }
                }

                if($routeParams.producto_id){
                    if($location.path() == '/variants/create/'+$routeParams.producto_id){
                        crudService.byId($routeParams.producto_id,'productos').then(function (data) {
                            $log.log(data);
                            $scope.producto = data;
                            if($scope.producto.type) $scope.variant.codigo = $scope.producto.codigo+$scope.producto.type.nombre.charAt(0); else{$scope.variant.codigo = $scope.producto.codigo;}
                                //espero q se llene producto y de ahi agrego Unidades por defecto
                            crudService.all('presentations_base').then(function(data){
                                $log.log(data);
                                $scope.presentations_base = data;
                                //$scope.producto.presentation_base_object
                                //$log.log( $scope.presentaciones);
                                $scope.variant.presentation_base_object = data[0];
                                $scope.variant.presentacionBase = $scope.variant.presentation_base_object.id;
                                $scope.enabled_presentation_button = false;

                                //$scope.presentationSelect =

                            });

                        });

                        crudService.all('warehouses').then(function (data){
                            $scope.warehouses = data;
                        });
                        crudService.all('atributes').then(function (data){
                            $scope.attributes = data.data;
                            $log.log($scope.attributes);
                        })
                    }


                }

                

                $scope.searchproducto = function(){
                if ($scope.query.length > 0) {
                    crudService.search('productos',$scope.query,1).then(function (data){
                        $scope.productos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('productos',1).then(function (data) {
                        $scope.productos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };



                $scope.createproducto = function(){

                    if ($scope.productoCreateForm.$valid) {
                        var $btn = $('#btn_generate').button('loading');
                        var f = document.getElementById('productoImage').files[0] ? document.getElementById('productoImage').files[0] : null;
                        //alert(f);
                        var r = new FileReader();
                        r.onloadend = function(e) {
                            $scope.producto.imagen = e.target.result;

                            crudService.create($scope.producto, 'productos').then(function (data) {
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('producto creado con Éxito');
                                    $location.path('/productos');

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');
                                    //alert(data);

                                }
                            });
                        }
                        if(!document.getElementById('productoImage').files[0]){
                            var $btn = $('#btn_generate').button('loading');
                            //alert($scope.producto.hasVariants);
                            crudService.create($scope.producto,'productos').then(function (data){
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('producto creado con Éxito');
                                    $location.path('/productos');

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');

                                }
                            });
                        }

                        if(document.getElementById('productoImage').files[0]){
                            r.readAsDataURL(f);
                        }

                    }
                }


                $scope.createVariant = function(){

                        //alert('hola');
                    $scope.variant.otros=$scope.ArrayTallas;
                    $scope.variant.cantTallas=$scope.variant1;
                            //alert($scope.variant.otros);

                    if ($scope.variantCreateForm.$valid) {
                        var $btn = $('#btn_generate').button('loading');
                        var fv = document.getElementById('variantImage').files[0] ? document.getElementById('variantImage').files[0] : null;
                        //alert(f);
                        var rv = new FileReader();
                        rv.onloadend = function(e) {
                            //alert('con img');
                            $scope.variant.imagen = e.target.result;

                            $scope.variant.producto_id = $scope.producto.id;
                            //$log.log($scope.variant.fvenc.getHours());
                            //$log.log($scope.variant.fvenc.getHours());
                            //modify fvenc menos 1 dia
                            $scope.variant.fvenc.setUTCHours($scope.variant.fvenc.getHours());
                            //
                            //$log.log($scope.variant);
                            
                            crudService.create($scope.variant, 'variants').then(function (data) {
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Variante creada con Éxito');
                                    $location.path('/productos/show/'+$scope.producto.id);

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');
                                    //alert(data);

                                }
                            });
                        }
                        if(!document.getElementById('variantImage').files[0]){
                            var $btn = $('#btn_generate').button('loading');
                            //alert($scope.producto.hasVariants);
                            //alert('sin img');
                            $scope.variant.producto_id = $scope.producto.id;
                            //$log.log($scope.variant.fvenc.getHours());
                            //$log.log($scope.variant.fvenc.getHours());
                            //modify fvenc menos 1 dia
                            $scope.variant.fvenc.setUTCHours($scope.variant.fvenc.getHours());
                            //

                            crudService.create($scope.variant,'variants').then(function (data){
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Variante creada con Éxito');
                                    $location.path('/productos/show/'+$scope.producto.id);

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');

                                }
                            });
                        }

                        if(document.getElementById('variantImage').files[0]){
                            rv.readAsDataURL(fv);
                        }

                    }
                }

                $scope.updateVariant = function(){

                    if ($scope.variantCreateForm.$valid) {
                        var $btn = $('#btn_generate').button('loading');
                        var f = document.getElementById('variantImage').files[0] ? document.getElementById('variantImage').files[0] : null;
                        //alert(f);
                        var r = new FileReader();
                        r.onloadend = function(e) {
                            $scope.variant.imagen = e.target.result;
                            
                            $scope.variant.producto_id = $scope.producto.id;
                            //modify fvenc menos 1 dia
                            $scope.variant.fvenc.setDate($scope.variant.fvenc.getDate() - 1);
                            //
                            crudService.update($scope.variant, 'variants').then(function (data) {
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Variante modificada con Éxito');
                                    $location.path('/productos/show/'+$scope.producto.id);

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');
                                    //alert(data);

                                }
                            });
                        }
                        if(!document.getElementById('variantImage').files[0]){
                            var $btn = $('#btn_generate').button('loading');
                            //alert($scope.producto.hasVariants);
                            $scope.variant.producto_id = $scope.producto.id;
                            //modify fvenc menos 1 dia
                            $scope.variant.fvenc.setDate($scope.variant.fvenc.getDate() - 1);
                            //
                            crudService.update($scope.variant,'variants').then(function (data){
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Variante modificada con Éxito');
                                    $location.path('/productos/show/'+$scope.producto.id);

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');

                                }
                            });
                        }

                        if(document.getElementById('variantImage').files[0]){
                            r.readAsDataURL(f);
                        }

                    }
                }

                $scope.editproducto = function(row){
                    $location.path('/productos/edit/'+row.proId);
                };

                $scope.editproductoshow = function(producto){
                    //$log.log(producto);
                    $location.path('/productos/edit/'+producto.id);
                }
                  
                $scope.updateproducto = function(){
                    //alert('ho');
                    if ($scope.productoCreateForm.$valid) {
                        var $btn = $('#btn_generate').button('loading');
                        var f = document.getElementById('productoImage').files[0] ? document.getElementById('productoImage').files[0] : null;
                        //alert(f);
                        var r = new FileReader();
                        r.onloadend = function(e) {
                            $scope.producto.imagen = e.target.result;
                        crudService.update($scope.producto,'productos').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/productos');
                            }else{
                                $scope.errors =data;
                                $btn.button('reset');
                            }
                        });
                        }
                        if(!document.getElementById('productoImage').files[0]){
                            var $btn = $('#btn_generate').button('loading');
                            //alert('ho');
                        crudService.update($scope.producto,'productos').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/productos');
                            }else{
                                $scope.errors =data;
                                $btn.button('reset');
                            }
                        });}

                        if(document.getElementById('productoImage').files[0]){
                            r.readAsDataURL(f);
                        }
                    }
                };

                $scope.deleteproducto = function(row){
                    $scope.producto = row;
                    //$log.log($scope.producto);
                }

                $scope.cancelproducto = function(){
                    $scope.producto = {};
                }

                $scope.destroyproducto = function(){
                    crudService.destroy($scope.producto,'productos').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.producto = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }

                $scope.deleteVariant = function(row){
                    $scope.variant = row;
                    //$log.log($scope.producto);
                }
                $scope.cancelVariant = function(){
                    $scope.variant = {};
                }
                $scope.destroyVariant = function(){
                    crudService.destroy($scope.variant,'variants').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.variant = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }

                $scope.disableproducto = function(row){
                    //$log.log(row);
                    crudService.byforeingKey('productos','disableprod',row.proId).then(function(data)
                    {
                        if(data['estado'] == true){
                            $route.reload();
                        }else{
                            alert('No se pudo cambiar el estado');
                        }
                    });
                }

                $scope.disableVariant = function(row){
                    crudService.byforeingKey('variants','disablevar',row.id).then(function(data)
                    {
                        if(data['estado'] == true){
                            $route.reload();
                        }else{
                            alert('No se pudo cambiar el estado');
                        }
                    });
                }
                /*
                fx de variants
                 */

                $scope.addVariant = function(producto_id){
                    $location.path('/variants/create/'+producto_id);
                    //$scope.producto = {nombre:'holi'};
                }

                $scope.showVariants = function(row){
                    $scope.variants = [];
                    crudService.byforeingKey('variants','variants',row.proId).then(function(data)
                    {
                            $scope.variants = data;
                    })
                    //crudService.
                }
                $scope.agregarenGrupo=function(){
                     if($scope.variant.checkTallas==true){
                        $scope.variant.track=false;
                        $scope.variant.autogenerado=true;
                        $scope.variant.detAtr[1].descripcion='';
                     }else{
                         $scope.variant.track=true;
                         $scope.ArrayTalla={};
                         $scope.ArrayTallas=[];
                         $scope.variant.talla=[];
                         $scope.LlenarRangoTallas();
                     }
                }
                
                $scope.editVariant = function(row){
                    $location.path('/variants/edit/'+row.id);
                };
                $scope.material='';
                /*$scope.capAttr1 = function(attr_id){
                    //alert(attr_id);
                    $scope.material='';
                    //alert($scope.variant.detAtr[3].descripcion);
                    var separador = " ";
                    var aregloSubcadena=new Array();
                   if(attr_id == 1 || attr_id == 4) {
                    if($scope.producto.type){} else{$scope.producto.type = { nombre : ''}}
                         
                          $scope.variant.codigo = $scope.producto.codigo + $scope.producto.type.nombre.charAt(0);
                     if(attr_id == 4){
                      var aregloSubcadena=$scope.variant.detAtr[3].descripcion.split(separador);
                      $scope.material= aregloSubcadena[0].substring(0,1);
                      
                      if(parseInt(aregloSubcadena.length)>1){
                        
                        $scope.material= aregloSubcadena[0].substring(0,1)+aregloSubcadena[1].substring(0,1);
                      }else{
                        $scope.material= aregloSubcadena[0].substring(0,2);
                      }
                     }
                         /*$scope.material= $scope.material+$scope.variant.detAtr[3].descripcion.substring(0, 1);
                         for(var n=0;n<$scope.variant.detAtr[3].descripcion.length;n++){
                            alert(n);
                            alert($scope.variant.detAtr[3].descripcion.substring(n,1));
                             if($scope.variant.detAtr[3].descripcion.substring(n,1)==' '){
                                //alert(aqui);
                                $scope.material=$scope.material+$scope.variant.detAtr[3].descripcion.substring(n+1,1);
                             }
                         }
                         alert($scope.material);
                         if(attr_id == 4 && $scope.variant.detAtr[0].descripcion!=undefined){
                            $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2)+ $scope.material.toLowerCase();
                         }else{

                               if(attr_id == 1 && $scope.variant.detAtr[3].descripcion!=undefined){
                               $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2)+ $scope.material.toLowerCase();
                               }else{
                                   if(attr_id == 1 ){
                                      $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2);
                                   }else{
                                      $scope.variant.codigo=$scope.variant.codigo+ $scope.material.toLowerCase();
                                   }
                               }*
                         }
                    }
                 }*/
               /* $scope.capAttr = function(attr_id){
                    //alert(attr_id);
                    //alert($scope.variant.detAtr[3].descripcion);
                    var separador = " ";
                    var aregloSubcadena=new Array();
                   if(attr_id == 1 || attr_id == 4) {
                    if($scope.producto.type){} else{$scope.producto.type = { nombre : ''}}
                         
                          $scope.variant.codigo = $scope.producto.codigo + $scope.producto.type.nombre.charAt(0);
                     if(attr_id == 4){
                      var aregloSubcadena=$scope.variant.detAtr[3].descripcion.split(separador);
                      $scope.material= aregloSubcadena[0].substring(0,1);
                      
                      if(parseInt(aregloSubcadena.length)>1){
                        
                        $scope.material= aregloSubcadena[0].substring(0,1)+aregloSubcadena[1].substring(0,1);
                      }else{
                        $scope.material= aregloSubcadena[0].substring(0,2);
                      }
                     }
                         /*$scope.material= $scope.material+$scope.variant.detAtr[3].descripcion.substring(0, 1);
                         for(var n=0;n<$scope.variant.detAtr[3].descripcion.length;n++){
                            alert(n);
                            alert($scope.variant.detAtr[3].descripcion.substring(n,1));
                             if($scope.variant.detAtr[3].descripcion.substring(n,1)==' '){
                                //alert(aqui);
                                $scope.material=$scope.material+$scope.variant.detAtr[3].descripcion.substring(n+1,1);
                             }
                         }
                         alert($scope.material);
                         if(attr_id == 4 && $scope.variant.detAtr[0].descripcion!=undefined){
                            $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2)+ $scope.material.toLowerCase();
                         }else{

                               if(attr_id == 1 && $scope.variant.detAtr[3].descripcion!=undefined){
                               $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2)+ $scope.material.toLowerCase();
                               }else{
                                   if(attr_id == 1 ){
                                      $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2);
                                   }else{
                                      $scope.variant.codigo=$scope.variant.codigo+ $scope.material.toLowerCase();
                                   }
                               }
                         }
                    }
                 }*/

                //var trouble;
                $scope.asignarDescr = function(index){
                    //$log.log($scope.trouble);

                    if(isEmpty(trouble)){
                        //alert('arriba');
                        crudService.byforeingKey('variants','getAttr',$routeParams.id).then(function(data){
                            trouble = data.det_atr;
                            $log.log(trouble);

                            var isCool = $.grep(trouble, function (e) {
                                return e.atribute_id == $scope.variant.detAtr[index].atribute_id;
                            });
                            //$log.log(isCool[0].descripcion);
                            if (isCool.length != 0) {
                                $scope.variant.detAtr[index].descripcion = isCool[0].descripcion;
                            }
                        })
                    }else{
                            //alert('abajo');
                            var isCool = $.grep(trouble, function (e) {
                                return e.atribute_id == $scope.variant.detAtr[index].atribute_id;
                            });
                            //$log.log(isCool[0].descripcion);
                            if (isCool.length != 0) {
                                $scope.variant.detAtr[index].descripcion = isCool[0].descripcion;
                            }
                    }
                }

                $scope.traerPres = function(preBase){
                    //$log.log(preBase);
                    if($location.path() != '/variants/create/'+$routeParams.producto_id && $location.path() != '/variants/edit/'+$routeParams.id) {
                        crudService.byforeingKey('presentaciones', 'all_by_base', preBase).then(function (data) {
                            $scope.presentaciones = data;
                            //$log.log( $scope.presentaciones);
                            //$scope.presentaciones.push({id:$scope.producto.presentacionBase.id,nombre:'holi'});
                            $scope.presentaciones.unshift({
                                id: $scope.producto.presentation_base_object.id,
                                nombre: $scope.producto.presentation_base_object.nombre,
                                shortname: $scope.producto.presentation_base_object.shortname,
                                cant: 'Pre. base'
                            });
                            $scope.presentationSelect = $scope.presentaciones[0];
                        });
                    }
                    if($location.path() == '/variants/create/'+$routeParams.producto_id || $location.path() == '/variants/edit/'+$routeParams.id){
                        crudService.byforeingKey('presentaciones','all_by_base',preBase).then(function(data){
                            //$scope.selectPres();
                            $scope.selectPres();
                            $scope.presentaciones = data;
                            //$log.log( $scope.presentaciones);
                            //$scope.presentaciones.push({id:$scope.producto.presentacionBase.id,nombre:'holi'});
                            $scope.presentaciones.unshift({
                                id:$scope.variant.presentation_base_object.id,
                                nombre:$scope.variant.presentation_base_object.nombre,
                                shortname:$scope.variant.presentation_base_object.shortname,
                                cant:'Pre. base'
                            });
                            $scope.presentationSelect = $scope.presentaciones[0];
                        });
                    }

                }

                $scope.traerPresX = function(preBase){
                    if($location.path() != '/variants/create/'+$routeParams.producto_id && $location.path() != '/variants/edit/'+$routeParams.id) {
                        crudService.byforeingKey('presentaciones', 'all_by_base', preBase).then(function (data) {
                            $scope.presentaciones = data;
                            //$log.log( $scope.presentaciones);
                            //$scope.presentaciones.push({id:$scope.producto.presentacionBase.id,nombre:'holi'});
                            $scope.presentaciones.unshift({
                                id: $scope.producto.presentation_base_object.id,
                                nombre: $scope.producto.presentation_base_object.nombre,
                                shortname: $scope.producto.presentation_base_object.shortname,
                                cant: 'Pre. base'
                            });
                            $scope.presentationSelect = $scope.presentaciones[0];
                        });
                    }
                    if($location.path() == '/variants/create/'+$routeParams.producto_id || $location.path() == '/variants/edit/'+$routeParams.id){
                        crudService.byforeingKey('presentaciones','all_by_base',preBase).then(function(data){
                            //$scope.selectPres();
                            if(!$scope.presentacion.edit) $scope.selectPres();
                            $scope.presentaciones = data;
                            //$log.log( $scope.presentaciones);
                            //$scope.presentaciones.push({id:$scope.producto.presentacionBase.id,nombre:'holi'});
                            $scope.presentaciones.unshift({
                                id:$scope.variant.presentation_base_object.id,
                                nombre:$scope.variant.presentation_base_object.nombre,
                                shortname:$scope.variant.presentation_base_object.shortname,
                                cant:'Pre. base'
                            });
                            $scope.presentationSelect = $scope.presentaciones[0];
                        });
                    }
                }

                $scope.AddPres = function(){
                    if($location.path() != '/variants/create/'+$routeParams.producto_id && $location.path() != '/variants/edit/'+$routeParams.id) {

                        if (typeof ($scope.presentationSelect.preFin_id) !== 'undefined') {
                            $scope.presentationSelect.id = $scope.presentationSelect.preFin_id;
                        }

                        var isYa = $.grep($scope.producto.presentaciones, function (e) {
                            return e.id == $scope.presentationSelect.id;
                        });
                        //$log.log($scope.presentationSelect);
                        //$log.log($scope.producto.presentaciones);
                        //alert("hola")
                        //$log.log("isYa");
                        //$log.log(isYa.length);
                        //if(isYa.length == 0 && $scope.presentationSelect!==null && $scope.presentationSelect.length!== 0) {
                        if (isYa.length == 0 && !isEmpty($scope.presentationSelect)) {
                            //alert(typeof($scope.presentationSelect.preFin_id));

                            $scope.presentationSelect.suppPri = $scope.presentacion.suppPri;
                            $scope.presentationSelect.markup = $scope.presentacion.markup;
                            $scope.presentationSelect.price = $scope.presentacion.price;
                            $scope.producto.presentaciones.push($scope.presentationSelect);
                            //$log.log($scope.producto.presentaciones);
                            $scope.presentacion = {};
                            $scope.presentationSelect = {};
                            $scope.presentacion.suppPri = 0;
                            $scope.presentacion.markup = 0;
                            $scope.presentacion.price = 0;
                        } else {
                            alert('Item duplicado o vacío');
                        }
                    }
                    if($location.path() == '/variants/create/'+$routeParams.producto_id || $location.path() == '/variants/edit/'+$routeParams.id){

                        //alert('hola');

                        if (typeof ($scope.presentationSelect.preFin_id) !== 'undefined') {
                            $scope.presentationSelect.id = $scope.presentationSelect.preFin_id;
                        }

                        var isYa2 = $.grep($scope.variant.presentaciones, function (e) {
                            return e.id == $scope.presentationSelect.id;
                        });
                        //$log.log($scope.presentationSelect);
                        //$log.log($scope.producto.presentaciones);
                        //$log.log(isYa);
                        //if(isYa.length == 0 && $scope.presentationSelect!==null && $scope.presentationSelect.length!== 0) {
                        if (isYa2.length == 0 && !isEmpty($scope.presentationSelect)) {
                            //alert(typeof($scope.presentationSelect.preFin_id));

                            $scope.presentationSelect.suppPri = $scope.presentacion.suppPri;
                            $scope.presentationSelect.markup = $scope.presentacion.markup;
                            $scope.presentationSelect.price = $scope.presentacion.price;

                            //new data
                            $scope.presentationSelect.suppPriDol = $scope.presentacion.suppPriDol;
                            $scope.presentationSelect.markupCant = $scope.presentacion.markupCant;
                            $scope.presentationSelect.cambioDolar = $scope.presentacion.cambioDolar;
                            //descto normal
                            $scope.presentationSelect.dscto = $scope.presentacion.dscto;
                            $scope.presentationSelect.dsctoCant = $scope.presentacion.dsctoCant;
                            $scope.presentationSelect.pvp = $scope.presentacion.pvp;
                            //dsctos por rango de fechas
                            var monthFecIni = parseInt($scope.presentacion.fecIniDscto.getMonth())+1;
                            var monthFecFin = parseInt($scope.presentacion.fecFinDscto.getMonth())+1;
                            $scope.presentationSelect.fecIniDscto = $scope.presentacion.fecIniDscto.getFullYear()+'-'+ monthFecIni+'-'+$scope.presentacion.fecIniDscto.getDate();
                            $scope.presentationSelect.fecFinDscto = $scope.presentacion.fecFinDscto.getFullYear()+'-'+ monthFecFin+'-'+$scope.presentacion.fecFinDscto.getDate();
                            $scope.presentationSelect.dsctoRange = $scope.presentacion.dsctoRange;
                            $scope.presentationSelect.dsctoCantRange = $scope.presentacion.dsctoCantRange;
                            $scope.presentationSelect.pvpRange = $scope.presentacion.pvpRange;
                            $scope.presentationSelect.activateDsctoRange = $scope.presentacion.activateDsctoRange;
                            //
                            $scope.variant.presentaciones.push($scope.presentationSelect);

                            $log.log($scope.variant.presentaciones);
                            $scope.presentacion = {};
                            $scope.presentationSelect = {};
                            $scope.presentacion.suppPri = 0;
                            $scope.presentacion.markup = 0;
                            $scope.presentacion.price = 0;
                            //alert('hola');
                            //$scope.presentacion.activateDsctoRange= false;
                        } else {
                            alert('Item duplicado o vacío');
                        }
                    }
                }
   $scope.AddPres1 = function(){
                    if($location.path() != '/productos/create' && $location.path() != '/productos/edit/'+$routeParams.id ) {
                             //alert("hola");
                        if (typeof ($scope.presentationSelect.preFin_id) !== 'undefined') {
                            $scope.presentationSelect.id = $scope.presentationSelect.preFin_id;
                        }

                        var isYa = $.grep($scope.producto.presentaciones, function (e) {
                            return e.id == $scope.presentationSelect.id;
                        });
                        //$log.log($scope.presentationSelect);
                        //$log.log($scope.producto.presentaciones);
                        //alert("hola")
                        //$log.log("isYa");
                        //$log.log(isYa.length);
                        //if(isYa.length == 0 && $scope.presentationSelect!==null && $scope.presentationSelect.length!== 0) {
                        if (isYa.length == 0 && !isEmpty($scope.presentationSelect)) {
                            //alert(typeof($scope.presentationSelect.preFin_id));

                            $scope.presentationSelect.suppPri = $scope.presentacion.suppPri;
                            $scope.presentationSelect.markup = $scope.presentacion.markup;
                            $scope.presentationSelect.price = $scope.presentacion.price;
                            $scope.producto.presentaciones.push($scope.presentationSelect);
                            //$log.log($scope.producto.presentaciones);
                            $scope.presentacion = {};
                            $scope.presentationSelect = {};
                            $scope.presentacion.suppPri = 0;
                            $scope.presentacion.markup = 0;
                            $scope.presentacion.price = 0;
                        } else {
                            alert('Item duplicado o vacío');
                        }
                    }
                    if($location.path() == '/productos/create' || $location.path() == '/productos/edit/'+$routeParams.id){

                        //alert('hola2');

                        if (typeof ($scope.presentationSelect.preFin_id) !== 'undefined') {
                            $scope.presentationSelect.id = $scope.presentationSelect.preFin_id;
                        }

                        var isYa2 = $.grep($scope.variant.presentaciones, function (e) {
                            return e.id == $scope.presentationSelect.id;
                        });
                        //$log.log($scope.presentationSelect);
                        //$log.log($scope.producto.presentaciones);
                        //$log.log(isYa);
                        //if(isYa.length == 0 && $scope.presentationSelect!==null && $scope.presentationSelect.length!== 0) {
                        if (isYa2.length == 0 && !isEmpty($scope.presentationSelect)) {
                            //alert(typeof($scope.presentationSelect.preFin_id));
           
                            $scope.presentationSelect.suppPri = $scope.presentacion.suppPri;
                            $scope.presentationSelect.markup = $scope.presentacion.markup;
                            $scope.presentationSelect.price = $scope.presentacion.price;

                            //new data
                            $scope.presentationSelect.suppPriDol = $scope.presentacion.suppPriDol;
                            $scope.presentationSelect.markupCant = $scope.presentacion.markupCant;
                            $scope.presentationSelect.cambioDolar = $scope.presentacion.cambioDolar;
                            //descto normal
                            $scope.presentationSelect.dscto = $scope.presentacion.dscto;
                            $scope.presentationSelect.dsctoCant = $scope.presentacion.dsctoCant;
                            $scope.presentationSelect.pvp = $scope.presentacion.pvp;
                            //dsctos por rango de fechas
                            var monthFecIni = parseInt($scope.presentacion.fecIniDscto.getMonth())+1;
                            var monthFecFin = parseInt($scope.presentacion.fecFinDscto.getMonth())+1;
                            $scope.presentationSelect.fecIniDscto = $scope.presentacion.fecIniDscto.getFullYear()+'-'+ monthFecIni+'-'+$scope.presentacion.fecIniDscto.getDate();
                            $scope.presentationSelect.fecFinDscto = $scope.presentacion.fecFinDscto.getFullYear()+'-'+ monthFecFin+'-'+$scope.presentacion.fecFinDscto.getDate();
                            $scope.presentationSelect.dsctoRange = $scope.presentacion.dsctoRange;
                            $scope.presentationSelect.dsctoCantRange = $scope.presentacion.dsctoCantRange;
                            $scope.presentationSelect.pvpRange = $scope.presentacion.pvpRange;
                            $scope.presentationSelect.activateDsctoRange = $scope.presentacion.activateDsctoRange;
                            //
                            $scope.producto.presentaciones.push($scope.presentationSelect);

                            $log.log($scope.variant.presentaciones);
                            $scope.presentacion = {};
                            $scope.presentationSelect = {};
                            $scope.presentacion.suppPri = 0;
                            $scope.presentacion.markup = 0;
                            $scope.presentacion.price = 0;
                            //alert('hola');
                            //$scope.presentacion.activateDsctoRange= false;
                        } else {
                            alert('Item duplicado o vacío');
                        }
                    }
                }

                $scope.editPres = function(row,$index){
                    //alert('hola');
                    $scope.presentacion.edit = true;
                    $scope.traerPresX($scope.variant.presentacionBase);
                    $log.log(row);
                    //$scope.presentationSelect = {};
                    $scope.presentacion.suppPri = row.suppPri;
                    $scope.presentacion.markup = row.markup;
                    $scope.presentacion.price = row.price;

                    //new data
                    $scope.presentacion.suppPriDol = row.suppPriDol;
                    $scope.presentacion.markupCant = row.markupCant;
                    $scope.presentacion.cambioDolar = row.cambioDolar;
                    //descto normal
                    $scope.presentacion.dscto = row.dscto;
                    $scope.presentacion.dsctoCant = row.dsctoCant;
                    $scope.presentacion.pvp = row.pvp;
                    //dsctos por rango de fechas
                    //if(row.fecIniDscto instanceof Date) {
                        //alert('holaxx');
                    $scope.presentacion.sinIgv = (parseFloat($scope.presentacion.suppPriDol) / 1.18);
                        $scope.presentacion.sinIgv = parseFloat($scope.presentacion.sinIgv).toFixed(2);
                    var fecIniDscto = new Date(row.fecIniDscto);
                    fecIniDscto.setDate(fecIniDscto.getDate()+1);

                        //var monthFecIni = parseInt(row.fecIniDscto.getMonth()) + 1;
                    $scope.presentacion.fecIniDscto = fecIniDscto;
                        //$scope.presentacion.fecIniDscto = row.fecIniDscto.getFullYear() + '-' + monthFecIni + '-' + row.fecIniDscto.getDate();
                    //}
                    var fecFinDscto = new Date(row.fecFinDscto);
                    fecFinDscto.setDate(fecFinDscto.getDate()+1);
                    $scope.presentacion.fecFinDscto = fecFinDscto;
                    //if(row.fecFinDscto instanceof Date) {
                        //var monthFecFin = parseInt(row.fecFinDscto.getMonth()) + 1;
                        //$scope.presentacion.fecFinDscto = row.fecFinDscto.getFullYear() + '-' + monthFecFin + '-' + row.fecFinDscto.getDate();
                    //}
                    $scope.presentacion.dsctoRange = row.dsctoRange;
                    $scope.presentacion.dsctoCantRange = row.dsctoCantRange;
                    $scope.presentacion.pvpRange = row.pvpRange;

                    $scope.presentacion.identificador = $index;

                    //alert(row.activateDsctoRange);

                    row.activateDsctoRange == '1' ? row.activateDsctoRange = true : row.activateDsctoRange = false;

                    $scope.presentacion.activateDsctoRange = row.activateDsctoRange;

                    $('#presentacion').modal('show');
                }

                $scope.UpdatePres = function(){
                    if($location.path() == '/variants/create/'+$routeParams.producto_id || $location.path() == '/variants/edit/'+$routeParams.id){
                        $scope.variant.presentaciones[$scope.presentacion.identificador].suppPri = $scope.presentacion.suppPri;
                        $scope.variant.presentaciones[$scope.presentacion.identificador].markup = $scope.presentacion.markup;
                        $scope.variant.presentaciones[$scope.presentacion.identificador].price = $scope.presentacion.price;

                        //new data
                        $scope.variant.presentaciones[$scope.presentacion.identificador].suppPriDol = $scope.presentacion.suppPriDol;
                        $scope.variant.presentaciones[$scope.presentacion.identificador].markupCant = $scope.presentacion.markupCant;
                        $scope.variant.presentaciones[$scope.presentacion.identificador].cambioDolar = $scope.presentacion.cambioDolar;
                        //descto normal
                        $scope.variant.presentaciones[$scope.presentacion.identificador].dscto = $scope.presentacion.dscto;
                        $scope.variant.presentaciones[$scope.presentacion.identificador].dsctoCant = $scope.presentacion.dsctoCant;
                        $scope.variant.presentaciones[$scope.presentacion.identificador].pvp = $scope.presentacion.pvp;
                        //dsctos por rango de fechas
                        var monthFecIni = parseInt($scope.presentacion.fecIniDscto.getMonth())+1;
                        var monthFecFin = parseInt($scope.presentacion.fecFinDscto.getMonth())+1;
                        $scope.variant.presentaciones[$scope.presentacion.identificador].fecIniDscto = $scope.presentacion.fecIniDscto.getFullYear()+'-'+ monthFecIni+'-'+$scope.presentacion.fecIniDscto.getDate();
                        $scope.variant.presentaciones[$scope.presentacion.identificador].fecFinDscto = $scope.presentacion.fecFinDscto.getFullYear()+'-'+ monthFecFin+'-'+$scope.presentacion.fecFinDscto.getDate();
                        $scope.variant.presentaciones[$scope.presentacion.identificador].dsctoRange = $scope.presentacion.dsctoRange;
                        $scope.variant.presentaciones[$scope.presentacion.identificador].dsctoCantRange = $scope.presentacion.dsctoCantRange;
                        $scope.variant.presentaciones[$scope.presentacion.identificador].pvpRange = $scope.presentacion.pvpRange;
                        $scope.variant.presentaciones[$scope.presentacion.identificador].activateDsctoRange =$scope.presentacion.activateDsctoRange;
                    }
                }
                $scope.UpdatePres1 = function(){
                    if($location.path() == '/productos/create/'+$routeParams.producto_id || $location.path() == '/productos/edit/'+$routeParams.id){
                        $scope.producto.presentaciones[$scope.presentacion.identificador].suppPri = $scope.presentacion.suppPri;
                        $scope.producto.presentaciones[$scope.presentacion.identificador].markup = $scope.presentacion.markup;
                        $scope.producto.presentaciones[$scope.presentacion.identificador].price = $scope.presentacion.price;

                        //new data
                        $scope.producto.presentaciones[$scope.presentacion.identificador].suppPriDol = $scope.presentacion.suppPriDol;
                        $scope.producto.presentaciones[$scope.presentacion.identificador].markupCant = $scope.presentacion.markupCant;
                        $scope.producto.presentaciones[$scope.presentacion.identificador].cambioDolar = $scope.presentacion.cambioDolar;
                        //descto normal
                        $scope.producto.presentaciones[$scope.presentacion.identificador].dscto = $scope.presentacion.dscto;
                        $scope.producto.presentaciones[$scope.presentacion.identificador].dsctoCant = $scope.presentacion.dsctoCant;
                        $scope.producto.presentaciones[$scope.presentacion.identificador].pvp = $scope.presentacion.pvp;
                        //dsctos por rango de fechas
                        var monthFecIni = parseInt($scope.presentacion.fecIniDscto.getMonth())+1;
                        var monthFecFin = parseInt($scope.presentacion.fecFinDscto.getMonth())+1;
                        $scope.producto.presentaciones[$scope.presentacion.identificador].fecIniDscto = $scope.presentacion.fecIniDscto.getFullYear()+'-'+ monthFecIni+'-'+$scope.presentacion.fecIniDscto.getDate();
                        $scope.producto.presentaciones[$scope.presentacion.identificador].fecFinDscto = $scope.presentacion.fecFinDscto.getFullYear()+'-'+ monthFecFin+'-'+$scope.presentacion.fecFinDscto.getDate();
                        $scope.producto.presentaciones[$scope.presentacion.identificador].dsctoRange = $scope.presentacion.dsctoRange;
                        $scope.producto.presentaciones[$scope.presentacion.identificador].dsctoCantRange = $scope.presentacion.dsctoCantRange;
                        $scope.producto.presentaciones[$scope.presentacion.identificador].pvpRange = $scope.presentacion.pvpRange;
                        $scope.producto.presentaciones[$scope.presentacion.identificador].activateDsctoRange =$scope.presentacion.activateDsctoRange;
                    }
                }
                $scope.deletePres = function($index){
                    if($location.path() != '/variants/create/'+$routeParams.producto_id && $location.path() != '/variants/edit/'+$routeParams.id) {
                        $scope.producto.presentaciones.splice($index, 1);
                    }
                    if($location.path() == '/variants/create/'+$routeParams.producto_id || $location.path() == '/variants/edit/'+$routeParams.id) {
                        $scope.variant.presentaciones.splice($index, 1);
                    }
                    if($location.path() != '/productos/create/' && $location.path() != '/productos/edit/'+$routeParams.id) {
                        $scope.producto.presentaciones.splice($index, 1);
                    }
                    if($location.path() == '/productos/create/' || $location.path() == '/productos/edit/'+$routeParams.id) {
                        $scope.producto.presentaciones.splice($index, 1);
                    }
                }

                $scope.selectPres = function(){
                    $scope.presentacion.suppPri = 0;
                    $scope.presentacion.markup = 0;
                    $scope.presentacion.price = 0;
                    $scope.presentacion.markupCant = 0;
                    $scope.presentacion.suppPriDol = 0;

                    //desctos
                    $scope.presentacion.dscto = 0;
                    $scope.presentacion.dsctoCant = 0;
                    $scope.presentacion.pvp = 0;
                    $scope.presentacion.fecIniDscto = new Date();
                    $scope.presentacion.fecFinDscto = new Date();
                    $scope.presentacion.dsctoRange = 0;
                    $scope.presentacion.dsctoCantRange = 0;
                    $scope.presentacion.pvpRange = 0;

                    $scope.presentacion.cambioDolar = 3.00;
                    //
                    $scope.presentacion.edit = false;
                    $scope.presentacion.identificador = -1;
                    $scope.presentacion.activateDsctoRange = false;
                }

                $scope.changePreBase = function(){
                    //$log.log($scope.producto.presentation_base_object);cartItems.length > 0
                    if($location.path() != '/variants/create/'+$routeParams.producto_id && $location.path() != '/variants/edit/'+$routeParams.id) {
                        if ($scope.producto.presentation_base_object !== null && !isEmpty($scope.producto.presentation_base_object)) {
                            $scope.producto.presentacionBase = $scope.producto.presentation_base_object.id;
                            $scope.producto.presentaciones = [];
                            //alert('borra if');
                            $scope.enabled_presentation_button = false;
                            $scope.enabled_createpresentation_button = false;
                        } else {
                            $scope.enabled_presentation_button = true;
                            $scope.enabled_createpresentation_button = true;
                            $scope.producto.presentacionBase = null;
                            $scope.producto.presentaciones = [];
                            //alert('borra else');
                        }
                    }
                    if($location.path() == '/variants/create/'+$routeParams.producto_id || $location.path() == '/variants/edit/'+$routeParams.id) {
                        if ($scope.variant.presentation_base_object !== null && !isEmpty($scope.variant.presentation_base_object)) {
                            $scope.variant.presentacionBase = $scope.variant.presentation_base_object.id;
                            $scope.variant.presentaciones = [];
                            //alert('borra if');
                            $scope.enabled_presentation_button = false;
                            $scope.enabled_createpresentation_button = false;
                        } else {
                            $scope.enabled_presentation_button = true;
                            $scope.enabled_createpresentation_button = true;
                            $scope.variant.presentacionBase = null;
                            $scope.variant.presentaciones = [];
                            //alert('borra else');
                        }
                    }

                }

                $scope.createPres = function(unidad_base){
                    $scope.preAdd.preBase_id = unidad_base;
                    //$log.log($scope.preAdd);
                    crudService.create($scope.preAdd, 'presentaciones').then(function (data) {
                        if (data['estado'] == true) {
                            $scope.presentaciones.push({
                                id:data['presentacion'].id,
                                nombre:data['presentacion'].nombre,
                                shortname:data['presentacion'].shortname,
                                cant:data['equiv'].cant
                            })
                            $scope.preAdd = {};
                            alert('Presentacion creada con éxito');
                        } else {
                            $scope.errors = data;
                        }
                    });

                }

                $scope.showStock = function(producto_id){
                    crudService.byforeingKey('stocks','traerstock',producto_id).then(function (data){
                        $scope.stockVariants = data;
                    })
                }

                /*

                Agregar Marca, Linea, Station, MAterial, Atributo

                 */
                $scope.addBrand = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent.html',
                        controller: 'ModalInstanceCtrl',
                        size: 'sm',
                        /*resolve: {
                            items: function () {
                                return $scope.items;
                            }
                        }*/
                    });

                    modalInstance.result.then(function (selectedItem) {
                        //$scope.selected = selectedItem;
                    }, function () {
                        //$log.info('Modal dismissed at: ' + new Date());
                        crudService.select('productos', 'marcas').then(function (data) {
                            $scope.marcas = data;
                        });

                    });
                };
                /*=======>$scope.addLine = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent2.html',
                        controller: 'ModalInstanceCtrl2',
                        size: 'sm',
                        /*resolve: {
                         items: function () {
                         return $scope.items;
                         }
                         }*/
                    /*========>});

                    modalInstance.result.then(function (selectedItem) {
                        //$scope.selected = selectedItem;
                    }, function () {
                        //$log.info('Modal dismissed at: ' + new Date());
                        crudService.select('productos', 'types').then(function (data) {
                            $scope.types = data;
                        });

                    });
                };
                $scope.addMaterial = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent3.html',
                        controller: 'ModalInstanceCtrl3',
                        size: 'sm',
                        /*resolve: {
                         items: function () {
                         return $scope.items;
                         }
                         }*/
                    /*=======>});

                    modalInstance.result.then(function (selectedItem) {
                        //$scope.selected = selectedItem;
                    }, function () {
                        //$log.info('Modal dismissed at: ' + new Date());
                        crudService.select('productos', 'materials').then(function (data) {
                            $scope.materials = data;
                        });

                    });
                };

                $scope.addStation = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent4.html',
                        controller: 'ModalInstanceCtrl4',
                        size: 'sm',
                        /*resolve: {
                         items: function () {
                         return $scope.items;
                         }
                         }*/
                    /*=======>});

                    modalInstance.result.then(function (selectedItem) {
                        //$scope.selected = selectedItem;
                    }, function () {
                        //$log.info('Modal dismissed at: ' + new Date());
                        crudService.select('productos', 'stations').then(function (data) {
                            $scope.stations = data;
                        });

                    });
                };=======>*/
                $scope.GenerarCodigoBarras=function(cant){
                        
                         crudService.reportCod('reports1', cant).then(function (data) {
                            alert(data);
                            $window.open(data);
                        });

                }
                $scope.ArrayTallas =[];
                $scope.ArrayTalla ={};
                $scope.variants1=[];
                $scope.variant1={};
                $scope.variant.checkTallas=false;
                $scope.obcional=0;
                $scope.h=0;
                $scope.LlenarRangoTallas=function(fin,ini){
                   // alert(fin);
                    $scope.ArrayTalla={};
                    $scope.ArrayTallas=[];
                    $scope.variant.talla=[];
                    $scope.obcional=0;
                    ///alert("hola que tal"+$scope.can);
                   // if($scope.obcional==0){
                      //  alert("estoy en cero");
                        $scope.can=parseInt(fin)-parseInt(ini);
                          for(var n=0;n<=$scope.can;n++)
                        {   
                            $scope.obcional=ini+n;
                            $scope.ArrayTalla[n]=$scope.obcional; 
                            $scope.ArrayTallas.push($scope.ArrayTalla);
                            $scope.h++;
                       // alert(n);
                        }

                   /* }else{
                        alert("no estoy en cero"+$scope.obcional+"/"+$scope.h);
                        $scope.can=parseInt(fin)-$scope.obcional;
                         for(var t=0;t<$scope.can;t++)
                        {   
                            
                            $scope.obcional++;
                            $scope.ArrayTalla[$scope.obcional]=$scope.obcional; 
                            $scope.ArrayTallas.push($scope.ArrayTalla);
                            $scope.h++;
                        }
                   }*/
                }
               $scope.generarVariantes=function(cant,index){
                ///alert("hola estoy llenando variantes"+index);
                   $scope.variant1[index]=cant;
                   $scope.variants1.push($scope.variant1);
               }
               $scope.validarNombre=function(){
                   alert("Usted no puede crear dos productos con el mismo nombre");
                   $scope.producto.nombre='';
                   crudService.paginate('productos',1).then(function (data) {
                        $scope.productos = data.data;
                   });
               }
               $scope.validaNombre2=function(texto){
                 if(texto!=undefined){
                    //alert(texto);
                  crudService.validar('productos',texto).then(function (data){
                        //$scope.productos = data;
                        //alert(data.nombre);
                        if(data.nombre!=undefined){
                           alert("Usted no puede crear dos productos con el mismo nombre");
                           $scope.producto.nombre=''; 
                        }
                    });
                 }
               }
               $scope.validanomMarca=function(texto){
                //alert('hola');
                    if(texto!=undefined){
                        crudService.search('marcas',texto,1).then(function (data){
                        $scope.materials = data.data;
                        if($scope.materials!=null){
                           alert("Usted no puede crear dos Marcas con el mismo nombre");
                           $scope.producto.nombre=''; 
                        }
                    });
                    }
               }
                $scope.addAttribute = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent5.html',
                        controller: 'ModalInstanceCtrl5',
                        size: 'sm',
                        /*resolve: {
                         items: function () {
                         return $scope.items;
                         }
                         }*/
                    });

                    modalInstance.result.then(function (selectedItem) {
                        //$scope.selected = selectedItem;
                    }, function () {
                        //$log.info('Modal dismissed at: ' + new Date());
                        crudService.all('atributes').then(function (data){
                            $scope.attributes = data.data;
                            //$log.log($scope.attributes);
                        })

                    });
                };

                $scope.opcAtr = [];
                $scope.opcAtr[1] = ['NEGRO','BLANCO','ROJO','AZUL','MARRÓN','VINO','NUDE','BEIGE','TURQUESA'];
                $scope.opcAtr[2] = ['18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45'];
                $scope.opcAtr[3] = ['3','5','7','9','10','11','12','13','15','18','20','21'];
                $scope.opcAtr[4] = ['CUERO LISO','CUERO GAMUZA','CUERO CHAROL','SINTÉTICO LISO','SINTÉTICO GAMUZA','SINTÉTICO CHAROL','TELA'];

                

                /*
                Fin de add
                 */

                function isEmpty(obj) {
                    return Object.keys(obj).length === 0;
                }


            }]);
})();
