(function(){
    angular.module('products.controllers',[])
        .controller('ProductController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log','ngProgressFactory','$rootScope','trouble',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log,ngProgressFactory,$rootScope,trouble){
                $scope.progressbar = ngProgressFactory.createInstance();
                /*$rootScope.$on('$routeChangeStart', function(ev,data) {
                    $scope.progressbar.start();
                });
                $rootScope.$on('$routeChangeSuccess', function(ev,data) {
                    $scope.progressbar.complete();
                });*/
                $scope.stockVariants = [];

                $scope.stockTemplate = 'stockTemplate.html';

                $scope.products = [];
                $scope.product = {};
                $scope.variant = {};
                $scope.product.track = true;
                $scope.variant.track = true;
                $scope.product.autogenerado = true;
                $scope.variant.autogenerado = true;
                //$scope.variant.detAtr = [];
                $scope.product.presentations = [];
                $scope.variant.presentations = [];
                $scope.generos = [{name:'Masculino'},{name:'Femenino'}];
                $scope.errors;
                $scope.success;
                $scope.query = '';
                $scope.brands = {};
                $scope.materials = {};
                $scope.types = {};
                $scope.stations = {};
                $scope.product.estado = true;
                $scope.product.hasVariants = false;

                $scope.presentation = {};
                $scope.presentations = [];
                $scope.preAdd = {};
                $scope.presentation.id = '1';
                //$scope.product.presentations = [];
                $scope.presentation.suppPri = 0;
                $scope.presentation.markup = 0;
                $scope.presentation.price = 0;

                $scope.minNumber = 0;

                $scope.warehouses = [];


                $scope.variants = []; //variantes por product_id;

                //$scope.product.presentation_base = '1';

                $scope.product.presentation_base_object = {};
                $scope.variant.presentation_base_object = {};

                //$scope.product.presentation_base_object = {id:1};
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


                $scope.calculateSuppPric = function() {//presentation.markup
                    //alert('holi');alert($scope.presentation.suppPri);
                    if(angular.isNumber($scope.presentation.suppPri) && angular.isNumber($scope.presentation.markup) && angular.isNumber($scope.presentation.price)){
                        $scope.presentation.price = $scope.presentation.suppPri + $scope.presentation.markup * $scope.presentation.suppPri / 100;
                        //alert('pasa');
                    }
                };
                $scope.calculateMarkup = function() {
                    //alert('holi');
                    if(angular.isNumber($scope.presentation.suppPri) && angular.isNumber($scope.presentation.markup) && angular.isNumber($scope.presentation.price)){
                        $scope.presentation.price = $scope.presentation.suppPri + $scope.presentation.markup * $scope.presentation.suppPri / 100;
                    }
                };
                $scope.calculatePrice = function() {
                    //alert('holi');
                    if(angular.isNumber($scope.presentation.suppPri) && angular.isNumber($scope.presentation.markup) && angular.isNumber($scope.presentation.price)){
                        $scope.presentation.markup = ($scope.presentation.price - $scope.presentation.suppPri) * 100 / $scope.presentation.suppPri;
                    }
                };
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('products',$scope.query,$scope.currentPage).then(function (data){
                        $scope.products = data.data;
                    });
                    }else{
                        crudService.paginate('products',$scope.currentPage).then(function (data) {
                            $scope.products = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                //$log.log($routeParams);

                if(id)
                {
                    if($location.path() == '/products/edit/'+$routeParams.id) {


                          //  if(!$scope.product.hasVariants){
                                crudService.byforeingKey('variants','variant',id).then(function(data){
                                    $log.log(data);
                                    $scope.product = data.product;
                                    $scope.product.estado = ( $scope.product.estado == 1 );
                                    $scope.product.hasVariants = ($scope.product.hasVariants == 1 );
                                    $scope.product.track = (data.track == 1 ); //de variants
                                    $scope.product.presentations = data.det_pre;
                                    $scope.product.stock = data.stock;
                                    crudService.all('warehouses').then(function (data){
                                        $scope.warehouses = data;
                                    });
                                    $scope.product.sku = data.sku;
                                    //alert(isEmpty(data.stock));
                                    if(isEmpty(data.stock)){
                                        //alert('holi');
                                        $scope.minNumber = null ;
                                    }
                                    $scope.product.autogenerado = false;
                                    crudService.all('presentations_base').then(function(data){
                                        //alert('holi');
                                        $scope.presentations_base = data;
                                        $log.log( $scope.presentations_base);
                                        $scope.obj = $.grep($scope.presentations_base, function(e){ return e.id == $scope.product.presentation_base; });
                                        $scope.product.presentation_base_object = $scope.obj[0];
                                        if(!isEmpty($scope.obj)) {
                                            //$scope.traerPres($scope.product.presentation_base_object.id);
                                            //$scope.changePreBase();
                                            $scope.enabled_presentation_button = false;
                                        }
                                    });

                                });
                            //}



                        crudService.select('products', 'brands').then(function (data) {
                            $scope.brands = data;
                        });
                        crudService.select('products', 'materials').then(function (data) {
                            $scope.materials = data;
                        });
                        crudService.select('products', 'types').then(function (data) {
                            $scope.types = data;
                        });
                        crudService.select('products', 'stations').then(function (data) {
                            $scope.stations = data;
                        });



                    };

                    if($location.path() == '/products/show/'+$routeParams.id) {
                        //alert('ok');
                        crudService.byId(id,'products').then(function (data){
                            $scope.product = data;
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
                            $scope.variant.image = data.image;

                            $scope.variant.nota = data.nota;
                            $scope.variant.observado = (data.observado == 1);

                            $scope.variant.product_id = data.product_id;
                            $scope.variant.category = parseInt(data.category);



                            //crudService.byId($scope.variant.product_id, 'products').then(function (data) {
                                //$log.log(data);
                            $scope.product = data.product;
                            //$scope.product.estado = ( $scope.product.estado == 1 );
                            //$scope.product.hasVariants = ($scope.product.hasVariants == 1 );
                            $scope.variant.track = (data.track == 1 ); //de variants
                            $scope.variant.presentations = data.det_pre;
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
                                //if ($scope.product.type) $scope.variant.codigo = $scope.product.codigo + $scope.product.type.nombre.charAt(0); else {
                                //    $scope.variant.codigo = $scope.product.codigo;
                                //}
                                //espero q se llene product y de ahi agrego Unidades por defecto
                                crudService.all('presentations_base').then(function (data) {
                                    $log.log(data);
                                    $scope.presentations_base = data;
                                    //$scope.product.presentation_base_object
                                    //$log.log( $scope.presentations);
                                    $scope.variant.presentation_base_object = data[0];
                                    $scope.variant.presentation_base = $scope.variant.presentation_base_object.id;
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
                    crudService.paginate('products',1).then(function (data) {
                        $scope.products = data.data;
                        //$log.log(data.data);
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    if($location.path() == '/products/create') {

                        crudService.select('products', 'brands').then(function (data) {
                            $scope.brands = data;
                        });
                        crudService.select('products', 'materials').then(function (data) {
                            $scope.materials = data;
                        });
                        crudService.select('products', 'types').then(function (data) {
                            $scope.types = data;
                        });
                        crudService.select('products', 'stations').then(function (data) {
                            $scope.stations = data;
                        });
                        crudService.all('warehouses').then(function (data){
                            $scope.warehouses = data;
                            //alert('h');

                        });
                        crudService.all('presentations_base').then(function(data){
                            //alert('holi');
                            $scope.presentations_base = data;
                            //$scope.product.presentation_base_object
                            //$log.log( $scope.presentations);
                            $scope.product.presentation_base_object = data[0];
                            $scope.product.presentation_base = $scope.product.presentation_base_object.id;
                            $scope.enabled_presentation_button = false;

                            //$scope.presentationSelect =

                        });
                    }
                }

                if($routeParams.product_id){
                    if($location.path() == '/variants/create/'+$routeParams.product_id){
                        crudService.byId($routeParams.product_id,'products').then(function (data) {
                            $log.log(data);
                            $scope.product = data;
                            if($scope.product.type) $scope.variant.codigo = $scope.product.codigo+$scope.product.type.nombre.charAt(0); else{$scope.variant.codigo = $scope.product.codigo;}
                                //espero q se llene product y de ahi agrego Unidades por defecto
                            crudService.all('presentations_base').then(function(data){
                                $log.log(data);
                                $scope.presentations_base = data;
                                //$scope.product.presentation_base_object
                                //$log.log( $scope.presentations);
                                $scope.variant.presentation_base_object = data[0];
                                $scope.variant.presentation_base = $scope.variant.presentation_base_object.id;
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

                socket.on('product.update', function (data) {
                    $scope.products=JSON.parse(data);
                });

                $scope.searchProduct = function(){
                if ($scope.query.length > 0) {
                    crudService.search('products',$scope.query,1).then(function (data){
                        $scope.products = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('products',1).then(function (data) {
                        $scope.products = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };



                $scope.createProduct = function(){

                    if ($scope.productCreateForm.$valid) {
                        var f = document.getElementById('productImage').files[0] ? document.getElementById('productImage').files[0] : null;
                        //alert(f);
                        var r = new FileReader();
                        r.onloadend = function(e) {
                            $scope.product.image = e.target.result;

                            crudService.create($scope.product, 'products').then(function (data) {
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Producto creado con Éxito');
                                    $location.path('/products');

                                } else {
                                    $scope.errors = data;
                                    //alert(data);

                                }
                            });
                        }
                        if(!document.getElementById('productImage').files[0]){
                            //alert($scope.product.hasVariants);
                            crudService.create($scope.product,'products').then(function (data){
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Producto creado con Éxito');
                                    $location.path('/products');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                        }

                        if(document.getElementById('productImage').files[0]){
                            r.readAsDataURL(f);
                        }

                    }
                }


                $scope.createVariant = function(){

                    if ($scope.variantCreateForm.$valid) {
                        var fv = document.getElementById('variantImage').files[0] ? document.getElementById('variantImage').files[0] : null;
                        //alert(f);
                        var rv = new FileReader();
                        rv.onloadend = function(e) {
                            //alert('con img');
                            $scope.variant.image = e.target.result;

                            $scope.variant.product_id = $scope.product.id;
                            crudService.create($scope.variant, 'variants').then(function (data) {
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Variante creada con Éxito');
                                    $location.path('/products/show/'+$scope.product.id);

                                } else {
                                    $scope.errors = data;
                                    //alert(data);

                                }
                            });
                        }
                        if(!document.getElementById('variantImage').files[0]){
                            //alert($scope.product.hasVariants);
                            //alert('sin img');
                            $scope.variant.product_id = $scope.product.id;
                            crudService.create($scope.variant,'variants').then(function (data){
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Variante creada con Éxito');
                                    $location.path('/products/show/'+$scope.product.id);

                                } else {
                                    $scope.errors = data;

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
                        var f = document.getElementById('variantImage').files[0] ? document.getElementById('variantImage').files[0] : null;
                        //alert(f);
                        var r = new FileReader();
                        r.onloadend = function(e) {
                            $scope.product.image = e.target.result;

                            $scope.variant.product_id = $scope.product.id;
                            crudService.update($scope.variant, 'variants').then(function (data) {
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Variante modificada con Éxito');
                                    $location.path('/products/show/'+$scope.product.id);

                                } else {
                                    $scope.errors = data;
                                    //alert(data);

                                }
                            });
                        }
                        if(!document.getElementById('variantImage').files[0]){
                            //alert($scope.product.hasVariants);
                            $scope.variant.product_id = $scope.product.id;
                            crudService.update($scope.variant,'variants').then(function (data){
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Variante modificada con Éxito');
                                    $location.path('/products/show/'+$scope.product.id);

                                } else {
                                    $scope.errors = data;

                                }
                            });
                        }

                        if(document.getElementById('variantImage').files[0]){
                            r.readAsDataURL(f);
                        }

                    }
                }

                $scope.editProduct = function(row){
                    $location.path('/products/edit/'+row.proId);
                };

                $scope.editProductShow = function(product){
                    //$log.log(product);
                    $location.path('/products/edit/'+product.id);
                }

                $scope.updateProduct = function(){
                    //alert('ho');
                    if ($scope.productCreateForm.$valid) {
                        var f = document.getElementById('productImage').files[0] ? document.getElementById('productImage').files[0] : null;
                        //alert(f);
                        var r = new FileReader();
                        r.onloadend = function(e) {
                            $scope.product.image = e.target.result;
                        crudService.update($scope.product,'products').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/products');
                            }else{
                                $scope.errors =data;
                            }
                        });
                        }
                        if(!document.getElementById('productImage').files[0]){
                            //alert('ho');
                        crudService.update($scope.product,'products').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/products');
                            }else{
                                $scope.errors =data;
                            }
                        });}

                        if(document.getElementById('productImage').files[0]){
                            r.readAsDataURL(f);
                        }
                    }
                };

                $scope.deleteProduct = function(row){
                    $scope.product = row;
                    //$log.log($scope.product);
                }

                $scope.cancelProduct = function(){
                    $scope.product = {};
                }

                $scope.destroyProduct = function(){
                    crudService.destroy($scope.product,'products').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.product = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }

                $scope.deleteVariant = function(row){
                    $scope.variant = row;
                    //$log.log($scope.product);
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

                $scope.disableProduct = function(row){
                    //$log.log(row);
                    crudService.byforeingKey('products','disableprod',row.proId).then(function(data)
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

                $scope.addVariant = function(product_id){
                    $location.path('/variants/create/'+product_id);
                    //$scope.product = {nombre:'holi'};
                }

                $scope.showVariants = function(row){
                    $scope.variants = [];
                    crudService.byforeingKey('variants','variants',row.proId).then(function(data)
                    {
                            $scope.variants = data;
                    })
                    //crudService.
                }

                $scope.editVariant = function(row){
                    $location.path('/variants/edit/'+row.id);
                };

                $scope.capAttr = function(attr_id){
                    //$log.log(attr_id);
                    if(attr_id == 1) {
                        if($scope.product.type){} else{$scope.product.type = { nombre : ''}}
                        $scope.variant.codigo = $scope.product.codigo + $scope.product.type.nombre.charAt(0) + $scope.variant.detAtr[0].descripcion.substring(0, 2);
                    }
                }

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
                            alert('abajo');
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
                    if($location.path() != '/variants/create/'+$routeParams.product_id && $location.path() != '/variants/edit/'+$routeParams.id) {
                        crudService.byforeingKey('presentations', 'all_by_base', preBase).then(function (data) {
                            $scope.presentations = data;
                            //$log.log( $scope.presentations);
                            //$scope.presentations.push({id:$scope.product.presentation_base.id,nombre:'holi'});
                            $scope.presentations.unshift({
                                id: $scope.product.presentation_base_object.id,
                                nombre: $scope.product.presentation_base_object.nombre,
                                shortname: $scope.product.presentation_base_object.shortname,
                                cant: 'Pre. base'
                            });
                            $scope.presentationSelect = $scope.presentations[0];
                        });
                    }
                    if($location.path() == '/variants/create/'+$routeParams.product_id || $location.path() == '/variants/edit/'+$routeParams.id){
                        crudService.byforeingKey('presentations','all_by_base',preBase).then(function(data){
                            $scope.presentations = data;
                            //$log.log( $scope.presentations);
                            //$scope.presentations.push({id:$scope.product.presentation_base.id,nombre:'holi'});
                            $scope.presentations.unshift({
                                id:$scope.variant.presentation_base_object.id,
                                nombre:$scope.variant.presentation_base_object.nombre,
                                shortname:$scope.variant.presentation_base_object.shortname,
                                cant:'Pre. base'
                            });
                            $scope.presentationSelect = $scope.presentations[0];
                        });
                    }

                }

                $scope.AddPres = function(){
                    if($location.path() != '/variants/create/'+$routeParams.product_id && $location.path() != '/variants/edit/'+$routeParams.id) {

                        if (typeof ($scope.presentationSelect.preFin_id) !== 'undefined') {
                            $scope.presentationSelect.id = $scope.presentationSelect.preFin_id;
                        }

                        var isYa = $.grep($scope.product.presentations, function (e) {
                            return e.id == $scope.presentationSelect.id;
                        });
                        //$log.log($scope.presentationSelect);
                        //$log.log($scope.product.presentations);
                        //$log.log(isYa);
                        //if(isYa.length == 0 && $scope.presentationSelect!==null && $scope.presentationSelect.length!== 0) {
                        if (isYa.length == 0 && !isEmpty($scope.presentationSelect)) {
                            //alert(typeof($scope.presentationSelect.preFin_id));

                            $scope.presentationSelect.suppPri = $scope.presentation.suppPri;
                            $scope.presentationSelect.markup = $scope.presentation.markup;
                            $scope.presentationSelect.price = $scope.presentation.price;
                            $scope.product.presentations.push($scope.presentationSelect);
                            //$log.log($scope.product.presentations);
                            $scope.presentation = {};
                            $scope.presentationSelect = {};
                            $scope.presentation.suppPri = 0;
                            $scope.presentation.markup = 0;
                            $scope.presentation.price = 0;
                        } else {
                            alert('Item duplicado o vacío');
                        }
                    }
                    if($location.path() == '/variants/create/'+$routeParams.product_id || $location.path() == '/variants/edit/'+$routeParams.id){

                        if (typeof ($scope.presentationSelect.preFin_id) !== 'undefined') {
                            $scope.presentationSelect.id = $scope.presentationSelect.preFin_id;
                        }

                        var isYa2 = $.grep($scope.variant.presentations, function (e) {
                            return e.id == $scope.presentationSelect.id;
                        });
                        //$log.log($scope.presentationSelect);
                        //$log.log($scope.product.presentations);
                        //$log.log(isYa);
                        //if(isYa.length == 0 && $scope.presentationSelect!==null && $scope.presentationSelect.length!== 0) {
                        if (isYa2.length == 0 && !isEmpty($scope.presentationSelect)) {
                            //alert(typeof($scope.presentationSelect.preFin_id));

                            $scope.presentationSelect.suppPri = $scope.presentation.suppPri;
                            $scope.presentationSelect.markup = $scope.presentation.markup;
                            $scope.presentationSelect.price = $scope.presentation.price;
                            $scope.variant.presentations.push($scope.presentationSelect);
                            //$log.log($scope.product.presentations);
                            $scope.presentation = {};
                            $scope.presentationSelect = {};
                            $scope.presentation.suppPri = 0;
                            $scope.presentation.markup = 0;
                            $scope.presentation.price = 0;
                        } else {
                            alert('Item duplicado o vacío');
                        }
                    }
                }

                $scope.deletePres = function($index){
                    if($location.path() != '/variants/create/'+$routeParams.product_id && $location.path() != '/variants/edit/'+$routeParams.id) {
                        $scope.product.presentations.splice($index, 1);
                    }
                    if($location.path() == '/variants/create/'+$routeParams.product_id || $location.path() == '/variants/edit/'+$routeParams.id) {
                        $scope.variant.presentations.splice($index, 1);
                    }
                }

                $scope.selectPres = function(){
                    $scope.presentation.suppPri = 0;
                    $scope.presentation.markup = 0;
                    $scope.presentation.price = 0;
                }

                $scope.changePreBase = function(){
                    //$log.log($scope.product.presentation_base_object);cartItems.length > 0
                    if($location.path() != '/variants/create/'+$routeParams.product_id && $location.path() != '/variants/edit/'+$routeParams.id) {
                        if ($scope.product.presentation_base_object !== null && !isEmpty($scope.product.presentation_base_object)) {
                            $scope.product.presentation_base = $scope.product.presentation_base_object.id;
                            $scope.product.presentations = [];
                            //alert('borra if');
                            $scope.enabled_presentation_button = false;
                            $scope.enabled_createpresentation_button = false;
                        } else {
                            $scope.enabled_presentation_button = true;
                            $scope.enabled_createpresentation_button = true;
                            $scope.product.presentation_base = null;
                            $scope.product.presentations = [];
                            //alert('borra else');
                        }
                    }
                    if($location.path() == '/variants/create/'+$routeParams.product_id || $location.path() == '/variants/edit/'+$routeParams.id) {
                        if ($scope.variant.presentation_base_object !== null && !isEmpty($scope.variant.presentation_base_object)) {
                            $scope.variant.presentation_base = $scope.variant.presentation_base_object.id;
                            $scope.variant.presentations = [];
                            //alert('borra if');
                            $scope.enabled_presentation_button = false;
                            $scope.enabled_createpresentation_button = false;
                        } else {
                            $scope.enabled_presentation_button = true;
                            $scope.enabled_createpresentation_button = true;
                            $scope.variant.presentation_base = null;
                            $scope.variant.presentations = [];
                            //alert('borra else');
                        }
                    }

                }

                $scope.createPres = function(unidad_base){
                    $scope.preAdd.preBase_id = unidad_base;
                    //$log.log($scope.preAdd);
                    crudService.create($scope.preAdd, 'presentations').then(function (data) {
                        if (data['estado'] == true) {
                            $scope.presentations.push({
                                id:data['presentation'].id,
                                nombre:data['presentation'].nombre,
                                shortname:data['presentation'].shortname,
                                cant:data['equiv'].cant
                            })
                            $scope.preAdd = {};
                            alert('Presentacion creada con éxito');
                        } else {
                            $scope.errors = data;
                        }
                    });

                }

                $scope.showStock = function(product_id){
                    crudService.byforeingKey('stocks','traerstock',product_id).then(function (data){
                        $scope.stockVariants = data;
                    })
                }

                function isEmpty(obj) {
                    return Object.keys(obj).length === 0;
                }


            }]);
})();
