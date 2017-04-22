<section class="content-header">
          <h1>
            Metodos de Pago
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/metodoPagos">Metodos de Pago</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Metodo de Pago</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="metodoPagoCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                     <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                   </ul>
                  </div>
                    
                <div class="row">
                  <div class="col-md-6">
                   <div class="form-group" ng-class="{true: 'has-error'}[ metodoPagoCreateForm.nombre.$error.required && metodoPagoCreateForm.$submitted || metodoPagoCreateForm.nombre.$dirty && metodoPagoCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="metodoPago.nombre" required>
                      <label ng-show="metodoPagoCreateForm.$submitted || metodoPagoCreateForm.nombre.$dirty && metodoPagoCreateForm.nombre.$invalid">
                        <span ng-show="metodoPagoCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="metodoPago.descripcion" rows="4" cols="50"></textarea>
                     </div>
                     </div>
                     </div>
                    </div>
                    </div>
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createMetodoPago()">Crear</button>
                    <a href="/metodoPagos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!--

