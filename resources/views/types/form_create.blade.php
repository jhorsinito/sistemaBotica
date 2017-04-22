<section class="content-header">
          <h1> Categorías
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/atributes">Categorías</a> </li>
            <li class="active">Crear</li>
          </ol>
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"> Nueva Categoría</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="TtypeCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                     <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                   </ul>
                 </div>
                    
                   <div class="row">
                    <div class="col-md-4">

                   <div class="form-group" ng-class="{true: 'has-error'}[ TtypeCreateForm.nombre.$error.required && TtypeCreateForm.$submitted || TtypeCreateForm.nombre.$dirty && TtypeCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" ng-blur="validanomType(Ttype.nombre)" placeholder="Nombre" ng-model="Ttype.nombre" required>
                      <label ng-show="TtypeCreateForm.$submitted || TtypeCreateForm.nombre.$dirty && TtypeCreateForm.nombre.$invalid">
                        <span ng-show="TtypeCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    </div>

                    <div class="col-md-4">
                    <div class="form-group">
                      <label for="shortname">Abreviatura</label>
                      <input type="text" class="form-control" name="shortname" placeholder="Abreviatura" ng-model="Ttype.shortname" required>
                      </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="Ttype.descripcion" rows="4" cols="50"></textarea>
                     </div>
                     </div>

                </div><!-- /.box-body -->
              </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createType()">Crear</button>
                    <a href="/types" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->