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
                    <div class="form-group" ng-class="{true: 'has-error'}[ productCreateForm.nombre.$error.required && productCreateForm.$submitted || productCreateForm.nombre.$dirty && productCreateForm.nombre.$invalid]">
                      <label for="nombres">Nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="product.nombre" required>
                      <label ng-show="productCreateForm.$submitted || productCreateForm.nombre.$dirty && productCreateForm.nombre.$invalid">
                        <span ng-show="productCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div></div>
                        <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ productCreateForm.codigo.$error.required && productCreateForm.$submitted || productCreateForm.codigo.$dirty && productCreateForm.codigo.$invalid]">
                      <label for="codigo">Código de Producto</label>
                      <input type="text" class="form-control" name="codigo" placeholder="1000"
                      ng-model="product.codigo" required>
                      <label ng-show="productCreateForm.$submitted || productCreateForm.codigo.$dirty && productCreateForm.codigo.$invalid">

                        <span ng-show="productCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                       <span class="text-info"> <em> Identificador único para este producto.</em></span>
                    </div></div>
                    <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ productCreateForm.suppCode.$error.required && productCreateForm.$submitted || productCreateForm.suppCode.$dirty && productCreateForm.suppCode.$invalid]">
                                          <label for="suppCode">Código de Proveedor</label>
                                          <input type="text" class="form-control" name="suppCode" placeholder="1000"
                                          ng-model="product.suppCode" required>
                                          <label ng-show="productCreateForm.$submitted || productCreateForm.suppCode.$dirty && productCreateForm.suppCode.$invalid">

                                            <span ng-show="productCreateForm.suppCode.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                           </label>
                                           <span class="text-info"> <em> Código del producto para el proveedor.</em></span>
                    </div>
                    </div></div>

                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                                               <label>Imagen</label>
                                               <input type="file" ng-model="product.image" id="productImage" name="productImage"/>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Presentación Base:</label>
                            <select  class="form-control" ng-model="product.presentation_base_object" ng-change="changePreBase()" ng-options="item as item.nombre for item in presentations_base">
                                <option value="">-- Elige Presentación Base--</option>
                            </select>
                        </div>
                        </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Modelo</label>
                            <input class="form-control" type="text" ng-model="product.modelo">
                        </div>
                      </div>
                    </div>
                   <div class="row">
                    <div class="col-md-3">
                          <div class="form-group">
                                                <label>Marca</label>
                                                <select name="brand" class="form-control" ng-model="product.brand_id" ng-options="k as v for (k, v) in brands">
                                                 <option value="">--Elige Marca--</option>
                                                </select>
                                                @{{ product.brand_id }}
                          </div></div>
                           <div class="col-md-3">
                            <div class="form-group">
                                                <label>Línea</label>
                                                <select name="ttype" class="form-control" ng-model="product.type_id" ng-options="k as v for (k, v) in types">
                                                 <option value="">--Elige Línea--</option>
                                                </select>
                          </div></div>
                           <div class="col-md-3">
                            <div class="form-group">
                                                <label>Material</label>
                                                <select name="material" class="form-control" ng-model="product.material_id" ng-options="k as v for (k, v) in materials">
                                                 <option value="">--Elige Material--</option>
                                                </select>
                          </div></div>
                           <div class="col-md-3">
                            <div class="form-group">
                                                <label>Estación</label>
                                                <select name="station" class="form-control" ng-model="product.station_id" ng-options="k as v for (k, v) in stations">
                                                 <option value="">--Elige Estación--</option>
                                                </select>
                          </div></div>

                    </div>
                    <div class="form-group" >
                      <label for="estado">¿Puede ser vendido/comprado?</label>
                      <input type="checkbox" name="estado" ng-model="product.estado" ng-checked="product.estado"/>
                     </div>
                     @{{product.estado}}
                    <div class="form-group" >
                      <label for="notas">Descripción</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..."
                      ng-model="product.descripcion" rows="4" cols="50"></textarea>
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
                                                                                       <input type="checkbox" name="variantes" ng-model="product.hasVariants" ng-checked="product.hasVariants"/>
                                                                    <span class="text-info"> <em> Si su producto cuenta con atributos específicos tales como: Color, Talla, etc. Active este item y agregue las variantes una vez creado el producto.</em></span>
                                                                  </div>
                                          </div><!-- /.box-body -->
                                        </div><!-- /.box -->
