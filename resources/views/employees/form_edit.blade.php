<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Empleados
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/employees">Empleados</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Empleados</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="employeeCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                      <div class="form-group" ng-class="{true: 'has-error'}[ employeeCreateForm.nombres.$error.required && employeeCreateForm.$submitted || employeeCreateForm.nombres.$dirty && employeeCreateForm.nombres.$invalid]">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres" placeholder="Nombres" ng-model="employee.nombres" required>
                      <label ng-show="employeeCreateForm.$submitted || employeeCreateForm.nombres.$dirty && employeeCreateForm.nombres.$invalid">
                        <span ng-show="employeeCreateForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ employeeCreateForm.apellidos.$error.required && employeeCreateForm.$submitted || employeeCreateForm.apellidos.$dirty && employeeCreateForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos"
                      ng-model="employee.apellidos" required>
                      <label ng-show="employeeCreateForm.$submitted || employeeCreateForm.apellidos.$dirty && employeeCreateForm.apellidos.$invalid">

                        <span ng-show="employeeCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                    </div>
                    <div class="form-group" >
                      <label for="apellidos">Dni</label>
                      <input type="text" class="form-control" name="empresa" placeholder="Dni"
                      ng-model="employee.dni">
                     </div>
                    <div class="form-group" >
                      <label for="apellidos">Codigo</label>
                      <input type="text" class="form-control" name="empresa" placeholder="Codigo"
                      ng-model="employee.codigo">
                     </div>
                     <div class="form-group" ng-class="{true: 'has-error'}[ employeeCreateForm.fechanac.$error.required && employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid]">
                    <label for="fechanac">Fecha de Nacimiento</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="datetime"  class="form-control" name="fechanac" ng-model="employee.fechanac">
                      <label ng-show="employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid">
                                              <span ng-show="employeeCreateForm.fechanac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div>
                     </div>
                    <div class="form-group" >
                      <label for="ruc">Telefono Fijo</label>
                      <input type="text" class="form-control" name="ruc" placeholder="ruc"
                      ng-model="employee.fijo">
                     </div>
                      <div class="form-group" >
                      <label for="codigo">Telefono Movil</label>
                      <input type="text" class="form-control" name="codigo" placeholder="Telfono Movil"
                      ng-model="employee.movil">
                     </div>
                    <div class="form-group" >
                      <label for="ruc">E-mail</label>
                      <input type="text" class="form-control" name="ruc" placeholder="E-mail"
                      ng-model="employee.email">
                     </div>
                     <div class="form-group" >
                      <label for="ruc">website</label>
                      <input type="text" class="form-control" name="ruc" placeholder="Website"
                      ng-model="employee.website">
                     </div>
                    
                      <div class="form-group">
                                            <label>Género</label>
                                            <select name="genero" class="form-control" ng-model="employee.genero">
                                             <option value="">-- elige género --</option>
                                             <option value="M">Masculino</option>
                                             <option value="F">Femenino</option>

                                            </select>
                      </div>
                       <div class="form-group" >
                      <label for="ruc">Direccion de Contacto</label>
                      <input type="text" class="form-control" name="ruc" placeholder="Direccion Contacto"
                      ng-model="employee.direccioncontacto">
                     </div>
                    <div class="form-group" >
                      <label for="fijo">Twitter </label>
                      <input type="text" class="form-control" name="fijo" placeholder="###"
                      ng-model="employee.twitter">
                     </div>
                    <div class="form-group" >
                      <label for="movil">Distrito</label>
                      <input type="text" class="form-control" name="movil" placeholder="###"
                      ng-model="employee.distrito">
                     </div>
                    <div class="form-group" >
                      <label for="email">Provincia</label>
                      <input type="email" class="form-control" name="email" placeholder="Chiclayo"
                      ng-model="employee.provincia">
                     </div>
                    <div class="form-group" >
                      <label for="website">Departamento</label>
                      <input type="text" class="form-control" name="website" placeholder="Lambayeque"
                      ng-model="employee.departamento">
                     </div>
                    <div class="form-group" >
                      <label for="direccContac">Pais</label>
                      <input type="text" class="form-control" name="direccContac" placeholder="Peru"
                      ng-model="employee.pais">
                     </div>
                     <div class="form-group" >
                      <label for="notas">Notas</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..."
                      ng-model="employee.notas" rows="4" cols="50"></textarea>
                     </div>
                    <div class="form-group" >
                      <label for="distrito">Estado</label>
                      <input type="text" class="form-control" name="distrito" placeholder="Estado"
                      ng-model="employee.estado">
                     </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateEmployee()">Modificar</button>
                    <a href="/employees" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->