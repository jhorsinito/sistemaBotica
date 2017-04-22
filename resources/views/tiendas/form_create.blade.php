<section class="content-header">
          <h1>
            Tiendas
            <small>Panel de Control</small>
          </h1>
          <ol cla<section class="content-header">
          <h1>
            Farmacias
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/tiendas">Farmacias</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Farmacia</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="tiendaCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                     <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                   </ul>
                  </div>
                <div class="row">
                  <div class="col-md-3">
                   <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.nombreTienda.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.nombreTienda.$dirty && tiendaCreateForm.nombreTienda.$invalid]">
                      <label for="nombreTienda">Nombre Farmacia</label>
                      <input type="text" class="form-control" name="nombreTienda" placeholder="Nombre Farmacia" ng-model="tienda.nombreTienda" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.nombreTienda.$dirty && tiendaCreateForm.nombreTienda.$invalid">
                        <span ng-show="tiendaCreateForm.nombreTienda.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>

                <div class="col-md-3">  
                    <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.razonSocial.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.razonSocial.$dirty && tiendaCreateForm.razonSocial.$invalid]">
                      <label for="razonSocial">Razon Social</label>
                      <input type="text" class="form-control" name="razonSocial" placeholder="Razon Social" ng-model="tienda.razonSocial" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.razonSocial.$dirty && tiendaCreateForm.razonSocial.$invalid">
                        <span ng-show="tiendaCreateForm.razonSocial.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
               </div>
               <div class="col-md-2">     
                    <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.ruc.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.ruc.$dirty && tiendaCreateForm.ruc.$invalid]">
                      <label for="ruc">RUC</label>
                      <input type="text" class="form-control" name="ruc" placeholder="RUC" ng-model="tienda.ruc" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.ruc.$dirty && tiendaCreateForm.ruc.$invalid">
                        <span ng-show="tiendaCreateForm.ruc.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                  <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.direccion.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.direccion.$dirty && tiendaCreateForm.direccion.$invalid]">
                      <label for="direccion">Dirección</label>
                      <input type="text" class="form-control" name="direccion" placeholder="Dirección" ng-model="tienda.direccion" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.direccion.$dirty && tiendaCreateForm.direccion.$invalid">
                        <span ng-show="tiendaCreateForm.direccion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                    </div>

                  <div class="row">
                    <div class="col-md-2">
                     <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.distrito.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.distrito.$dirty && tiendaCreateForm.distrito.$invalid]">
                      <label for="distrito">Distrito</label>
                      <input type="text" class="form-control" name="distrito" placeholder="Distrito" ng-model="tienda.distrito" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.distrito.$dirty && tiendaCreateForm.distrito.$invalid">
                        <span ng-show="tiendaCreateForm.distrito.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                    <div class="col-md-2">
                     <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.provincia.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.provincia.$dirty && tiendaCreateForm.provincia.$invalid]">
                      <label for="provincia">Provincia</label>
                      <input type="text" class="form-control" name="provincia" placeholder="Provincia" ng-model="tienda.provincia" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.provincia.$dirty && tiendaCreateForm.provincia.$invalid">
                        <span ng-show="tiendaCreateForm.provincia.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                    <div class="col-md-2">
                     <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.departamento.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.departamento.$dirty && tiendaCreateForm.departamento.$invalid]">
                      <label for="departamento">Departamento</label>
                      <input type="text" class="form-control" name="departamento" placeholder="Departamento" ng-model="tienda.departamento" required>
                      <label ng-show="tiendaCreateForm.$submitted || tiendaCreateForm.departamento.$dirty && tiendaCreateForm.departamento.$invalid">
                        <span ng-show="tiendaCreateForm.departamento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                    </div>

                   
                      <div class="col-md-2">
                    <div class="form-group" ng-class="{true: 'has-error'}[ tiendaCreateForm.pais.$error.required && tiendaCreateForm.$submitted || tiendaCreateForm.pais.$dirty && tiendaCreateForm.pais.$invalid]">
                      <label for="pais">País</label>
                      <input type="text" class="form-control" name="pais" placeholder="País" ng-model="tienda.pais" required>
                      <label ng-show="tiendaCrepaisateForm.$submitted || tiendaCreateForm.pais.$dirty && tiendaCreateForm.pais.$invalid">
                        <span ng-show="tiendaCreateForm.pais.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                    </div>

                    <div class="col-md-4">
                     <div class="form-group">
                      <label for="email">Correo Electrónico</label>
                      <input type="text" class="form-control" name="email" placeholder="E-mail" ng-model="tienda.email">
                      </div>
                    </div>
                    </div>
                    

                  <div class="row">
                    <div class="col-md-2">
                    <div class="form-group">
                      <label for="telMovil">Celular</label>
                      <input type="text" class="form-control" name="telMovil" placeholder="Telefono Móvil" ng-model="tienda.telMovil">
                    </div>
                    </div>
                    
                    <div class="col-md-2">
                    <div class="form-group">
                      <label for="telFijo">Telefono Fijo</label>
                      <input type="text" class="form-control" name="telFijo" placeholder="Telefono Fijo" ng-model="tienda.telFijo">
                      </div>
                      </div>

                      <div class="col-md-2">
                    <div class="form-group">
                      <label for="webSite">Página Web</label>
                      <input type="text" class="form-control" name="webSite" placeholder="Página Web" ng-model="tienda.webSite">
                    </div>
                    </div>
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createTienda()">Crear</button>
                    <a href="/tiendas" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!--