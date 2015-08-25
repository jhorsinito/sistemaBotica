<section class="content-header">
          <h1>
            Compras
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/stores">Compras</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Pedido de Compras</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="purchaseCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
  <div class="row">
     <div class="col-md-4">
          <label>Proveedor</label>
          <div class="input-group">
                      <input type="text" ng-model="purchase.empresa"  name="table_search" class="form-control input-sm pull-right" placeholder="Search" />
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default" data-toggle="modal" ng-click="searchsupplier()" data-target="#miventana" ><i class="fa fa-search"></i></button>
                      </div>
                    </div> 
      </div> 
     
  
  
  <div class="col-md-4">
                      <div class="form-group" ng-class="{true: 'has-error'}[ employeeCreateForm.fechanac.$error.required && employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid]">
                    <label for="fechanac">Fecha Pedido</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control"  name="fechanac" ng-model="purchase.fechaPedido" required>
                      <label ng-show="employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid">
                                              <span ng-show="employeeCreateForm.fechanac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div></div>  
  </div>
  <div class="col-md-4">
                      <div class="form-group" ng-class="{true: 'has-error'}[ employeeCreateForm.fechanac.$error.required && employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid]">
                    <label for="fechanac">Fecha Prevista</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input  type="date"  class="form-control" name="fechanac" ng-model="purchase.fechaPrevista"  >
                      <label ng-show="employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid">
                                              <span ng-show="employeeCreateForm.fechanac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div></div> 
                   
    </div>
</div>
<div class="row">
   <div class="col-md-4">
                   <div class="form-group" >
                       <label for="Tienda">Almacen</label>
                       <select class="form-control" name="" ng-model="purchase.warehouses_id" ng-options="item.id as item.nombre for item in warehouses">
                       <option value="">--Elija Almacen--</option>
                       </select>
                     </div>
   </div>
</div>
<!--==========================================Agregar Producto====================================-->
      <div class="box box-default" id="box-addPro">
        <div class="box-header with-border">
          <h3 class="box-title">Precio del Producto</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">

        <form name="detailPurchaseCreateForm" role="form" novalidate> 
          <div class="row">

            <div class="col-md-4">
              <label>Producto</label>
              <div class="input-group">
                <input type="text" ng-model="product.id"  name="table_search" class="form-control input-sm pull-right" placeholder="Search" />
                <div class="input-group-btn">
                  <button class="btn btn-sm btn-default" data-toggle="modal" ng-click="searchProduct()" data-target="#miventanaProductos" ><i class="fa fa-search"></i></button>
                </div>
              </div> 
            </div> 

            <div class="col-md-4">
              <div class="form-group" >
                <label for="Variante">Variate</label>
                <select class="form-control" name="" ng-click="seleccionar()" ng-model="variants.id" ng-options="item.id as item.sku for item in variants">
                  <option value="">--Elija Variate--</option>
                </select>
                @{{variants.varid}}
                </div>
            </div>

          </div>
          <div class="row">
          <!-- capo de Texto  Cantidad-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailPurchaseCreateForm.cantidad.$error.required && detailPurchaseCreateForm.$submitted || detailPurchaseCreateForm.cantidad.$dirty && detailPurchaseCreateForm.cantidad.$invalid]">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="cantidad" id="cantidad" placeholder="0.00" ng-model="detailPurchase.cantidad" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailPurchaseCreateForm.$submitted || detailPurchaseCreateForm.cantidad.$dirty && detailPurchaseCreateForm.cantidad.$invalid">
                  <span ng-show="detailPurchaseCreateForm.cantidad.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Precio-->
            <div class="col-md-2">
               <div class="form-group" ng-class="{true: 'has-error'}[ detailPurchaseCreateForm.preCompra.$error.required && detailPurchaseCreateForm.$submitted || detailPurchaseCreateForm.preCompra.$dirty && detailPurchaseCreateForm.preCompra.$invalid]">
                <label for="preCompra">Precio </label>

                <input type="text" class="form-control ng-pristine ng-valid ng-touched" name="preCompra" placeholder="0.00" ng-model="detailPurchase.preCompra" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailPurchaseCreateForm.$submitted || detailPurchaseCreateForm.preCompra.$dirty && detailPurchaseCreateForm.preCompra.$invalid">
                  <span ng-show="detailPurchaseCreateForm.preCompra.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>

            <!-- capo de Texto  Total Bruto-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailPurchaseCreateForm.montoBruto.$error.required && detailPurchaseCreateForm.$submitted || detailPurchaseCreateForm.montoBruto.$dirty && detailPurchaseCreateForm.montoBruto.$invalid]">
                <label for="montoBruto">Total Bruto</label>
                <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="montoBruto" placeholder="0.00" ng-model="detailPurchase.montoBruto" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailPurchaseCreateForm.$submitted || detailPurchaseCreateForm.montoBruto.$dirty && detailPurchaseCreateForm.montoBruto.$invalid">
                  <span ng-show="detailPurchaseCreateForm.montoBruto.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Descuento-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailPurchaseCreateForm.descuento.$error.required && detailPurchaseCreateForm.$submitted || detailPurchaseCreateForm.descuento.$dirty && detailPurchaseCreateForm.descuento.$invalid]">
                <label for="descuento">Descuento % </label>

                <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="descuento" placeholder="0.00" ng-model="detailPurchase.descuento" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailPurchaseCreateForm.$submitted || detailPurchaseCreateForm.descuento.$dirty && detailPurchaseCreateForm.descuento.$invalid">
                  <span ng-show="detailPurchaseCreateForm.descuento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Total-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailPurchaseCreateForm.montoTotal.$error.required && detailPurchaseCreateForm.$submitted || detailPurchaseCreateForm.montoTotal.$dirty && detailPurchaseCreateForm.montoTotal.$invalid]">
                <label for="montoTotal">Total</label>
                <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="montoTotal" placeholder="0.00" ng-model="detailPurchase.montoTotal" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailPurchaseCreateForm.$submitted || detailPurchaseCreateForm.montoTotal.$dirty && detailPurchaseCreateForm.montoTotal.$invalid">
                  <span ng-show="detailPurchaseCreateForm.montoTotal.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            </div>
          <button type="submit" class="btn btn-primary" ng-click="AgregarProducto()">Agregar Producto</button>
        
          </from>
        </div><!-- /.box-body -->
      </div>
      <script>
    $("#box-addPro").activateBox();
      </script>
