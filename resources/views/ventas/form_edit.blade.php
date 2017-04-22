<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ventas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/ventas">Ventas</li>
            <li class="active">Editar</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Venta</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="VentaEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                    <ul>
                      <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong>
                        </li>
                    </ul>
                  </div>

                  <div class="row">
                  <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ VentaEditForm.nombre.$error.required && VentaEditForm.$submitted || VentaEditForm.nombre.$dirty && VentaEditForm.nombre.$invalid]">
                      <label for="nombres">Nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="venta.nombre" ng-blur="validaNombre2(venta.nombre)" typeahead-on-select="validarNombre()" typeahead="venta as venta.proNombre for venta in ventas | filter:$viewValue | limitTo:8" required>
                      <label ng-show="VentaEditForm.$submitted || VentaEditForm.nombre.$dirty && VentaEditForm.nombre.$invalid">
                        <span ng-show="VentaEditForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ VentaEditForm.codigo.$error.required && VentaEditForm.$submitted || VentaEditForm.codigo.$dirty && VentaEditForm.codigo.$invalid]">
                      <label for="codigo">Código de Venta</label>
                      <input type="text" class="form-control" name="codigo" placeholder="1000"
                      ng-model="venta.codigo" ng-blur="validacodigo(venta.codigo)" required>
                      <label ng-show="VentaEditForm.$submitted || VentaEditForm.codigo.$dirty && VentaEditForm.codigo.$invalid">

                        <span ng-show=VentaEditForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                       <span class="text-info"> <em> Codigo Nesesario para la venta.</em></span>
                    </div>

                    </div>


                    <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ VentaEditForm.numero.$error.required && VentaEditForm.$submitted || VentaEditForm.numero.$dirty && VentaEditForm.numero.$invalid]">
                      <label for="numero">Numero</label>
                      <input type="text" class="form-control" name="numero" placeholder="numero"
                      ng-model="venta.numero" ng-blur="validanumero(venta.numero)" required>
                      <label ng-show="VentaEditForm.$submitted || VentaEditForm.numero.$dirty && VentaEditForm.numero.$invalid">

                        <span ng-show=VentaEditForm.numero.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                       <span class="text-info"> <em> Numero Nesesario para la Venta.</em></span>
                    </div>
                    </div>


                    <div class="col-md-4">
                 <div class="form-group" ng-class="{true: 'has-error'}[ VentaEditForm.igv.$error.required && VentaEditForm.$submitted || VentaEditForm.igv.$dirty && VentaEditForm.igv.$invalid]">
                      <label for="suppPric"> IGV </label>
                  <input type="number" class="form-control" name="price1" string-to-number placeholder="0.00" ng-model="venta.igv" ng-change="calculatePrice()" step="0.1">
                    </div>
                    </div>

                       <div class="col-md-4">
                 <div class="form-group" ng-class="{true: 'has-error'}[ VentaEditForm.monto.$error.required && VentaEditForm.$submitted || VentaEditForm.monto.$dirty && VentaEditForm.monto.$invalid]">
                      <label for="suppPric"> _Monto </label>
                  <input type="number" class="form-control" name="price1" string-to-number placeholder="0.00" ng-model="venta.monto" ng-change="calculatePrice()" step="0.1">
                    </div>
                    </div>


                       <div class="col-md-4">
                 <div class="form-group" ng-class="{true: 'has-error'}[ VentaEditForm.precioventa.$error.required && VentaEditForm.$submitted || VentaEditForm.precioventa.$dirty && VentaEditForm.precioventa.$invalid]">
                      <label for="suppPric"> Precio Venta </label>
                  <input type="number" class="form-control" name="price1" string-to-number placeholder="0.00" ng-model="venta.precioventa" ng-change="calculatePrice()" step="0.1">
                    </div>
                    </div>


                   <div class="col-md-4">
                          <div class="form-group">
                                <label>-- Farmacias --<a class="btn btn-xs btn-info btn-flat" ng-click="addTienda()"> CREAR NUEVA FARMACIA </a></label>
                                <select name="tienda" class="form-control" ng-model="venta.tienda_id" ng-options="k as v for (k, v) in tiendas">
                                    <option value="">--Elige Farmacia--</option>
                                    <option value="">+Agrega Farmacia</option>
                                </select>

                          </div>
                    </div>
                

                
                    
                           <div class="col-md-4" >
                            <div class="form-group">
                                <label>-- Comprobantes --<a class="btn btn-xs btn-info btn-flat" ng-click="addComprobante()"> CREAR NUEVO COMPROBANTE </a></label>
                                <select name="Comprobante" class="form-control" ng-model="venta.comprobante_id" ng-options="k as v for (k, v) in comprobantes">
                               <option value="">-- Eliga Comprobante --</option>
                                                </select>
                          </div>
                          </div>


                            <div class="col-md-4" >
                            <div class="form-group">
                                <label>-- Cliente --<a class="btn btn-xs btn-info btn-flat" ng-click="addCliente()"> CREAR NUEVO CLIENTE </a></label>
                                <select name="cliente" class="form-control" ng-model="venta.cliente_id" ng-options="k as v for (k, v) in clientes">
                                <option value="">--Eliga Cliente--</option>
                                                </select>
                          </div>
                          </div>




                            <div class="col-md-4" >
                            <div class="form-group">
                                <label>Productos</label>
                                <select name="product" class="form-control" ng-model="venta.product_id" ng-options="k as v for (k, v) in products">
                                <option value="">--Eliga Producto--</option>
                                                </select>
                          </div>
                          </div>
                           

                 <div class="col-md-12" >
                    <div class="form-group" >
                      <label for="notas">Descripción</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..."
                      ng-model="venta.descripcion" rows="4" cols="50"></textarea>
                     </div>
                     </div>

                 </div>
                 </div>
     
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button id="btn_generate" data-loading-text="Enviando.." type="submit" class="btn btn-primary" ng-click="updateVenta()">Editar</button>
                    <a href="ventas" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->



         