<!--  =============================================================================PRESENTACIONES===============================================================-->
<div class="box box-default" id="price">
                                                                    <div class="box-header with-border">
                                                                      <h3 class="box-title">Presentaciones del Producto     </h3>
                                                                        <button class="btn btn-xs btn-info btn-flat" data-toggle="modal" data-target="#presentation" ng-click="traerPres(product.presentation_base)" ng-disabled="enabled_presentation_button" >Añadir Presentación</button>
                                                                        <button class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#createpresentation"  ng-disabled="enabled_createpresentation_button" >Crear Presentación</button>
                                                                        <div class="box-tools pull-right">
                                                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                      </div><!-- /.box-tools -->
                                                                      </div><!-- /.box-header -->
                                                                      <div class="box-body">

                                                                                  <div class="row">

                                                                                        <div class="col-md-6 col-md-offset-3">
                                                                                            <table class="table table-bordered">
                                                                                                                <tbody><tr>
                                                                                                                  <th>#</th>
                                                                                                                  <th>Presentación</th>
                                                                                                                  <th>Precio de Proveedor</th>
                                                                                                                  <th>% de Utilidad</th>
                                                                                                                  <th>Precio de Venta</th>
                                                                                                                  <th>Opciones</th>
                                                                                                                </tr>
                                                                                                                <tr ng-repeat="row in product.presentations">
                                                                                                                  <td>@{{$index + 1}}</td>
                                                                                                                  <td>@{{row.nombre}}</td>
                                                                                                                  <td>@{{row.suppPri}}</td>
                                                                                                                  <td>@{{row.markup}}</td>

                                                                                                                  <td>@{{row.price}}</td>
                                                                                                                  <td><a class="btn btn-warning btn-xs" href="" ng-click="editPres($index)"><i class="fa fa-fw fa-pencil"></i></a>
                                                                                                                  <a href="" class="btn btn-danger btn-xs" ng-click="deletePres($index)"><i class="fa fa-fw fa-trash"></i></a>
                                                                                                                  </td>
                                                                                                                </tr>



                                                                                         </tbody></table>
                                                                                     </div>


                                                                                 </div>
                                                                    </div><!-- /.box-body -->
                                                                    <div class="overlay" ng-class="{ 'hidden': !product.hasVariants}">
                                                                    </div>

                                                                  </div><!-- /.box -->
                      form @{{ productCreateForm.$error}}
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
                                                                                                    ng-model="product.suppPri" ng-disabled="product.hasVariants"  ng-blur="calculateSuppPric()" step="0.1">

                                                                              </div>
                                                                              </div>
                                                                               <div class="col-md-2"><div class="form-group" >

                                                                                                                                                                                    <label for="suppPric">% de Ganancia</label>
                                                                                                                                                                                     <input type="number" class="form-control" name="markup" placeholder="0.00"
                                                                                                                                                                                                   ng-model="product.markup" ng-blur="calculateMarkup()" ng-disabled="product.hasVariants" step="0.1">

                                                                                                                                                                             </div></div>
                                                                                <div class="col-md-2"><div class="form-group" >

                                                                                                                                                                                     <label for="suppPric">Precio de Venta</label>
                                                                                                                                                                                      <input type="number" class="form-control" name="price" placeholder="0.00"
                                                                                                                                                                                                    ng-model="product.price" ng-blur="calculatePrice()" ng-disabled="product.hasVariants" step="0.1">

                                                                                                                                                                              </div></div>
                                                                      </div>
                                                                    </div>
                                                                        <div class="overlay" >
                                                                        </div>

                                                                  </div> -->

