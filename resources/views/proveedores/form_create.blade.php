<section class="content-header">
          <h1>
            Proveedores
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/proveedores">Proveedores</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Proveedor</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="proveedorCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                     <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                   </ul>
                  </div>

                <div class="row">
                  <div class="col-md-4"> 
                   <div class="form-group" ng-class="{true: 'has-error'}[ proveedorCreateForm.nombreProveedor.$error.required && proveedorCreateForm.$submitted || proveedorCreateForm.nombreProveedor.$dirty && proveedorCreateForm.nombreProveedor.$invalid]">
                      <label for="nombreProveedor">Nombre Proveedor</label>
                      <input type="text" class="form-control" name="nombreProveedor" placeholder="Nombre Proveedor" ng-model="proveedor.nombreProveedor" required>
                      <label ng-show="proveedorCreateForm.$submitted || proveedorCreateForm.nombreProveedor.$dirty && proveedorCreateForm.nombreProveedor.$invalid">
                        <span ng-show="proveedorCreateForm.nombreProveedor.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                   </div>

                  <div class="col-md-2"> 
                     <div class="form-group" ng-class="{'has-error': proveedorCreateForm.tipoDocumento_id.$invalid,'has-success':proveedorCreateForm.tipoDocumento_id.$invalid}">
                    <label>Tipo Documento</label>
                      <select class="form-control ng-pristine ng-valid ng-touched" name="tipoDocumento_id" ng-model="proveedor.tipoDocumento_id" ng-options="item.id as item.nombreDocumento for item in tipoDocumentos" required><option value="">-- Elige Documento --</option></select>
                    <label ng-show="proveedorCreateForm.tipoDocumento_id.$error.required">
                      <span ng-show="proveedorCreateForm.tipoDocumento_id.$error.required"><i class="fa fa-times-circle-o"></i>El campo Documento es Requerido. 
                      </span>
                   </label>
                  </div>
                </div>

              <div class="col-md-2">  
                <div class="form-group" ng-class="{true: 'has-error'}[ proveedorCreateForm.numDocumento.$error.required && proveedorCreateForm.$submitted || proveedorCreateForm.numDocumento.$dirty && proveedorCreateForm.numDocumento.$invalid]">
                      <label for="numDocumento">Número de Documento</label>
                      <input type="text" class="form-control" name="numDocumento" placeholder="Número de Documento" ng-model="proveedor.numDocumento" required>
                      <label ng-show="proveedorCreateForm.$submitted || proveedorCreateForm.numDocumento.$dirty && proveedorCreateForm.numDocumento.$invalid">
                        <span ng-show="proveedorCreateForm.numDocumento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-4">     
                    <div class="form-group" ng-class="{true: 'has-error'}[ proveedorCreateForm.direccion.$error.required && proveedorCreateForm.$submitted || proveedorCreateForm.direccion.$dirty && proveedorCreateForm.direccion.$invalid]">
                      <label for="direccion">Dirección</label>
                      <input type="text" class="form-control" name="direccion" placeholder="Dirección" ng-model="proveedor.direccion" required>
                      <label ng-show="proveedorCreateForm.$submitted || proveedorCreateForm.direccion.$dirty && proveedorCreateForm.direccion.$invalid">
                        <span ng-show="proveedorCreateForm.direccion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                 </div>

                 <div class="row">
                  <div class="col-md-3"> 
                    <div class="form-group" ng-class="{true: 'has-error'}[ proveedorCreateForm.numCuenta.$error.required && proveedorCreateForm.$submitted || proveedorCreateForm.numCuenta.$dirty && proveedorCreateForm.numCuenta.$invalid]">
                      <label for="numCuenta">Número de Cuenta</label>
                      <input type="text" class="form-control" name="numCuenta" placeholder="Número de Cuenta" ng-model="proveedor.numCuenta" required>
                      <label ng-show="proveedorCreateForm.$submitted || proveedorCreateForm.numCuenta.$dirty && proveedorCreateForm.numCuenta.$invalid">
                        <span ng-show="proveedorCreateForm.numCuenta.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                  

                  <div class="col-md-3"> 
                    <div class="form-group">
                      <label for="telMovil">Teléfonos</label>
                      <input type="text" class="form-control" name="telMovil" placeholder="Teléfonos" ng-model="proveedor.telMovil">
                    </div>
                    </div>

                  <div class="col-md-3"> 
                    <div class="form-group">
                      <label for="email">Correo Electrónico</label>
                      <input type="text" class="form-control" name="email" placeholder="Correo Electrónico" ng-model="proveedor.email">
                      </div>
                  </div>

                    <div class="col-md-3">  
                      <div class="form-group">
                      <label for="webSite">Página Web</label>
                      <input type="text" class="form-control" name="webSite" placeholder="Página Web" ng-model="proveedor.webSite">
                    </div>
                    </div>
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createProveedor()">Crear</button>
                    <a href="/proveedores" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!--

