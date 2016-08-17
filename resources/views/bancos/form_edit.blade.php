<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Bancos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/bancos">Bancos</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar banco</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="motivoVentaEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                     <div class="form-group" ng-class="{true: 'has-error'}[ bancoEditForm.nombre.$error.required && bancoEditForm.$submitted || bancoEditForm.nombre.$dirty && bancoEditForm.nombre.$invalid]">
                      <label for="nombre">nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="nombre" ng-model="banco.nombre" required>
                      <label ng-show="bancoEditForm.$submitted || bancoEditForm.nombre.$dirty && bancoEditForm.nombre.$invalid">
                        <span ng-show="bancoEditForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateBanco()">Modificar</button>
                    <a href="/bancos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->