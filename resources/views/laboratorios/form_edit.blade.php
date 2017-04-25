<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Laboratorio
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/laboratorios">Laboratorio</a> </li>

            <li class=""><a href="/brands">Laboratorio</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Laboratorio</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="LaboratorioEditForm" role="form" novalidate>

                <form name="laboratorioCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                    <ul>
                      <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                  </div>
                    
                  <div class="row">
                    <div class="col-md-4">  
                    <div class="form-group" ng-class="{true: 'has-error'}[ LaboratorioEditForm.nombre.$error.required && LaboratorioEditForm.$submitted || LaboratorioEditForm.nombre.$dirty && LaboratorioEditForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                      ng-model="laboratorio.nombre">
                      <label ng-show="LaboratorioEditForm.$submitted || LaboratorioEditForm.nombreDocumento.$dirty && LaboratorioEditForm.nombreDocumento.$invalid">
                        <span ng-show="LaboratorioEditForm.nombreDocumento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>

                    </div>

                   <div class="col-md-4">
                    <div class="form-group" >
                      <label for="shortName">ShortName</label>
                      <input type="text" class="form-control" name="shortName" placeholder="ShortName"
                      ng-model="laboratorio.shortName">
                     </div>
                   </div>

                  <div class="col-md-4">

                    <div class="form-group" >
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                      ng-model="laboratorio.nombre">
                     </div>
                    <div class="form-group" >
                      <label for="pais">ShortName</label>
                      <input type="text" class="form-control" name="pais" placeholder="ShortName"
                      ng-model="laboratorio.shortname">
                     </div>
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="laboratorio.descripcion" rows="4" cols="50"></textarea>
                     </div>
                  </div>
                  </div>


                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateLaboratorio()">Modificar</button>

                    <button type="submit" class="btn btn-primary" ng-click="updateBrand()">Modificar</button>
                    <a href="/laboratorios" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->