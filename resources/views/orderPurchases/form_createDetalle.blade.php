<setion class="content-header"><h1>
            Marcas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/orderPurchases">Marcas</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Marcas</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="detailOrderPurchaseCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                 
                    <div class="box">
                      <div class="box box-default" id="box-addPro">
        <div class="box-header with-border">
          <h3 class="box-title">Agregar Producto</h3>
          <div class="box-tools pull-right">
            <button  type="submit" class="btn btn-box-tool" data-widget="collapse"><i  class="fa fa-minus"></i></button>
          
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">

        <form name="detailOrderPurchaseCreateForm" role="form" novalidate> 
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

            <div class="col-md-4" ng-show="mostrarVariantes">
              <div class="form-group" >
                <label for="Variante">Variante</label>
                <select class="form-control"  data-target="#miventanaPresentacion" data-toggle="modal" ng-click="seleccionar()" ng-model="variants.id" ng-options="item.id as item.sku for item in variants">
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
                <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="cantidad" id="cantidad" placeholder="0.00" ng-model="detailOrderPurchase.cantidad" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.cantidad.$dirty && detailOrderPurchaseCreateForm.cantidad.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.cantidad.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Precio-->
            <div class="col-md-2">
               <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.preCompra.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.preCompra.$dirty && detailOrderPurchaseCreateForm.preCompra.$invalid]">
                <label for="preCompra">Precio </label>

                <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="preCompra" placeholder="0.00" ng-model="detailOrderPurchase.preCompra" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.preCompra.$dirty && detailOrderPurchaseCreateForm.preCompra.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.preCompra.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>

            <!-- capo de Texto  Total Bruto-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.montoBruto.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoBruto.$dirty && detailOrderPurchaseCreateForm.montoBruto.$invalid]">
                <label for="montoBruto">Total Bruto</label>
                <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="montoBruto" placeholder="0.00" ng-model="detailOrderPurchase.montoBruto" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoBruto.$dirty && detailOrderPurchaseCreateForm.montoBruto.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.montoBruto.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Descuento-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.descuento.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.descuento.$dirty && detailOrderPurchaseCreateForm.descuento.$invalid]">
                <label for="descuento">Descuento % </label>

                <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="descuento" placeholder="0.00" ng-model="detailOrderPurchase.descuento" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.descuento.$dirty && detailOrderPurchaseCreateForm.descuento.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.descuento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Total-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.montoTotal.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoTotal.$dirty && detailOrderPurchaseCreateForm.montoTotal.$invalid]">
                <label for="montoTotal">Total</label>
                <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="montoTotal" placeholder="0.00" ng-model="detailOrderPurchase.montoTotal" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoTotal.$dirty && detailOrderPurchaseCreateForm.montoTotal.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.montoTotal.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            </div>
          <button type="submit" class="btn btn-primary" ng-click="AgregarProducto()">Agregar Producto</button>
        
          </form>
        </div><!-- /.box-body -->
      </div>
      <script>
    $("#box-addPro").activateBox();
      </script>
    <!--==================================================================================-->
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
              <td></td>     
            </tr>
            <tr ng-repeat="row in detailOrderPurchases">
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
                      <td><a data-target="#miventanaEditRow" ng-click="EditarDetalles(row,row.index)" data-toggle="modal" class="btn btn-warning btn-xs" ><i class="fa fa-fw fa-pencil"></i></a>
                          <a  class="btn btn-danger btn-xs" ng-click="sacarRow(row.index,row.montoTotal)"><i class="fa fa-fw fa-trash"></i></a>
                      </td>
                      <!--<td><a ng-click="sacarRow(row.index,row.montoTotal)" class="btn btn-warning btn-xs">Sacar</a></td>
                      <td><a ng-click="EditarDetalles(row,row.index)" data-target="#miventanaEditRow" data-toggle="modal" class="btn btn-warning btn-xs">Edit</a></td>
                    -->
                    </tr> 
          </table>


        </div>
      </div>
      </div>

    <!-- /.box-body -->
            <div class="row">
          <div class="col-md-4"> 
                <div class="form-group">
                <label for="suppPric">Descuento</label>
                <input type="number" ng-model="orderPurchase.descuento" class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="descuento" placeholder="0.00"  ng-disabled="product.hasVariants" ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
            <!-- capo de Texto  Descuento-->
            <div class="col-md-4"> 
              <div class="form-group">
                <label for="suppPric">Monto Bruto</label>
                <input type="number" ng-model="orderPurchase.montoBruto" class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="montoBruto" placeholder="0.00"  ng-disabled="product.hasVariants" ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
            <!-- capo de Texto  Total-->
            <div class="col-md-4"> 
                <div class="form-group">
                <label for="suppPric">Monto Total</label>
                <input type="number" ng-model="orderPurchase.montoTotal" class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="montoTotal" placeholder="0.00"  ng-disabled="product.hasVariants" ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
          </div></div>


                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="DcreatePurchase()">Crear</button>
                    <a href="/orderPurchases" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->



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
                      <td>@{{row.precio}}</td>  
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
       <button type="submit" class="btn btn-primary" ng-click="DcreatePurchase()">Crear</button>
      <a href="/orderPurchases" class="btn btn-danger">Cancelar</a>           
    </form>
                      
                   </div>
                    
               </div>
             </div>
           </div>
        </div>
        </div>