<section class="content-header">
          <h1>
            Editar Ordenes de Cedidos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/stores">Editar Ordenes de Cedido</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Pedidos de Compra</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="orderPurchaseCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
 <!-- <div class="row">
     <div class="col-md-4">
          <label>Proveedor</label>
          <div class="input-group">
                      <input type="text" ng-disabled="orderPurchase.Estado" ng-model="orderPurchase.empresa"  name="table_search" class="form-control input-sm pull-right" placeholder="Search" />
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default" ng-disabled="orderPurchase.Estado" data-toggle="modal" ng-click="searchsupplier()" data-target="#miventana" ><i class="fa fa-search"></i></button>
                      </div>
                    </div> 
      </div> -->
  <!--================================================================-->
  <div class="box-body">           
    <div class="row">
          <div class="col-md-4">
              <div class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.table_search.$error.required && orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.table_search.$dirty && orderPurchaseCreateForm.table_search.$invalid]">
                    <label>Proveedor: </label>
                    <div ng-hide="true" class="input-group">
                               <input  type="text" ng-model="orderPurchase.empresa"  name="table_search" class="form-control input-sm pull-right" placeholder="Search" />
                               <div class="input-group-btn">
                                 <button class="btn btn-sm btn-default" data-toggle="modal" ng-click="searchsupplier()" data-target="#miventana" ><i class="fa fa-search"></i></button>
                               </div>
                               <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.table_search.$dirty && orderPurchaseCreateForm.table_search.$invalid">
                                    <span ng-show="orderPurchaseCreateForm.table_search.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                </label>
                   </div>
                    <div ng-show="true" class="input-group">
                               <spam >@{{orderPurchase.empresa}}</spam>

                    </div> 
              </div> 
            </div>
            <button type="button" class="btn btn-default" ng-click="ActualizarStock()">ActualizarEstock</button>
           <div class="col-md-4">

                      <div  class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.fechaPedido.$error.required && orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPedido.$dirty && orderPurchaseCreateForm.fechaPedido.$invalid]">
                                      <label for="fechaPedido">Fecha Pedido: </label>
                                <div ng-show="activEstados" class="input-group">
                                <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                </div>
                            <input type="date" class="form-control"  name="fechaPedido" ng-model="orderPurchase.fechaPedido" >
                            <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPedido.$dirty && orderPurchaseCreateForm.fechaPedido.$invalid">
                                  <span ng-show="orderPurchaseCreateForm.fechaPedido.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                            </label>
                             </div>
                             <div ng-hide="activEstados" class="input-group">
                               <spam >@{{orderPurchase.fechaPedid}}</spam>
                    </div> 
                      </div>  
                      
          </div>
          <div class="col-md-4">
                       <div  class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.fechaPrevista.$error.required && orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPrevista.$dirty && orderPurchaseCreateForm.fechaPrevista.$invalid]">
                            <label for="fechaPrevista">Fecha Prevista: </label>
                                        <div ng-show="activEstados" class="input-group">
                                        <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                        </div>
                           <input  type="date"  min="@{{orderPurchase.fechaPedido}}" class="form-control" name="fechaPrevista" ng-model="orderPurchase.fechaPrevista"  >
                           <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPrevista.$dirty && orderPurchaseCreateForm.fechaPrevista.$invalid">
                              <span ng-show="orderPurchaseCreateForm.fechaPrevista.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                           </label>
                           </div>
                           <div ng-hide="activEstados" class="input-group">
                               <spam>@{{orderPurchase.fechaPrevist}}</spam>
                           </div>
                      </div> 
                                          
         </div>
      </div>
    <div class="row">
          <div class="col-md-4">
                   <div class="form-group" >
                       <label for="Tienda">Almacen: </label>
                       <select ng-hide="true" class="form-control" ng-click="seleccionarWarehouse()" ng-model="orderPurchase.warehouses_id" ng-options="item.id as item.nombre for item in warehouses">
                       <option value="">--Elija warehouses_id--</option>
                       </select>
                       <div ng-show="true" class="input-group">
                               <spam>@{{warehouses.nombre}}</spam>
                           </div>
                    </div>
          </div>
     </div>
<div class="row"></div>
<div ng-if="orderPurchase.estados==0" class="col-md-8">
      <div  class="form-group">
                
                <a ng-show="activEstados" ng-click="Warehouses(0)" class="btn btn-default btn-xs">Guardar y Continuar</a>
                <a ng-hide="activEstados" ng-click="activarCamposEdit()" class="btn btn-default btn-xs">Editar</a>
     
      </div>
