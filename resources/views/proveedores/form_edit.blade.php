<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Proveedores
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/proveedores">Proveedores</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Proveedor</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="ProveedorEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                    <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                           </ul>
                    </div>
                    
                  <div class="row">
                  <div class="col-md-4">   
                  <div class="form-group" >
                      <label for="nombreProveedor">Nombre Proveedor</label>
                      <input type="text" class="form-control" name="nombreProveedor" placeholder="Nombre Proveedor" ng-model="proveedor.nombreProveedor" required>
                  </div>
                  </div>

                  <div class="col-md-2">  
                     <div class="form-group" ng-class="{'has-error': ProveedorEditForm.tipoDocumento_id.$invalid,'has-success':ProveedorEditForm.tipoDocumento_id.$invalid}">
                    <label>Tipo Documento</label>
                      <select class="form-control ng-pristine ng-valid ng-touched" name="tipoDocumento_id" ng-model="proveedor.tipoDocumento_id" ng-options="item.id as item.nombreDocumento for item in tipoDocumentos" required><option value="">-- Elige Documento --</option></select>
                    <label ng-show="ProveedorEditForm.tipoDocumento_id.$error.required">
                      <span ng-show="ProveedorEditForm.tipoDocumento_id.$error.required"><i class="fa fa-times-circle-o"></i>El campo Documento es Requerido. 
                      </span>
                   </label>
                  </div>
                    </div>

                    <div class="col-md-2">
                    <div class="form-group" >
                      <label for="numDocumento">Número de Documento</label>
                      <input type="text" class="form-control" name="numDocumento" placeholder="Número de Documento" ng-model="proveedor.numDocumento" required>
                    </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group" >
                      <label for="direccion">Dirección</label>
                      <input type="text" class="form-control" name="direccion" placeholder="Dirección" ng-model="proveedor.direccion" required>
                    </div>
                    </div>
                    </div>

                <div class="row">  
                    <div class="col-md-3">
                    <div class="form-group" >
                      <label for="numCuenta">N° Cuenta</label>
                      <input type="text" class="form-control" name="numCuenta" placeholder="N° Cuenta" ng-model="proveedor.numCuenta" required> 
                    </div>
                    </div>
                  
                    <div class="col-md-3">
                     <div class="form-group" >
                      <label for="telefonos">Teléfonos</label>
                      <input type="text" class="form-control" name="telefonos" placeholder="Telefonos" ng-model="proveedor.telefonos" required>
                      
                    </div>
                    </div>

                    <div class="col-md-3">
                     <div class="form-group" >
                      <label for="email">Correo Electrónico</label>
                      <input type="text" class="form-control" name="email" placeholder="Correo Electrónico" ng-model="proveedor.email" required>
                      
                    </div>
                    </div>

                    <div class="col-md-3">
                     <div class="form-group" >
                      <label for="webSite">Pagina Web</label>
                      <input type="text" class="form-control" name="webSite" placeholder="Pagina Web" ng-model="proveedor.webSite" required>
                      
                      </div>
                    </div>

                    </div>

                                      
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateProveedor()">Modificar</button>
                    <a href="/proveedores" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->