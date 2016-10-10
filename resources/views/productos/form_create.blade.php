<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Productos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/products">Productos</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Producto</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="productCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                        </div>
                        <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" ng-class="{true: 'has-error'}[ productCreateForm.nombreProducto.$error.required && productCreateForm.$submitted || productCreateForm.nombreProducto.$dirty && productCreateForm.nombreProducto.$invalid]">
                              <label for="nombres">Nombre</label>
                              <input type="text" class="form-control" name="nombreProducto" placeholder="Nombre" ng-model="producto.nombreProducto" ng-blur="validaNombre2(producto.nombreProducto)" typeahead-on-select="validarNombre()" typeahead="producto as producto.proNombre for producto in products | filter:$viewValue | limitTo:8" required>
                              <label ng-show="productCreateForm.$submitted || productCreateForm.nombreProducto.$dirty && productCreateForm.nombreProducto.$invalid">
                                <span ng-show="productCreateForm.nombreProducto.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                              </label>
                            </div>
                          </div>
                        <div class="col-md-4">
                          <div class="form-group" ng-class="{'has-error': almacenCreateForm.tipo_medicamento.$invalid,'has-success':almacenCreateForm.tipo_medicamento.$invalid}">
                            <label>Tipo Producto</label>
                            <select class="form-control ng-pristine ng-valid ng-touched" name="tipo_medicamento" ng-model="producto.tipo_medicamento" required>
                              <option value="">-- Elige Tipo de Producto --</option>
                              <option value="MEDICAMENTO">MEDICAMENTO</option>
                              <option value="PERFUMERIA">PERFUMERIA</option>
                              <option value="BAZAR">BAZAR</option>
                            </select>
                            <label ng-show="almacenCreateForm.tipo_medicamento.$error.required">
                                <span ng-show="almacenCreateForm.tipo_medicamento.$error.required"><i class="fa fa-times-circle-o"></i>El campo DNI es Requerido. 
                                </span>
                              </label>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" ng-class="{true: 'has-error'}[ productCreateForm.codigo.$error.required && productCreateForm.$submitted || productCreateForm.codigo.$dirty && productCreateForm.codigo.$invalid]">
                              <label for="codigo">Código de Producto</label>
                              <input type="text" class="form-control" name="codigo" placeholder="1000" ng-model="producto.codigo" required>
                              <label ng-show="productCreateForm.$submitted || productCreateForm.codigo.$dirty && productCreateForm.codigo.$invalid">

                                <span ng-show="productCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                              </label>
                              <span class="text-info"> <em> Identificador único para este producto.</em></span>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                                               <label>Imagen</label>
                                               <input type="file" ng-model="producto.imagen" id="productImage" name="productImage"/>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Presentación Base:</label>
                            <select  class="form-control" ng-model="producto.presentation_base_object" ng-change="changePreBase()" ng-options="item as item.nombre for item in presentations_base">
                                <option value="">-- Elige Presentación Base--</option>
                            </select>
                        </div>
                        </div>
                       
                   <div class="col-md-4">
                          <div class="form-group">
                                                <label>Marca <a class="btn btn-xs btn-info btn-flat" ng-click="addBrand()">+</a></label>
                                                <select name="marca" class="form-control" ng-model="producto.marca_id" ng-options="k as v for (k, v) in marcas">
                                                 <option value="">--Elige Marca--</option>
                                                    <option value="">+Agrega Marca</option>
                                                </select>

                          </div></div>
                    </div>
                   

                    </div>
                    <div class="form-group" >
                      <label for="estado">¿Puede ser vendido/comprado?</label>
                      <input type="checkbox" name="estado" ng-model="producto.estado" ng-checked="producto.estado"/>
                     </div>

                    <div class="form-group" >
                      <label for="notas">Descripción</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..."
                      ng-model="producto.descripcion" rows="4" cols="50"></textarea>
                     </div>


                      <div class="box box-default" id="variants">
                                          <div class="box-header with-border">
                                            <h3 class="box-title">Variantes</h3>
                                            <div class="box-tools pull-right">
                                              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div><!-- /.box-tools -->
                                          </div><!-- /.box-header -->
                                          <div class="box-body">
                                            <div class="form-group" >
                                                                                       <label for="variantes">¿Producto con Variantes?</label>
                                                                                       <input type="checkbox" name="variantes" ng-model="producto.hasVariants" ng-checked="producto.hasVariants"/>
                                                                    <span class="text-info"> <em> Si su producto cuenta con atributos específicos tales como: Color, Talla, etc. Active este item y agregue las variantes una vez creado el producto.</em></span>
                                                                  </div>
                                          </div><!-- /.box-body -->
                                        </div><!-- /.box -->
