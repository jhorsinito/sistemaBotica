<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tiendas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/tiendas">Tiendas</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Tienda</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="TiendaEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>



                  <div class="form-group" ng-class="{true: 'has-error'}[ TiendaEditForm.nombreTienda.$error.required && TiendaEditForm.$submitted || TiendaEditForm.nombreTienda.$dirty && TiendaEditForm.nombreTienda.$invalid]">
                      <label for="nombreTienda">Nombre Tienda</label>
                      <input type="text" class="form-control" name="nombreTienda" placeholder="Nombre Tienda" ng-model="tienda.nombreTienda" required>
                      <label ng-show="TiendaEditForm.$submitted || TiendaEditForm.nombreTienda.$dirty && TiendaEditForm.nombreTienda.$invalid">
                        <span ng-show="TiendaEditForm.nombreTienda.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{true: 'has-error'}[ TiendaEditForm.razonSocial.$error.required && TiendaEditForm.$submitted || TiendaEditForm.razonSocial.$dirty && TiendaEditForm.razonSocial.$invalid]">
                      <label for="razonSocial">Razon Social</label>
                      <input type="text" class="form-control" name="razonSocial" placeholder="Razon Social" ng-model="tienda.razonSocial" required>
                      <label ng-show="TiendaEditForm.$submitted || TiendaEditForm.razonSocial.$dirty && TiendaEditForm.razonSocial.$invalid">
                        <span ng-show="TiendaEditForm.razonSocial.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{true: 'has-error'}[ TiendaEditForm.ruc.$error.required && TiendaEditForm.$submitted || TiendaEditForm.ruc.$dirty && TiendaEditForm.ruc.$invalid]">
                      <label for="ruc">RUC</label>
                      <input type="text" class="form-control" name="ruc" placeholder="RUC" ng-model="tienda.ruc" required>
                      <label ng-show="TiendaEditForm.$submitted || TiendaEditForm.ruc.$dirty && TiendaEditForm.ruc.$invalid">
                        <span ng-show="TiendaEditForm.ruc.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{true: 'has-error'}[ TiendaEditForm.direccion.$error.required && TiendaEditForm.$submitted || TiendaEditForm.direccion.$dirty && TiendaEditForm.direccion.$invalid]">
                      <label for="direccion">Dirección</label>
                      <input type="text" class="form-control" name="direccion" placeholder="Dirección" ng-model="tienda.direccion" required>
                      <label ng-show="TiendaEditForm.$submitted || TiendaEditForm.direccion.$dirty && TiendaEditForm.direccion.$invalid">
                        <span ng-show="TiendaEditForm.direccion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>


                    <div class="row">

                    <div class="col-md-4">
                     <div class="form-group" ng-class="{true: 'has-error'}[ TiendaEditForm.distrito.$error.required && TiendaEditForm.$submitted || TiendaEditForm.distrito.$dirty && TiendaEditForm.distrito.$invalid]">
                      <label for="distrito">Distrito</label>
                      <input type="text" class="form-control" name="distrito" placeholder="Distrito" ng-model="tienda.distrito" required>
                      <label ng-show="TiendaEditForm.$submitted || TiendaEditForm.distrito.$dirty && TiendaEditForm.distrito.$invalid">
                        <span ng-show="TiendaEditForm.distrito.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                    <div class="col-md-4">
                     <div class="form-group" ng-class="{true: 'has-error'}[ TiendaEditForm.provincia.$error.required && TiendaEditForm.$submitted || TiendaEditForm.provincia.$dirty && TiendaEditForm.provincia.$invalid]">
                      <label for="provincia">Provincia</label>
                      <input type="text" class="form-control" name="provincia" placeholder="Provincia" ng-model="tienda.provincia" required>
                      <label ng-show="TiendaEditForm.$submitted || TiendaEditForm.provincia.$dirty && TiendaEditForm.provincia.$invalid">
                        <span ng-show="TiendaEditForm.provincia.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                    <div class="col-md-4">
                     <div class="form-group" ng-class="{true: 'has-error'}[ TiendaEditForm.departamento.$error.required && TiendaEditForm.$submitted || TiendaEditForm.departamento.$dirty && TiendaEditForm.departamento.$invalid]">
                      <label for="departamento">Departamento</label>
                      <input type="text" class="form-control" name="departamento" placeholder="Departamento" ng-model="tienda.departamento" required>
                      <label ng-show="TiendaEditForm.$submitted || TiendaEditForm.departamento.$dirty && TiendaEditForm.departamento.$invalid">
                        <span ng-show="TiendaEditForm.departamento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                    </div>

                    </div>

                    <div class="row">
                      <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ TiendaEditForm.pais.$error.required && TiendaEditForm.$submitted || TiendaEditForm.pais.$dirty && TiendaEditForm.pais.$invalid]">
                      <label for="pais">País</label>
                      <input type="text" class="form-control" name="pais" placeholder="País" ng-model="tienda.pais" required>
                      <label ng-show="tiendaCrepaisateForm.$submitted || TiendaEditForm.pais.$dirty && TiendaEditForm.pais.$invalid">
                        <span ng-show="TiendaEditForm.pais.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                    </div>
                    <div class="col-md-4">
                     <div class="form-group">
                      <label for="email">E-mail</label>
                      <input type="text" class="form-control" name="email" placeholder="E-mail" ng-model="tienda.email">
                      </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group">
                      <label for="telMovil">Telefono Móvil</label>
                      <input type="text" class="form-control" name="telMovil" placeholder="Telefono Móvil" ng-model="tienda.telMovil">
                    </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="telFijo">Telefono Fijo</label>
                      <input type="text" class="form-control" name="telFijo" placeholder="Telefono Fijo" ng-model="tienda.telFijo">
                      </div>
                      </div>

                      <div class="col-md-6">
                    <div class="form-group">
                      <label for="webSite">webSite</label>
                      <input type="text" class="form-control" name="webSite" placeholder="webSite" ng-model="tienda.webSite">
                    </div>
                    </div>
                    </div>



                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateTienda()">Modificar</button>
                    <a href="/tiendas" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