</div>
<div ng-if="orderPurchase.estados==0" class="col-md-4">
      <a ng-click="CambiarEstado()"  class="btn btn-default btn-xs">Editar Detalles</a>
      <a ng-click="CambiarEstado1()" class="btn btn-default btn-xs">Cambiar Estados </a>
</div>
</div>
             <!--   <div ng-app>
                         <a ng-click="purchase.$show()" ng-show="!purchase.$visible" editable-text="userxx.name">@{{ userxx.name }}</a>
                </div>-->
            </div>
  <!--================================================================-->
  
  <!--
  <div class="col-md-4">

                      <div class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.fechaPedido.$error.required && orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPedido.$dirty && orderPurchaseCreateForm.fechaPedido.$invalid]">
                    <label for="fechaPedido">Fecha Pedido</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" ng-disabled="orderPurchase.Estado" class="form-control"  name="fechaPedido" ng-model="orderPurchase.fechaPedido" >
                      <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPedido.$dirty && orderPurchaseCreateForm.fechaPedido.$invalid">
                                              <span ng-show="orderPurchaseCreateForm.fechaPedido.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div></div>  
  </div>
  <div class="col-md-4">
                      <div class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.fechaPrevista.$error.required && orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPrevista.$dirty && orderPurchaseCreateForm.fechaPrevista.$invalid]">
                    <label for="fechaPrevista">Fecha Prevista</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input  type="date"  ng-disabled="orderPurchase.Estado" min="@{{orderPurchase.fechaPedido}}" class="form-control" name="fechaPrevista" ng-model="orderPurchase.fechaPrevista"  >
                      <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPrevista.$dirty && orderPurchaseCreateForm.fechaPrevista.$invalid">
                                              <span ng-show="orderPurchaseCreateForm.fechaPrevista.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div></div> 
                   
    </div>
</div>
<div class="row">
   <div class="col-md-4">
                   <div class="form-group" >
                       <label for="Tienda">Almacen</label>
                       <select class="form-control" ng-disabled="orderPurchase.Estado"ng-click="seleccionarWarehouse()" ng-model="orderPurchase.warehouses_id" ng-options="item.id as item.nombre for item in warehouses">
                       <option value="">--Elija Almacen--</option>
                       </select>
                     </div>
   </div>
</div>
<!--==========================================Agregar Producto====================================-->
      <div ng-if="orderPurchase.estados==0" ng-show="estados" class="box box-default" id="box-addPro">
        <div class="box-header with-border">
          <h3 class="box-title">Agregar Producto</h3>
          <div class="box-tools pull-right">
            <button  type="submit"  class="btn btn-box-tool" data-widget="collapse"><i  class="fa fa-minus"></i></button>
            <!--<button ng-if="codigoTemporalP!=0" type="submit" class="btn btn-box-tool" data-widget="collapse"><i  class="fa fa-minus"></i></button>
          
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div  class="box-body" style="display: block;">

        <form name="detailOrderPurchaseCreateForm" role="form" novalidate> 
          <div class="row">

            <div class="col-md-4">
              <label>Producto</label>
              <div class="input-group">
                <input type="text"  ng-model="product.id"  name="table_search" class="form-control input-sm pull-right" placeholder="Search" />
                <div class="input-group-btn">
                  <button class="btn btn-sm btn-default" data-toggle="modal" ng-click="searchProduct()" data-target="#miventanaProductos" ><i class="fa fa-search"></i></button>
                </div>
              </div> 
            </div> 

            <div class="col-md-4" ng-show="mostrarVariantes">
              <div class="form-group" >
                <label for="Variante">Variante</label>
                <select class="form-control"  data-target="#miventanaPresentacion" data-toggle="modal" ng-click="seleccionarDetPres()" ng-model="variants.id" ng-options="item.id as item.sku for item in variants">
                  <option value="">--Elija Variante--</option>
                </select>
                <!--@{{variants.varid}}-->
                </div>
            </div>

          </div>
          <div class="row">
          <!-- capo de Texto  Cantidad-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.cantidad.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.cantidad.$dirty && detailOrderPurchaseCreateForm.cantidad.$invalid]">
                <label for="cantidad">Cantidad</label>
                <input type="number"   class="form-control ng-pristine ng-valid ng-touched" name="cantidad" id="cantidad" placeholder="0.00" ng-model="detailOrderPurchase.cantidad" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.cantidad.$dirty && detailOrderPurchaseCreateForm.cantidad.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.cantidad.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Precio-->
            <div class="col-md-2">
               <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.preCompra.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.preCompra.$dirty && detailOrderPurchaseCreateForm.preCompra.$invalid]">
                <label for="preCompra">Precio </label>

                <input type="number"  class="form-control ng-pristine ng-valid ng-touched" name="preCompra" placeholder="0.00" ng-model="detailOrderPurchase.preCompra" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.preCompra.$dirty && detailOrderPurchaseCreateForm.preCompra.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.preCompra.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>

            <!-- capo de Texto  Total Bruto-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.montoBruto.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoBruto.$dirty && detailOrderPurchaseCreateForm.montoBruto.$invalid]">
                <label for="montoBruto">Total Bruto</label>
                <input type="number"  class="form-control ng-pristine ng-valid ng-touched" name="montoBruto" placeholder="0.00" ng-model="detailOrderPurchase.montoBruto" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoBruto.$dirty && detailOrderPurchaseCreateForm.montoBruto.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.montoBruto.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Descuento-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.descuento.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.descuento.$dirty && detailOrderPurchaseCreateForm.descuento.$invalid]">
                <label for="descuento">Descuento % </label>

                <input type="number"  class="form-control ng-pristine ng-valid ng-touched" name="descuento" placeholder="0.00" ng-model="detailOrderPurchase.descuento" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.descuento.$dirty && detailOrderPurchaseCreateForm.descuento.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.descuento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Total-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.montoTotal.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoTotal.$dirty && detailOrderPurchaseCreateForm.montoTotal.$invalid]">
                <label for="montoTotal">Total</label>
                <input type="number"  class="form-control ng-pristine ng-valid ng-touched" name="montoTotal" placeholder="0.00" ng-model="detailOrderPurchase.montoTotal" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoTotal.$dirty && detailOrderPurchaseCreateForm.montoTotal.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.montoTotal.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            </div>
          <button type="submit"  class="btn btn-primary" ng-click="AgregarProducto()">Agregar Producto</button>
        
          </form>
        </div><!-- /.box-body -->
        
      </div>
     <!-- <div class="overlay"></div>-->
     </div>
      <script>
    $("#box-addPro").activateBox();
      </script>