<!--  =============================================================================PRESENTACIONES===============================================================-->
<div class="box box-default" id="price" ng-hide="producto.hasVariants">
                                                                  <div class="box box-default" id="price">
                            <div class="box-header with-border">
                                <h3 class="box-title">Presentaciones del Producto     </h3>
                                <button class="btn btn-xs btn-info btn-flat" data-toggle="modal" data-target="#presentacion" ng-click="traerPres(variant.presentacionBase)" ng-disabled="enabled_presentation_button" >Añadir Presentación</button>
                                <button class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#createpresentation"  ng-disabled="enabled_createpresentation_button" >Crear Presentación</button>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">

                                <div class="row">

                                    <div class="col-md-12">
                                       <div class="box-body table-responsive no-padding">
                                            <table class="table table-bordered">
                                                <tbody><tr>
                                                    <th>#</th>
                                                    <th>Presentación</th>
                                                    <th>Precio de Proveedor Soles</th>
                                                    <th>Tipo de Cambio</th>
                                                    <th>Precio de Proveedor Dólares</th>
                                                    <th>% de Utilidad</th>
                                                    <th>Cant. de Utilidad</th>
                                                    <th>Precio de Venta</th>
                                                    <th>% Descuento</th>
                                                    <th>Cant de Descuento</th>
                                                    <th>PVP</th>
                                                    <th>Dscto Rango Activado</th>
                                                    <th>Fecha Inicio</th>
                                                    <th>Fecha Fin</th>
                                                    <th>% Descuento</th>
                                                    <th>Cant de Descuento</th>
                                                    <th>PVP (Rango)</th>
                                                    <th>Opciones</th>
                                                </tr>
                                                <tr ng-repeat="row in producto.presentaciones">
                                                    <td>@{{$index + 1}}</td>
                                                    <td>@{{row.nombre}}</td>
                                                    <td>@{{row.suppPri}}</td>
                                                    <td>@{{row.cambioDolar}}</td>
                                                    <td>@{{row.suppPriDol}}</td>
                                                    <td>@{{row.markup}}</td>
                                                    <td>@{{row.markupCant}}</td>
                                                    <td>@{{row.price}}</td>
                                                    <td>@{{row.dscto}}</td>
                                                    <td>@{{row.dsctoCant}}</td>
                                                    <td>@{{row.pvp}}</td>
                                                    <td ng-if="row.activateDsctoRange == '1'" style="color:red;">SI</td>
                                                    <td ng-if="row.activateDsctoRange == '0'" style="color:red;">NO</td>
                                                    <td>@{{row.fecIniDscto}}</td>
                                                    <td>@{{row.fecFinDscto}}</td>
                                                    <td>@{{row.dsctoRange}}</td>
                                                    <td>@{{row.dsctoCantRange}}</td>
                                                    <td>@{{row.pvpRange}}</td>

                                                    <td>
                                                        <a href="" class="btn btn-warning btn-xs" ng-click="editPres(row, $index)"><i class="fa fa-fw fa-pencil"></i></a>
                                                        <a href="" class="btn btn-danger btn-xs" ng-click="deletePres($index)"><i class="fa fa-fw fa-trash"></i></a>
                                                    </td>
                                                </tr>



                                                </tbody></table></div> <!--div responsive-->
                                    </div>


                                </div>
                            </div><!-- /.box-body -->


                        </div><!-- /.box -->

                                                                  </div><!-- /.box -->

