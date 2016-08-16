<section class="content-header">
          <h1>
            Acreditadras
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/acreditadoras">Acreditadras</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Acreditadra</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="acreditadoraCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                   <div class="form-group" ng-class="{true: 'has-error'}[ acreditadoraCreateForm.nombre.$error.required && acreditadoraCreateForm.$submitted || acreditadoraCreateForm.z.$dirty && acreditadoraCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" ng-blur="validanomUbigeo(acreditadora.nombre)" placeholder="Nombre" ng-model="acreditadora.nombre" required>
                      <label ng-show="acreditadoraCreateForm.$submitted || acreditadoraCreateForm.nombre.$dirty && acreditadoraCreateForm.nombre.$invalid">
                        <span ng-show="acreditadoraCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div>
                        <label>Departamento</label>
                        <select ng-click="selectPlan1()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="depertamentoSelect" ng-options="item.id as item.departamento for item in departamentos"><option value="0" selected="selected" label="2015-I">2015-I</option></select>
                    </div>
 
                    <div>
                        <label>Provinca</label>
                        <select ng-click="selectPlan1()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="plan_id" ng-options="item.id as item.nombre for item in planEstudiantil"><option value="0" selected="selected" label="2015-I">2015-I</option></select>
                    </div>

                    <div>
                        <label>Distrito</label>
                        <select ng-click="selectPlan1()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="plan_id" ng-options="item.id as item.nombre for item in planEstudiantil"><option value="0" selected="selected" label="2015-I">2015-I</option></select>
                    </div>
                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createAcreditadora()">Crear</button>
                    <a href="/acreditadoras" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->