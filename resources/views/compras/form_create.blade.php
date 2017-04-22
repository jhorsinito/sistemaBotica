<section class="content-header">
          <h1>
            Compras
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/proveedores">Compras</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Compra</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="compraCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                     <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                   </ul>
                  </div>

                <div class="row">
                  <div class="col-md-3"> 
                   <div class="form-group" ng-class="{'has-error': compraCreateForm.proveedor_id.$invalid,'has-success':compraCreateForm.proveedor_id.$invalid}">
                    <label>Proveedor</label>
                      <select class="form-control ng-pristine ng-valid ng-touched" name="proveedor_id" ng-model="proveedor.proveedor_id" ng-options="item.id as item.nombreProveedor for item in proveedores" required><option value="">-- Elige Proveedor --</option></select>
                    <label ng-show="compraCreateForm.proveedor_id.$error.required">
                      <span ng-show="compraCreateForm.proveedor_id.$error.required"><i class="fa fa-times-circle-o"></i>El campo Proveedor es Requerido. 
                      </span>
                   </label>
                  </div>
                   </div>

                  <div class="col-md-3"> 
                     <div class="form-group" ng-class="{'has-error': compraCreateForm.metodoPago_id.$invalid,'has-success':compraCreateForm.metodoPago_id.$invalid}">
                    <label>Metodo de Pago</label>
                      <select class="form-control ng-pristine ng-valid ng-touched" name="metodoPago_id" ng-model="metodoPago.metodoPago_id" ng-options="item.id as item.nombre for item in metodoPagos" required><option value="">-- Elige Metodo de Pago --</option></select>
                    <label ng-show="compraCreateForm.metodoPago_id.$error.required">
                      <span ng-show="compraCreateForm.metodoPago_id.$error.required"><i class="fa fa-times-circle-o"></i>El campo Metodo de Pago es Requerido. 
                      </span>
                   </label>
                  </div>
                </div>

              <div class="col-md-3">  
                  <div class="form-group" ng-class="{'has-error': compraCreateForm.comprobante_id.$invalid,'has-success':compraCreateForm.comprobante_id.$invalid}">
                    <label>Comprobante</label>
                      <select class="form-control ng-pristine ng-valid ng-touched" name="comprobante_id" ng-model="comprobante.comprobante_id" ng-options="item.id as item.nombreComprobante for item in comprobantes" required><option value="">-- Elige Comprobante --</option></select>
                    <label ng-show="compraCreateForm.comprobante_id.$error.required">
                      <span ng-show="compraCreateForm.comprobante_id.$error.required"><i class="fa fa-times-circle-o"></i>El campo Comprobante es Requerido. 
                      </span>
                   </label>
                  </div>
                  </div>

                  <div class="col-md-3">     
                    <div class="form-group" >
                      <label for="notas">Observaciones</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Observaciones"
                      ng-model="compra.observaciones" rows="1" cols="10"></textarea>
                     </div>
                    </div>
                 </div>

 
               <div class="box box-primary">

               <div class="box-header with-border">
                  <h3 class="box-title">Agregar Productos</h3>
                </div><!-- /.box-header -->

                  <div class="form-group" ng-class="{'has-error': compraCreateForm.product_id.$invalid,'has-success':compraCreateForm.product_id.$invalid}">
                    <label>Producto</label>
                      <select class="form-control ng-pristine ng-valid ng-touched" name="product_id" ng-model="product.product_id" ng-options="item.id as item.nombre for item in products" required><option value="">-- Elige Producto --</option></select>
                    <label ng-show="compraCreateForm.product_id.$error.required">
                      <span ng-show="compraCreateForm.product_id.$error.required"><i class="fa fa-times-circle-o"></i>El campo Producto es Requerido. 
                      </span>
                   </label>
                  </div>
                
                    <br>
                  <br>
                     <div class="box-body" >
                        <table class="table table-bordered" >
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nombre de Medicamento</th>
                      <th style="width: 40px">Eliminar</th>
                    </tr>
                    
                    <tr ng-repeat="row in grupoProductos">
                      <td>@{{$index + 1}}</td>
                      <td>@{{row.nombre}}</td>
                      <td><a ng-click="eliminarProducto($index)" class="btn btn-danger btn-xs">Eliminar</a></td>
                      
                    </tr>
                    
                    
                  </table>
                    </div>


               </div>
                 
                  
                
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createCompra()">Crear</button>
                    <a href="/compras" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section>



              
