<section class="content-header">
          <h1>
            Clientes
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/clientes">Clientes</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo Cliente</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="clienteCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
              </ul>
              </div>
                                            
                <div class="row">
                    <div class="col-md-6">

                   <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.nombreCliente.$error.required && clienteCreateForm.$submitted || clienteCreateForm.nombreCliente.$dirty && clienteCreateForm.nombreCliente.$invalid]">
                      <label for="nombreCliente">Nombre y Apellidos </label>
                      <input type="text" class="form-control" name="nombreCliente" placeholder="Nombre Cliente" ng-model="cliente.nombreCliente" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.nombreCliente.$dirty && clienteCreateForm.nombreCliente.$invalid">
                        <span ng-show="clienteCreateForm.nombreCliente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-6">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.empresaCliente.$error.required && clienteCreateForm.$submitted || clienteCreateForm.empresaCliente.$dirty && clienteCreateForm.empresaCliente.$invalid]">
                      <label for="empresaCliente">Empresa</label>
                      <input type="text" class="form-control" name="empresaCliente" placeholder="Empresa de Cliente" ng-model="cliente.empresaCliente" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.empresaCliente.$dirty && clienteCreateForm.empresaCliente.$invalid">
                        <span ng-show="clienteCreateForm.empresaCliente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                    </div>


                <div class="row">
                    <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.direccionCliente.$error.required && clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid]">
                      <label for="direccionCliente">Dirección</label>
                      <input type="text" class="form-control" name="direccionCliente" placeholder="Dirección de Cliente" ng-model="cliente.direccion" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid">
                        <span ng-show="clienteCreateForm.direccionCliente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.direccionCliente.$error.required && clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid]">
                      <label for="direccionCliente">RUC</label>
                      <input type="text" class="form-control" name="direccionCliente" placeholder="RUC de Cliente" ng-model="cliente.direccion" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid">
                        <span ng-show="clienteCreateForm.direccionCliente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.direccionCliente.$error.required && clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid]">
                      <label for="direccionCliente">DNI</label>
                      <input type="text" class="form-control" name="direccionCliente" placeholder="DNI de Cliente" ng-model="cliente.direccion" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid">
                        <span ng-show="clienteCreateForm.direccionCliente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                  </div>



                  <div class="row">
                    <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.direccionCliente.$error.required && clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid]">
                      <label for="direccionCliente">Código</label>
                      <input type="text" class="form-control" name="direccionCliente" placeholder="Código de Cliente" ng-model="cliente.direccion" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid">
                        <span ng-show="clienteCreateForm.direccionCliente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.direccionCliente.$error.required && clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid]">
                      <label for="direccionCliente">Fecha Nacimiento</label>
                      <input type="text" class="form-control" name="direccionCliente" placeholder="Fecha Nacimiento de Cliente" ng-model="cliente.direccion" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid">
                        <span ng-show="clienteCreateForm.direccionCliente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.direccionCliente.$error.required && clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid]">
                      <label for="direccionCliente">Śexo</label>
                      <input type="text" class="form-control" name="direccionCliente" placeholder="Śexo de Cliente" ng-model="cliente.direccion" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid">
                        <span ng-show="clienteCreateForm.direccionCliente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                    <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.direccionCliente.$error.required && clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid]">
                      <label for="direccionCliente">Tel-Fijo</label>
                      <input type="text" class="form-control" name="direccionCliente" placeholder="Tel-Fijo de Cliente" ng-model="cliente.direccion" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid">
                        <span ng-show="clienteCreateForm.direccionCliente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.direccionCliente.$error.required && clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid]">
                      <label for="direccionCliente">Tel-Movil</label>
                      <input type="text" class="form-control" name="direccionCliente" placeholder="Tel-Movil de Cliente" ng-model="cliente.direccion" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.direccionCliente.$dirty && clienteCreateForm.direccionCliente.$invalid">
                        <span ng-show="clienteCreateForm.direccionCliente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                  </div>



                    </div>
                    

                    <div class="row">
                      <div class="col-md-4">
                      <div class="form-group" >
                        <label for="notas">Notas</label>
                        <textarea type="notas" class="form-control" name="notas" placeholder="Notas"
                        ng-model="cliente.notas" rows="4" cols="50"></textarea>
                      </div>

                    </div>
                   </div>


                    </div>
                    


                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createAlmacen()">Crear</button>
                    <a href="/almacenes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!--