<!--=================================================================================================================-->
<!--==========================================Agregar Producto====================================-->
      <div class="box box-default" id="price">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Producto</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
          <table class="table table-bordered" id="tabla1">
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
                      
            </tr>
            <tr ng-repeat="row in detailPurchases">
                      <td></td>
                      <td>@{{purchase.empresa}}</td>
                      <td>@{{row.codigo}}</td>
                      <td>@{{row.cantidad}}</td>
                      <td>@{{row.preProducto}}</td>
                      <td>@{{row.preCompra}}</td>
                      <td>@{{row.montoBruto}}</td>
                      <td>@{{row.descuento}}</td>
                      <td>@{{row.montoTotal}}</td>
                      <td><a ng-click="sacarRow(row.index,row.montoTotal)" class="btn btn-warning btn-xs">Sacar</a></td>
                    </tr> 
          </table>


        </div>
      </div>
  <!-- ==========================================================================================-->
        <div class="row">
          <div class="col-md-4"> 
                <div class="form-group">
                <label for="suppPric">Descuento</label>
                <input type="number" ng-model="purchase.descuento" class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="descuento" placeholder="0.00"  ng-disabled="product.hasVariants" ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
            <!-- capo de Texto  Descuento-->
            <div class="col-md-4"> 
              <div class="form-group">
                <label for="suppPric">Monto Bruto</label>
                <input type="number" ng-model="purchase.montoBruto" class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="montoBruto" placeholder="0.00"  ng-disabled="product.hasVariants" ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
            <!-- capo de Texto  Total-->
            <div class="col-md-4"> 
                <div class="form-group">
                <label for="suppPric">Monto Total</label>
                <input type="number" ng-model="purchase.montoTotal" class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="montoTotal" placeholder="0.00"  ng-disabled="product.hasVariants" ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
          </div>


        
                    <button type="submit" class="btn btn-primary" ng-click="updatePurchase()">Modificar</button>
                    <a href="/purchases" class="btn btn-danger">Cancelar</a>
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
                     <td>@{{row.proCodigo}}</td>
                      <td>@{{row.proNombre }}</td>                      
                      <td>@{{row.braNombre +"/"+row.typNombre}}</td>
                      <td>@{{row.varPrice}}</td>
                      <td><a ng-click="asignarProduc(row)" class="btn btn-warning btn-xs">Enviar</a></td>

                    </tr>
                    
                    
                  </table>
                  
                      
                     </div>
                    
               </div>
             </div>
           </div>
        </div>
        </div>
        <!-- ===================================================================================-->