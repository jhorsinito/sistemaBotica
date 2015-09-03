<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Goastos Mensuales
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/cashMonthlys">Gastos Mensuales</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
          <div class="row">
            <div class="col-md-12">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Gastos Mensuales</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="cashCreateForm" role="form" novalidate>
                  <div class="box-body">
                    <div class="callout callout-danger" ng-show="errors">
                      <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                      </ul>
                    </div>
                    <div class="row">
                    <div class="col-md-1">
                    </div>
                      <div class="col-md-4">
                        <a ng-click="rutaMovimiento()" ng-href="@{{rutaDetCash}}"  target="_self" type="submit" class="btn btn-primary" >Agregar Movimiento</a>
                      </div>
                      <div class="col-md-1">
                    </div>
                      <div class="col-md-4">
                        <a ng-click="cerrarCaja()"  type="submit" class="btn btn-primary" >Cerrar Caja</a>
                      </div>
                    </div>

                    

                  <div class="row">
                  <div class="col-md-1">
                    </div>
                    <div class="col-md-4">
                      <div class="box box-solid">
                        <div class="box-header with-border">
                          <i class="fa fa-calculator"></i>
                          <h3 class="box-title">Movimientos de Caja</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                          <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.montoInicial.$error.required && cashCreateForm.$submitted || cashCreateForm.montoInicial.$dirty && cashCreateForm.montoInicial.$invalid]">
                            <label for="montoInicial">Monto Inicial</label>
                            <input type="text" class="form-control ng-pristine ng-valid ng-touched" name="montoInicial" placeholder="0.00" ng-model="cash.montoInicial" ng-blur="calculateSuppPric()" step="0.1">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.montoInicial.$dirty && cashCreateForm.montoInicial.$invalid">
                              <span ng-show="cashCreateForm.montoInicial.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>

                          <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.ingresos.$error.required && cashCreateForm.$submitted || cashCreateForm.ingresos.$dirty && cashCreateForm.ingresos.$invalid]">
                            <label for="ingresos">Monto Ingresos</label>
                            <input type="text" class="form-control ng-pristine ng-valid ng-touched" name="ingresos" placeholder="0.00" ng-model="cash.ingresos" ng-blur="calculateSuppPric()" step="0.1">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.ingresos.$dirty && cashCreateForm.ingresos.$invalid">
                              <span ng-show="cashCreateForm.ingresos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>

                          <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.gastos.$error.required && cashCreateForm.$submitted || cashCreateForm.gastos.$dirty && cashCreateForm.gastos.$invalid]">
                            <label for="gastos">Monto Gastos</label>
                            <input type="text" class="form-control ng-pristine ng-valid ng-touched" name="gastos" placeholder="0.00" ng-model="cash.gastos" ng-blur="calculateSuppPric()" step="0.1">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.gastos.$dirty && cashCreateForm.gastos.$invalid">
                              <span ng-show="cashCreateForm.gastos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>
                     
                    
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>


                    <div class="col-md-1">
                    </div>

                    <div class="col-md-4">
                      <div class="box box-solid">
                        <div class="box-header with-border">
                          <i class="fa fa-calculator"></i>
                          <h3 class="box-title">Arqueo</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                          <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.montoInicial.$error.required && cashCreateForm.$submitted || cashCreateForm.montoInicial.$dirty && cashCreateForm.montoInicial.$invalid]">
                            <label for="montoInicial">Monto Teorico</label>
                            <input type="text" class="form-control ng-pristine ng-valid ng-touched" name="montoInicial" placeholder="0.00" ng-model="cash.montoBruto" ng-blur="calculateSuppPric()" step="0.1">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.montoInicial.$dirty && cashCreateForm.montoInicial.$invalid">
                              <span ng-show="cashCreateForm.montoInicial.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>

                          <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.ingresos.$error.required && cashCreateForm.$submitted || cashCreateForm.ingresos.$dirty && cashCreateForm.ingresos.$invalid]">
                            <label for="ingresos">Monto Real</label>
                            <input type="text" class="form-control ng-pristine ng-valid ng-touched" name="ingresos" placeholder="0.00" ng-model="cash.montoReal" ng-blur="calculardescuadre()" step="0.1">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.ingresos.$dirty && cashCreateForm.ingresos.$invalid">
                              <span ng-show="cashCreateForm.ingresos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>

                          <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.gastos.$error.required && cashCreateForm.$submitted || cashCreateForm.gastos.$dirty && cashCreateForm.gastos.$invalid]">
                            <label for="gastos">Descuadre</label>
                            <input type="text" class="form-control ng-pristine ng-valid ng-touched" name="gastos" placeholder="0.00" ng-model="cash.descuadre" ng-blur="calculateSuppPric()" step="0.1">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.gastos.$dirty && cashCreateForm.gastos.$invalid">
                              <span ng-show="cashCreateForm.gastos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>
                     
                    
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>
                  </div>

                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Tipo</th>
                      <th>Monto Caja</th>
                      <th>S/.Tarjeta</th>
                      <th>S/.Efectivo</th>
                      <th>Monto Final</th>
                      <th>Ver Venta</th>
                    </tr>
                    
                    <tr ng-repeat="row in detCashes">
                      <td>@{{$index + 1}}</td>
                      <td>@{{row.fecha}}</td>
                      <td>@{{row.hora}}</td>
                      <td>@{{row.cash_motive.nombre}}</td>
                      <td>@{{row.montoCaja}}</td>
                      <td>@{{row.montoMovimientoTarjeta}}</td>
                      <td>@{{row.montoMovimientoEfectivo}}</td>
                      <td>@{{row.montoFinal}}</td>
                      <td ng-if="row.cashMotive_id==1"><a href="/sales/edit/@{{row.observacion}}" target="_blank">ver venta</a></td>
                      <td ng-if="row.cashMotive_id!=1">@{{row.observacion}}</td>
                    </tr>                   
                  </table>
                  <div class="box-footer clearfix">
                    <pagination total-items="totalItems1" ng-model="currentPage1" max-size="maxSize1" 
                    class="pagination-sm no-margin pull-right" items-per-page="itemsperPage1" boundary-links="true" rotate="false" 
                    num-pages="numPages1" ng-change="pageChanged1()"></pagination>
                  </div>



                    </div>

                  <div class="box-footer">
                    <a href="/cashes" class="btn btn-danger">salir</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
        </section><!-- /.content -->