<!--  =============================================================================FIN PRECIO DEL PRODUCTO.. ya no se usa===============================================================-->
<!--  =============================================================================INVENTARIOS===============================================================-->
                         <div class="box box-default" id="inventory">
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
                                                                    <input class="form-control" name="sku" type="text" ng-model="product.sku" ng-disabled="product.hasVariants" ng-required="!product.hasVariants"/>
                                                                   <span style="color:#dd4b39;" ng-show="productCreateForm.sku.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                                                   </div>
                                                                   </div>
                                                                   </div>
                                                                     <div class="form-group" >
                                                                                                                <label for="variantes">¿Desea seguir el stock del Producto?</label>
                                                                                                                <input type="checkbox" name="trackeo" ng-model="product.track" ng-checked="product.track" ng-disabled="product.hasVariants"/>

                                                                                             <span class="text-info"> <em> </em></span>

                                                                                             <div class="row" ng-show="product.track && !product.hasVariants">

                                                                                              <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            Buscar Almacén: <input ng-model="query">
                                                                                                            </div>
                                                                                              </div>

                                                                                                <span ng-repeat="row in warehouses | filter:query">
                                                                                                <div class="col-md-5">
                                                                                                <div class="form-group" >
                                                                                                 <label for=""></label>
                                                                                                   <h5>@{{ row.nombre }}</h5>
                                                                                                   <input type="text" class="hidden" ng-model="product.stock[$index].warehouse_id" ng-init="product.stock[$index].warehouse_id = row.id"/>

                                                                                                </div></div>

                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                    <label for="suppPric">Stock Actual</label>
                                                                                                    <input type="number" class="form-control" name="markup" min="0" placeholder="0.00"  ng-model="product.stock[$index].stockActual" ng-disabled="product.hasVariants || !product.track" step="0.1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                    <label for="suppPric">Stock Mínimo</label>
                                                                                                     <input type="number" class="form-control" name="markup" min="0" placeholder="0.00"  ng-model="product.stock[$index].stockMin" ng-disabled="product.hasVariants || !product.track" step="0.1">
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                <div class="form-group" >
                                                                                                     <label for="suppPric">Costo Mínimo</label>
                                                                                                      <input type="number" class="form-control" name="markup" min="0" placeholder="0.00"  ng-model="product.stock[$index].stockMinSoles" ng-disabled="product.hasVariants || !product.track" step="0.1">
                                                                                                        </div>
                                                                                                </div>
                                                                                                 </span>
                                                                                                 @{{product.stock[0].warehouse_id}}

                                                                                             </div>
                                                                                           </div>
                                                                   </div><!-- /.box-body -->
                                                                    <div class="overlay" ng-class="{ 'hidden': !product.hasVariants}">
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
                    <button type="submit" class="btn btn-primary" ng-click="createProduct()">Crear</button>
                    <a href="/products" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->



             <!-- =============================Modal de Presentacion ================================ -->

             <div class="modal fade bs-example-modal-sm" id="presentation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog modal-sm"  role="document">
                             <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                 <h4 class="modal-title">Añadir Presentación</h4>
                               </div>
                               <div class="modal-body">
                                <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                 <select name="" ng-click="selectPres()" class="form-control" id="" ng-model="presentationSelect" ng-options="item as item.nombre+' / '+item.shortname+' / '+item.cant for item in presentations">
                                        <option value="">-- Elige Presentación--</option>
                                 </select>
                                 @{{presentationSelect}}
                                </div>
                                </div>
                                </div>
                                <div class="row">
                                 <div class="col-md-4">
                                 <input type="text" class="form-control hidden" name="presentation.nombre" ng-model="presentation.nombre" ng-disabled="product.hasVariants">
                                 <div class="form-group" >
                                  <label for="suppPric">Precio de Compra</label>
                                  <input type="number" class="form-control" name="suppPric1" placeholder="0.00" ng-model="presentation.suppPri" ng-disabled="product.hasVariants"  ng-blur="calculateSuppPric()" step="0.1">
                                   </div>
                                    </div>
                                     <div class="col-md-4">
                                     <div class="form-group" > <label for="suppPric">% de Ganancia</label> <input type="number" class="form-control" name="markup1" placeholder="0.00" ng-model="presentation.markup" ng-blur="calculateMarkup()" ng-disabled="product.hasVariants" step="0.1">
                                     </div>
                                     </div>
                                     <div class="col-md-4">
                                      <div class="form-group" >
                                      <label for="suppPric">Precio de Venta</label>
                                      <input type="number" class="form-control" name="price1" placeholder="0.00" ng-model="presentation.price" ng-blur="calculatePrice()" ng-disabled="product.hasVariants" step="0.1">
                                      </div>
                                      </div>
                                      </div>
                                     @{{ presentation.markup}}
                               </div>
                               <div class="modal-footer">
                                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                 <button type="button" class="btn btn-primary" ng-click="AddPres()" data-dismiss="modal">Grabar Cambios</button>
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
                        <input type="text" class="form-control" name="preAdd.preBase_id" ng-model="product.presentation_base">
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
                            <label for="suppPric">Equiv (@{{ product.presentation_base_object.nombre }})</label>
                            <input type="number" class="form-control" name="equiv" placeholder="12.00" ng-model="preAdd.cant" min="0">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" ng-click="createPres(product.presentation_base)" data-dismiss="modal">Crear</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ======================================================================================== -->