<!--=================================================================================================================-->
<!--==========================================Agregar Producto====================================-->
      <div class="box box-default"  id="price">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Producto</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div  class="box-body" style="display: block;">
          <table  class="table table-bordered" id="tabla1">
            <tr>
              <th style="width: 10px">#</th>

              <th>Producto</th>
              <th>Variante </th>
              <th>Cantidad</th>
              <th>Precio Producto</th>
              <th>Precio Compra</th>
              <th>Total Bruto</th>
              <th>Descuento</th>
              <th>Total</th>
              <th ng-if="estados==true">Acciones</th>  
              <th ng-if="estados1==true">Confirmar</th>   
            </tr>
            <tr  ng-repeat="row in detailOrderPurchases">
                      <td>@{{$index + 1}}</td>
                      <td ng-hide="true">@{{row.orderPurchases_id}}</td>
                      <td ng-hide="true">@{{row.detPres_id}}</td>
                      <td>@{{row.nombre}}</td>
                      <td>@{{row.CodigoPCompra}}</td>
                      <td>@{{row.cantidad}}</td>
                      <td>@{{row.preProducto}}</td>
                      <td>@{{row.preCompra}}</td>
                      <td>@{{row.montoBruto}}</td>
                      <td>@{{row.descuento}}</td>
                      <td>@{{row.montoTotal}}</td>
                      <td ng-if="orderPurchase.estados==0" ng-show="estados1" alingn="center"><input style="width: 45px" ng-model="row.cantidad1" ng-blur="notar(row,$index)"  type="number" placeholder="@{{row.cantidad}}" ></td>
                      <td ng-if="orderPurchase.estados==0" ng-show="estados" ><a data-target="#miventanaEditRow" ng-click="EditarDetalles(row,$index)" data-toggle="modal" class="btn btn-warning btn-xs" href="" ><i class="fa fa-fw fa-pencil"></i></a>
                          <a  class="btn btn-danger btn-xs" ng-click="sacarRow($index,row.montoTotal)"><i class="fa fa-fw fa-trash"></i></a>
                      </td>

                      <!--<td><a ng-click="sacarRow(row.index,row.montoTotal)" class="btn btn-warning btn-xs">Sacar</a></td>
                      <td><a ng-click="EditarDetalles(row,row.index)" data-target="#miventanaEditRow" data-toggle="modal" class="btn btn-warning btn-xs">Edit</a></td>
                    -->
                    </tr> 
          </table>


        </div>
      </div>
  <!-- ==========================================================================================-->
  <div class="box-body">
        <div class="row">
          <div class="col-md-4"> 
                <div class="form-group">
                <label for="suppPric">Descuento</label>
                <input type="number" ng-model="orderPurchase.descuento" class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="descuento" placeholder="0.00"  ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
            <!-- capo de Texto  Descuento-->
            <div class="col-md-4"> 
              <div class="form-group">
                <label for="suppPric">Monto Bruto</label>
                <input type="number" ng-model="orderPurchase.montoBruto" class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="montoBruto" placeholder="0.00"   ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
            <!-- capo de Texto  Total-->
            <div class="col-md-4"> 
                <div class="form-group">
                <label for="suppPric">Monto Total</label>
                <input type="number" ng-model="orderPurchase.montoTotal" class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="montoTotal" placeholder="0.00"  ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
          </div>
    </div>
          <div  ng-if="orderPurchase.estados==0" ng-show="estados1" class="box-body">
                      <div  class="form-group" >
                            <label for="variantes">¿Pedido Atendido?</label>
                            <input type="checkbox"  name="variantes" ng-model="orderPurchase.Estado" />
                            <span class="text-info"> <em> Seleccione si su pedido ha sido atendido.</em></span>
                        </div>
                        <div  class="form-group" >
                            <label for="variantes">¿Cancelar Pedido?</label>
                            <input type="checkbox"  name="variantes" ng-model="orderPurchase.Estado1" />
                            <span class="text-info"> <em> Seleccione si desea cancelar pedido.</em></span>
                        </div>
          </div>



        
                    <button ng-if="orderPurchase.estados==0" ng-show="estados" type="submit" class="btn btn-primary" ng-click="updateDPurchase()">Modificar M</button>
                    <a ng-if="orderPurchase.estados==0" href="/orderPurchases" class="btn btn-danger">Cancelar</a>
                    <a ng-if="orderPurchase.estados==1" href="/orderPurchases" class="btn btn-success btn-xs">Regresar</a>
                    <button ng-if="orderPurchase.estados==0" ng-show="estados1" type="submit" class="btn btn-primary" ng-click="updatePurchase()">Modificar E</button>
                    
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->




                <!-- ==============================Ventana Elegir Empresa=================================-->
        <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
               <div style="border-radius: 5px" class="modal-content">
                 <div class="modal-header"  >
                   <button type="button"  class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                   <h4><b>Gastos Del Empleado </b></h4>
                   </div>
                   <div class="modal-body">

                    <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>

                      <th>Empresa</th>
                      <th>Nombre Completo </th>
                      <th>Ruc</th>
                      
                      
                      <th style="width: 40px">Seleccionar</th>
                    </tr>
                  <tr ng-repeat="row in suppliers">
                      <td>@{{$index + 1 + (currentPage-1)*itemsperPage}}</td>
                      <td>@{{row.empresa}}</td>
                      <td>@{{row.nombres+ " " + row.apellidos }}</td>
                      <td>@{{row.ruc}}</td>
                      
                      <td><a ng-click="asignarEmpresa(row)" class="btn btn-danger btn-xs" data-dismiss="modal">Eviar</a></td>
                      
                    </tr>               
                    
                    
                    
                  </table>
                  
                      
                     </div>
                    
               </div>
             </div>
           </div>
        </div>
        </div>
        <!-- ===================================================================================-->





        <!-- =================================Ventana Elegir Producto=================================-->
        <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventanaProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
               <div style="border-radius: 5px" class="modal-content">
                 <div class="modal-header"  >
                   <button type="button"  class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                   <h4><b>Elija Producto</b></h4>
                   </div>
                   <div class="modal-body">

                    <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Código</th>
                      <th>Nombre</th>
                      <th>Marca</th>
                      <th>Categoría</th>

                      <th style="width: 40px">Enviar</th>
                    </tr>
                    
                    <tr ng-repeat="row in products">
                      <td>@{{$index + 1}}</td>
                      <td ng-hide='true'>@{{row.proId}}</td>
                      <td ng-hide='true'>@{{row.precioProducto}}</td>
                      <td ng-hide='true'>@{{row.TieneVariante}}</td>
                     <td>@{{row.proCodigo}}</td>
                      <td>@{{row.proNombre }}</td>                      
                      <td>@{{row.braNombre +"/"+row.typNombre}}</td>
                      <td>@{{row.varPrice}}</td>
                      <td><a ng-click="asignarProduc(row)" class="btn btn-warning btn-xs" data-dismiss="modal">Enviar</a></td>

                    </tr>
                    
                    
                  </table>
                  
                      
                     </div>
                    
               </div>
             </div>
           </div>
        </div>
        </div>
        <!-- ===================================================================================-->
        <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventanaPresentacion"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
               <div style="border-radius: 5px" class="modal-content">
                 <div class="modal-header"  >
                   <button type="button"  class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                   <h4><b>Elija Presentacion</b></h4>
                   </div>
                   <div class="modal-body">

                    <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Producto Base</th>

                      <th style="width: 40px">Enviar</th>
                    </tr>
                    
                    <tr ng-repeat="row in detPres">
                      <td>@{{$index + 1}}</td>
                      <td ng-hide="true">@{{row.iddetalleP}}</td>
                      <td >@{{row.nombre}}</td>
                      <td>@{{row.precioCompra}}</td>  
                      <td ng-if="row.base==0"><span class="badge bg-red">NO</span></td> 
                      <td ng-if="row.base!=0"><span class="badge bg-green">SI</span></td> 
                      <td><a ng-click="AsignarP(row)" class="btn btn-warning btn-xs" data-dismiss="modal">Enviar</a></td>

                    </tr>
                    
                    
                  </table>
                  
                      
                     </div>
                    
               </div>
             </div>
           </div>
        </div>
        </div>
        <!-- ===================================================================================-->

