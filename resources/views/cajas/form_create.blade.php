<section class="content-header">
          <h1> Cajas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/cajas">Cajas</a> </li>
            <li class="active">Crear</li>
          </ol>
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Nueva Caja</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="cajaCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                     <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                   </ul>
                 </div>
                    
                   <div class="row">
                    <div class="col-md-4">

                   <div class="form-group" ng-class="{true: 'has-error'}[ cajaCreateForm.nombreCaja.$error.required && cajaCreateForm.$submitted || cajaCreateForm.nombreCaja.$dirty && cajaCreateForm.nombreCaja.$invalid]">
                      <label for="nombreCaja">Nombre</label>
                      <input type="text" class="form-control" name="nombreCaja" ng-blur="validanomCaja(caja.nombreCaja)" placeholder="Nombre caja" ng-model="caja.nombreCaja" required>
                      <label ng-show="cajaCreateForm.$submitted || cajaCreateForm.nombreCaja.$dirty && cajaCreateForm.nombreCaja.$invalid">
                        <span ng-show="cajaCreateForm.nombreCaja.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    </div>



                        <div class="col-md-4">

                   <div class="form-group" ng-class="{true: 'has-error'}[ cajaCreateForm.turno.$error.required && cajaCreateForm.$submitted || cajaCreateForm.turno.$dirty && cajaCreateForm.turno.$invalid]">
                      <label for="turno">Turno</label>
                      <input type="text" class="form-control" name="turno" ng-blur="validanomCaja(caja.turno)" placeholder="Nombre caja" ng-model="caja.turno" required>
                      <label ng-show="cajaCreateForm.$submitted || cajaCreateForm.turno.$dirty && cajaCreateForm.turno.$invalid">
                        <span ng-show="cajaCreateForm.turno.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    </div>


                  

                     <div class="col-md-4">
                          <div class="form-group">
                                <label>Farmacia </label>
                                <select name="tienda" class="form-control" ng-model="caja.tienda_id" ng-options="k as v for (k, v) in tiendas">
                                    <option value="">--Elige Farmacia--</option>
                                    <option value="">+Agrega Farmacia</option>
                                </select>

                          </div>
                    </div>
                            <div class="col-md-4" >
                            <div class="form-group">
                                <label>Almacen </label>
                                <select name="almacen" class="form-control" ng-model="caja.almacen_id" ng-options="k as v for (k, v) in almacenes">
                                <option value="">--Elige Almacen--</option>
                                                </select>
                          </div></div>


                            <div class="col-md-12">
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="caja.descripcion" rows="4" cols="50"></textarea>
                     </div>
                    </div>
                  </div>
                 </div>


                </div><!-- /.box-body -->
              </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createCaja()">Crear</button>
                    <a href="/cajas" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->