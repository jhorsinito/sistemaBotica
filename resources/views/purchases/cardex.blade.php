 <section class="content-header">
          <h1>
            Cardex
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/purchases"><i class="fa fa-dashboard"></i>compras</a></li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Cardex</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="storeCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                    
        <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-8">
              <div class="input-group" style="width: 600px;">
                  <label>Producto</label>
              
                  <input  typeahead-on-select="asignarProduc1()" type="text" ng-model="product.proId" placeholder="Locations loaded via $http" 
                  typeahead="variant as variant.proNombre+'('+(variant.BraName==null ? '': variant.BraName+'/')+(variant.TName==null ? '' : variant.TName+'/')+(variant.Mnombre==null ? '':variant.Mnombre+'/')+(variant.NombreAtributos==null ? '':variant.NombreAtributos)+')' for variant in variants1 | filter:$viewValue | limitTo:8" 
                  typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"
                  tooltip="Ingrese caracteres para busacar producto por codigo unico"
                  >
                 <i ng-show="loadingLocations" class="glyphicon glyphicon-refresh"></i>
                 <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> No Results Found
                 </div>
            
             </div> 
          </div>
          <div class="col-md-2">
             <div class="form-group" >
                <label for="Variante">Tienda: </label>
                <select   ng-change="" class="form-control"   ng-model="purchase.tienda" ng-options="item.id as item.nombreTienda for item in stores">
                  
                </select>
                <!--@{{variants.varid}}-->
                </div>
          </div>
      </div>    
      <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-3">
             <div class="form-group" >
                <label for="Variante">Generar Reporte de:</label>
                <select   ng-change="" class="form-control"   ng-model="purchase.tipoMov" >
                  <option value="">Elejir una opcion</option>
                  <option value="Entrada">Entradas</option>
                  <option value="Salida por Venta">Salida por Venta</option>
                  <option value="Salida">Salidas</option>
                  <option value="Compra">Compras</option>
                  <option value="Venta">Venta</option>
                  <option value="Transferencia">Transferencias</option>
                  <option value="masVendido" ng-disabled="product.proId!=null">Producto mas Vendido</option>
                  <option value="menVendido" ng-disabled="product.proId!=null">Producto menos vendido</option>
                  <option value="topMasVendido" ng-disabled="product.proId!=null">Top 10 mas vendido</option>
                  <option value="topMasVendido" ng-disabled="product.proId!=null">Top 10 menos vendidos</option>
                </select>
                <!--@{{variants.varid}}-->
                </div>
          </div>
          <div ng-show="purchase.tipoMov=='masVendido'  || purchase.tipoMov=='menVendido' ||
          purchase.tipoMov=='topMasVendido' || purchase.tipoMov=='topMasVendido'"class="col-md-3">
             <div class="form-group" >
                <label for="Variante">Elija movimiento</label>
                <select   ng-change="" class="form-control"   ng-model="purchase.tipoMov2" >
                  <option value="Compra" selected>Compra</option>
                  <option value="Venta">Venta</option>
                 </select>
                <!--@{{variants.varid}}-->
                </div>
          </div>
           <div class="col-md-3">
             <div class="form-group" >
                <label for="Variante">Del:</label>
                <select   ng-change="filtrarCardex()" class="form-control"   ng-model="purchase.tiempo" >
                  <option value="">Elejir</option>
                  <option value="dia">Ultimo dia</option>
                 <!-- <option value="semana">Ultima Semana</option>-->
                  <option value="mes">Ultimo mes</option>
                  <option value="año">Ultimo año</option>
                  <option value="otro">Rango de Fechas</option>
                </select>
                <!--@{{variants.varid}}-->
                </div>
          </div>
          
           
      </div>
      <div class="row">
      <div class="col-md-1">
      </div>
        <div ng-show="purchase.tiempo=='otro'" class="col-md-2">
                  <div  class="form-group">
                                <label for="fechaPedido">Rango de Fechas</label>
                            <div  class="input-group">
                                <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                </div>
                                  <input  type="date" class="form-control"  ng-change="filtrarCardex()" name="fechaPedido" ng-model="purchase.fechaini">
                            </div>
                  </div>
          </div>
          <div ng-show="purchase.tiempo=='otro'" class="col-md-3">
                  <div  class="form-group" ng-class="{true: 'has-error'}[ inputStocksCreateForm.fechaPrevista.$error.required && inputStocksCreateForm.$submitted || inputStocksCreateForm.fechaPrevista.$dirty && inputStocksCreateForm.fechaPrevista.$invalid]">
                            <label for="fechaPrevista"><---></label>
                                <div  class="input-group">
                                        <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                        </div>
                                      <input  ng-disabled="purchase.fechaini==null" type="date"  ng-change="filtrarCardex()" min="@{{purchase.fechaini}}" class="form-control" name="fechaPrevista" ng-model="purchase.fechafin" required>
                                   </div>   
                                  <label ng-show="inputStocksCreateForm.$submitted || inputStocksCreateForm.fechaPrevista.$dirty && inputStocksCreateForm.fechaPrevista.$invalid">
                                         <span ng-show="inputStocksCreateForm.fechaPrevista.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                      </label>
                            
                      </div> 
          </div>
      </div>
      <div class="row">
          <div class="col-md-1"></div>
              <div  class="col-md-6">
                 <button  ng-click="GenerateRportCardex()" class="btn btn-danger">@{{textgeneratecardex}}</button>
                 <a ng-href="@{{reportCardex}}" target="_blank" class="btn btn-primary">Ver Reporte</a>
              </div>

       </div> 
       <hr>
       <div class="row">
            <div class="col-md-1"></div>
              <div  class="col-md-6">
               <h2>Reporte Mejores Clientes/Empleados</h2>
              </div>

       </div>   <hr>   
        <div class="row">
                <div class="col-md-1">  </div>
                    <div class="col-md-4">                             
                            <label for="fechaPedido">Fecha Inicio: </label>
                            <div ng-hide="show" class="input-group">
                                <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                </div>
                                  <input type="date" class="form-control"  name="fechainicio" ng-model="fechainicio" >
                            </div>                          
                        </div> 
                         <div class="col-md-4">                             
                            <label for="fechaPedido">Fecha Fin: </label>
                            <div ng-hide="show" class="input-group">
                                <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                </div>
                                  <input type="date" class="form-control"  ng-model="fechafin" >
                            </div>                          
                        </div>
                        <div class="col-md-2"> 
                        <label>Cantidad</label> <br>
                        <input  type="number" class="form-control" ng-model="limit">
                        </div>
                </div>
                 <div class="row">
                      <div class="col-md-1">  </div>
                      <div class="col-md-2"> 
                        <label></label> <br>
                        <input ng-disabled="fechafin<fechainicio" type="button" class="btn btn-warning" ng-click="ReportMejoresCliente()" value="@{{decriboton}}">
                      </div>
                      <div class="col-md-2"> 
                        <label></label> <br>
                        <input ng-disabled="fechafin<fechainicio" type="button" class="btn btn-warning" ng-click="ReportMejoresEmpleados()" value="@{{decriboton1}}">
                      </div>
                 </div>
                <br>    
       <!-- <div class="row">
        <div class="col-md-1"></div>
              <div  class="col-md-6">
                     <div class="input-group" style="width: 100%;">
                  <label>Producto</label>
              
                  <input  typeahead-on-select="Inventario()" type="text" ng-model="producto.proId" placeholder="Locations loaded via $http" 
                  typeahead="variant as variant.proCodigo+'-'+variant.proNombre+'('+(variant.BraName==null ? '': variant.BraName+'/')+(variant.TName==null ? '' : variant.TName+'/')+(variant.Mnombre==null ? '':variant.Mnombre+'/')+(variant.NombreAtributos==null ? '':variant.NombreAtributos)+')' for variant in variants1 | filter:$viewValue | limitTo:8" 
                  typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"
                  tooltip="Ingrese caracteres para busacar producto por codigo unico"
                  >
                 <i ng-show="loadingLocations" class="glyphicon glyphicon-refresh"></i>
                 <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> No Results Found
                 </div>
            
                  </div> 
              </div>
              <div class="col-md-3">
             <div class="form-group" >
                <label for="Variante">Almacen: </label>
                <select   ng-change="" class="form-control"   ng-model="purchase.almacen" ng-options="item.id as item.nombre for item in almacenes">
                  
                </select>
                <!--@{{variants.varid}}-
                </div>
          </div>
        </div> 
        <div class="row"> 
            <div class="col-md-1"></div>
           <div class="col-md-2">
               <label>Stock Actual:</label>
               <input ng-disabled="true" type="text" class="form-control" ng-model="comproStock.stockActual">
           </div>
           <div class="col-md-2">
               <label>Stock Real:</label>
               <input type="number" class="form-control" ng-model="comproStock.stockReal">
           </div>
           <div class="col-md-2">
               <label></label><br>
               <input type="submit" class="btn btn-info" ng-click="ActualizarStock()" value="Actualizar Stock">
           </div>
           <div class="col-md-2">
               <label></label><br>
               <input type="submit" class="btn btn-success" ng-click="limpiarCardex()" value="Limpiar">
           </div>
        </div> 
        <div class="row"> 
           <div class="col-md-1"></div>
           <div class="col-md-10">
               <table class="table table-striped">
                 <thead>
                   <th>Variante</th>
                   <th>Stock Actual</th>
                   <th>Stock Real</th>
                 </thead>
                 <tbody>
                   <tr ng-repeat="row in objectto">
                     <td>@{{row.producto}}</td>
                     <td>@{{row.stockActual}}</td>
                     <td>@{{row.stockReal}}</td>
                   </tr>
                 </tbody>
               </table>
           </div>
        </div>    -->      
     <div class="box-footer">
                    <a href="/purchases" class="btn btn-danger">Salir</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
