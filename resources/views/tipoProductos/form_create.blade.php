<section class="content-header">
          <h1> Tipos de Productos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/tipoProductos">Tipos de Productos</a> </li>
            <li class="active">Crear</li>
          </ol>
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo Tipo de Productos</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="tipoProductoCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                     <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                   </ul>
                 </div>
                    
                   <div class="row">
                    <div class="col-md-4">

                   <div class="form-group" ng-class="{true: 'has-error'}[ tipoProductoCreateForm.nombre.$error.required && tipoProductoCreateForm.$submitted || tipoProductoCreateForm.nombre.$dirty && tipoProductoCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" ng-blur="validanomComprobante(tipoProducto.nombre)" placeholder="Nombre Tipo de Producto" ng-model="tipoProducto.nombre" required>
                      <label ng-show="tipoProductoCreateForm.$submitted || tipoProductoCreateForm.nombre.$dirty && tipoProductoCreateForm.nombre.$invalid">
                        <span ng-show="tipoProductoCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    </div>


                    <div class="col-md-4">
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="tipoProducto.descripcion" rows="4" cols="50"></textarea>
                     </div>
                     </div>
                     </div>


                </div><!-- /.box-body -->
              </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createTipoProducto()">Crear</button>
                    <a href="/tipoProductos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->