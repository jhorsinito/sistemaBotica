<section class="content-header">
          <h1>
            Ventas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/compras">Ventas</li>
            <li class="active">Ver</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Ventas</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="purchaseCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                       </div>
                                    
 <div class="box">  
                       <div  class="input-group">
                               <label>Cliente:</label>
                               <spam>@{{order1.customer.nombres+' '+order1.customer.apellidos +' - Empresa: '+order1.customer.empresa}}</spam>
                         </div>
                          <div class="input-group">
                                <label>vendedor:</label>
                               <spam>@{{order1.employee.nombres+' '+order1.employee.apellidos+' - Codigo: '+order1.employee.codigo}}</spam>
                         </div>
                          <div  class="input-group">
                               <label>Fecha de Venta:</label>
                               <spam>@{{order1.fechaPedido}}</spam>
                         </div>
                         <div>
                         <label>Venta</label>
                          <div class="row">
                            <div class="col-md-8">
                              <table  class="table table-bordered" id="tabla1">
                                <td><label>Monto Venta</label></td> <td>@{{order1.montoTotal}}</td>
                                <td><label>Sub total</label></td> <td>@{{order1.montoBruto}}</td>
                                <td><label>IGV</label></td> <td>@{{order1.igv}}</td>
                                <td><label>Descuento</label></td> <td>@{{order1.descuento+'%'}}</td>
                              </table>
                            </div> 
                          </div>
                           
                         </div>
                          
    </div>   

<!--=================================================================================================================-->
<!--==========================================Agregar Producto====================================-->
      <div class="box box-default"  id="price">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Producto</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div  class="box-body" style="display: block;">
          <table  class="table table-bordered" id="tabla1">
            <tr>
              <th style="width: 10px">#</th>
              <th>Producto</th>
              <th>Atributos</th>
              <th>Presentacion</th>
              <th>Precio Producto</th>
              <th>Precio Venta </th>
              <th>Cantidad</th>
              <th>Descuento</th>
              <th>Total</th>


              
            </tr>
            <tr  ng-repeat="row in detOrders">
                      <td>@{{$index + 1}}</td>
                      <td>@{{row.nameProducto}}</td>
                      <td>@{{row.NombreAtributos}}</td>
                      <td>@{{row.presentacion}}</td>
                      <td ng-hide="true">@{{row.purchases_id}}</td>
                      <td ng-hide="true">@{{row.detPres_id}}</td>
                      <td>@{{row.precioProducto}}</td>
                      <td>@{{row.precioVenta}}</td>
                      <td>@{{row.cantidad}}</td>
                      <td>@{{row.descuento}}</td>
                      <td>@{{row.subTotal}}</td>

                      
                      <!--<td><a ng-click="sacarRow(row.index,row.montoTotal)" class="btn btn-warning btn-xs">Sacar</a></td>
                      <td><a ng-click="EditarDetalles(row,row.index)" data-target="#miventanaEditRow" data-toggle="modal" class="btn btn-warning btn-xs">Edit</a></td>
                    -->
                    </tr> 
          </table>


        </div>
      </div>
  <!-- ==========================================================================================-->
       <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Detalle de Pagos</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="TtypeCreateForm" role="form" novalidate>
                  <div class="box-body">
                  
                   
                    <table class="table table-striped">
                    <tr>
                      <th>Numero Factura</th>
                      <th>Monto Total</th>
                      <th>Monto Adelantado</th>
                      <th>Saldo</th>
                      <th>Numero de compra</th>

                      <th></th>
                    </tr>
                    
                    <tr ng-repeat="row in payment">
                      <td>Hola</td>
                      <td>@{{row.MontoTotal}}</td>
                      <td>@{{row.Acuenta}}</td>
                      <td>@{{row.Saldo}}</td>
                      <td>@{{row.sale_id}}</td>  
                      
              <td><progressbar animate="false" value="dynamic" type="success"><b>10%</b></progressbar></td>

                    </tr>
                    
                    
                  </table>
                  
                </div><!-- /.box-body -->
      <div class="box-body">
<div class="row">
     <div  class="col-md-6" align="center">
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
                                      <input  type="date"   class="form-control" name="fecha" ng-model="detPago.fecha" required>
                                   </div>   
                                  
                     
              </td>
              <td >
               <div class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.warehouse.$error.required && orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.warehouse.$dirty && orderPurchaseCreateForm.warehouse.$invalid]">
                       
                       <select ng-hide="show" class="form-control" name="warehouse" ng-click="" ng-model="detPago.saleMethodPayment_id" ng-options="item.id as item.nombre for item in saleMethodPayments" required>
                       <option value="">--Elija Modo de Pago--</option>
                       </select>
                       <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.warehouse.$dirty && orderPurchaseCreateForm.warehouse.$invalid">
                                <span ng-show="orderPurchaseCreateForm.warehouse.$invalid"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                       
                    </div>
              </td>
              <td>
                     <div class="form-group" >
                       <input type="number" class="form-control" ng-model='detPago.monto' ng-blur='recalPayments()' name="markup" placeholder="0.00"  step="0.1">
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
                      <th># Caja</th>
                      <th>Descartar</th>
                    </tr>
                    
                    <tr ng-repeat="row in detPayments">
                      <td ng-hide="true">@{{row.id}}</td>
                      <td>@{{row.fecha}}</td>
                      <td>@{{row.sale_method_payment.nombre}}</td>
                      <td>@{{row.monto}}</td>
                      <td><a href="/cashes/edit/@{{row.numCaja}}" target="_blank">@{{row.numCaja}}</a></td>
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
            <div class="form-group" >
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

              <!-- ======================================================================= -->

          

        
                   <a href="/orders" class="btn btn-success btn-xs">Regresar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->