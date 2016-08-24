<section class="content-header">
          <h1>
            Cursos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/cursos">Cursos</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Curso</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="cursoCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>


                        <div  class="form-group">
                                  <label for="fechaRegistro">Fecha de Registro</label>
                              <div  class="input-group">
                                  <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                 </div>
                                    <input  type="date" ng-change="filtroFechas()" class="form-control"  name="fechaRegistro" ng-model="curso.fechaRegistro">
                              </div>
                        </div>

                    
                   <div class="form-group" ng-class="{true: 'has-error'}[ cursoCreateForm.descripcion.$error.required && cursoCreateForm.$submitted || cursoCreateForm.descripcion.$dirty && cursoCreateForm.descripcion.$invalid]">
                      <label for="descripcion">descripcion</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="descripcion" ng-model="curso.descripcion" required>
                      <label ng-show="cursoCreateForm.$submitted || cursoCreateForm.descripcion.$dirty && cursoCreateForm.descripcion.$invalid">
                        <span ng-show="cursoCreateForm.descripcion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createCurso()">Crear</button>
                    <a href="/cursos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->