<div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventanaEditRow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
               <div style="border-radius: 5px" class="modal-content">
                 <div class="modal-header"  >
                   <button type="button"  class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                   <h4><b>Edita Detalle</b></h4>
                   </div>
                   <div class="modal-body">
        <form>
                       
                      <input type="text" ng-hide="true"  name="producto" 
                      ng-model="detailOrderPurchase.orderPurchases_id">
                     
                      <input type="text" ng-hide="true"  name="producto" 
                      ng-model="detailOrderPurchase.detPres_id">
                     
            
        <div class="row ">
          <div class="col-md-4">
                     <div class="form-group" >
                      <label for="descripcion">Producto</label>
                      <input type="text" class="form-control" name="producto" placeholder="Capcidad"
                      ng-model="detailOrderPurchase.nombre">
                     </div>
            </div> 
            <div class="col-md-4">
                     
                     <div class="form-group" >
                      <label for="descripcion">Variante</label>
                      <input type="text" class="form-control" name="variante" placeholder="Capcidad"
                      ng-model="detailOrderPurchase.CodigoPCompra">
                     </div>
            </div>
        </div> 
    <div class="row ">
          <div class="col-md-4">
                     <div class="form-group" >
                      <label for="descripcion">Cantidad</label>
                      <input type="number" class="form-control" ng-blur="calculateSuppPric()" name="cantidad" placeholder="0.00"
                      ng-model="detailOrderPurchase.cantidad">
                     </div>
          </div>
          <div class="col-md-4">
                     <div class="form-group" >
                      <label for="descripcion">Precio Producto</label>
                      <input type="number" class="form-control" ng-blur="calculateSuppPric()" name="preproduct" placeholder="0.00"
                      ng-model="detailOrderPurchase.preProducto">
                     </div>
          </div>
          <div class="col-md-4">
                     <div class="form-group" >
                      <label for="descripcion">Precio Compra</label>
                      <input type="number" class="form-control" ng-blur="calculateSuppPric()" name="precompra" placeholder="0.00"
                      ng-model="detailOrderPurchase.preCompra">
                     </div>
          </div>
    </div>
    <div class="row ">
          <div class="col-md-4">
                     <div class="form-group" >
                      <label for="descripcion">Total Bruto</label>
                      <input type="number" class="form-control" ng-blur="calculateSuppPric()" name="montoBruto" placeholder="0.00"
                      ng-model="detailOrderPurchase.montoBruto">
                     </div>
          </div>
          <div class="col-md-4">
                     <div class="form-group" >
                      <label for="descripcion">Descuento</label>
                      <input type="number" class="form-control" ng-blur="calculateSuppPric()" name="descuento" placeholder="0.00"
                      ng-model="detailOrderPurchase.descuento">
                     </div>
          </div>
          <div class="col-md-4">
                     <div class="form-group" >
                      <label for="descripcion">Total</label>
                      <input type="number" class="form-control" ng-blur="calculateSuppPric()" name="total" placeholder="0.00"
                      ng-model="detailOrderPurchase.montoTotal">
                     </div>
            </div>
      </div>
        <button type="submit" data-dismiss="modal" class="btn btn-primary" ng-click="ModificarRow()">Modificar</button>
        <button class="btn btn-danger" data-dismiss="modal" ng-click="ModificarRow()" >Cancelar</button>
                  
    </form>
                      
                   </div>
                    
               </div>
             </div>
           </div>
        </div>
        </div>