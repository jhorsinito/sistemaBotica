  <section class="content-header">
          <h1>
            Stores
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/stores">Stores</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Store</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="storeCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                   
                   <label for="apellidos">Nombre Tienda</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre Tienda"
                      ng-model="store.nombreTienda">
                     </div>
                    <div class="form-group" >
                      <label for="apellidos">Razon Social</label>
                      <input type="text" class="form-control" name="razonsocial" placeholder="Razon Social"
                      ng-model="store.razonSocial">
                     </div>
                    <div class="form-group" >
                      <label for="apellidos">Ruc</label>
                      <input type="text" class="form-control" name="ruc" placeholder="Ruc"
                      ng-model="store.ruc">
                     </div>
                     <div class="form-group" >
                      <label for="apellidos">Direccion</label>
                      <input type="text" class="form-control" name="direccion" placeholder="Direccion"
                      ng-model="store.direccion">
                     </div>
                    <div class="form-group" >
                      <label for="apellidos">Distrito</label>
                      <input type="text" class="form-control" name="distrito" placeholder="Distrito"
                      ng-model="store.distrito">
                     </div>
                    <div class="form-group" >
                      <label for="apellidos">Provincia</label>
                      <input type="text" class="form-control" name="provincia" placeholder="Provincia"
                      ng-model="store.provincia">
                     </div>
                     <div class="form-group" >
                      <label for="apellidos">Departamento</label>
                      <input type="text" class="form-control" name="departamento" placeholder="Departamento"
                      ng-model="store.departamento">
                     </div>
                    <div class="form-group" >
                      <label for="apellidos">Email</label>
                      <input type="int" class="form-control" name="email" placeholder="Email"
                      ng-model="store.email">
                     </div>
                    <div class="form-group" >
                      <label for="apellidos">Website</label>
                      <input type="text" class="form-control" name="website" placeholder="Website"
                      ng-model="store.website">
                     </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateStore()">Modificar</button>
                    <a href="/stores" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->