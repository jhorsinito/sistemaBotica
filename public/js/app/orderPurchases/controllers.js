(function(){
    angular.module('orderPurchases.controllers',[])
        .controller('OrderPurchaseController',['$scope', '$routeParams','$location','crudPurchase','socketService' ,'$filter','$route','$http','$log',
            function($scope, $routeParams,$location,crudPurchase,socket,$filter,$route , $http,$log){
             
                $scope.orderPurchases = [];
                $scope.orderPurchase = {};
                $scope.products = [];
                $scope.product = {};
                $scope.detailOrderPurchases = [];
                $scope.detailOrderPurchase = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.warehouses;
                $scope.orderPurchase.fechaPedido=new Date();
                $scope.date=new Date();
                $scope.variants=[];
                $scope.variant={};
                $scope.payments=[];
                $scope.payment={};
                $scope.atributes=[];
                $scope.atribute={};
                //$scope.detPayments=[];
                $scope.cantidad;
                $scope.detPayment={};
                $scope.suppliers;
                $scope.orderPurchase.montoBruto=0;
                $scope.orderPurchase.montoTotal=0;
                $scope.orderPurchase.descuento=0;
                $scope.codigoTemporalP=0;
                $scope.indexmodificar;
                $scope.mostrarVariantes=false;
                $scope.idtemporalP;
                $scope.master=true;
                $scope.cheked2=false;
                $scope.variants.id;
                $scope.companies=[];
                $scope.company={};



                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudPurchase.search('orderPurchases',$scope.query,$scope.currentPage).then(function (data){
                        $scope.orderPurchases = data.data;
                    });
                    }else{
                        crudPurchase.paginate('orderPurchases',$scope.currentPage).then(function (data) {
                            $scope.orderPurchases = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudPurchase.byId(id,'orderPurchases').then(function (data) {
                        $scope.orderPurchase = data;
                        $scope.codigoTemporalP=data.id;
                        $scope.orderPurchase.estados=data.Estado;
                        if(data.fechaPedido != null) {
                            if (data.fechaPedido.length > 0) {
                                data.fechaPedido = new Date(data.fechaPedido);
                            }
                        }
                        if(data.fechaPrevista != null) {
                            if (data.fechaPrevista.length > 0) {
                                data.fechaPrevista = new Date(data.fechaPrevista);
                            }
                        }
                        crudPurchase.byId(data.warehouses_id,'warehouses').then(function (data) {
                        $scope.warehouses=data;
                    });
                     $scope.dd=$scope.orderPurchase.fechaPrevista.getDate();
                     $scope.mm=$scope.orderPurchase.fechaPrevista.getMonth();
                     $scope.yyyy=$scope.orderPurchase.fechaPrevista.getFullYear();
                     $scope.dd1=$scope.orderPurchase.fechaPedido.getDate();
                     $scope.mm1=$scope.orderPurchase.fechaPedido.getMonth();
                     $scope.yyyy1=$scope.orderPurchase.fechaPedido.getFullYear();
                     if($scope.dd<10){$scope.dd="0"+$scope.dd;} else{$scope.dd=$scope.dd;}
                     if($scope.mm<10){$scope.mm="0"+(parseInt($scope.mm)+1);}else{$scope.mm=$scope.mm;}
                     $scope.orderPurchase.fechaPrevist=$scope.dd+"-"+$scope.mm+"-"+$scope.yyyy;
                     if($scope.dd1<10){$scope.dd1="0"+$scope.dd1;} else{$scope.dd1=$scope.dd1;}
                     if($scope.mm<10){$scope.mm1="0"+(parseInt($scope.mm1)+1);}else{$scope.mm1=$scope.mm1;}
                     $scope.orderPurchase.fechaPedid=$scope.dd1+"-"+$scope.mm1+"-"+$scope.yyyy1;
                    
                       /* $scope.orderPurchase.montoBruto=parseFloat(data.montoBruto);
                        $scope.orderPurchase.montoTotal=parseFloat(data.montoTotal);
                        $scope.orderPurchase.descuento=parseFloat(data.descuento);     */                 

                        
                        $scope.idtemporalP=data.supplier_id;
                        crudPurchase.traerEmpresa($scope.idtemporalP).then(function (data) { 
                        $scope.orderPurchase.empresa = data.empresa;
                    });
                       // alert(data.id);
                        crudPurchase.paginateDPedido(data.id,'detailOrderPurchases').then(function (data) {
                        $scope.detailOrderPurchases = data.data;
                        $log.log($scope.detailOrderPurchases);
                        $scope.detailOrderPurchase.unidades=parseFloat(data.cantidad);
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                       
                    });

                    });
                    crudPurchase.select('warehouses','select').then(function(data){
                        $scope.warehouses = data;
                    });
                    

                }else{
                    
                    crudPurchase.paginate('orderPurchases',1).then(function (data) {
                        $scope.orderPurchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                   
                    crudPurchase.select('warehouses','select').then(function(data){
                        $scope.warehouses = data;
                    });

                     
                }
                //=========================================
                /* crudPurchase.paginate('suppliers',1).then(function (data) {
                        $scope.suppliers = data.data;
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 15;
                       
                    });*/
               // if($location.path() == '/orderPurchases/create/'){
                     crudPurchase.autocomplit('products',1).then(function (data) {
                        $scope.products = data.data;
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 15;
                       
                    });
                    $scope.TraerPorSku=function(sku){
                        //alert("eecho"+sku);
                     crudPurchase.autocomplitVar('variants',sku).then(function (data) {
                        $scope.product.proId = data;
                        alert(data.varCodigo);
                         
             if($scope.product.proId.varCodigo!=null){


                      //  alert($scope.product.proId.varid);
                        //$scope.detailOrderPurchase.marca=$scope.product.proId.BraName;
                        //$scope.detailOrderPurchase.material=$scope.product.proId.Mnombre;
                        //$scope.detailOrderPurchase.tipo=$scope.product.proId.TName;
                        //$scope.detailOrderPurchase.proNombre=$scope.product.proId.proNombre;
                       // alert($scope.product.proId.varid);
                        $scope.codigoVarP=$scope.product.proId.varCodigo;
                        $scope.detailOrderPurchase.Codigovar=$scope.product.proId.varid;
                        $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                        $scope.detailOrderPurchase.codigoEspecifico=$scope.product.proId.varCodigo;
                        $scope.detailOrderPurchase.esbase=$scope.product.proId.esBase;
                        $scope.detailOrderPurchase.equivalecia=$scope.product.proId.equivalecia;
                               //$scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                       
                               $scope.detailOrderPurchase.Codigovar=$scope.product.proId.varid;
                                      $scope.detailOrderPurchase.producto=$scope.product.proId.proNombre+"("+$scope.product.proId.NombreAtributos+")";
                                        $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                                        $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                                        //$scope.variant.sku=$scope.product.proId.varcode; 
                                        $scope.detailOrderPurchase.detPres_id=$scope.product.proId.presid;
                                        alert("codigo det Pres"+$scope.detailOrderPurchase.detPres_id);
                                       $scope.detailOrderPurchase.Codigovar=$scope.product.proId.varid;
                                     $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                                              $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                                              $scope.detailOrderPurchase.preCompra=parseFloat($scope.product.proId.precioCompra);
                                              $scope.detailOrderPurchase.preProducto=parseFloat($scope.product.proId.precioCompra);
                                               alert($scope.detailOrderPurchase.preCompra);
                                                //$scope.mostrarPresentacion=false;
                                                $scope.variant.sku=$scope.product.proId.varcode; 
                                              $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                                              $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                                        
                    
                 }else{
                    alert("no coinsiden los resultados");
                 }});}
                      crudPurchase.paginate('suppliers',1).then(function (data) {
                        $scope.suppliers = data.data;
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 15;
                       
                    });
                    crudPurchase.paginate('methodPayments',1).then(function (data) {
                        $scope.methodPayments = data.data;
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 15;

                    });
                    //=========================================

                socket.on('orderPurchase.update', function (data) {
                    $scope.orderPurchases=JSON.parse(data);
                });
                $scope.ProvandoEdicion=function(){
                    $scope.show = !$scope.show;
                 crudPurchase.select('warehouses','select').then(function(data){
                        $scope.warehouses = data;
                    });   
                }
                 $scope.toggle = function () {
                    $scope.show = !$scope.show;
                
                };
                $scope.asignarEmpresa=function(){
                   // alert("hola estoy aqui");
                   // alert($scope.orderPurchase.empresa.empresa);
                    $scope.orderPurchase.supplier_id=$scope.orderPurchase.empresa.id;
                    $scope.orderPurchase.empresa=$scope.orderPurchase.empresa.empresa;
                }
                $scope.total20;
               
                /*$scope.searchsupplier=function(){
                 crudPurchase.paginate('suppliers',1).then(function (data) {
                        $scope.suppliers = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                       
                    });
                }*/
                  
                $scope.sacarRow=function(index,total){
                      $scope.detailOrderPurchases.splice(index,1);
                      $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto - (parseFloat(total));
                      $scope.orderPurchase.montoTotal=parseFloat($scope.orderPurchase.montoBruto)-((parseFloat($scope.orderPurchase.montoBruto)*parseFloat($scope.orderPurchase.descuento))/100);
                    }
                 /* $scope.llenar=function(){
                    $scope.master= !$scope.master;
                    if($scope.master){
                    $scope.mostrarPresentacion=true;}
                    $scope.product.proId='';
                    $scope.variant.sku='';
                  }*/
                  $scope.chekedval;
                  $scope.item={};
                  $scope.jajjajaja;
                 /* $scope.selecTalla=function(valor){
                    alert(valor);
                    //alert(document.getElementById('dato').value);
                  }*/
                  $scope.n=0;
                  
                  $scope.badera=true;
                  $scope.quitarTalla=function(talla,estado){
                    //alert(talla+"/"+estado);
                    if(estado==false){
                    var t=0;
                    for(var n=0;n<$scope.companies.length;n++){
                        t++;
                        //alert($scope.companies[n].talla);
                        if($scope.companies[n].talla==('TL:'+String(talla))){
                            $scope.detailOrderPurchase.cantidad=$scope.detailOrderPurchase.cantidad-$scope.companies[n].cantidad;
                            $scope.n=$scope.detailOrderPurchase.cantidad;
                            $scope.detailOrderPurchase.montoBruto=$scope.detailOrderPurchase.montoBruto-$scope.companies[n].montoBruto;
                            $scope.detailOrderPurchase.montoTotal=$scope.detailOrderPurchase.montoTotal-$scope.companies[n].montoTotal; 
                     
                            break;
                        }
                    }
                    $scope.companies.splice(t-1,1);
                }
                   // alert("hola"+t);
                  }
                  $scope.calCantidad=function(detID,esBase,atributos,sku,varCodigo,precioProducto,can,talla,equivalecia){
                   alert("hoye estamos llenado obcional"+equivalecia);

                      if(can>0){
                        $scope.company.producto=$scope.company.producto+"/TL:"+talla;
                     if($scope.companies[0]!=undefined){
                      for(var n=0;n<$scope.companies.length;n++){
                        if($scope.companies[n].talla==('TL:'+String(talla))){
                            $scope.detailOrderPurchase.cantidad=$scope.n-Number($scope.companies[n].cantidad);
                            $scope.n=Number($scope.detailOrderPurchase.cantidad);
                            $scope.detailOrderPurchase.montoBruto=$scope.detailOrderPurchase.montoBruto-parseFloat(($scope.companies[n].cantidad * precioProducto).toFixed(2));
                            $scope.detailOrderPurchase.montoTotal=$scope.detailOrderPurchase.montoBruto; 
                            $scope.companies[n].cantidad=can;
                            $scope.companies[n].montoBruto=Number(precioProducto)*Number(can);
                            $scope.companies[n].montoTotal=$scope.companies[n].montoBruto;
                            $scope.detailOrderPurchase.cantidad=Number(can)+$scope.n;
                            $scope.n=Number($scope.detailOrderPurchase.cantidad);
                            $scope.detailOrderPurchase.montoBruto=$scope.detailOrderPurchase.montoBruto+parseFloat(($scope.companies[n].cantidad * precioProducto).toFixed(2));
                            $scope.detailOrderPurchase.montoTotal=$scope.detailOrderPurchase.montoBruto; 
                     
                            $scope.badera=false;                      
                        }
                      }}
                      if($scope.badera){
                      $scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preProducto).toFixed(2));
                      $scope.company.talla='TL:'+String(talla);
                      $scope.company.producto=$scope.detailOrderPurchase.proNombre+"("+atributos+")";
                      $scope.company.esbase=$scope.detailOrderPurchase.esbase;
                      $scope.company.detPres_id=detID;
                      $scope.company.equivalencia=parseFloat(equivalecia);
                      alert($scope.company.detPres_id);
                      $scope.company.esbase=esBase;
                      alert($scope.company.esbase);
                      $scope.company.Codigovar=varCodigo;
                      $scope.company.CodigoPCompra=sku;
                      $scope.company.nombre=$scope.detailOrderPurchase.nombre;
                      $scope.company.preCompra=precioProducto;
                      $scope.company.taco=$scope.detailOrderPurchase.taco;
                      $scope.company.preProducto=precioProducto;
                      $scope.company.codigoEspecifico=$scope.detailOrderPurchase.codigoEspecifico;
                      $scope.company.cantidad=can;
                      $scope.company.pendiente=can;
                      $scope.company.orderPurchases_id=$scope.codigoTemporalP;                      
                      $scope.company.montoBruto=Number($scope.company.preProducto)*Number(can);
                      $scope.company.montoTotal=$scope.company.montoBruto;
                      $scope.companies.push($scope.company);
                      $scope.company={};
                      
                      //-----------------------------------------------------------------
                      $scope.detailOrderPurchase.cantidad=Number(can)+$scope.n;
                      $scope.n=Number($scope.detailOrderPurchase.cantidad);
                      $scope.detailOrderPurchase.orderPurchases_id=$scope.codigoTemporalP;
                      $scope.detailOrderPurchase.montoBruto=parseFloat(($scope.detailOrderPurchase.cantidad * precioProducto).toFixed(2));
                      $scope.detailOrderPurchase.montoTotal=$scope.detailOrderPurchase.montoBruto; 
                      //$scope.detailOrderPurchases.push($scope.detailOrderPurchase); 
                     }
                     }else{
                        alert("Ingrese Cantidad mayor a cero!!!!");
                     }
                  }
                  $scope.codigoVarP;
                  $scope.mostrarTallas=function(taco){
                    //alert($scope.codigoVarP+"/el taco es/"+taco);
                    if(taco!=null){
                    $scope.company.producto=$scope.company.producto+"/TC:"+taco;
                    crudPurchase.MostrarTallas($scope.codigoVarP,taco).then(function (data) {
                    $scope.atributes=data.data;
                         
                    });
                    $scope.mostrarPresentacion=false;
                } else{
                    alert("Selecciones un numero de Taco!!!")
                }
                  }
                    $scope.mostrarPresentacion=true;
                    $scope.tieneTaco=null;
                    $scope.asignarProduc1=function(){
                       // alert($scope.product.proId.varid);
                        $scope.detailOrderPurchase.marca=$scope.product.proId.BraName;
                        $scope.detailOrderPurchase.material=$scope.product.proId.Mnombre;
                        $scope.detailOrderPurchase.tipo=$scope.product.proId.TName;
                        $scope.detailOrderPurchase.proNombre=$scope.product.proId.proNombre;
                       // alert($scope.product.proId.varid);
                        $scope.codigoVarP=$scope.product.proId.varCodigo;
                        $scope.detailOrderPurchase.Codigovar=$scope.product.proId.varid;
                        $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                        $scope.detailOrderPurchase.codigoEspecifico=$scope.product.proId.varCodigo;
                               $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                       
                                crudPurchase.MostrarAtributos($scope.product.proId.varCodigo,'Taco').then(function (data) {
                               $scope.variants=data.data;
                               
                                if($scope.variants[0]==null){
                                      // alert("Se cargaran las tallas")
                                       crudPurchase.MostrarAtributos($scope.product.proId.varCodigo,'Talla').then(function (data) {
                                       $scope.atributes=data.data;
                                    if($scope.atributes[0]==null)
                                    {
                                                 //---------------------------------------------------------------
                                        $scope.detailOrderPurchase.Codigovar=$scope.product.proId.varid;
                                       // alert($scope.product.proId.proId+"jajjaj");
                                        $scope.detailOrderPurchase.producto=$scope.detailOrderPurchase.proNombre+"("+$scope.product.proId.NombreAtributos+")";
                                        $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                                        $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                                         /*crudPurchase.paginateDPedido($scope.product.proId.proId,'variants').then(function (data) {
                                                $scope.variants=data.data;
                                                $scope.maxSize = 5;
                                                $scope.totalItems = data.total;
                                                $scope.currentPage = data.current_page;
                                                $scope.itemsperPage = 15;
                         
                                         });*/
                                       //$scope.mostrarPresentacion=false;
                                       $scope.variant.sku=$scope.product.proId.varcode; 
                                       $scope.detailOrderPurchase.Codigovar=$scope.product.proId.varid;
                                       if($scope.master==false)
                                       {
                                           //alert($scope.master+"jajjaj");
                                              $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                                              $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                                               crudPurchase.paginateDPedido($scope.product.proId.varid,'detpres').then(function (data) {
                                              $scope.detPres=data.data;
                                              $scope.maxSize = 5;
                                              $scope.totalItems = data.total;
                                              $scope.currentPage = data.current_page;
                                              $scope.itemsperPage = 15;
                         
                                                 });
                                                $scope.mostrarPresentacion=false;
                                                $scope.variant.sku=$scope.product.proId.varcode;    

                                        }else
                                        {
                                              // alert($scope.master);
                                              $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                                              $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                                              crudPurchase.select('detpres',$scope.product.proId.varid).then(function (data) {
                                    //$scope.detPres=data;
                                   // alert(data.esbase);
                                                    $scope.detailOrderPurchase.esbase=data.esbase;
                                                    $scope.detailOrderPurchase.detPres_id=data.detpresen_id;
                                                    $scope.detailOrderPurchase.preProducto=parseFloat(data.precioProduct);
                                                    $scope.detailOrderPurchase.preCompra=parseFloat(data.precioProduct);
                                             });
                                 //$scope.mostrarPresentacion=false;
                                            $scope.variant.sku=$scope.product.proId.varcode; 
                                        }
                      //---------------------------------------------------------
                                      
                                    }else{
                                        $scope.mostrarPresentacion=false;
                                    }
                         
                                  });
                                  
                              
                                  }});
                                
                                  
                                
                                 crudPurchase.select('detpres',$scope.product.proId.varid).then(function (data) {
                                    //$scope.detPres=data;
                                   // alert(data.esbase);
                                    $scope.detailOrderPurchase.esbase=data.esbase;
                                    $scope.detailOrderPurchase.detPres_id=data.detpresen_id;
                                    $scope.detailOrderPurchase.preProducto=parseFloat(data.precioProduct);
                                    $scope.detailOrderPurchase.preCompra=parseFloat(data.precioProduct);
                                  });
                        /*$scope.detailOrderPurchase.Codigovar=$scope.product.proId.varid;
                        alert($scope.product.proId.proId+"jajjaj");
                               $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                               $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                                crudPurchase.paginateDPedido($scope.product.proId.proId,'variants').then(function (data) {
                               $scope.variants=data.data;
                               $scope.maxSize = 5;
                               $scope.totalItems = data.total;
                               $scope.currentPage = data.current_page;
                               $scope.itemsperPage = 15;
                         
                                  });
                                 $scope.mostrarPresentacion=false;
                                 $scope.variant.sku=$scope.product.proId.varcode; 
                        $scope.detailOrderPurchase.Codigovar=$scope.product.proId.varid;
                        if($scope.master==false){
                            //alert($scope.master+"jajjaj");
                               $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                               $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                                crudPurchase.paginateDPedido($scope.product.proId.varid,'detpres').then(function (data) {
                               $scope.detPres=data.data;
                               $scope.maxSize = 5;
                               $scope.totalItems = data.total;
                               $scope.currentPage = data.current_page;
                               $scope.itemsperPage = 15;
                         
                                  });
                                 $scope.mostrarPresentacion=false;
                                 $scope.variant.sku=$scope.product.proId.varcode;                  
                         }else{
                           // alert($scope.master);
                            $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                               $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                                crudPurchase.select('detpres',$scope.product.proId.varid).then(function (data) {
                                    //$scope.detPres=data;
                                   // alert(data.esbase);
                                    $scope.detailOrderPurchase.esbase=data.esbase;
                                    $scope.detailOrderPurchase.detPres_id=data.detpresen_id;
                                    $scope.detailOrderPurchase.preProducto=parseFloat(data.precioProduct);
                                    $scope.detailOrderPurchase.preCompra=parseFloat(data.precioProduct);
                                  });
                                 //$scope.mostrarPresentacion=false;
                                 $scope.variant.sku=$scope.product.proId.varcode; 
                         }*/
                     
                    }
                   /* $scope.asignarProduc2=function(){
                        alert("este es el codigo de variante"+$scope.variant.sku.id);
                        $scope.detailOrderPurchase.Codigovar=$scope.variant.sku.id;
                         if($scope.master==false){
                           $scope.detailOrderPurchase.CodigoPCompra=$scope.variant.sku.sku;
                               $scope.detailOrderPurchase.nombre=$scope.variant.sku.nombre;
                                crudPurchase.paginateDPedido($scope.variant.sku.id,'detpres').then(function (data) {
                               $scope.detPres=data.data;
                               $scope.maxSize = 5;
                               $scope.totalItems = data.total;
                                $scope.currentPage = data.current_page;
                               $scope.itemsperPage = 15;
                                  });
                                 $scope.mostrarPresentacion=false;
                                 $scope.product.proId=$scope.variant.sku.nombre+" /"+$scope.variant.sku.descripcion;
                         }else{
                             $scope.detailOrderPurchase.CodigoPCompra=$scope.variant.sku.sku;
                               $scope.detailOrderPurchase.nombre=$scope.variant.sku.nombre;
                                crudPurchase.select('detpres',$scope.variant.sku.id).then(function (data) {
                                    //$scope.detPres=data;
                                    $scope.detailOrderPurchase.esbase=data.esbase;
                                    $scope.detailOrderPurchase.detPres_id=data.detpresen_id;
                                    $scope.detailOrderPurchase.preProducto=parseFloat(data.precioProduct);
                                    $scope.detailOrderPurchase.preCompra=parseFloat(data.precioProduct);
                                  });
                                 //$scope.mostrarPresentacion=false;
                                 $scope.product.proId=$scope.variant.sku.nombre+" /"+$scope.variant.sku.NombreAtributos;
                         }
                    }*/
                    $scope.valor=21;
                    $scope.aumentarValor=function(){
                        if($scope.valor<42){
                           $scope.valor=$scope.valor+1;
                        }else{
                            alert("no existe talla mayor");
                        }
                    }
                    $scope.bajarValor=function(){
                        if($scope.valor>21){
                           $scope.valor=$scope.valor-1;
                        }else{
                           alert("no existe talla menor"); 
                        }
                    }
                    $scope.tallaSelect='';
                    $scope.traerUno=function(){
                        if($scope.tallaSelect==''){
                            $scope.tallaSelect=$scope.tallaSelect+""+$scope.valor;
                        }else{
                            $scope.tallaSelect=$scope.tallaSelect+";"+$scope.valor;
                        }
                    }
                    $scope.traerTodo=function(){
                        $scope.tallaSelect='';
                        for($n=21;$n<43;$n++){
                        if($scope.tallaSelect==''){
                            $scope.tallaSelect=$scope.tallaSelect+""+$n;
                        }else{
                            $scope.tallaSelect=$scope.tallaSelect+";"+$n;
                        }
                       }
                    }
                    $scope.seleccionarDetPres=function(){
                       if($scope.variants.id != undefined){
                        $id=$scope.variants.id;

                        //lo nuevo
                        crudPurchase.eligirNumero($id,'detpres').then(function (data) {
                            $scope.detPres=data.data;
                            $scope.maxSize = 5;
                            $scope.totalItems = data.total;
                            $scope.currentPage = data.current_page;
                            $scope.itemsperPage = 15;

                         });
                        //finlo nuevo
                         /*crudPurchase.paginateDPedido($id,'detpres').then(function (data) {
                            $scope.detPres=data.data;
                            $scope.maxSize = 5;
                            $scope.totalItems = data.total;
                            $scope.currentPage = data.current_page;
                            $scope.itemsperPage = 15;

                         });
                          //$scope.mostrarModal="modal";
                        crudPurchase.byId($id,'variants').then(function (data) {
                        $scope.detailOrderPurchase.CodigoPCompra=data.sku;
                        $scope.mostrarPresentacion=false;
                    });*/
                        }else{
                            alert("por favor seleccione una variante");
                        }
                    }
                    $scope.AsignarP=function(row){
                         $scope.detailOrderPurchase.preProducto=parseFloat(row.precioCompra);
                         $scope.detailOrderPurchase.preCompra=parseFloat(row.precioCompra);
                         $scope.detailOrderPurchase.detPres_id=row.iddetalleP;
                        // alert(row.base);
                         $scope.detailOrderPurchase.esbase=row.base;
                         $scope.mostrarPresentacion=true;
                    }
                    $scope.AgregarProducto=function(){
                    if( $scope.mostrarPresentacion==false){
                       $scope.cantRows=$scope.companies.length;
                       $scope.detailOrderPurchase.descuento=Number($scope.detailOrderPurchase.descuento)/Number($scope.cantRows);
                            
                      for(var n=0;n<$scope.companies.length;n++){
                          $scope.companies[n].Fecha=new Date();
                        if($scope.detailOrderPurchase.descuento>0){
                            $scope.companies[n].preCompra=parseFloat(($scope.companies[n].preCompra - (($scope.companies[n].preCompra * $scope.detailOrderPurchase.descuento ) / 100)).toFixed(2));
                            $scope.companies[n].montoTotal=Number($scope.companies[n].cantidad)*$scope.companies[n].preCompra;
                            $scope.companies[n].descuento=$scope.detailOrderPurchase.descuento;
                        }
                        $scope.orderPurchase.montoBruto=Number($scope.orderPurchase.montoBruto)+Number($scope.companies[n].montoTotal);
                        $scope.orderPurchase.montoTotal=parseFloat(($scope.orderPurchase.montoBruto - parseFloat(($scope.orderPurchase.montoBruto*$scope.orderPurchase.descuento)/100)).toFixed(2));
                        $scope.detailOrderPurchases.push($scope.companies[n]);
                      }
                      $scope.companies=[];
                      $scope.detailOrderPurchase.cantidad=0;
                      $scope.detailOrderPurchase.montoBruto=0;
                      $scope.detailOrderPurchase.montoTotal=0;
                      $scope.detailOrderPurchase.descuento=0;
                      $scope.detailOrderPurchase.preCompra=0;
                      $scope.n=0;
                      $scope.cheked2=false;
                      $scope.mostrarPresentacion=true;
                  }else{
                       if($scope.detailOrderPurchase.detPres_id>0){
                        if($scope.detailOrderPurchase.cantidad>1){
                        $scope.detailOrderPurchase.orderPurchases_id=$scope.codigoTemporalP;
                        $scope.detailOrderPurchases.push($scope.detailOrderPurchase);
                        $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases;
                        //---------------------------------------------------------
                        $scope.orderPurchase.montoBruto= parseFloat(($scope.orderPurchase.montoBruto+$scope.detailOrderPurchase.montoTotal));
                        $scope.orderPurchase.montoTotal=parseFloat(($scope.orderPurchase.montoBruto-(($scope.orderPurchase.montoBruto*$scope.orderPurchase.descuento)/100)));
                        $scope.orderPurchases.push($scope.orderPurchase);
                        $scope.detailOrderPurchase = {};
                        //$scope.variants={};
                        $scope.product.proId='';
                        $scope.variant.sku='';
                        $scope.product.id='';
                    }else{
                       alert("Por favor debe ingresar una cantidad mayor a cero para poder agregar pedido");
                    }
                    }else{ alert("!!Usted Debe seleccionar un producto y una presentacion para poder agregar!!");}
                 }}
                    $scope.ejemplo2=null;
                    $scope.estado_fin2=0;
                    $scope.ejemplo_de2=true;
                    $scope.calcularmontoBrutoF=function(){
                        if($scope.ejemplo2 != $scope.orderPurchase.montoTotal && $scope.estado_fin2 == $scope.orderPurchase.descuento){
                          $scope.orderPurchase.descuento=parseFloat(((($scope.orderPurchase.montoBruto - $scope.orderPurchase.montoTotal)/$scope.orderPurchase.montoBruto)*100).toFixed(2));
                          $scope.estado_fin2=$scope.orderPurchase.descuento;
                          $scope.ejemplo_de2=false;
                        }
                        if($scope.ejemplo_de2 && $scope.estado_fin2 != $scope.orderPurchase.descuento){
                        $scope.orderPurchase.montoTotal=parseFloat(($scope.orderPurchase.montoBruto - parseFloat(($scope.orderPurchase.montoBruto*$scope.orderPurchase.descuento)/100)).toFixed(2));
                        $scope.ejemplo2=$scope.orderPurchase.montoTotal;
                        $scope.estado_fin2=$scope.orderPurchase.descuento;
                        }else{$scope.ejemplo_de2=true;}
                    }
                   
                    $scope.ejemplo=null;
                    $scope.ejemplo_de=null;
                    $scope.estado_fin=true;
                    $scope.calculateSuppPric=function()
                    {      $scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preProducto).toFixed(2));
                           $scope.detailOrderPurchase.montoBruto=parseFloat(($scope.detailOrderPurchase.cantidad * parseFloat($scope.detailOrderPurchase.preProducto)).toFixed(2));
                           $scope.detailOrderPurchase.pendiente=$scope.detailOrderPurchase.cantidad;
                       if($scope.ejemplo != $scope.detailOrderPurchase.montoTotal && $scope.ejemplo_de == $scope.detailOrderPurchase.descuento){
                          $scope.detailOrderPurchase.descuento=parseFloat(((($scope.detailOrderPurchase.montoBruto - $scope.detailOrderPurchase.montoTotal)/$scope.detailOrderPurchase.montoBruto)*100).toFixed(2));
                           $scope.ejemplo_de=$scope.detailOrderPurchase.descuento;
                          $scope.estado_fin=false;
                        }
                      
                      if( $scope.estado_fin){
                       if($scope.detailOrderPurchase.descuento>0 ){
                          $scope.detailOrderPurchase.montoTotal= parseFloat(($scope.detailOrderPurchase.cantidad * ($scope.detailOrderPurchase.preCompra - (($scope.detailOrderPurchase.preCompra * $scope.detailOrderPurchase.descuento ) / 100))).toFixed(2));
                          $scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preCompra - (($scope.detailOrderPurchase.preCompra * $scope.detailOrderPurchase.descuento ) / 100)).toFixed(2));
                          $scope.ejemplo=$scope.detailOrderPurchase.montoTotal;
                          $scope.ejemplo_de=$scope.detailOrderPurchase.descuento;
                       }else{
                         $scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preProducto).toFixed(2));
                         $scope.detailOrderPurchase.montoBruto=parseFloat(($scope.detailOrderPurchase.cantidad * parseFloat($scope.detailOrderPurchase.preCompra)).toFixed(2));
                         $scope.detailOrderPurchase.montoTotal= parseFloat(($scope.detailOrderPurchase.cantidad * parseFloat($scope.detailOrderPurchase.preCompra)).toFixed(2));
                         $scope.detailOrderPurchase.descuento=0;
                         $scope.ejemplo_de=$scope.detailOrderPurchase.descuento;
                        $scope.ejemplo=$scope.detailOrderPurchase.montoTotal;
                       }}else{
                        $scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preCompra - (($scope.detailOrderPurchase.preCompra * $scope.detailOrderPurchase.descuento ) / 100)).toFixed(2));
                        $scope.estado_fin=true;}
                  // }
                    }
                /*$scope.calEnBaseTotal=function(){
                    $scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preProducto).toFixed(2));
                    $scope.detailOrderPurchase.montoBruto=parseFloat(($scope.detailOrderPurchase.cantidad * parseFloat($scope.detailOrderPurchase.preProducto)).toFixed(2));
                $scope.detailOrderPurchase.descuento=parseFloat(((($scope.detailOrderPurchase.montoBruto - $scope.detailOrderPurchase.montoTotal)/$scope.detailOrderPurchase.montoBruto)*100).toFixed(2));
                         
                }*/
                $scope.searchPurchase = function(){
                if ($scope.query.length > 0) {
                    crudPurchase.search('orderPurchases',$scope.query,1).then(function (data){
                        $scope.orderPurchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
               
                    
                }
                $scope.addCant=function(row,index){
                   
                      $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto-parseFloat(row.montoTotal);
                      row.cantidad=parseInt(row.cantidad)+1;
                      row.pendiente=parseInt(row.pendiente)+1;
                      row.montoBruto=parseFloat((parseInt(row.cantidad)*parseFloat(row.preProducto)).toFixed(2));
                      row.montoTotal=parseFloat((parseInt(row.cantidad)*parseFloat(row.preCompra)).toFixed(2));
                      $scope.detailOrderPurchases.splice(index,1,row);
                      $scope.orderPurchase.montoBruto=parseFloat((($scope.orderPurchase.montoBruto)+parseFloat(row.montoTotal)).toFixed(2));;
                      $scope.orderPurchase.montoTotal=parseFloat((parseFloat($scope.orderPurchase.montoBruto)-((parseFloat($scope.orderPurchase.montoBruto)*parseFloat($scope.orderPurchase.descuento))/100)).toFixed(2));
                      
                }
                $scope.lessCant=function(row,index){
                     if(parseInt(row.cantidad)>1){
                    $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto-parseFloat(row.montoTotal);
                      row.cantidad=parseInt(row.cantidad)-1;
                      row.pendiente=parseInt(row.pendiente)-1;
                      row.montoBruto=parseFloat((parseInt(row.cantidad)*parseFloat(row.preProducto)).toFixed(2));
                      row.montoTotal=parseFloat((parseInt(row.cantidad)*parseFloat(row.preCompra)).toFixed(2));
                      $scope.detailOrderPurchases.splice(index,1,row); 
                      $scope.orderPurchase.montoBruto=parseFloat((($scope.orderPurchase.montoBruto)+parseFloat(row.montoTotal)).toFixed(2));
                      // $scope.orderPurchase.montoBruto= $scope.orderPurchase.montoBruto.toFixed(2);
                      $scope.orderPurchase.montoTotal=parseFloat((parseFloat($scope.orderPurchase.montoBruto)-((parseFloat($scope.orderPurchase.montoBruto)*parseFloat($scope.orderPurchase.descuento))/100)).toFixed(2));
                      }else{
                        alert("Usted debe tener como minimo una unidad de lo contrario elimine la este producto de la lista");
                      }
                }

                $scope.createPurchase = function(){
                if($scope.codigoTemporalP == 0){
                   if ($scope.orderPurchaseCreateForm.$valid) {
                        crudPurchase.create($scope.orderPurchase, 'orderPurchases').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                 $scope.codigoTemporalP=(data['codigo']);
                                 $scope.orderPurchase.id=(data['codigo']);
                                alert('Orden Creada correctamente');
                                //$scope.llenar();
                                $scope.Warehouses(data['warehouse_id']);
                        } else {
                                $scope.errors = data;

                            }
                        });

                         
                    }}else{
                        $scope.Warehouses($scope.orderPurchase.warehouses_id);
                    }
                }
                $scope.Warehouses=function(id){
                    alert($scope.orderPurchase.supplier_id);
            if($scope.orderPurchaseCreateForm.$valid){
                    crudPurchase.MostrarTotalDeudas($scope.orderPurchase.supplier_id).then(function (data) {
                        $scope.orderPurchase.saldoDisponible=data.total;
                    });
                    if(parseInt(id)> 0){
                    
                    crudPurchase.byId(id,'warehouses').then(function (data) {
                        $scope.warehouses=data;
                    });}
                    else{
                       crudPurchase.byId($scope.orderPurchase.warehouses_id,'warehouses').then(function (data) {
                        $scope.warehouses=data;
                    });  
                    }
                    if($scope.orderPurchase.fechaPrevista != null){
                    $scope.dd=$scope.orderPurchase.fechaPrevista.getDate();
                    $scope.mm=$scope.orderPurchase.fechaPrevista.getMonth();
                    $scope.yyyy=$scope.orderPurchase.fechaPrevista.getFullYear();
                };
                    $scope.dd1=$scope.orderPurchase.fechaPedido.getDate();
                    $scope.mm1=$scope.orderPurchase.fechaPedido.getMonth();
                    $scope.yyyy1=$scope.orderPurchase.fechaPedido.getFullYear();
                     if($scope.dd<10){$scope.dd="0"+$scope.dd;} else{$scope.dd=$scope.dd;}
                     if($scope.mm<10){$scope.mm="0"+(parseInt($scope.mm)+1);}else{$scope.mm=$scope.mm+1;}
                     $scope.orderPurchase.fechaPrevist=$scope.dd+"-"+$scope.mm+"-"+$scope.yyyy;
                     if($scope.dd1<10){$scope.dd1="0"+$scope.dd1;} else{$scope.dd1=$scope.dd1;}
                     if($scope.mm1<=9){$scope.mm1="0"+(parseInt($scope.mm1)+1);}else{$scope.mm1=$scope.mm1+1;}
                     $scope.orderPurchase.fechaPedid=$scope.dd1+"-"+$scope.mm1+"-"+$scope.yyyy1;
                     $scope.activEstados=false;
                    $scope.toggle();
                   
                }
              }
                
             
                 $scope.DcreatePurchase = function(){
                    $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases;
                    crudPurchase.create($scope.orderPurchase, 'detailOrderPurchases').then(function (data) {
                          $log.log($scope.orderPurchase.detailOrderPurchases);
                            if (data['estado'] == true) {
                                alert('grabado correctamente detalle');
                                $scope.updatePurchase();
                                $scope.detailOrderPurchases=[];
                            } else {
                                $scope.errors = data;

                            }
                        });
                    
                 }
                 $scope.activEstados=false;
                 $scope.activarCamposEdit=function(){
                     $scope.activEstados=true;
                 }
                
                 $scope.updateDPurchase = function(){
                   $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases;
                   if ($scope.orderPurchaseCreateForm.$valid) {
                        crudPurchase.update($scope.orderPurchase,'detailOrderPurchases').then(function (data) {
                            if (data['estado'] == true) {
                                alert('Editado correctamente a la fila');
                               // $scope.updatePurchase();
                            } else {
                                $scope.errors = data;

                            }
                        });

                         
                    }
                };

                $scope.updatePurchase = function(){
                    $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases;

                    //$log.log($scope.orderPurchase);
                      $scope.orderPurchase.fecha=new Date();
                   if ($scope.orderPurchaseCreateForm.$valid) {
                        crudPurchase.update($scope.orderPurchase,'orderPurchases').then(function (data) {
                         
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Editado correctamente');
                               // $scope.CrearCompra();
                            } else {
                                $scope.errors = data;

                            }
                        });

                         
                    }
                };


                $scope.cancelPurchase = function(){
                    $scope.orderPurchase = {};
                }
               $scope.estados=false;
               $scope.estados1=false;
                $scope.CambiarEstado=function(){
                      $scope.estados=true;
                     $scope.estados1=false;
                     $scope.MostrarEdcionStock=false;
                     //$scope.llenar();
                }
                $scope.MostrarCancelar=true;
                $scope.MostrarEdcionStock=true;
                $scope.CambiarEstado1=function(){
                    for(var n=0;n<$scope.detailOrderPurchases.length;n++){
                        if($scope.detailOrderPurchases[n].Cantidad_Ll>0){
                           $scope.MostrarCancelar=false;
                           //alert("oye ya cambie estado");
                           break;
                        }
                    }
                      $scope.orderPurchase.Estado=false;
                      $scope.MostrarEdcionStock=false;
                      $scope.estados=false;
                      $scope.estados1=true;
                }
                //-----------------------------------------------------------------------
                $scope.editPurchase= function(row){

                       $location.path('/orderPurchases/edit/'+row.id);

                 };
                 
                $scope.paymentsCalc=function(){
                    $scope.payment.Saldo=$scope.payment.montoTotal-$scope.payment.Acuenta;
                }
                 $scope.createPayments=function(){
                    
                        /*crudPurchase.create($scope.payment, 'payments').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Adelanto creado correctamente');

                            } else {
                                $scope.errors = data;

                            }
                        });
                   // }*/
                    $scope.detPayment.payment_id=$scope.idProvicional;
                    $scope.payment.detPayments=$scope.detPayment;
                    //alert($scope.payment.id);
                    //if ($scope.TtypeCreateForm.$valid) {
                        //if ($scope.paymentCreateForm.$valid){
                        crudPurchase.create($scope.payment, 'detPayments').then(function (data) {
                          
                            if (data['estado'] == true) {
                                
                                alert('grabado correctamente');
                               // $scope.detPayments={};
                               $scope.totAnterior=$scope.payment.Acuenta;
                               $scope.detPayment={};
                               $scope.detPayment.fecha=new Date();
                               $scope.payment.cash_id=0; 
                               //$scope.detPayment.montoPagado='';
                                $scope.paginateDetPay();
                                //$location.path('/types');

                            } else {
                                $scope.errors = data;

                            }
                        });//}
                }
                $scope.CrearCompraDirecta =function(){
                    $scope.orderPurchase.compraDirecta=1;
                    $scope.orderPurchase.fecha=new Date();
                    $scope.orderPurchase.fechaEntrega=$scope.orderPurchase.fechaPedido;
                    $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases
                    $scope.orderPurchase.Saldo=$scope.orderPurchase.montoTotal;
                    $scope.orderPurchases.push( $scope.orderPurchase);
                    
                     crudPurchase.create($scope.orderPurchase, 'purchases').then(function (data) {
                         
                            if (data['estado'] == true) {
                                alert('Compra directa correctamente registrada');
                                $location.path('/orderPurchases');
                            } else {
                                $scope.errors = data;

                            }
                        });
                 
            }

                $scope.CrearCompra =function(){
                    $scope.orderPurchase.fechaEntrega=new Date();
                    $scope.orderPurchase.fecha=new Date();
                    $scope.orderPurchase.estado=1;
                    $scope.orderPurchase.orderPurchase_id=$scope.codigoTemporalP;
                    $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases;

                    $scope.orderPurchase.Saldo=$scope.orderPurchase.montoTotal;
                    $scope.orderPurchases.push( $scope.orderPurchase);
                    if($scope.orderPurchase.cancelar){
                      $scope.orderPurchase.Estado=2;
                      $scope.orderPurchase.estado=2;
                   }
                    if($scope.orderPurchase.Estado==1 || $scope.orderPurchase.Estado==2){
                     crudPurchase.create($scope.orderPurchase, 'purchases').then(function (data) {
                         
                            if (data['estado'] == true) {
                                alert('Compra registrada');
                                $location.path('/orderPurchases');
                            } else {
                                $scope.errors = data;

                            }
                        });
                 }else{
                    $location.path('/orderPurchases');
                 }
            }
            $scope.estado;
            $scope.searchEstados=function(){
                    if($scope.estado < 3 ){
                    crudPurchase.all('orderPurchases',$scope.estado).then(function (data) {
                        $scope.orderPurchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }else{
                    crudPurchase.paginate('orderPurchases',1).then(function (data) {
                        $scope.orderPurchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }
                }
            $scope.detailOrderPurchase.unidades;
            $scope.ActualizarPartStock=function(row,index){
                if(row.cantidad_llegado<=row.cantidad){
                    alert("oye que paso");
                      row.fecha=new Date();
                      row.Cantidad_Ll=Number(row.Cantidad_Ll)+row.cantidad_llegado;
                      row.pendiente=Number(row.cantidad)-row.Cantidad_Ll;
                      $scope.detailOrderPurchases.splice(index,1,row);
                }else{
                    row.cantidad_llegado=0;
                    alert("ERROR: La cantidad igresada no debe superar la cantidad real");
                }
            }
           
            $scope.ActualizarStock=function(){
                $scope.orderPurchase.fecha=new Date();
                $scope.orderPurchase.tipo="Entrada";
                $scope.orderPurchase.eliminar=0;
                $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases;
                crudPurchase.create($scope.orderPurchase, 'inputStocks').then(function (data) {
                         
                            if (data['estado'] == true) {
                                alert('Stock registrado');
                                $location.path('/orderPurchases');
                            } else {
                                $scope.errors = data;

                            }
                        });
            }
            $scope.Restante;
            $scope.ComprovarCantidad=function(row,index){
                
                if(row.cantidad1>0  && row.cantidad1<=row.pendiente){ 
                    $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto-row.montoTotal;
                          row.Cantidad_Ll=Number(row.Cantidad_Ll)+row.cantidad1;
                          row.pendiente=Number(row.pendiente)-row.cantidad1;
                          row.montoBruto=(row.Cantidad_Ll* parseFloat(row.preCompra));
                // if(row.descuento>0){
                          row.montoTotal= row.montoBruto - ((row.montoBruto * row.descuento ) / 100);
                       
                ///}else{
                  //        row.montoTotal= row.montoBruto;
                      
               // }
                $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto+row.montoTotal;
                $scope.orderPurchase.montoTotal=parseFloat($scope.orderPurchase.montoBruto)-((parseFloat($scope.orderPurchase.montoBruto)*parseFloat($scope.orderPurchase.descuento))/100);
                $scope.orderPurchases.push($scope.orderPurchase);
                $scope.detailOrderPurchases.splice(index,1,row);
                          
                }else{
                     alert("usted no puede ingresar una cantidad menor a 0 y mayor a"+$scope.Restante);
                     if(row.cantidad1==0 && row.pendiente>0){
                            $scope.orderPurchase.montoBruto=parseFloat($scope.orderPurchase.montoBruto)-row.montoTotal;
                           $scope.orderPurchase.montoTotal=parseFloat($scope.orderPurchase.montoBruto)-(
                           (parseFloat($scope.orderPurchase.montoBruto)*parseFloat($scope.orderPurchase.descuento))/100);
                     
                         row.Cantidad_Ll=Number(row.Cantidad_Ll);
                          row.pendiente=Number(row.pendiente);
                          row.montoBruto=(row.Cantidad_Ll* parseFloat(row.preCompra)); 
                          row.montoTotal= row.montoBruto - ((row.montoBruto * parseFloat(row.descuento)) / 100);
                          if(parseFloat(row.montoTotal)>0){
                             $scope.orderPurchase.montoBruto=parseFloat($scope.orderPurchase.montoBruto)+row.montoTotal;
                             $scope.orderPurchase.montoTotal=parseFloat($scope.orderPurchase.montoBruto)-(
                           (parseFloat($scope.orderPurchase.montoBruto)*parseFloat($scope.orderPurchase.descuento))/100);
                     
                          }
                     }
            }
                
                alert("modifique la fila correctamente");
            }
            
               $scope.searchPurchase = function(){
                if ($scope.query.length > 0) {
                    crudPurchase.search('orderPurchases',$scope.query,1).then(function (data){
                        $scope.orderPurchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudPurchase.paginate('orderPurchases',1).then(function (data) {
                        $scope.orderPurchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };
                 $scope.popover=function(row){
                        crudPurchase.bytraervar(row.detPres_id,'variants').then(function (data) {
                        $scope.variants = data;
                        crudPurchase.bytraervar(data.base,'presentations').then(function (data) {
                        $scope.presentation = data;
                        
                         });
                    });
                 }
                 ///caja no es mia XD -------------------------------------------------------------------
                $scope.cajas={};
                $scope.cashes={};

                $scope.TraerSales=function(id){
                    alert("hola"+id);
                     crudPurchase.byId(id,'cashes').then(function (data) {
                       $scope.cashes=data;
                        alert($scope.cashes.montoBruto);
                    
                
                    ///$scope.payment={};
                    //$scope.detPayment.detCash_id=$scope.cashes.id;
                    $scope.payment.cash_id=$scope.cashes.id; 
                    $scope.payment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                    $scope.payment.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                    $scope.payment.montoCaja=$scope.cashes.montoBruto;
                    $scope.payment.montoMovimientoTarjeta=0;
                    $scope.payment.cashMotive_id=7;
                    $scope.payment.estado=1;
                    //$scope.sale.fechaPedido=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                    //$scope.sale.detOrders=$scope.compras;
                    //$scope.sale.movimiento=$scope.payment; 
                    //$scope.sale.caja=$scope.cashfinal;
                    });
                }

    ///---------------------------------------------------------------------------------
$scope.recalPayments=function(){
                    //alert($scope.payment.MontoTotal);
                if($scope.payment.cash_id>0){
                    alert('hola');
                    $scope.payment.montoMovimientoEfectivo=Number($scope.detPayment.montoPagado);
                    $scope.payment.montoFinal=Number($scope.payment.montoCaja)-$scope.payment.montoMovimientoEfectivo;
                    //$scope.cashes.gastos=Number($scope.cashes.gastos)+Number($scope.payment.montoMovimientoEfectivo); 
                    //$scope.cashes.montoBruto=$scope.payment.montoFinal;
                }     //---------------------------------------------------
                if(Number(Number($scope.payment.Saldo)>=Number($scope.detPayment.montoPagado) && Number($scope.payment.MontoTotal)>=Number($scope.detPayment.montoPagado) && Number($scope.detPayment.montoPagado)>0)){
                    if($scope.payment.detpId>0){
                          $scope.payment.Acuenta=Number($scope.totAnterior)-Number($scope.PagoAnterior);
                          alert($scope.payment.Acuenta);
                          $scope.payment.Acuenta=Number($scope.payment.Acuenta)+Number($scope.detPayment.montoPagado);
                          $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                          $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                          $scope.random();
                    }else{
                        alert($scope.totAnterior);
                          $scope.payment.Acuenta=Number($scope.totAnterior)+Number($scope.detPayment.montoPagado);
                          $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                          $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                          $scope.random();
                   }
                   }else{
                    alert('!!Error Usted Solo Puede Ingresar una cantidad menor o igual al total!!');
                }
                }/*
                 $scope.payment.Acuenta=0;
                 $scope.recalPayments=function(){
                    //alert($scope.payment.MontoTotal);
                if(Number($scope.payment.MontoTotal)>=Number($scope.detPayment.montoPagado)){
                    if($scope.payment.detpId>0){
                           $scope.payment.Acuenta=Number($scope.totAnterior)-Number($scope.PagoAnterior);
                           alert($scope.payment.Acuenta);
                           $scope.payment.Acuenta=Number($scope.payment.Acuenta)+Number($scope.detPayment.montoPagado);
                           $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                           $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                           $scope.totAnterior=$scope.payment.Acuenta;
                           $scope.random();
                    }else{
                          $scope.payment.Acuenta=Number($scope.totAnterior)+Number($scope.detPayment.montoPagado);
                          $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                          $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                          $scope.totAnterior=$scope.payment.Acuenta;
                          $scope.random();
                 }
                }else{
                    alert('!!Error Usted Solo Puede Ingresar una cantidad menor o igual al total!!');
                }
                }*/
                $scope.payment={};
                 $scope.payment.idpayment;
                 $scope.totAnterior;
                $scope.payments=function(row){
                    alert(row.id);
                    $scope.detPayment.fecha=new Date();
                    crudPurchase.byId(row.id,'payments').then(function (data){
                            $scope.payment = data;
                            $scope.payment.empresa=row.empresa;
                            $scope.totAnterior=$scope.payment.Acuenta
                            $scope.payment.idpayment=$scope.payment.id;
                            $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                    
                           // alert($data.Acuenta);
                     if(data.id>0){   
                     alert("el codigo de pago es"+$scope.payment.id);   
                    crudPurchase.byId($scope.payment.id,'detPayments').then(function (data) {
                        $scope.detPayments = data.data;

                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 5;

                    }); }else{
                        $scope.detPayments=[];
                    $scope.payment=row;
                    $scope.payment.MontoTotal=row.montoTotal;
                    $scope.payment.orderPurchase_id=row.id;
                    $scope.payment.supplier_id=row.supID;
                    $scope.payment.Saldo=row.montoTotal;
                    $scope.payment.PorPagado=0;
                    $scope.totAnterior=0;
                     }  });
                      crudPurchase.listaCashes('cashHeaders').then(function (data) {
                        $scope.cashHeaders = data;
                        
                    });
                      
                    $scope.totAnterior=$scope.payment.Acuenta
                    $scope.random();
                   //  alert($scope.totAnterior);
                    //alert(row.empresa);
                    
                }
                /*$scope.asignarCodPayme=function(row)
                {
                       $scope.payment.orderPurchase_id=row.id;
                       $scope.payment.supplier_id=row.supID;
                }*/
                 $scope.createPayment = function(){
                    alert( $scope.payment.fecha);
                    $scope.payment.detPayments=$scope.detPayment;
                    if ($scope.paymentCreateForm.$valid){
                        crudPurchase.create($scope.payment, 'payments').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente payments');
                                $scope.detPayment.methodPayment_id='';
                               $scope.detPayment.montoPagado='';
                                $scope.paginateDetPay();

                            } else {
                                $scope.errors = data;

                            }
                        });}
                }
                $scope.paginateDetPay=function(){
                    $scope.detPayment.fecha=new Date();
                      crudPurchase.byId($scope.payment.id,'detPayments').then(function (data) {
                        $scope.detPayments = data.data;
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 5;

                    });
                      $scope.mostrarBtnGEd=false;
                }
                $scope.destroyPay = function(row){
                    $scope.payment.detpId=row.id;
                    //$scope.detPayment.montoPagado=row.montoPagado;
                   // alert(row.montoPagado);
                   alert(row.id);
                   $scope.payment.detpId=row.id;
                    $scope.payment.cashMonthly_id=row.cashMonthly_id;
                   // $scope.Payment.cash_id=parseInt(row.cashID);
                    $scope.payment.detCash_id=row.detCash_id;
                    crudPurchase.destroy($scope.payment,'payments').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            
                            alert('Eliminado Correctamente');
                           // alert($scope.totAnterior);
                            $scope.payment.Acuenta=Number($scope.totAnterior)-Number($scope.detPayment.montoPagado);
                            $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                            $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                            $scope.totAnterior=$scope.payment.Acuenta;
                            $scope.detPayment = {};
                            //$route.reload();
                            $scope.paginateDetPay();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
                $scope.PagoAnterior;
                $scope.mostrarBtnGEd=false;
              /*  $scope.editDetpayment=function(row){

                    $scope.payment.detpId=row.id;
                    $scope.PagoAnterior=row.montoPagado;
                    $scope.detPayment.fecha=new Date(row.fecha);
                    $scope.detPayment.methodPayment_id=row.methodPayment_id;
                    $scope.detPayment.montoPagado=(parseFloat(row.montoPagado));
                     $scope.mostrarBtnGEd=true;
                }
                  $scope.PagoAnterior;
                $scope.mostrarBtnGEd=false;*/
                $scope.cashmontly=function(){
                    alert($scope.payment.cajamensual);
                     $scope.payment.months_id=$scope.date.getMonth()+1;
                     $scope.payment.año=$scope.date.getFullYear();
                     }
                 $scope.check=false;
                $scope.editDetpayment=function(row){
                   $scope.check=true;
                    if(row.cashMonthly_id>0){
                        $scope.payment.cajamensual=true;
                        $scope.payment.cashMonthly_id=row.cashMonthly_id;
                    }else{
                        $scope.payment.cajamensual=false;
                    }
                    $scope.payment.detpId=row.id;
                    $scope.detPayment.cashe_id=row.cashID;
                    $scope.payment.cash_id=$scope.detPayment.cashe_id;
                    $scope.payment.detCash_id=row.detCash_id;
                    $scope.detPayment.oldPay=row.montoPagado;
                    $scope.PagoAnterior=row.montoPagado;
                    $scope.detPayment.fecha=new Date(row.fecha);
                    $scope.detPayment.methodPayment_id=row.methodPayment_id;
                    $scope.detPayment.montoPagado=(parseFloat(row.montoPagado));
                    $scope.mostrarBtnGEd=true;
                }
                
                $scope.editPayment = function(){
                    $scope.payment.detPayments=$scope.detPayment;
                    
                    crudPurchase.update($scope.payment,'payments').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.payment.detpId=0;
                            $scope.detPayment = {};
                            alert('Editado Correctamente');
                            //$route.reload();
                            $scope.paginateDetPay();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            $scope.random = function() {
                var type;

                if ($scope.payment.PorPagado < 25) {
                  type = 'info';
                } else if ($scope.payment.PorPagado < 50) {
                  type = 'success';
                } else if ($scope.payment.PorPagado < 75) {
                  type = 'warning';
                } else {
                  type = 'danger';
                }

                $scope.type = type;
              };
 
            }]);
})();
