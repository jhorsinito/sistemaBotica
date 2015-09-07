 <section class="content-header"> 
          <h1>
            Pedido Venta
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/stores">Pedido Venta</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Pedido Venta</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="storeCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                    <ul>
                      <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                  </div>






            <div class="nav-tabs-custom" id="myTabs">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Venta</a></li>
                  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false" ng-click="actualizarCaja()">Caja Venta</a></li>
                  <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Opciones</a></li>
                  
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">


                    <div class="row">
                      <div class="col-md-6" >
                      <div class="box box-solid">
                        <div class="box-header with-border" style="background-color: #D7EAE3; border-style: solid;
                              border-width: 2px; border-color: #C8D9F7; border-radius: 10px 10px 0px 0px;">
                          <div class="row">
                            <div class="col-md-7" ng-show="skuestado">
                              <input type="text" ng-model="varianteSkuSelected" placeholder="Buscar por SKU" ng-change="getvariantSKU()" class="form-control">
                            </div>

                            <div class="col-md-7" ng-show="!skuestado">
                              <input  type="text" ng-model="atributoSelected" placeholder="Buscar por codigo" typeahead="atributo as atributo.NombreAtributos for atributo in getAtributos($viewValue)" 
                                    typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                            </div>
                            <div class="col-md-2" >
                              <a ng-click="open()" class="btn btn-default ng-binding">ADD</a>
                            </div>
                            <div class="col-md-3" >
                            <div class="form-group">
                                <input type="checkbox" name="estado" ng-model="base" ng-checked="base" class="ng-valid ng-dirty ng-valid-parse ng-touched" ng-click="baseestado()">
                                <label for="estado">Base</label>                             
                              
                                <input type="checkbox" name="skuestado" ng-model="skuestado" ng-checked="skuestado" class="ng-valid ng-dirty ng-valid-parse ng-touched">
                                <label for="estado">SKU</label>                             
                              </div>
                            </div>

                            
                            
                            
     
                           </div> 
 
                        </div><!-- /.box-header -->
                        <div class="box-body" style="min-height: 400px; border-style: solid;
                                border-width: 2px; border-color: #C8D9F7;" >
                          <table class="table table-bordered">
                                             
                            <tr ng-repeat="row in compras track by $index">
                              <td>
                                  <button data-toggle="popover" popover-template="dynamicPopover.templateUrl" type="button" class="btn btn-default">@{{compras[$index].cantidad}}</button>
                              </td>
                              <td><a popover-template="dynamicPopover5.templateUrl" popover-trigger="mouseenter">@{{compras[$index].NombreAtributos}}</a></td>
                              <td>
                                  <button data-toggle="popover" popover-template="dynamicPopover1.templateUrl" type="button" class="btn btn-default">@{{compras[$index].precioVenta| number:2}}</button>
                              </td>
                              <td>@{{compras[$index].subTotal | number:2}}</td>
                              <td><button type="button" class="btn btn-danger ng-binding"  ng-click="sacarRow($index,row.subTotal)">
                              <span class="glyphicon glyphicon-trash"></span>
                              </td>                    
                            </tr>                                    
                          </table>
    
                        </div><!-- /.box-body -->


                        <div class="box-footer clearfix" style="background-color: #D7EAE3; border-style: solid;
                               border-width: 2px; border-color: #C8D9F7; border-radius: 0px 0px 10px 10px;">
                          <div class="row">
                            <div class="col-md-6" >
                              <table class="table table-bordered">
                                <tr>
                                  <div class="row">
                                    <div class="col-md-10" >
                                      <input type="text" ng-model="customersSelected" placeholder="Buscar Cliente" typeahead="atributo as atributo.busqueda for atributo in getcustomers($viewValue)" 
                                            typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                                    </div>
                                    <div>
                                      <a class="btn btn-default ng-binding" data-toggle="modal" data-target="#miventana2"><span class="glyphicon glyphicon-plus"></span></a>
                                    </div>
                                </tr>
                                <tr>
                                  <div>
                                    <a ng-if="sale.cliente!=undefined"type="button" class="glyphicon glyphicon-remove-sign " ng-click="deleteCliente()"></a>
                                    @{{sale.cliente!=undefined? sale.cliente:'--No hay cliente seleccionado--'}}
                                  </div>
                                </tr>
                                <tr>
                                  <div>
                                    <input type="text" ng-model="employeeSelected" placeholder="Buscar Vendedor" typeahead="atributo as atributo.busqueda for atributo in getemployee($viewValue)" 
                                            typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                                  </div>
                                </tr>
                               <tr>
                                  <div>
                                    <a ng-if="sale.vendedor!=undefined"type="button" class="glyphicon glyphicon-remove-sign " ng-click="deleteVendedor()"></a>
                                    @{{sale.vendedor!=undefined? sale.vendedor:'--No hay vendedor seleccionado--'}}
                                  </div>
                                </tr>
                                <tr>
                                  <div class="row">
                                    <div class="col-md-7" >
                                      <button ng-click="estadoNotas()" ng-if="banderaNotas" data-toggle="popover" popover-template="dynamicPopover6.templateUrl" type="button" class="btn btn-default">ADD NOTAS</a>
                                      <button ng-click="estadoNotas()" ng-if="!banderaNotas" data-toggle="popover" popover-template="dynamicPopover6.templateUrl" type="button" class="btn btn-danger">ADD NOTAS</a>
                                      
                                    
                                    </div>
                                    <div class="col-md-5" >
                                      <a ng-if="sale.montoTotal>0" class="btn btn-default ng-binding" data-toggle="modal" data-target="#miventana1" ng-click="pagar()">PAGAR</a>
                                      <a ng-if="sale.montoTotal==0"class="btn btn-default ng-binding" ng-click="pagar()">PAGAR</a>
                                    </div>
                                  </div>
                                </tr>
                                  
                              </table>

                            </div>

                            <div class="col-md-6" >
                                <table class="table table-bordered">
                                <tr>
                                <td>Sub Total</td>
                                <td>@{{sale.montoBruto | number:2}}</td>                    
                                </tr>
                                <tr> 
                                <td>IGV</td>
                                <td>@{{sale.igv | number:2}}</td>                    
                                </tr> 
                                <tr style="border-bottom: solid; border-width: medium;">
                                <td>Descuento</td>
                                <td>
                                  <button popover-template="dynamicPopover2.templateUrl" type="button" class="btn btn-default">@{{sale.descuento | number:2}}</button>
                                </td>                    
                                </tr> 
                                <tr>
                                <td ><b>Total</b></td>
                                <td ng-model="sale.montoTotal" ><b>@{{sale.montoTotal | number:2}}</b></td>                    
                                </tr>                                   
                              </table>
                            </div>
                        </div>
                      </div> 

                    </div>





                    </div>

                    <div class="col-md-6" style="min-height: 670px; border-style: solid;
                                border-width: 2px; border-color: #C8D9F7; border-radius:10px" >
                       <!-- Parte de Favorito-->
                      
                    </div>
                  </div>

                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="tab_2">
                    <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Tipo</th>
                      <th>Monto Caja</th>
                      <th>S/.Tarjeta</th>
                      <th>S/.Efectivo</th>
                      <th>Monto Final</th>
                      <th>Ver Venta</th>
                    </tr>
                    
                    <tr ng-repeat="row in detCashes">
                      <td>@{{$index + 1}}</td>
                      <td>@{{row.fecha}}</td>
                      <td>@{{row.hora}}</td>
                      <td>@{{row.cash_motive.nombre}}</td>
                      <td>@{{row.montoCaja}}</td>
                      <td>@{{row.montoMovimientoTarjeta}}</td>
                      <td>@{{row.montoMovimientoEfectivo}}</td>
                      <td>@{{row.montoFinal}}</td>
                      <td ng-if="row.cashMotive_id==1 || row.cashMotive_id==14"><a href="/sales/edit/@{{row.observacion}}" target="_blank">ver venta</a></td>
                      <td ng-if="row.cashMotive_id!=1 && row.cashMotive_id!=14">@{{row.observacion}}</td>
                    </tr>                   
                  </table>
                  <div class="box-footer clearfix">
                    <pagination total-items="totalItems1" ng-model="currentPage1" max-size="maxSize1" 
                    class="pagination-sm no-margin pull-right" items-per-page="itemsperPage1" boundary-links="true" rotate="false" 
                    num-pages="numPages1" ng-change="pageChanged1()"></pagination>
                  </div>                    

                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="tab_3">
                  <div class="row">
                    <div class="col-md-4">
                     <div class="form-group" >
                        <label for="year">Tienda</label>
                        <select ng-click="mostrarAlmacenCaja()" class="form-control" name="" ng-model="store.id" ng-options="item.id as item.nombreTienda for item in stores">
                          <option value="">--Elije Tienda--</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group" >
                        <label for="year">Almacen</label>
                        <select class="form-control" name="" ng-model="warehouse.id" ng-options="item.id as item.nombre for item in warehouses" ng-click="cargarAtributos()">
                          <option value="">--Elije Almacen--</option>
                        </select>
                      </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group" >
                          <label for="month">Caja</label>

                          <select class="form-control" name="" ng-model="cash1.cashHeader_id" ng-options="item.id as item.nombre for item in cashHeaders">
                          <option value="">--Elije Caja--</option>
                          </select>
                        </div>
                      </div>

                    </div>


                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div>
               <script type="text/javascript">$('#myTabs a').click(function (e) {
                          e.preventDefault()
                          $(this).tab('show')})
              </script>



                  



                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
            
              </section><!-- /.content -->


      <script type="text/ng-template" id="myPopoverTemplate6.html">
        <div class="form-group">
          <label>@{{dynamicPopover6.title}}</label>
          <div class="row" >
          <div class="col-md-12">
            <textarea  ng-model="sale.notas" type="text"  class="form-control"/>
           </div> 
          </div>
        </div>
    </script>




    <script type="text/ng-template" id="myPopoverTemplate.html">
        <div class="form-group">
          <label>@{{dynamicPopover.title}}</label>
          <div class="row" >
          <div class="col-md-9">
            <input type="number" ng-model="compras[$index].cantidad" ng-change="calcularmontos($index)" class="form-control">
            </div>
            <button type="button" class="btn btn-xs" ng-click="aumentarCantidad($index)">
            <span type="button" class="glyphicon glyphicon-plus"></span></button>
            <button type="button" class="btn btn-xs" ng-click="disminuirCantidad($index)">
            <span type="button" class="glyphicon glyphicon-minus"></span></button>

          </div>
        </div>
    </script>
    <hr />
    <script type="text/ng-template" id="myPopoverTemplate1.html">
        
      <tabset justified="true">

      <tab heading="Descuento">
        <label>@{{dynamicPopover1.title1}}</label>
            <div class="row" >
            <div class="col-md-9">
            <input type="number" ng-model="compras[$index].descuento" ng-change="keyUpDescuento($index)"class="form-control">
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarDescuento($index)">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirDescuento($index)">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div>

      </tab>
      <tab heading="Precio Unidad"><div class="form-group">
            <label>@{{dynamicPopover1.title}}</label>
            <div class="row" >
            <div class="col-md-9">
            <input type="number" ng-change="calcularmontos($index)" ng-model="compras[$index].precioVenta" class="form-control">
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarPrecio($index)">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirPrecio($index)">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div> 

        </tab>
      </tabset>
              
    </script>
    <hr />
    <script type="text/ng-template" id="myPopoverTemplate2.html">
        
      <tabset justified="true">

      <tab heading="Descuento">
        <label>@{{dynamicPopover2.title1}}</label>
            <div class="row" >
            <div class="col-md-8">
            <input type="number" ng-model="sale.descuento" ng-change="keyUpDescuentoPedido()" class="form-control"></input>
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarDescuentoPedido()">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirDescuentoPedido()">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div>

      </tab>
      <tab heading="Total"><div class="form-group">
            <label>@{{dynamicPopover2.title}}</label>
            <div class="row" >
            <div class="col-md-8">
            <input type="number" ng-model="sale.montoTotal" ng-change="keyUpTotalPedido()" class="form-control">
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarTotalPedido()">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirTotalPedido()">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div> 

        </tab>
      </tabset>
              
    </script>


    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">Presentaciones</h3>
        </div>
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Presentacion</th>
                      <th>Equivalencia</th>
                      <th>Producto Base</th>

                      <th style="width: 40px">Enviar</th>
                    </tr>
                    
                    <tr ng-repeat="row in presentations">
                      <td>@{{$index + 1}}</td>
                      <td ng-hide="true">@{{row.iddetalleP}}</td>
                      <td >@{{row.NombreAtributos}}</td>
                      <td>@{{row.precioProducto}}</td> 
                      <td>@{{row.Presentacion}}</td>  
                      <td>@{{row.equivalencia}} @{{row.nomBase}}</td>
                      <td ng-if="row.base==0"><span class="badge bg-red">NO</span></td> 
                      <td ng-if="row.base!=0"><span class="badge bg-green">SI</span></td> 
                      <td><a ng-click="AsignarCompra(row)" class="btn btn-warning btn-xs" data-dismiss="modal">Enviar</a></td>

                    </tr>                                       
                  </table>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>