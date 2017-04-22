<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Metodos de Pago
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/metodoPagos">Metodos de Pago</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Métodos de Pago</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="metodoPagoEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                    <ul>
                    <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                       </ul>
                      </div>
                    

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group" ng-class="{true: 'has-error'}[ metodoPagoEditForm.nombre.$error.required && metodoPagoEditForm.$submitted || metodoPagoEditForm.nombre.$dirty && metodoPagoEditForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="metodoPago.nombre" required>
                      <label ng-show="metodoPagoEditForm.$submitted || metodoPagoEditForm.nombre.$dirty && metodoPagoEditForm.nombre.$invalid">
                        <span ng-show="metodoPagoEditForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group" ng-class="{true: 'has-error'}[ metodoPagoEditForm.descripcion.$error.required && metodoPagoEditForm.$submitted || metodoPagoEditForm.descripcion.$dirty && metodoPagoEditForm.descripcion.$invalid]">
                      <label for="descripcion">Descripción</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Descripción" ng-model="metodoPago.descripcion" required>
                      <label ng-show="metodoPagoEditForm.$submitted || metodoPagoEditForm.descripcion.$dirty && metodoPagoEditForm.descripcion.$invalid">
                        <span ng-show="metodoPagoEditForm.descripcion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>
                  </div>
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateMetodoPago()">Modificar</button>
                    <a href="/metodoPagos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->