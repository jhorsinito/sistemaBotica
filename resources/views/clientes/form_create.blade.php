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
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.empresa.$error.required && clienteCreateForm.$submitted || clienteCreateForm.empresa.$dirty && clienteCreateForm.empresa.$invalid]">
                      <label for="empresa">Empresa</label>
                      <input type="text" class="form-control" name="empresa" placeholder="Empresa de Cliente" ng-model="cliente.empresa" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.empresa.$dirty && clienteCreateForm.empresa.$invalid">
                        <span ng-show="clienteCreateForm.empresa.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                    </div>


                <div class="row">
                    <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.direccion.$error.required && clienteCreateForm.$submitted || clienteCreateForm.direccion.$dirty && clienteCreateForm.direccion.$invalid]">
                      <label for="direccion">Dirección</label>
                      <input type="text" class="form-control" name="direccion" placeholder="Dirección de Cliente" ng-model="cliente.direccion" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.direccion.$dirty && clienteCreateForm.direccion.$invalid">
                        <span ng-show="clienteCreateForm.direccion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.ruc.$error.required && clienteCreateForm.$submitted || clienteCreateForm.ruc.$dirty && clienteCreateForm.ruc.$invalid]">
                      <label for="ruc">RUC</label>
                      <input type="text" class="form-control" name="ruc" placeholder="RUC de Cliente" ng-model="cliente.ruc" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.ruc.$dirty && clienteCreateForm.ruc.$invalid">
                        <span ng-show="clienteCreateForm.ruc.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.dni.$error.required && clienteCreateForm.$submitted || clienteCreateForm.dni.$dirty && clienteCreateForm.dni.$invalid]">
                      <label for="dni">DNI</label>
                      <input type="text" class="form-control" name="dni" placeholder="DNI de Cliente" ng-model="cliente.dni" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.dni.$dirty && clienteCreateForm.dni.$invalid">
                        <span ng-show="clienteCreateForm.dni.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                    <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.email.$error.required && clienteCreateForm.$submitted || clienteCreateForm.email.$dirty && clienteCreateForm.email.$invalid]">
                      <label for="email">E-Mail</label>
                      <input type="text" class="form-control" name="email" placeholder="E-Mail de Cliente" ng-model="cliente.email" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.email.$dirty && clienteCreateForm.email.$invalid">
                        <span ng-show="clienteCreateForm.email.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                  </div>



                  <div class="row">
                    <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.codigo.$error.required && clienteCreateForm.$submitted || clienteCreateForm.codigo.$dirty && clienteCreateForm.codigo.$invalid]">
                      <label for="codigo">Código</label>
                      <input type="text" class="form-control" name="codigo" placeholder="Código de Cliente" ng-model="cliente.codigo" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.codigo.$dirty && clienteCreateForm.codigo.$invalid">
                        <span ng-show="clienteCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.fechaNac.$error.required && clienteCreateForm.$submitted || clienteCreateForm.fechaNac.$dirty && clienteCreateForm.fechaNac.$invalid]">
                      <label for="fechaNac">Fecha Nacimiento</label>
                      <input type="text" class="form-control" name="fechaNac" placeholder="Fecha Nacimiento de Cliente" ng-model="cliente.fechaNac" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.fechaNac.$dirty && clienteCreateForm.fechaNac.$invalid">
                        <span ng-show="clienteCreateForm.fechaNac.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.genero.$error.required && clienteCreateForm.$submitted || clienteCreateForm.genero.$dirty && clienteCreateForm.genero.$invalid]">
                      <label for="genero">Sexo</label>
                      <input type="text" class="form-control" name="genero" placeholder="Śexo de Cliente" ng-model="cliente.genero" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.genero.$dirty && clienteCreateForm.genero.$invalid">
                        <span ng-show="clienteCreateForm.genero.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                    <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.tel_fijotel_movil.$error.required && clienteCreateForm.$submitted || clienteCreateForm.tel_fijotel_movil.$dirty && clienteCreateForm.tel_fijotel_movil.$invalid]">
                      <label for="tel_fijotel_movil">Tel-Fijo</label>
                      <input type="text" class="form-control" name="tel_fijotel_movil" placeholder="Tel-Fijo de Cliente" ng-model="cliente.tel_fijotel_movil" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.tel_fijotel_movil.$dirty && clienteCreateForm.tel_fijotel_movil.$invalid">
                        <span ng-show="clienteCreateForm.tel_fijotel_movil.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                    <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.webSite.$error.required && clienteCreateForm.$submitted || clienteCreateForm.webSite.$dirty && clienteCreateForm.webSite.$invalid]">
                      <label for="webSite">webSite</label>
                      <input type="text" class="form-control" name="webSite" placeholder="webSite de Cliente" ng-model="cliente.webSite" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.webSite.$dirty && clienteCreateForm.webSite.$invalid">
                        <span ng-show="clienteCreateForm.webSite.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>


                     <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ clienteCreateForm.tel_movil.$error.required && clienteCreateForm.$submitted || clienteCreateForm.tel_movil.$dirty && clienteCreateForm.tel_movil.$invalid]">
                      <label for="tel_movil">Tel-Movil</label>
                      <input type="text" class="form-control" name="tel_movil" placeholder="Tel-Movil de Cliente" ng-model="cliente.tel_movil" required>
                      <label ng-show="clienteCreateForm.$submitted || clienteCreateForm.tel_movil.$dirty && clienteCreateForm.tel_movil.$invalid">
                        <span ng-show="clienteCreateForm.tel_movil.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
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
                    <button type="submit" class="btn btn-primary" ng-click="createCliente()">Crear</button>
                    <a href="/clientes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!--

