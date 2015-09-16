<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Variantes
        <small>Panel de Control</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="/variants">Variantes</li>
        <li class="active">Editar</li>
    </ol>


</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Variante de <b>@{{ product.nombre }}</b></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="variantCreateForm" role="form" novalidate>
                    <div class="box-body">
                        <div class="callout callout-danger" ng-show="errors">
                            <ul>
                                <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" ng-class="{true: 'has-error'}[ variantCreateForm.nombre.$error.required && variantCreateForm.$submitted || variantCreateForm.nombre.$dirty && variantCreateForm.nombre.$invalid]">
                                    <label for="nombres">Código (Autogenerado)</label>
                                    <input type="text" class="form-control" name="codigo" placeholder="Codigo autogenerado" ng-model="variant.codigo" required disabled>
                                    <label ng-show="variantCreateForm.$submitted || variantCreateForm.codigo.$dirty && variantCreateForm.codigo.$invalid">
                                        <span ng-show="variantCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                    </label>
                                </div></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Categoría</label>
                                    <select name="brand" class="form-control" ng-model="variant.category" ng-options="category.id as category.nombre for category in categories">
                                        <option value="" >--Elige Categoría--</option>
                                    </select>

                                </div>

                            </div>

                            </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Presentación Base:</label>
                                    <select  class="form-control" ng-model="variant.presentation_base_object" ng-change="changePreBase()" ng-options="item as item.nombre for item in presentations_base">
                                        <option value="">-- Elige Presentación Base--</option>
                                    </select>
                                </div>
                            </div>



                        </div>
                        <div class="row">



                        </div>


                        <div class="form-group">
                            <label for="notas">Notas</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..."
                                ng-model="variant.nota" rows="4" cols="50"></textarea>
                        </div>
                            </div>
                            <div class="col-md-4">

                                    <div class="form-group">
                                        <label>Imagen</label>
                                        <input type="file" ng-model="variant.image" id="variantImage" name="variantImage"/>

                                    </div>
                                <div class="form-group">
                                    <img ng-src="@{{variant.image}}" alt="" class="img-thumbnail"/>
                                </div>

                            </div>
                        </div>
                        <!--  =============================================================================ATRIBUTOS===============================================================-->
                        <div class="box box-default" id="inventory">
                            <div class="box-header with-border">
                                <h3 class="box-title">Definir Atributos</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <input type="search" ng-model="qA" placeholder="filtrar atributo..." aria-label="filtrar atributo" />
                                <div class="row" ng-repeat="row in attributes | filter:qA" ng-init="variant.detAtr[$index].atribute_id = row.id">
                                    <div class="col-md-2">
                                        <input type="hidden" ng-model="variant.detAtr[$index].atribute_id">
                                        <label for="">@{{ row.nombre }}</label>

                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" ng-model="variant.detAtr[$index].descripcion"  ng-init="asignarDescr($index)" ng-keyup="capAttr(row.id)">
                                    </div>
                                </div>



                            </div><!-- /.box-body -->

                        </div>

                        <!--  =============================================================================FIN ATRIBUTOS===============================================================-->

                        <!-- /.box -->
                        <!--  =============================================================================PRESENTACIONES===============================================================-->
                        <div class="box box-default" id="price">
                            <div class="box-header with-border">
                                <h3 class="box-title">Presentaciones del Producto     </h3>
                                <button class="btn btn-xs btn-info btn-flat" data-toggle="modal" data-target="#presentation" ng-click="traerPres(variant.presentation_base)" ng-disabled="enabled_presentation_button" >Añadir Presentación</button>
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
                                            <tr ng-repeat="row in variant.presentations">
                                                <td>@{{$index + 1}}</td>
                                                <td>@{{row.nombre}}</td>
                                                <td>@{{row.suppPri}}</td>
                                                <td>@{{row.markup}}</td>

                                                <td>@{{row.price}}</td>
                                                <td>
                                                    <a href="" class="btn btn-danger btn-xs" ng-click="deletePres($index)"><i class="fa fa-fw fa-trash"></i></a>
                                                </td>
                                            </tr>



                                            </tbody></table>
                                    </div>


                                </div>
                            </div><!-- /.box-body -->


                        </div><!-- /.box -->

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
                                            <input class="form-control" name="sku" type="text" ng-model="variant.sku" ng-disabled="variant.autogenerado" ng-required="!variant.autogenerado"/>
                                            <span style="color:#dd4b39;" ng-show="variantCreateForm.sku.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" ng-model="variant.autogenerado"> Autogenerado
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="variantes">¿Desea seguir el stock del Producto?</label>
                                    <input type="checkbox" name="trackeo" ng-model="variant.track" ng-checked="variant.track"/>

                                    <span class="text-info"> <em> </em></span>

                                    <div class="row" ng-show="variant.track">

                                        <div class="row">
                                            <div class="col-md-12">
                                                Buscar Almacén: <input type="search"  ng-model="query" placeholder="buscar..." aria-label="buscar">
                                            </div>
                                        </div>

                                                                                                <span ng-repeat="row in warehouses | filter:query">
                                                                                                <div class="col-md-5">
                                                                                                    <div class="form-group" >
                                                                                                        <label for=""></label>
                                                                                                        <h5>@{{ row.nombre }}</h5>
                                                                                                        <input type="hidden" class="" ng-model="variant.stock[$index].warehouse_id" ng-init="variant.stock[$index].warehouse_id = row.id"/>

                                                                                                    </div></div>

                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                        <label for="suppPric">Stock Actual</label>
                                                                                                        <input type="number" class="form-control" name="markup" ng-attr-min="@{{minNumber}}" string-to-number placeholder="0.00"  ng-model="variant.stock[$index].stockActual" ng-disabled="!variant.track" step="0.1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                        <label for="suppPric">Stock Mínimo</label>
                                                                                                        <input type="number" class="form-control" name="markup" ng-attr-min="@{{minNumber}}" string-to-number placeholder="0.00"  ng-model="variant.stock[$index].stockMin" ng-disabled="!variant.track" step="0.1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                        <label for="suppPric">Costo Mínimo</label>
                                                                                                        <input type="number" class="form-control" name="markup" ng-attr-min="@{{minNumber}}" string-to-number placeholder="0.00"  ng-model="variant.stock[$index].stockMinSoles" ng-disabled="!variant.track" step="0.1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                 </span>


                                    </div>
                                </div>
                            </div><!-- /.box-body -->

                        </div>
                        <!--  =============================================================================FIN INVENTARIO===============================================================-->
                        <script>
                            $("#variants").activateBox();
                            $("#price").activateBox();
                            $("#inventory").activateBox();
                        </script>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" ng-click="updateVariant()">Editar</button>
                        <a href="/products/show/@{{product.id}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div><!-- /.box -->

        </div>
    </div><!-- /.row -->
