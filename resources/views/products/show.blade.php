<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Productos
        <small>Panel de Control</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="/products">Productos</li>
                    <li class="active">Ver</li>
    </ol>


</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">@{{product.nombre}}</h3>
            <div class="box-tools pull-right">
              <!-- Buttons, labels, and many other things can be placed here! -->
              <!-- Here is a label for example -->
              <button class=" label-default" ng-if="product.hasVariants == '1'">Añadir Variante</button>

              <button class=" label-default">Imprimir Código de Barras</button>
              <button class=" label-default">Editar Producto</button>
              <button class=" label-danger" ng-if="product.quantVar == '0'">Eliminar</button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            Descripción: @{{product.descripcion}}<br/>
            -----------------------------------------------------------------------------<br/>

            Marca: @{{ product.brand.nombre }} <br/>
            Categoría: @{{ product.type.nombre }} <br/>
            Código Único de Producto: @{{ product.codigo }}<br/>

            <div class="box">
                            <div class="box-header">
                              <h3 class="box-title">Stock de Productos</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body no-padding">
                              <table class="table table-striped">
                                <tbody><tr>
                                  <th style="width: 10px">#</th>
                                  <th>SKU</th>
                                  <th>Variante</th>
                                  <th style="">Precio</th>
                                  <th style="">En stock</th>
                                </tr>
                                <tr>
                                  <td>1.</td>
                                  <td>Update software</td>
                                  <td>
                                    <div class="progress progress-xs">
                                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div>
                                  </td>
                                  <td><span class="badge bg-red">55%</span></td>
                                  <td><span class="badge bg-red">55%</span></td>

                                </tr>



                              </tbody></table>
                            </div><!-- /.box-body -->
                          </div>

          </div><!-- /.box-body -->
          <div class="box-footer">
            Creado: @{{ product.created_at }}
            <div class="box-tools pull-right">

                          <a href="/products" class="btn btn-default btn-xs">Regresar</a>
            </div>
          </div><!-- box-footer -->
        </div><!-- /.box -->
        </div>
    </div>
</section>
