<section class="content-header">
          <h1>
            Tiendas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/stores">Tiendas</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Tiendas</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="purchaseCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
  <div class="row">
     <div class="col-md-4">
          <label>Proveedor</label>
          <div class="input-group">
                      <input type="text" ng-model="purchase.empresa"  name="table_search" class="form-control input-sm pull-right" placeholder="Search" />
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default" data-toggle="modal" ng-click="searchsupplier()" data-target="#miventana" ><i class="fa fa-search"></i></button>
                      </div>
                    </div> 
      </div> 
     
  
  
  <div class="col-md-4">
                      <div class="form-group" ng-class="{true: 'has-error'}[ employeeCreateForm.fechanac.$error.required && employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid]">
                    <label for="fechanac">Fecha Pedido</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control" name="fechanac" ng-model="purchase.fechaPedido">
                      <label ng-show="employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid">
                                              <span ng-show="employeeCreateForm.fechanac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div></div>  
  </div>
  <div class="col-md-4">
                      <div class="form-group" ng-class="{true: 'has-error'}[ employeeCreateForm.fechanac.$error.required && employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid]">
                    <label for="fechanac">Fecha Prevista</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control" name="fechanac" ng-model="purchase.fechaPrevista">
                      <label ng-show="employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid">
                                              <span ng-show="employeeCreateForm.fechanac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div></div> 
                   
    </div>
</div>
<div class="row">
   <div class="col-md-4">
                   <div class="form-group" >
                       <label for="Tienda">Almacen</label>
                       <select class="form-control" name="" ng-model="purchase.warehouses_id" ng-options="item.id as item.nombre for item in warehouses">
                       <option value="">--Elija Almacen--</option>
                       </select>
                     </div>
   </div>
</div>
               
                    <button type="submit" class="btn btn-primary" ng-click="createPurchase()">Crear</button>
                    <a href="/purchases" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
                <!-- =======================================================================================================Ventana Emergente Crear=================================-->
        <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
               <div style="border-radius: 5px" class="modal-content">
                 <div class="modal-header"  >
                   <button type="button"  class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                   <h4><b>Gastos Del Empleado </b></h4>
                   </div>
                   <div class="modal-body">

                    <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>

                      <th>Empresa</th>
                      <th>Nombre Completo </th>
                      <th>Ruc</th>
                      
                      
                      <th style="width: 40px">Seleccionar</th>
                    </tr>
                  <tr ng-repeat="row in suppliers">
                      <td>@{{$index + 1 + (currentPage-1)*itemsperPage}}</td>
                      <td>@{{row.empresa}}</td>
                      <td>@{{row.nombres+ " " + row.apellidos }}</td>
                      <td>@{{row.ruc}}</td>
                      
                      <td><a ng-click="asignarEmpresa(row)" class="btn btn-danger btn-xs">Eviar</a></td>
                      
                    </tr>               
                    
                    
                    
                  </table>
                  
                      
                     </div>
                    
               </div>
             </div>
           </div>
        </div>
        </div>
        <!-- ===================================================================================