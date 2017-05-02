<section class="content-header">
          <h1>
            Almacenes
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/almacenes">Almacenes</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo Almacen</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="almacenCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                       <ul>
                          <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                        </ul>
                  </div>
                                            
                <div class="row">
                  <div class="col-md-4">    
                      <div class="form-group" ng-class="{true: 'has-error'}[ almacenCreateForm.nombreAlmacen.$error.required && almacenCreateForm.$submitted || almacenCreateForm.nombreAlmacen.$dirty && almacenCreateForm.nombreAlmacen.$invalid]">
                      <label for="nombreAlmacen">Nombre Almacen</label>
                      <input type="text" class="form-control" name="nombreAlmacen" g-blur="validanomAlmacen(almacen.nombreAlmacen)" placeholder="Nombre Almacen" ng-model="almacen.nombreAlmacen" required>
                      <label ng-show="almacenCreateForm.$submitted || almacenCreateForm.nombreAlmacen.$dirty && almacenCreateForm.nombreAlmacen.$invalid">
                        <span ng-show="almacenCreateForm.nombreAlmacen.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>

                  <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ almacenCreateForm.descripcion.$error.required && almacenCreateForm.$submitted || almacenCreateForm.descripcion.$dirty && almacenCreateForm.descripcion.$invalid]">
                      <label for="descripcion">Descripción</label>
                      <input type="text" class="form-control" name="descripcion" g-blur="validanomAlmacen(almacen.descripcion)" placeholder="DEscripción de Almacen" ng-model="almacen.descripcion" required>
                      <label ng-show="almacenCreateForm.$submitted || almacenCreateForm.descripcion.$dirty && almacenCreateForm.descripcion.$invalid">
                        <span ng-show="almacenCreateForm.descripcion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group" ng-class="{'has-error': almacenCreateForm.tienda_id.$invalid,'has-success':almacenCreateForm.tienda_id.$invalid}">
                    <label>Farmacia</label>
                      <select class="form-control ng-pristine ng-valid ng-touched" name="tienda_id" ng-model="almacen.tienda_id" ng-options="item.id as item.nombreTienda for item in tiendas" required><option value="">-- Elige Farmacia --</option></select>
                    <label ng-show="almacenCreateForm.tienda_id.$error.required">
                      <span ng-show="almacenCreateForm.tienda_id.$error.required"><i class="fa fa-times-circle-o"></i>El campo Farmacia es Requerido. 
                      </span>
                   </label>
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

