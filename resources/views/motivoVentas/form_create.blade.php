<section class="content-header">
          <h1>
            Motivo Ventas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/motivoVentas">Motivo Ventas</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Motivo Venta</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="motivoVentaCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                   <div class="form-group" ng-class="{true: 'has-error'}[ motivoVentaCreateForm.descripcion.$error.required && motivoVentaCreateForm.$submitted || motivoVentaCreateForm.descripcion.$dirty && motivoVentaCreateForm.descripcion.$invalid]">
                      <label for="descripcion">Descripcion</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" ng-model="motivoVenta.descripcion" required>
                      <label ng-show="motivoVentaCreateForm.$submitted || motivoVentaCreateForm.descripcion.$dirty && motivoVentaCreateForm.descripcion.$invalid">
                        <span ng-show="motivoVentaCreateForm.descripcion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createMotivoVenta()">Crear</button>
                    <a href="/motivoVentas" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->