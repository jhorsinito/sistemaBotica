 <section class="content-header">
          <h1>
            Compra
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/stores">Compra</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Compra</h3>
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
                  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Tab 1</a></li>
                  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Tab 2</a></li>
                  <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Tab 3</a></li>
                  
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">


                    <div class="row">
                      <div class="col-md-6" >
                      <div class="box box-solid">
                        <div class="box-header with-border" style="background-color: #D7EAE3; border-style: solid;
                              border-width: 2px; border-color: #C8D9F7; border-radius: 10px 10px 0px 0px;">
                          <div class="row">
                            <div class="col-md-8" >
                              <input type="text" ng-model="atributoSelected" placeholder="Buscar Producto" typeahead="atributo as atributo.NombreAtributos for atributo in getAtributos($viewValue)" 
                                    typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                            </div>
                            <div class="col-md-2" >
                              <a ng-click="open()" class="btn btn-default ng-binding">ADD</a>
                            </div>
                            <div class="col-md-2" >
                              <div class="form-group">
                                <input type="checkbox" name="estado" ng-model="base" ng-checked="base" class="ng-valid ng-dirty ng-valid-parse ng-touched" ng-click="baseestado()">
                                <label for="estado">Base</label>
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
                              <td><a popover-template="dynamicPopover5.templateUrl" popover-trigger="mouseenter">@{{row.NombreAtributos}}</a></td>
                              <td>
                                  <button data-toggle="popover" popover-template="dynamicPopover1.templateUrl" type="button" class="btn btn-default">@{{compras[$index].precioVenta}}</button>
                              </td>
                              <td>@{{compras[$index].subTotal}}</td>
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
                                      <a class="btn btn-default ng-binding" data-toggle="modal" data-target="#miventana2">+</a>
                                    </div>
                                </tr>
                                <br>
                                <tr>
                                  <div>
                                    <input type="text" ng-model="employeeSelected" placeholder="Buscar Vendedor" typeahead="atributo as atributo.busqueda for atributo in getemployee($viewValue)" 
                                            typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                                  </div>
                                </tr>
                               <br>
                                <tr>
                                  <div class="row">
                                    <div class="col-md-7" >
                                      <a class="btn btn-default ng-binding" ng-click="createorder()">ADD NOTAS</a>
                                    </div>
                                    <div class="col-md-5" >
                                      <a class="btn btn-default ng-binding" data-toggle="modal" data-target="#miventana1" ng-click="pagar()">PAGAR</a>
                                    </div>
                                  </div>
                                </tr>
                                  
                              </table>

                            </div>

                            <div class="col-md-6" >
                                <table class="table table-bordered">
                                <tr>
                                <td>Sub Total</td>
                                <td>@{{order.montoBruto}}</td>                    
                                </tr>
                                <tr> 
                                <td>IGV</td>
                                <td>@{{order.igv}}</td>                    
                                </tr> 
                                <tr>
                                <td>Descuento</td>
                                <td>
                                  <button popover-template="dynamicPopover2.templateUrl" type="button" class="btn btn-default">@{{order.descuento}}</button>
                                </td>                    
                                </tr> 
                                <tr>
                                <td >Total</td>
                                <td ng-model="order.montoTotal" >@{{order.montoTotal}}</td>                    
                                </tr>                                   
                              </table>
                            </div>
                        </div>
                      </div> 

                    </div>





                    </div>

                    <div class="col-md-6" style="min-height: 670px; border-style: solid;
                                border-width: 2px; border-color: #C8D9F7; border-radius:10px" >
                        <div >

                           <button type="button" class="btn btn-default" ng-repeat="row in compras" style="width: 115px;height: 60px;">@{{row.cantidad}}</button>   
                    
                        </div>
                      
                    </div>
                  </div>

                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="tab_2">
                    <div class="row">
                    <div class="col-md-6">
                     <div class="form-group" >
                        <label for="year">Tienda</label>
                        <select class="form-control" name="" ng-model="store.id" ng-options="item.id as item.nombreTienda for item in stores">
                          <option value="">--Elije Tienda--</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group" >
                        <label for="year">Tienda</label>
                        <select class="form-control" name="" ng-model="warehouse.id" ng-options="item.id as item.nombre for item in warehouses" ng-click="cargarAtributos()">
                          <option value="">--Elije Almacen--</option>
                        </select>
                      </div>
                    </div>

                    </div>

                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="tab_3">
                  <p>Hola 3 </p>


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