<!--  =============================================================================PRECIO DEL PRODUCTO.. ya no se usa===============================================================-->

         <!--                                <div class="box box-default" id="price">
                                                                    <div class="box-header with-border">
                                                                      <h3 class="box-title">Precio del Producto</h3>
                                                                      <div class="box-tools pull-right">
                                                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                      </div>
                                                                      </div>
                                                                      <div class="box-body">
                                                                                <div class="callout callout-default">
                                                                                    <p>Si el producto presenta Variantes. El precio del mismo se establecerá al momento de crear las Variantes.</p>
                                                                                  </div>
                                                                                  <div class="row">
                                                                                  <div class="col-md-2 col-md-offset-3">
                                                                              <div class="form-group" >

                                                                                     <label for="suppPric">Precio de Compra</label>
                                                                                      <input type="number" class="form-control" name="suppPric" placeholder="0.00"
                                                                                                    ng-model="producto.suppPri" ng-disabled="producto.hasVariants"  ng-blur="calculateSuppPric()" step="0.1">

                                                                              </div>
                                                                              </div>
                                                                               <div class="col-md-2"><div class="form-group" >

                                                                                                                                                                                    <label for="suppPric">% de Ganancia</label>
                                                                                                                                                                                     <input type="number" class="form-control" name="markup" placeholder="0.00"
                                                                                                                                                                                                   ng-model="producto.markup" ng-blur="calculateMarkup()" ng-disabled="producto.hasVariants" step="0.1">

                                                                                                                                                                             </div></div>
                                                                                <div class="col-md-2"><div class="form-group" >

                                                                                                                                                                                     <label for="suppPric">Precio de Venta</label>
                                                                                                                                                                                      <input type="number" class="form-control" name="price" placeholder="0.00"
                                                                                                                                                                                                    ng-model="producto.price" ng-blur="calculatePrice()" ng-disabled="producto.hasVariants" step="0.1">

                                                                                                                                                                              </div></div>
                                                                      </div>
                                                                    </div>
                                                                        <div class="overlay" >
                                                                        </div>

                                                                  </div> -->

<!--  =============================================================================FIN PRECIO DEL PRODUCTO.. ya no se usa===============================================================-->
<!--  =============================================================================INVENTARIOS===============================================================-->
                         <div class="box box-default" id="inventory" ng-hide="producto.hasVariants">
                                                                   <div class="box-header with-border">
                                                                     <h3 class="box-title">Inventario</h3>
                                                                     <div class="box-tools pull-right">
                                                                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                     </div><!-- /.box-tools -->
                                                                   </div><!-- /.box-header -->
                                                                   <div class="box-body">
                                                                   <div class="row">
                                                                   <div class="col-md-2">
                                                                   <div class="form-group">
                                                                   <label for="sku">Sku: <br>(Stock Keep Unit) </label>

                                                                   </div>
                                                                   </div>
                                                                   <div class="col-md-2">
                                                                   <div class="form-group">
                                                                    <input class="form-control" name="sku" type="text" ng-model="producto.sku" ng-disabled="producto.hasVariants || producto.autogenerado" ng-required="!producto.hasVariants && !producto.autogenerado"/>
                                                                   <span style="color:#dd4b39;" ng-show="productCreateForm.sku.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                                                   </div>
                                                                   </div>
                                                                       <div class="col-md-2">
                                                                           <div class="form-group">
                                                                               <input type="checkbox" ng-model="producto.autogenerado"> Autogenerado
                                                                               </div>
                                                                       </div>
                                                                   </div>
                                                                     <div class="form-group" >
                                                                                                                <label for="variantes">¿Desea seguir el stock del Producto?</label>
                                                                                                                <input type="checkbox" name="trackeo" ng-model="producto.track" ng-checked="producto.track" ng-disabled="producto.hasVariants"/>

                                                                                             <span class="text-info"> <em> </em></span>

                                                                                             <div class="" ng-show="producto.track && !producto.hasVariants">

                                                                                                 <div class="box-tools">
                                                                                                     <div class="input-group" style="width: 150px;">
                                                                                                         <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search" ng-model="query">
                                                                                                         <div class="input-group-btn">
                                                                                                             <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                                                                                         </div>
                                                                                                     </div>
                                                                                                 </div>

                                                                                                <span ng-repeat="row in warehouses | filter:query">
                                                                                                <div class="col-md-5">
                                                                                                <div class="form-group" >
                                                                                                 <label for=""></label>
                                                                                                   <h5>@{{ row.nombre }}</h5>
                                                                                                   <input type="text" class="hidden" ng-model="producto.stock[$index].warehouse_id" ng-init="producto.stock[$index].warehouse_id = row.id"/>

                                                                                                </div></div>

                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                    <label for="suppPric">Stock Actual</label>
                                                                                                    <input type="number" class="form-control" name="markup" min="0" placeholder="0.00"  ng-model="producto.stock[$index].stockActual" ng-disabled="producto.hasVariants || !producto.track" step="0.1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                    <label for="suppPric">Stock Mínimo</label>
                                                                                                     <input type="number" class="form-control" name="markup" min="0" placeholder="0.00"  ng-model="producto.stock[$index].stockMin" ng-disabled="producto.hasVariants || !producto.track" step="0.1">
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                <div class="form-group" >
                                                                                                     <label for="suppPric">Costo Mínimo</label>
                                                                                                      <input type="number" class="form-control" name="markup" min="0" placeholder="0.00"  ng-model="producto.stock[$index].stockMinSoles" ng-disabled="producto.hasVariants || !producto.track" step="0.1">
                                                                                                        </div>
                                                                                                </div>
                                                                                                 </span>


                                                                                             </div>
                                                                                           </div>
                                                                   </div><!-- /.box-body -->
                                                                    <div class="overlay" ng-class="{ 'hidden': !producto.hasVariants}">
                                                                    </div>
                                                                 </div>
