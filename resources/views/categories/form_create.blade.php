<setion class="content-header"><h1>
            Categorias
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/categories">Categorias</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Categorias</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="categoryCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                   <div class="form-group" ng-class="{true: 'has-error'}[ categoryCreateForm.nombre.$error.required && categoryCreateForm.$submitted || categoryCreateForm.nombre.$dirty && categoryCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" ng-blur="validanomStacion()"placeholder="Nombre" ng-model="category.nombre" required>
                      <label ng-show="categoryCreateForm.$submitted || categoryCreateForm.nombre.$dirty && categoryCreateForm.nombre.$invalid">
                        <span ng-show="categoryCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ categoryCreateForm.shortname.$error.required && categoryCreateForm.$submitted || categoryCreateForm.shortname.$dirty && categoryCreateForm.shortname.$invalid]">
                      <label for="shortname">ShortName</label>
                      <input type="text" class="form-control" name="shortname" placeholder="ShortName" ng-model="category.shortname" required>
                      <label ng-show="categoryCreateForm.$submitted || categoryCreateForm.shortname.$dirty && categoryCreateForm.shortname.$invalid">
                        <span ng-show="categoryCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="category.descripcion" rows="4" cols="50"></textarea>
                     </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createCategory()">Crear</button>
                    <a href="/categories" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->