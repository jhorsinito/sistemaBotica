<section class="content-header">
          <h1> Laboratorios
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/atributes">Laboratorios</a> </li>
            <li class="active">Crear</li>
          </ol>
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo Laboratorio</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="laboratorioCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                     <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                   </ul>
                 </div>
                    
                   <div class="row">
                    <div class="col-md-4">

                   <div class="form-group" ng-class="{true: 'has-error'}[ laboratorioCreateForm.nombre.$error.required && laboratorioCreateForm.$submitted || laboratorioCreateForm.nombre.$dirty && laboratorioCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" ng-blur="validanomLaboratorio(laboratorio.nombre)" placeholder="Nombre" ng-model="laboratorio.nombre" required>
                      <label ng-show="laboratorioCreateForm.$submitted || laboratorioCreateForm.nombre.$dirty && laboratorioCreateForm.nombre.$invalid">
                        <span ng-show="laboratorioCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    </div>

                    <div class="col-md-4">
                    <div class="form-group">
                      <label for="shortName">Abreviatura</label>
                      <input type="text" class="form-control" name="shortName" placeholder="Abreviatura" ng-model="laboratorio.shortName" required>
                      </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="laboratorio.descripcion" rows="4" cols="50"></textarea>
                     </div>
                     </div>

                </div><!-- /.box-body -->
              </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createLaboratorio()">Crear</button>
                    <a href="/laboratorios" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->