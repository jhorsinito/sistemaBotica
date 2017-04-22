<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Categorías
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/types">Categorías</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Categorías</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="TtypeEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                    <ul>
                      <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                  </div>
                    
                  <div class="row">
                    <div class="col-md-4">  
                    <div class="form-group" ng-class="{true: 'has-error'}[ TtypeEditForm.nombre.$error.required && TtypeEditForm.$submitted || TtypeEditForm.nombre.$dirty && TtypeEditForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                      ng-model="Ttype.nombre">
                      <label ng-show="TtypeEditForm.$submitted || TtypeEditForm.nombreDocumento.$dirty && TtypeEditForm.nombreDocumento.$invalid">
                        <span ng-show="TtypeEditForm.nombreDocumento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>

                    </div>

                   <div class="col-md-4">
                    <div class="form-group" >
                      <label for="shortname">ShortName</label>
                      <input type="text" class="form-control" name="shortname" placeholder="ShortName"
                      ng-model="Ttype.shortname">
                     </div>
                   </div>

                  <div class="col-md-4">
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="Ttype.descripcion" rows="4" cols="50"></textarea>
                     </div>
                  </div>
                  </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateType()">Modificar</button>
                    <a href="/types" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->