<!--  =============================================================================FIN INVENTARIO===============================================================-->
                    <script>
                        $("#variants").activateBox();
                        $("#price").activateBox();
                        $("#inventory").activateBox();
                    </script>
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button id="btn_generate" data-loading-text="Enviando.." type="submit" class="btn btn-primary" ng-click="createProduct()" >Crear</button>
                    <a href="/products" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->



            <!-- =============================Modal de Presentacion ================================ -->

<div class="modal fade bs-example-modal-sm" id="presentacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Añadir Presentación</h4>

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="suppPric">Elige Presentación(Unidades, paquetes, six pack.)</label>
                            <select name="" ng-click="selectPres()" class="form-control" id="" ng-model="presentationSelect" ng-options="item as item.nombre+' / '+item.shortname+' / '+item.cant for item in presentaciones">
                                <option value="">-- Elige Presentación--</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="suppPric">Cambio de Dolar</label>
                        <input type="number" name="table_search" class="form-control pull-rigt" string-to-number ng-model="presentacion.cambioDolar" ng-change="calculateCambioDolar()">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control hidden" name="presentacion.nombre" ng-model="presentacion.nombre">
                        <div class="form-group" >
                            <label for="suppPric">Precio de Compra (S/.)</label>
                            <input type="number" class="form-control" name="suppPric1" string-to-number placeholder="0.00" ng-model="presentacion.suppPri" ng-change="calculateSuppPric()" step="0.1">
                            <label for="suppPriDolar">Precio de Compra + IGV ($USS)</label>
                            <input type="number" class="form-control" name="suppPriDolar" string-to-number placeholder="0.00" ng-model="presentacion.suppPriDol" ng-change="calculateSuppPricDol1()" step="0.1">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" > 
                            <label for="suppPric">% de Ganancia</label> 
                            <input type="number" class="form-control" name="markup1" string-to-number placeholder="0.00" ng-model="presentacion.markup" ng-change="calculateMarkup()" step="0.1">
                            <label for="suppPric">Precio de Compra Sin IGV ($USS)</label>
                            <input type="number" class="form-control" name="markup1" string-to-number placeholder="0.00" ng-model="presentacion.sinIgv" ng-change="calcularigv()" step="0.1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="suppPric">Precio de Venta</label>
                            <input type="number" class="form-control" name="price1" string-to-number placeholder="0.00" ng-model="presentacion.price" ng-change="calculatePrice()" step="0.1">
                            <label for="suppPric">Cant. de Ganancia</label>
                            <input type="number" class="form-control" name="suppPriDolar" string-to-number placeholder="0.00" ng-model="presentacion.markupCant" ng-change="calculateMarkupCant()" step="0.1">

                        </div>
                    </div>
                </div>
                <h3>Descuentos</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="suppPric">% Descuento</label>
                            <input type="number" class="form-control" name="" string-to-number placeholder="0.00" ng-model="presentacion.dscto" ng-change="calculateDscto()" step="0.1">
                            <label for="suppPric">Cant Descuento</label>
                            <input type="number" class="form-control" name="" string-to-number placeholder="0.00" ng-model="presentacion.dsctoCant" ng-change="calculateDsctoCant()" step="0.1">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="suppPric">% PVP</label>
                        <input type="number" class="form-control" string-to-number  ng-model="presentacion.pvp" step="0.1" ng-change="calculatePVP()">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h4>Descuentos por Rango</h4></div> <div class="col-md-4"><h4><input type="checkbox" ng-model="presentacion.activateDsctoRange"> Activar</h4></div>
                </div>
                <div class="row" ng-show="presentacion.activateDsctoRange">
                    <div class="col-md-4">

                        <div class="form-group" >
                            <label for="suppPric">Fecha de Inicio</label>
                            <input type="date" class="form-control" ng-model="presentacion.fecIniDscto" ng-change="">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="suppPric">Fecha de Fin</label>
                            <input type="date" class="form-control" ng-model="presentacion.fecFinDscto" ng-change="">

                        </div>
                    </div>

                </div>

                <div class="row" ng-show="presentacion.activateDsctoRange">
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="suppPric">% Descuento</label>
                            <input type="number" class="form-control" name="" string-to-number placeholder="0.00" ng-model="presentacion.dsctoRange" ng-change="calculateDsctoRange()" step="0.1">
                            <label for="suppPric">Cant Descuento</label>
                            <input type="number" class="form-control" name="" string-to-number placeholder="0.00" ng-model="presentacion.dsctoCantRange" ng-change="calculateDsctoCantRange()" step="0.1">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="suppPric">% PVP (Rango)</label>
                            <input type="number" class="form-control" string-to-number ng-model="presentacion.pvpRange" ng-change="calculatePVPRange()">

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="AddPres1()" data-dismiss="modal" ng-hide="presentacion.edit">Grabar Cambios</button>
                <button type="button" class="btn btn-primary" ng-click="UpdatePres()" data-dismiss="modal" ng-show="presentacion.edit">Editar Cambios</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ======================================================================================== -->


