<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ubigeos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/ubigeos">Ubigeos</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Ubigeo</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="ubigeoCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                    <div class="form-group" ng-class="{true: 'has-error'}[ ubigeoCreateForm.codigo.$error.required && ubigeoCreateForm.$submitted || ubigeoCreateForm.codigo.$dirty && ubigeoCreateForm.codigo.$invalid]">
                      <label for="codigo">Codigo</label>
                      <input type="text" class="form-control" name="codigo" ng-blur="validanomUbigeo(ubigeo.codigo)" placeholder="Codigo" ng-model="ubigeo.codigo" required>
                      <label ng-show="ubigeoCreateForm.$submitted || ubigeoCreateForm.codigo.$dirty && ubigeoCreateForm.codigo.$invalid">
                        <span ng-show="ubigeoCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{true: 'has-error'}[ ubigeoCreateForm.departamento.$error.required && ubigeoCreateForm.$submitted || ubigeoCreateForm.departamento.$dirty && ubigeoCreateForm.departamento.$invalid]">
                      <label for="departamento">Departamento</label>
                      <input type="text" class="form-control" name="departamento" placeholder="Departamento" ng-model="ubigeo.departamento" required>
                      <label ng-show="ubigeoCreateForm.$submitted || ubigeoCreateForm.departamento.$dirty && ubigeoCreateForm.departamento.$invalid">
                        <span ng-show="ubigeoCreateForm.departamento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{true: 'has-error'}[ ubigeoCreateForm.provincia.$error.required && ubigeoCreateForm.$submitted || ubigeoCreateForm.provincia.$dirty && ubigeoCreateForm.provincia.$invalid]">
                      <label for="provincia">Provincia</label>
                      <input type="text" class="form-control" name="provincia" placeholder="Provincia" ng-model="ubigeo.provincia" required>
                      <label ng-show="ubigeoCreateForm.$submitted || ubigeoCreateForm.provincia.$dirty && ubigeoCreateForm.provincia.$invalid">
                        <span ng-show="ubigeoCreateForm.provincia.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{true: 'has-error'}[ ubigeoCreateForm.distrito.$error.required && ubigeoCreateForm.$submitted || ubigeoCreateForm.distrito.$dirty && ubigeoCreateForm.distrito.$invalid]">
                      <label for="distrito">Distrito</label>
                      <input type="text" class="form-control" name="distrito" placeholder="Distrito" ng-model="ubigeo.distrito" required>
                      <label ng-show="ubigeoCreateForm.$submitted || ubigeoCreateForm.distrito.$dirty && ubigeoCreateForm.distrito.$invalid">
                        <span ng-show="ubigeoCreateForm.distrito.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateUbigeo()">Modificar</button>
                    <a href="/ubigeos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->