<!-- =============================Modal de Farmacia ================================ -->
            
<script type="text/ng-template" id="myModalContent.html">
    <div class="modal-header">
        <h3 class="modal-title">Crear Farmacia</h3>
    </div>
    <div class="modal-body">


               <form name="tiendaCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                     <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                   </ul>
                  </div>

                   <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.nombreTienda.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.nombreTienda.$dirty && tiendaCreateForm.nombreTienda.$invalid]">
                      <label for="nombreTienda">Nombre Farmacia</label>
                      <input type="text" class="form-control" name="nombreTienda" placeholder="Nombre Farmacia" ng-model="tienda.nombreTienda" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.nombreTienda.$dirty && tiendaCreateForm.nombreTienda.$invalid">
                        <span ng-show="tiendaCreateForm.nombreTienda.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
   
                    <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.razonSocial.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.razonSocial.$dirty && tiendaCreateForm.razonSocial.$invalid]">
                      <label for="razonSocial">Razon Social</label>
                      <input type="text" class="form-control" name="razonSocial" placeholder="Razon Social" ng-model="tienda.razonSocial" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.razonSocial.$dirty && tiendaCreateForm.razonSocial.$invalid">
                        <span ng-show="tiendaCreateForm.razonSocial.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
     
                    <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.ruc.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.ruc.$dirty && tiendaCreateForm.ruc.$invalid]">
                      <label for="ruc">RUC</label>
                      <input type="text" class="form-control" name="ruc" placeholder="RUC" ng-model="tienda.ruc" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.ruc.$dirty && tiendaCreateForm.ruc.$invalid">
                        <span ng-show="tiendaCreateForm.ruc.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.direccion.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.direccion.$dirty && tiendaCreateForm.direccion.$invalid]">
                      <label for="direccion">Dirección</label>
                      <input type="text" class="form-control" name="direccion" placeholder="Dirección" ng-model="tienda.direccion" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.direccion.$dirty && tiendaCreateForm.direccion.$invalid">
                        <span ng-show="tiendaCreateForm.direccion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
  
                     <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.distrito.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.distrito.$dirty && tiendaCreateForm.distrito.$invalid]">
                      <label for="distrito">Distrito</label>
                      <input type="text" class="form-control" name="distrito" placeholder="Distrito" ng-model="tienda.distrito" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.distrito.$dirty && tiendaCreateForm.distrito.$invalid">
                        <span ng-show="tiendaCreateForm.distrito.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
    
                     <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.provincia.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.provincia.$dirty && tiendaCreateForm.provincia.$invalid]">
                      <label for="provincia">Provincia</label>
                      <input type="text" class="form-control" name="provincia" placeholder="Provincia" ng-model="tienda.provincia" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.provincia.$dirty && tiendaCreateForm.provincia.$invalid">
                        <span ng-show="tiendaCreateForm.provincia.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
  
                     <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.departamento.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.departamento.$dirty && tiendaCreateForm.departamento.$invalid]">
                      <label for="departamento">Departamento</label>
                      <input type="text" class="form-control" name="departamento" placeholder="Departamento" ng-model="tienda.departamento" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.departamento.$dirty && tiendaCreateForm.departamento.$invalid">
                        <span ng-show="tiendaCreateForm.departamento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
  
                    <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.pais.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.pais.$dirty && tiendaCreateForm.pais.$invalid]">
                      <label for="pais">País</label>
                      <input type="text" class="form-control" name="pais" placeholder="País" ng-model="tienda.pais" required>
                      <label ng-show="tiendaCrepaisateForm.$submitted || tiendaCreateForm.pais.$dirty && tiendaCreateForm.pais.$invalid">
                        <span ng-show="tiendaCreateForm.pais.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>

                     <div class="form-group">
                      <label for="email">Correo Electrónico</label>
                      <input type="text" class="form-control" name="email" placeholder="E-mail" ng-model="tienda.email">
                      </div>
     
                    <div class="form-group">
                      <label for="telMovil">Celular</label>
                      <input type="text" class="form-control" name="telMovil" placeholder="Telefono Móvil" ng-model="tienda.telMovil">
                    </div>
     
                    <div class="form-group">
                      <label for="telFijo">Telefono Fijo</label>
                      <input type="text" class="form-control" name="telFijo" placeholder="Telefono Fijo" ng-model="tienda.telFijo">
                      </div>
     
                    <div class="form-group">
                      <label for="webSite">Página Web</label>
                      <input type="text" class="form-control" name="webSite" placeholder="Página Web" ng-model="tienda.webSite">
                    </div>


            </div><!-- /.box-body -->

        </form>                 

    </div>
    <div class="modal-footer">
        <button id="btn_generateTienda" data-loading-text="Enviando.." class="btn btn-primary" type="button" ng-click="createTienda()">Crear</button>
        <button class="btn btn-warning" type="button" ng-click="cancelTienda()">Cancelar</button>
    </div>
