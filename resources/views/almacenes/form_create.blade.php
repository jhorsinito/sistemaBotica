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
                  <h3 class="box-title">Agregar Almacen</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="almacenCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                                            
                    
                   <div class="form-group" ng-class="{true: 'has-error'}[ almacenCreateForm.nombreAlmacen.$error.required && almacenCreateForm.$submitted || almacenCreateForm.nombreAlmacen.$dirty && almacenCreateForm.nombreAlmacen.$invalid]">
                      <label for="nombreAlmacen">Nombre Almacen</label>
                      <input type="text" class="form-control" name="nombreAlmacen" placeholder="Nombre Almacen" ng-model="almacen.nombreAlmacen" required>
                      <label ng-show="almacenCreateForm.$submitted || almacenCreateForm.nombreAlmacen.$dirty && almacenCreateForm.nombreAlmacen.$invalid">
                        <span ng-show="almacenCreateForm.nombreAlmacen.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>


                    <div class="form-group" ng-class="{true: 'has-error'}[ almacenCreateForm.descripcionAlmacen.$error.required && almacenCreateForm.$submitted || almacenCreateForm.descripcionAlmacen.$dirty && almacenCreateForm.descripcionAlmacen.$invalid]">
                      <label for="descripcionAlmacen">Descripción</label>
                      <input type="text" class="form-control" name="descripcionAlmacen" placeholder="Descripción Almacen" ng-model="almacen.descripcionAlmacen" required>
                      <label ng-show="almacenCreateForm.$submitted || almacenCreateForm.descripcionAlmacen.$dirty && almacenCreateForm.descripcionAlmacen.$invalid">
                        <span ng-show="almacenCreateForm.descripcionAlmacen.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>


                     
                     <div class="form-group" ng-class="{'has-error': almacenCreateForm.tienda_id.$invalid,'has-success':almacenCreateForm.tienda_id.$invalid}">
                            <label>Farmacia</label>
                            <select class="form-control ng-pristine ng-valid ng-touched" name="tienda_id" ng-model="almacen.tienda_id" ng-options="item.id as item.nombreTienda for item in tiendas" required><option value="">-- Elige Farmacia --</option></select>
                            <label ng-show="almacenCreateForm.tienda_id.$error.required">
                                <span ng-show="almacenCreateForm.tienda_id.$error.required"><i class="fa fa-times-circle-o"></i>El campo Farmacia es Requerido. 
                                </span>
                              </label>
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


