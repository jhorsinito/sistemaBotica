<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Clientes
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/clientes">Documentos</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Cliente</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="ClienteEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                    <ul>
                    <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                       </ul>
                      </div>
                    

              <div class="row">
                <div class="col-md-3">
                  <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.nombreCliente.$error.required && ClienteEditForm.$submitted || ClienteEditForm.nombreCliente.$dirty && ClienteEditForm.nombreCliente.$invalid]">
                      <label for="nombreCliente">Nombre Cliente</label>
                      <input type="text" class="form-control" name="nombreCliente" placeholder="Nombre Cliente" ng-model="cliente.nombreCliente" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.nombreCliente.$dirty && ClienteEditForm.nombreCliente.$invalid">
                        <span ng-show="ClienteEditForm.nombreCliente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.empresa.$error.required && ClienteEditForm.$submitted || ClienteEditForm.empresa.$dirty && ClienteEditForm.empresa.$invalid]">
                      <label for="empresa">Empresa</label>
                      <input type="text" class="form-control" name="empresa" placeholder="Empresa" ng-model="cliente.empresa" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.empresa.$dirty && ClienteEditForm.empresa.$invalid">
                        <span ng-show="ClienteEditForm.empresa.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>

                   <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.empresa.$error.required && ClienteEditForm.$submitted || ClienteEditForm.empresa.$dirty && ClienteEditForm.empresa.$invalid]">
                      <label for="empresa">Empresa</label>
                      <input type="text" class="form-control" name="empresa" placeholder="Empresa" ng-model="cliente.empresa" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.empresa.$dirty && ClienteEditForm.empresa.$invalid">
                        <span ng-show="ClienteEditForm.empresa.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>


                   <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.direccion.$error.required && ClienteEditForm.$submitted || ClienteEditForm.direccion.$dirty && ClienteEditForm.direccion.$invalid]">
                      <label for="direccion">Direccion</label>
                      <input type="text" class="form-control" name="direccion" placeholder="Direccion" ng-model="cliente.direccion" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.direccion.$dirty && ClienteEditForm.direccion.$invalid">
                        <span ng-show="ClienteEditForm.direccion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>


                   <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.ruc.$error.required && ClienteEditForm.$submitted || ClienteEditForm.ruc.$dirty && ClienteEditForm.ruc.$invalid]">
                      <label for="ruc">RUC</label>
                      <input type="text" class="form-control" name="ruc" placeholder="RUC" ng-model="cliente.ruc" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.ruc.$dirty && ClienteEditForm.ruc.$invalid">
                        <span ng-show="ClienteEditForm.ruc.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>


                   <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.dni.$error.required && ClienteEditForm.$submitted || ClienteEditForm.dni.$dirty && ClienteEditForm.dni.$invalid]">
                      <label for="dni">DNI</label>
                      <input type="text" class="form-control" name="dni" placeholder="DNI" ng-model="cliente.dni" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.dni.$dirty && ClienteEditForm.dni.$invalid">
                        <span ng-show="ClienteEditForm.dni.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>


                   <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.codigo.$error.required && ClienteEditForm.$submitted || ClienteEditForm.codigo.$dirty && ClienteEditForm.codigo.$invalid]">
                      <label for="codigo">Código</label>
                      <input type="text" class="form-control" name="codigo" placeholder="Código" ng-model="cliente.codigo" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.codigo.$dirty && ClienteEditForm.codigo.$invalid">
                        <span ng-show="ClienteEditForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>


                   <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.fechaNac.$error.required && ClienteEditForm.$submitted || ClienteEditForm.fechaNac.$dirty && ClienteEditForm.fechaNac.$invalid]">
                      <label for="fechaNac">Fecha de Nacimiento</label>
                      <input type="text" class="form-control" name="fechaNac" placeholder="Fecha Nacimiento" ng-model="cliente.fechaNac" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.fechaNac.$dirty && ClienteEditForm.fechaNac.$invalid">
                        <span ng-show="ClienteEditForm.fechaNac.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.genero.$error.required && ClienteEditForm.$submitted || ClienteEditForm.genero.$dirty && ClienteEditForm.genero.$invalid]">
                      <label for="genero">Género</label>
                      <input type="text" class="form-control" name="genero" placeholder="Género" ng-model="cliente.genero" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.genero.$dirty && ClienteEditForm.genero.$invalid">
                        <span ng-show="ClienteEditForm.genero.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.tel_fijo.$error.required && ClienteEditForm.$submitted || ClienteEditForm.tel_fijo.$dirty && ClienteEditForm.tel_fijo.$invalid]">
                      <label for="tel_fijo">Teléfono Fijo</label>
                      <input type="text" class="form-control" name="tel_fijo" placeholder="Teléfono Fijo" ng-model="cliente.tel_fijo" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.tel_fijo.$dirty && ClienteEditForm.tel_fijo.$invalid">
                        <span ng-show="ClienteEditForm.tel_fijo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>


                  <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.tel_movil.$error.required && ClienteEditForm.$submitted || ClienteEditForm.tel_movil.$dirty && ClienteEditForm.tel_movil.$invalid]">
                      <label for="tel_movil">Telefono Movil</label>
                      <input type="text" class="form-control" name="tel_movil" placeholder="Telefono Movil" ng-model="cliente.tel_movil" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.tel_movil.$dirty && ClienteEditForm.tel_movil.$invalid">
                        <span ng-show="ClienteEditForm.tel_movil.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>


                  <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.email.$error.required && ClienteEditForm.$submitted || ClienteEditForm.email.$dirty && ClienteEditForm.email.$invalid]">
                      <label for="email">E-Mail</label>
                      <input type="text" class="form-control" name="email" placeholder="E-Mail" ng-model="cliente.email" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.email.$dirty && ClienteEditForm.email.$invalid">
                        <span ng-show="ClienteEditForm.email.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group" ng-class="{true: 'has-error'}[ ClienteEditForm.webSite.$error.required && ClienteEditForm.$submitted || ClienteEditForm.webSite.$dirty && ClienteEditForm.webSite.$invalid]">
                      <label for="webSite">Pagina Web</label>
                      <input type="text" class="form-control" name="webSite" placeholder="Pagina Web" ng-model="cliente.webSite" required>
                      <label ng-show="ClienteEditForm.$submitted || ClienteEditForm.webSite.$dirty && ClienteEditForm.webSite.$invalid">
                        <span ng-show="ClienteEditForm.webSite.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>


                    <div class="col-md-4">
                    <div class="form-group" >
                      <label for="notas">Notas</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Notas"
                      ng-model="cliente.notas" rows="4" cols="50"></textarea>
                     </div>
                </div>
                  </div>
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateCliente()">Modificar</button>
                    <a href="/clientes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->