<section class="content-header">
          <h1>
            Tipos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/types">Tipos</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Tipos</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="orderPurchaseCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                   
                    <table class="table table-striped">
                    <tr>
                      <th>Numero Factura</th>
                      <th>Monto Total</th>
                      <th>Monto Adelantado</th>
                      <th>Saldo</th>
                      <th>Numero de compra</th>
                      <th>Proveedor</th>
                      <th></th>
                    </tr>
                    
                    <tr >
                      <td>@{{payment.NumFactura}}</td>
                      <td>@{{payment.MontoTotal}}</td>
                      <td>@{{payment.Acuenta}}</td>
                      <td>@{{payment.Saldo}}</td>
                      <td>@{{purchase.id}}</td>  
                      <td>@{{supplier.empresa}}</td>
              <td>
                 <progressbar class="progress-striped active" value="payment.PorPagado" type="@{{type}}">@{{payment.PorPagado}}%</progressbar>
               </td>
                    </tr>
                    
                    
                  </table>
                  
                </div><!-- /.box-body -->
      <div class="box-body">
<div class="row">
     <div ng-if="payment.Saldo>0" class="col-md-6" align="center">
                 <div  class="form-group" >
                      <b>Agrega Pago</b>
                 </div>
                 <table class="table table-striped" >
                    <tr>
                      <th >Fecha</th>
                      <th style="width: 200px">Metodo de Pago</th>
                      <th style="width: 150px">Monto Pagado</th>
                    </tr>
                <tr >
                <td >

                               <div  class="input-group">
                                        <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                        </div>
                                      <input  type="date"   class="form-control" name="fecha" ng-model="detPayment.fecha" required>
                                   </div>   
                                
                     
              </td>
              <td >
               <div class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.warehouse.$error.required && orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.warehouse.$dirty && orderPurchaseCreateForm.warehouse.$invalid]">
                       
                       <select ng-hide="show" class="form-control" name="warehouse" ng-click="" ng-model="detPayment.methodPayment_id" ng-options="item.id as item.nombre for item in methodPayments" required>
                       <option value="">--Elija Modo de Pago--</option>
                       </select>
                       <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.warehouse.$dirty && orderPurchaseCreateForm.warehouse.$invalid">
                                <span ng-show="orderPurchaseCreateForm.warehouse.$invalid"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
                 
              </td>
              <td>
                     <div class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.montoPagando.$error.required && orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.montoPagando.$dirty && orderPurchaseCreateForm.montoPagando.$invalid]" >
                       <input type="number" class="form-control" ng-model='detPayment.montoPagado' ng-blur='recalPayments()' name="montoPagando" placeholder="0.00"  step="0.1" required>
                      <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.montoPagando.$dirty && orderPurchaseCreateForm.montoPagando.$invalid">
                                <span ng-show="orderPurchaseCreateForm.montoPagando.$invalid"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                     </div>

              </td>
              </tr>
            </table>
        </div>
        <div class="col-md-6" align="center">
            <div class="form-group">
              <b>Pagos Realizados</b>
              </div>
            <table class="table table-striped" >
                    <tr>
                      <th>Fecha</th>
                      <th>Tipo de Pago</th>
                      <th>Monto Pagado</th>
                      <th>Tipo Pago</th>
                      <th>Descartar</th>
                    </tr>
                    
                    <tr ng-repeat="row in detPayments">
                      <td ng-hide="true">@{{row.id}}</td>
                      <td>@{{row.fecha}}</td>
                      <td>@{{row.nameMethod}}</td>
                      <td>@{{row.montoPagado}}</td>
                      <td ng-if="row.tipoPago=='A'"><span class="badge bg-blue">@{{row.tipoPago}}</span></td> 
                      <td ng-if="row.tipoPago=='P'"><span class="badge bg-green">@{{row.tipoPago}}</span></td> 
                     <td><button type="button" class="btn btn-danger btn-xs"  ng-click="destroyPay(row)">
                        <span class="glyphicon glyphicon-trash"></span></td>
                    </tr>
                    
                    
                  </table>
                  <div class="box-footer clearfix">
                  <pagination total-items="totalItems" ng-model="currentPage" max-size="maxSize" 
                  class="pagination-sm no-margin pull-right" items-per-page="itemsperPage" boundary-links="true" 
                  rotate="false" num-pages="numPages" ng-change="pageChanged()"></pagination>



                </div>
            </div>
      </div>
            <div ng-if="payment.Saldo>0" class="form-group" >
                    <button class=" label-default" type='submit' ng-click='createdetPayment()' >Registrar Pago</button>  
                  </div> 
        </div>
     
             
                  <div class="box-footer">
                    
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->