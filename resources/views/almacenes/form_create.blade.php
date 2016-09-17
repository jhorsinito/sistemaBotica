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


                     <div class="form-group" ng-class="{true: 'has-error'}[ almacenCreateForm.tiendas_id.$error.required && almacenCreateForm.$submitted || almacenCreateForm.tiendas_id.$dirty && almacenCreateForm.tiendas_id.$invalid]">
                      <label for="tiendas_id">Tienda</label>

                      
                  <select>
                      ("tiendas_id",$tiendas=/sistemaBotica/app/Salesfly/Entities/Tienda::lists('nombreTienda',id)->prepend('Seleccione la Tienda'), null,['id'=>'tiendas_id','class'=>'form-control'])</select>
                   
                     
                    </div>


                    <div class="form-group" ng-class="{true: 'has-error'}[ almacenCreateForm.tienda.$error.required  && almacenCreateForm.$submitted || almacenCreateForm.tienda.$dirty && almacenCreateForm.tienda.$invalid]">
                                               <label>Tienda</label>
                                                    <select name="tienda" class="form-control" ng-model="tienda.tiendas_id" ng-options="tiendas.key1 as tienda.value1 for tienda in tiendas">

                                                 </select>
                                                
                                          </div>



                    


                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createTienda()">Crear</button>
                    <a href="/almacenes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!--