<script type="text/ng-template" id="myPopoverTemplate5.html">
      <div class="form-group">
          <label>@{{dynamicPopover5.title}}</label>
        </div>
        <table class="table table-bordered">
          <tr>
          <th>Stock</th>
          <th>@{{compras[$index].Stock}}</th>
          </tr>
          <tr></tr>
          <th>precio</th>
          <th>@{{compras[$index].precioProducto}}</th>
          <tr></tr>
        </table>
          
                 
    </script>









    <script type="text/ng-template" id="myPopoverTemplate.html">
        <div class="form-group">
          <label>@{{dynamicPopover.title}}</label>
          <div class="row" >
          <div class="col-md-9">
            <input type="number" ng-model="compras[$index].cantidad" class="form-control">
            </div>
            <button type="button" class="btn btn-xs">
            <span type="button" class="glyphicon glyphicon-plus" ng-click="aumentarCantidad($index)"></span></button>
            <button type="button" class="btn btn-xs">
            <span type="button" class="glyphicon glyphicon-minus" ng-click="disminuirCantidad($index)"></span></button>

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
            <input type="number" ng-model="compras[$index].descuento" class="form-control">
          </div>
         <button type="button" class="btn btn-xs">
          <span type="button" class="glyphicon glyphicon-plus" ng-click="aumentarDescuento($index)"></span></button>
         <button type="button" class="btn btn-xs">
         <span type="button" class="glyphicon glyphicon-minus" ng-click="disminuirDescuento($index)"></span></button>

        </div>
        </div>

      </tab>
      <tab heading="Precio Unidad"><div class="form-group">
            <label>@{{dynamicPopover1.title}}</label>
            <div class="row" >
            <div class="col-md-9">
            <input type="number" ng-model="compras[$index].precioVenta" class="form-control">
          </div>
         <button type="button" class="btn btn-xs">
          <span type="button" class="glyphicon glyphicon-plus" ng-click="aumentarPrecio($index)"></span></button>
         <button type="button" class="btn btn-xs">
         <span type="button" class="glyphicon glyphicon-minus" ng-click="disminuirPrecio($index)"></span></button>

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
            <input type="number" ng-model="order.descuento" class="form-control">
          </div>
         <button type="button" class="btn btn-xs">
          <span type="button" class="glyphicon glyphicon-plus" ng-click="aumentarDescuentoPedido()"></span></button>
         <button type="button" class="btn btn-xs">
         <span type="button" class="glyphicon glyphicon-minus" ng-click="disminuirDescuentoPedido()"></span></button>

        </div>
        </div>

      </tab>
      <tab heading="Total"><div class="form-group">
            <label>@{{dynamicPopover2.title}}</label>
            <div class="row" >
            <div class="col-md-8">
            <input type="number" ng-model="order.montoTotal" class="form-control">
          </div>
         <button type="button" class="btn btn-xs">
          <span type="button" class="glyphicon glyphicon-plus" ng-click="aumentarTotalPedido()"></span></button>
         <button type="button" class="btn btn-xs">
         <span type="button" class="glyphicon glyphicon-minus" ng-click="disminuirTotalPedido()"></span></button>

        </div>
        </div> 

        </tab>
      </tabset>
              
    </script>

    <!-- =========================================Ventana Agregar Año=================================-->
         <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventana2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
                  <div style="border-radius: 5px" class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                          <h4 class="modal-title">Opciones Año</h4>
                        </div>
                        <form name="customerCreateForm" role="form" novalidate> 
                        <!--=================cueropo========================-->
                        <div class="modal-body">
                   <div class="row" >
                    <div class="col-md-6">
                      <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.nombres.$error.required && customerCreateForm.$submitted || customerCreateForm.nombres.$dirty && customerCreateForm.nombres.$invalid]">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres" placeholder="Nombres" ng-model="customer.nombres" required>
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.nombres.$dirty && customerCreateForm.nombres.$invalid">
                        <span ng-show="customerCreateForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.apellidos.$error.required && customerCreateForm.$submitted || customerCreateForm.apellidos.$dirty && customerCreateForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos"
                      ng-model="customer.apellidos" required>
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.apellidos.$dirty && customerCreateForm.apellidos.$invalid">

                        <span ng-show="customerCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                    </div>
                    </div>
                    </div>

                    <div class="row" >
                    <div class="col-md-6">
                    <div class="form-group" >
                      <label for="apellidos">Empresa / Razón Social</label>
                      <input type="text" class="form-control" name="empresa" placeholder="empresa"
                      ng-model="customer.empresa">
                     </div>
                     </div>
                     <div class="col-md-6">
                    <div class="form-group" >
                      <label for="direccFiscal">Dirección Fiscal</label>
                      <input type="text" class="form-control" name="direccFiscal" placeholder="dirección fiscal"
                      ng-model="customer.direccFiscal">
                     </div>
                     </div>
                     </div>

                    <div class="row" >
                    <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="ruc">RUC</label>
                      <input type="text" class="form-control" name="ruc" placeholder="ruc"
                      ng-model="customer.ruc">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="codigo">Código de Cliente</label>
                      <input type="text" class="form-control" name="codigo" placeholder="codigo de cliente"
                      ng-model="customer.codigo">
                     </div>
                     </div>

                    <div class="col-md-6"> 
                    <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.fechaNac.$error.required && customerCreateForm.$submitted || customerCreateForm.fechaNac.$dirty && customerCreateForm.fechaNac.$invalid]">
                    <label for="fechaNac">Fecha de Nac.</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control" name="fechaNac" ng-model="customer.fechaNac">
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.fechaNac.$dirty && customerCreateForm.fechaNac.$invalid">
                                              <span ng-show="customerCreateForm.fechaNac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div>
                     </div>
                     </div>
                     </div>
                     <div class="row" >
                     <div class="col-md-4"> 
                      <div class="form-group">
                                            <label>Género</label>
                                            <select name="genero" class="form-control" ng-model="customer.genero">
                                             <option value="">-- elige género --</option>
                                             <option value="M">Masculino</option>
                                             <option value="F">Femenino</option>

                                            </select>
                      </div>
                      </div>

                    <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="fijo">Teléfono fijo</label>
                      <input type="text" class="form-control" name="fijo" placeholder="###"
                      ng-model="customer.fijo">
                     </div>
                     </div>

                     <div class="col-md-4"> 
                    <div class="form-group" >
                      <label for="movil">Teléfono movil</label>
                      <input type="text" class="form-control" name="movil" placeholder="###"
                      ng-model="customer.movil">
                     </div>
                     </div>
                     </div>

                    <div class="row" >
                     <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="###"
                      ng-model="customer.email">
                     </div>
                     </div>
                     <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="website">Página Web</label>
                      <input type="text" class="form-control" name="website" placeholder="###"
                      ng-model="customer.website">
                     </div>
                     </div>
                     <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="direccContac">Dirección de Contacto</label>
                      <input type="text" class="form-control" name="direccContac" placeholder="###"
                      ng-model="customer.direccContac">
                     </div>
                     </div>
                     </div>

                    <div class="row" >
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="distrito">Distrito</label>
                      <input type="text" class="form-control" name="distrito" placeholder="Chiclayo"
                      ng-model="customer.distrito">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="provincia">Provincia</label>
                      <input type="text" class="form-control" name="provincia" placeholder="Chiclayo"
                      ng-model="customer.provincia">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="departamento">Departamento</label>
                      <input type="text" class="form-control" name="departamento" placeholder="Lambayeque"
                      ng-model="customer.departamento">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="pais">País</label>
                      <input type="text" class="form-control" name="pais" placeholder="Perú"
                      ng-model="customer.pais">
                     </div>
                     </div>
                     </div>
                    <div class="form-group" >
                      <label for="notas">Notas</label>
                      <input type="notas" class="form-control" name="notas" placeholder="..."
                      ng-model="customer.notas"></input>
                     </div>
                      </div>
                        <!--================================================-->
                        <div class="modal-footer" >
                          <button type="submit" class="btn btn-primary" ng-click="createCustomer()">Crear</button>
                          <a  class="btn btn-danger" data-dismiss="modal" aria-hidden="ngenabled">Salir</a>
                      </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>


          <!-- =========================================Ventana Agregar Año=================================-->
         <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventana1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
                  <div style="border-radius: 5px" class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                          <h4 class="modal-title">Opciones Año</h4>
                        </div>
                        <!--=================cueropo========================-->
                <div class="modal-body">
              <div class="row" >
                <div class="col-md-9"> 
                  <table class="table table-bordered">
                    <tr>
                      <td>Cash</td>
                      <td>
                        <input type="number" class="form-control" name="cash" placeholder=""
                          ng-model="pago.cash"></input>
                      </td>                    
                    </tr>
                    <tr>

                      <td>Tarjeta</td>
                      <td><input type="number" class="form-control" name="tarjeta" placeholder=""
                          ng-model="pago.tarjeta"></input>
                      </td> 
                      <td>
                        <div class="btn-group">
                          <label class="btn btn-primary" ng-model="radioModel" btn-radio="'2'">Visa</label>
                          <label class="btn btn-primary" ng-model="radioModel" btn-radio="'3'">MasterCard</label>
                        </div>
                      </td>                    
                    </tr>                                    
                  </table>
                </div>
                  <div class="col-md-3">
                  <label>@{{order.montoTotal}}</label> 
                  
                    <div class="form-group">
                      <input type="checkbox" name="estado" ng-model="acuenta" ng-checked="acuenta" class="ng-valid ng-dirty ng-valid-parse ng-touched" ng-click="baseestado()">
                      <label for="estado">Acuenta</label>
                    </div>
                </div>
                </div>
                   
                </div>

                        <!--================================================-->
                        <div class="modal-footer" >
                          <button type="submit" class="btn btn-primary" ng-click="realizarPago()">Cobrar</button>
                          <a  class="btn btn-danger" data-dismiss="modal" aria-hidden="ngenabled">Salir</a>
                      </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>




          <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">Presentaciones</h3>
        </div>
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Equivalencia</th>
                      <th>Producto Base</th>

                      <th style="width: 40px">Enviar</th>
                    </tr>
                    
                    <tr ng-repeat="row in presentations">
                      <td>@{{$index + 1}}</td>
                      <td ng-hide="true">@{{row.iddetalleP}}</td>
                      <td >@{{row.NombreAtributos}}</td>
                      <td>@{{row.precioProducto}}</td>  
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








    
    













              
               