</section><!-- /.content -->



<!-- =============================Modal de Presentacion ================================ -->

<div class="modal fade bs-example-modal-sm" id="presentation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md"  role="document">
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

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control hidden" name="presentation.nombre" ng-model="presentation.nombre">
                        <div class="form-group" >
                            <label for="suppPric">Precio de Compra</label>
                            <input type="number" class="form-control" name="suppPric1" placeholder="0.00" ng-model="presentation.suppPri" ng-blur="calculateSuppPric()" step="0.1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" > <label for="suppPric">% de Ganancia</label> <input type="number" class="form-control" name="markup1" placeholder="0.00" ng-model="presentation.markup" ng-blur="calculateMarkup()" step="0.1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="suppPric">Precio de Venta</label>
                            <input type="number" class="form-control" name="price1" placeholder="0.00" ng-model="presentation.price" ng-blur="calculatePrice()" step="0.1">
                        </div>
                    </div>
                </div>

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
    <div class="modal-dialog modal-md"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Crear Presentación</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" class="form-control" name="preAdd.preBase_id" ng-model="variant.presentation_base">
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
                            <label for="suppPric">Equiv (@{{ variant.presentation_base_object.nombre }})</label>
                            <input type="number" class="form-control" name="equiv" placeholder="12.00" ng-model="preAdd.cant" min="0">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" ng-click="createPres(variant.presentation_base)" data-dismiss="modal">Crear</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ======================================================================================== -->