<!-- =============================Modal CREATE de Presentacion ================================ -->

<div class="modal fade bs-example-modal-sm" id="createpresentation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Crear Presentación</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" class="form-control" name="preAdd.preBase_id" ng-model="producto.presentacionBase">
                        <div class="form-group" >
                            <label for="suppPric">Nombre</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Docena" ng-model="preAdd.nombre">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" > <label for="suppPric">Shortname</label>
                            <input type="text" class="form-control" name="shortname" placeholder="DO12" ng-model="preAdd.shortname">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="suppPric">Equiv (@{{ producto.presentation_base_object.nombre }})</label>
                            <input type="number" class="form-control" name="equiv" placeholder="12.00" ng-model="preAdd.cant" min="0">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" ng-click="createPres(producto.presentacionBase)" data-dismiss="modal">Crear</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ======================================================================================== -->

<!-- =============================Modal de Marca ================================ -->
<script type="text/ng-template" id="myModalContent.html">
    <div class="modal-header">
        <h3 class="modal-title">Crear Marca</h3>
    </div>
    <div class="modal-body">


        <form name="marcaCreateForm" role="form" novalidate>
            <div class="box-body">
                <div class="callout callout-danger" ng-show="errors">
                    <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                </div>

                <div class="form-group" ng-class="{true: 'has-error'}[ marcaCreateForm.nombre.$error.required && marcaCreateForm.$submitted || marcaCreateForm.nombre.$dirty && marcaCreateForm.nombre.$invalid]">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" ng-blur="validanomMarca()" name="nombre" placeholder="Nombre" ng-model="marca.nombre" required>
                    <label ng-show="marcaCreateForm.$submitted || marcaCreateForm.nombre.$dirty && marcaCreateForm.nombre.$invalid">
                        <span ng-show="marcaCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                
                <div class="form-group" >
                    <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                                ng-model="marca.descripcion" rows="4" cols="50"></textarea>
                </div>

            </div><!-- /.box-body -->

        </form>



    </div>
    <div class="modal-footer">
        <button id="btn_generateMarca" data-loading-text="Enviando.." class="btn btn-primary" type="button" ng-click="createMarca()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancelMarca()">Cancelar</button>
    </div>
</script>
<!-- =============================END Modal de Marca ================================ -->