</script>
<!-- =============================END Modal de Farmacia ================================ -->





<!-- =============================Modal de Comprobante ================================ -->
<script type="text/ng-template" id="myModalContent2.html">
    <div class="modal-header">
        <h3 class="modal-title">Crear Comprobante</h3>
    </div>
    <div class="modal-body">


             <form name="comprobanteCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                     <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                   </ul>
                 </div>

                   <div class="form-group" ng-class="{true: 'has-error'}[ comprobanteCreateForm.nombreComprobante.$error.required && comprobanteCreateForm.$submitted || comprobanteCreateForm.nombreComprobante.$dirty && comprobanteCreateForm.nombreComprobante.$invalid]">
                      <label for="nombreComprobante">Nombre</label>
                      <input type="text" class="form-control" name="nombreComprobante" ng-blur="validanomComprobante(comprobante.nombreComprobante)" placeholder="Nombre Comprobante" ng-model="comprobante.nombreComprobante" required>
                      <label ng-show="comprobanteCreateForm.$submitted || comprobanteCreateForm.nombreComprobante.$dirty && comprobanteCreateForm.nombreComprobante.$invalid">
                        <span ng-show="comprobanteCreateForm.nombreComprobante.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="comprobante.descripcion" rows="4" cols="50"></textarea>
                     </div>
                    

            </div><!-- /.box-body -->

        </form>                 

    </div>
    <div class="modal-footer">
        <button id="btn_generateComprobante" data-loading-text="Enviando.." class="btn btn-primary" type="button" ng-click="createComprobante()">Crear</button>
        <button class="btn btn-warning" type="button" ng-click="cancelComprobante()">Cancelar</button>
    </div>
</script>
<!-- =============================END Modal de Comprobante ================================ -->
