<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Cajas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/cajas">Cajas</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Caja</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="cajaEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                 <ul>
                  <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                 </ul>
                 </div>
                    
                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ cajaEditForm.nombreCaja.$error.required && cajaEditForm.$submitted || cajaEditForm.nombreCaja.$dirty && cajaEditForm.nombreCaja.$invalid]">
                      <label for="nombreCaja">Nombre</label>
                      <input type="text" class="form-control" name="nombreCaja" placeholder="Nombre Caja"
                      ng-model="caja.nombreCaja">
                      <label ng-show="cajaEditForm.$submitted || cajaEditForm.nombreDocumento.$dirty && cajaEditForm.nombreDocumento.$invalid">
                        <span ng-show="cajaEditForm.nombreDocumento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                  </div>



                 <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ cajaEditForm.turno.$error.required && cajaEditForm.$submitted || cajaEditForm.turno.$dirty && cajaEditForm.turno.$invalid]">
                      <label for="turno">Turno</label>
                      <input type="text" class="form-control" name="turno" placeholder="Nombre Caja"
                      ng-model="caja.turno">
                      <label ng-show="cajaEditForm.$submitted || cajaEditForm.turno.$dirty && cajaEditForm.turno.$invalid">
                        <span ng-show="cajaEditForm.turno.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                  </div>


                    <div class="col-md-4">
                          <div class="form-group">
                                <label>Farmacia <a class="btn btn-xs btn-info btn-flat" ng-click="addBrand()">+</a></label>
                                <select name="tienda" class="form-control" ng-model="caja.tienda_id" ng-options="k as v for (k, v) in tiendas">
                                    <option value="">--Elige Farmacia--</option>
                                    <option value="">+Agrega Farmacia</option>
                                </select>

                          </div>
                        </div>
                            <div class="col-md-4" >
                            <div class="form-group">
                                <label>Almacen <a class="btn btn-xs btn-info btn-flat" ng-click="addLine()">+</a></label>
                                <select name="almacen" class="form-control" ng-model="caja.almacen_id" ng-options="k as v for (k, v) in almacenes">
                                <option value="">--Elige Almacen--</option>
                                                </select>
                          </div></div>


                    <div class="col-md-4">
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="caja.descripcion" rows="4" cols="50"></textarea>
                     </div>
                </div>
                    
               </div>
             </div>
          </div>
         </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateCaja()">Modificar</button>
                    <a href="/cajas" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->