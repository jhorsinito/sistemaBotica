<section class="content-header">
          <h1>
            Personas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/personas">Personas</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Persona</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="personaCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors"> 
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                   <div class="form-group" ng-class="{true: 'has-error'}[ personaCreateForm.nombres.$error.required && personaCreateForm.$submitted || personaCreateForm.z.$dirty && personaCreateForm.nombres.$invalid]">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres"  placeholder="Nombres" ng-model="persona.nombres" required>
                      <label ng-show="personaCreateForm.$submitted || personaCreateForm.nombres.$dirty && personaCreateForm.nombres.$invalid">
                        <span ng-show="personaCreateForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{true: 'has-error'}[ personaCreateForm.apellidos.$error.required && personaCreateForm.$submitted || personaCreateForm.z.$dirty && personaCreateForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos"  placeholder="Apellidos" ng-model="persona.apellidos" required>
                      <label ng-show="personaCreateForm.$submitted || personaCreateForm.apellidos.$dirty && personaCreateForm.apellidos.$invalid">
                        <span ng-show="personaCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{true: 'has-error'}[ personaCreateForm.dni.$error.required && personaCreateForm.$submitted || personaCreateForm.z.$dirty && personaCreateForm.dni.$invalid]">
                      <label for="dni">DNI</label>
                      <input type="text" class="form-control" name="dni"  placeholder="DNI" ng-model="persona.dni" required>
                      <label ng-show="personaCreateForm.$submitted || personaCreateForm.dni.$dirty && personaCreateForm.dni.$invalid">
                        <span ng-show="personaCreateForm.dni.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div>
                        <label>Sexo</label>
                        <select ng-click="cargarProvincia()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="depertamentoSelect" ng-options="item.departamento as item.departamento for item in departamentos"><option value="">-- Elige Sexo --</option></select>
                    </div>

                    <div>
                        <label>Departamento</label>
                        <select ng-click="cargarProvincia()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="depertamentoSelect" ng-options="item.departamento as item.departamento for item in departamentos"><option value="">-- Elige Departamento --</option></select>
                    </div>
 
                    <div>
                        <label>Provinca</label>
                        <select ng-disabled="depertamentoSelect==null" ng-click="cargarDistrito()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="provinciaSelect" ng-options="item.provincia as item.provincia for item in provincias"><option value="">-- Elige Provincia --</option></select>
                    </div>

                    <div>
                        <label>Distrito</label>
                        <select ng-disabled="depertamentoSelect==null || provinciaSelect==undefined" ng-click="selectPlan1()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="distritoSelect" ng-options="item.id as item.distrito for item in distritos"><option value="">-- Elige Didtrito --</option></select>
                    </div>
                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createPersona()">Crear</button>
                    <a href="/personas" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->