<!-- =============================Modal de Linea ================================ -->
<script type="text/ng-template" id="myModalContent2.html">
    <div class="modal-header">
        <h3 class="modal-title">Crear Línea</h3>
    </div>
    <div class="modal-body">


        <form name="TtypeCreateForm" role="form" novalidate>
            <div class="box-body">
                <div class="callout callout-danger" ng-show="errors">
                    <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                </div>

                <div class="form-group" ng-class="{true: 'has-error'}[ TtypeCreateForm.nombre.$error.required && TtypeCreateForm.$submitted || TtypeCreateForm.nombre.$dirty && TtypeCreateForm.nombre.$invalid]">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="Ttype.nombre" required>
                    <label ng-show="TtypeCreateForm.$submitted || TtypeCreateForm.nombre.$dirty && TtypeCreateForm.nombre.$invalid">
                        <span ng-show="TtypeCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" ng-class="{true: 'has-error'}[ TtypeCreateForm.shortname.$error.required && TtypeCreateForm.$submitted || TtypeCreateForm.shortname.$dirty && TtypeCreateForm.shortname.$invalid]">
                    <label for="nombre">ShortName</label>
                    <input type="text" class="form-control" name="shortname" placeholder="Nombre" ng-model="Ttype.shortname" required>
                    <label ng-show="TtypeCreateForm.$submitted || TtypeCreateForm.shortname.$dirty && TtypeCreateForm.shortname.$invalid">
                        <span ng-show="TtypeCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" >
                    <label for="descripcion">Descripcion</label>
                      <textarea type="descripcion" class="form-control" name="descripcion" placeholder="Decripcion"
                                ng-model="Ttype.descripcion" rows="4" cols="50"></textarea>
                </div>

            </div><!-- /.box-body -->


        </form>



    </div>
    <div class="modal-footer">
        <button id="btn_generateLinea" data-loading-text="Enviando.." class="btn btn-primary" type="button" ng-click="createLine()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancelLine()">Cancelar</button>
    </div>
</script>
<!-- =============================END Modal de Linea ================================ -->

<!-- =============================Modal de Material ================================ -->
<script type="text/ng-template" id="myModalContent3.html">
    <div class="modal-header">
        <h3 class="modal-title">Crear Material</h3>
    </div>
    <div class="modal-body">


        <form name="materialCreateForm" role="form" novalidate>
            <div class="box-body">
                <div class="callout callout-danger" ng-show="errors">
                    <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                </div>

                <div class="form-group" ng-class="{true: 'has-error'}[ materialCreateForm.nombre.$error.required && materialCreateForm.$submitted || materialCreateForm.nombre.$dirty && materialCreateForm.nombre.$invalid]">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="material.nombre" required>
                    <label ng-show="materialCreateForm.$submitted || materialCreateForm.nombre.$dirty && materialCreateForm.nombre.$invalid">
                        <span ng-show="materialCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" ng-class="{true: 'has-error'}[ materialCreateForm.shortname.$error.required && materialCreateForm.$submitted || materialCreateForm.shortname.$dirty && materialCreateForm.shortname.$invalid]">
                    <label for="shortname">ShortName</label>
                    <input type="text" class="form-control" name="shortname" placeholder="ShortName" ng-model="material.shortname" required>
                    <label ng-show="materialCreateForm.$submitted || materialCreateForm.shortname.$dirty && materialCreateForm.shortname.$invalid">
                        <span ng-show="materialCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" >
                    <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                                ng-model="material.descripcion" rows="4" cols="50"></textarea>
                </div>

            </div><!-- /.box-body -->


        </form>



    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="button" ng-click="createMaterial()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancelMaterial()">Cancelar</button>
    </div>
</script>
<!-- =============================END Modal de Material ================================ -->

<!-- =============================Modal de Material ================================ -->
<script type="text/ng-template" id="myModalContent4.html">
    <div class="modal-header">
        <h3 class="modal-title">Crear Estación</h3>
    </div>
    <div class="modal-body">


        <form name="stationCreateForm" role="form" novalidate>
            <div class="box-body">
                <div class="callout callout-danger" ng-show="errors">
                    <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                </div>

                <div class="form-group" ng-class="{true: 'has-error'}[ stationCreateForm.nombre.$error.required && stationCreateForm.$submitted || stationCreateForm.nombre.$dirty && stationCreateForm.nombre.$invalid]">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="station.nombre" required>
                    <label ng-show="stationCreateForm.$submitted || stationCreateForm.nombre.$dirty && stationCreateForm.nombre.$invalid">
                        <span ng-show="stationCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" ng-class="{true: 'has-error'}[ stationCreateForm.shortname.$error.required && stationCreateForm.$submitted || stationCreateForm.shortname.$dirty && stationCreateForm.shortname.$invalid]">
                    <label for="shortname">ShortName</label>
                    <input type="text" class="form-control" name="shortname" placeholder="ShortName" ng-model="station.shortname" required>
                    <label ng-show="stationCreateForm.$submitted || stationCreateForm.shortname.$dirty && stationCreateForm.shortname.$invalid">
                        <span ng-show="stationCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" >
                    <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                                ng-model="station.descripcion" rows="4" cols="50"></textarea>
                </div>

            </div><!-- /.box-body -->


        </form>



    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="button" ng-click="createStation()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancelStation()">Cancelar</button>
    </div>
</script>
<!-- =============================END Modal de Estación ================================ -->