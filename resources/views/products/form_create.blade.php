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
                      <label ng-show="productCreateForm.$submitted || productCreateForm.nombre.$dirty && productCreateForm.nombres.$invalid">
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

                    <div class="box box-default" id="price">
                                                              <div class="box-header with-border">
                                                                <h3 class="box-title">Precio del Producto</h3>
                                                                <div class="box-tools pull-right">
                                                                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                </div><!-- /.box-tools -->
                                                                </div><!-- /.box-header -->
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
                                                              </div><!-- /.box-body -->
                                                            </div><!-- /.box -->
                    <div class="form-group">
                                           <label>Imagen</label>
                                           <input type="file" ng-model="product.image" id="productImage" name="productImage"/>
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
                                                <label>Categoría</label>
                                                <select name="ttype" class="form-control" ng-model="product.type_id" ng-options="k as v for (k, v) in types">
                                                 <option value="">--Elige Categoría--</option>
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

                      @{{ product.hasVariants }}

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
                                                                   <input class="form-control" type="text" ng-model="product.sku" ng-disabled="product.hasVariants"/>
                                                                   </div>
                                                                   </div>
                                                                   </div>
                                                                     <div class="form-group" >
                                                                                                                <label for="variantes">¿Desea seguir el stock del Producto?</label>
                                                                                                                <input type="checkbox" name="track" ng-model="product.track" ng-checked="product.track" ng-disabled="product.hasVariants"/>
                                                                                             <span class="text-info"> <em> </em></span>
                                                                                             <div class="row" ng-show="product.track && !product.hasVariants">

                                                                                                <div class="col-md-5">
                                                                                                <div class="form-group" >
                                                                                                   <label for="suppPric">Almacenes</label>
                                                                                                   <h5>Almacén Principal</h5>
                                                                                                </div></div>

                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                    <label for="suppPric">Stock Actual</label>
                                                                                                    <input type="number" class="form-control" name="markup" placeholder="0.00" ng-model="product.markup" ng-blur="calculateMarkup()" ng-disabled="product.hasVariants || !product.track" step="0.1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                    <label for="suppPric">Stock Mínimo</label>
                                                                                                     <input type="number" class="form-control" name="markup" placeholder="0.00" ng-model="product.markup" ng-blur="calculateMarkup()" ng-disabled="product.hasVariants || !product.track" step="0.1">
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                <div class="form-group" >
                                                                                                     <label for="suppPric">Costo Mínimo</label>
                                                                                                      <input type="number" class="form-control" name="markup" placeholder="0.00" ng-model="product.markup" ng-blur="calculateMarkup()" ng-disabled="product.hasVariants || !product.track" step="0.1">
                                                                                                        </div>
                                                                                                </div>

                                                                                             </div>
                                                                                           </div>
                                                                   </div><!-- /.box-body -->
                                                                 </div>
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