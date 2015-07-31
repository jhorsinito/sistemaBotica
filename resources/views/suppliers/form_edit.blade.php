<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Proveedores
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/suppliers">Proveedores</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Proveedor</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="supplierCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ supplierCreateForm.nombres.$error.required && supplierCreateForm.$submitted || supplierCreateForm.nombres.$dirty && supplierCreateForm.nombres.$invalid]">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres" placeholder="Nombres" ng-model="supplier.nombres" required>
                      <label ng-show="supplierCreateForm.$submitted || supplierCreateForm.nombres.$dirty && supplierCreateForm.nombres.$invalid">
                        <span ng-show="supplierCreateForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ supplierCreateForm.apellidos.$error.required && supplierCreateForm.$submitted || supplierCreateForm.apellidos.$dirty && supplierCreateForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos"
                      ng-model="supplier.apellidos" required>
                      <label ng-show="supplierCreateForm.$submitted || supplierCreateForm.apellidos.$dirty && supplierCreateForm.apellidos.$invalid">

                        <span ng-show="supplierCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                    </div>
                    <div class="form-group" >
                      <label for="apellidos">Empresa</label>
                      <input type="text" class="form-control" name="empresa" placeholder="Empresa"
                      ng-model="supplier.empresa">
                     </div>
                    <div class="form-group" >
                      <label for="apellidos">Codigo</label>
                      <input type="text" class="form-control" name="empresa" placeholder="Codigo"
                      ng-model="supplier.codigo">
                     </div>
                     <div class="form-group" >
                      <label for="apellidos">Direccion Fiscal</label>
                      <input type="text" class="form-control" name="empresa" placeholder="Direccion Fiscal"
                      ng-model="supplier.direccionfiscal">
                     </div>
                     <div class="form-group" >
                      <label for="apellidos">Ruc</label>
                      <input type="text" class="form-control" name="empresa" placeholder="Ruc"
                      ng-model="supplier.ruc">
                     </div>
                     <div class="form-group" >
                      <label for="apellidos">Numero Cuenta</label>
                      <input type="text" class="form-control" name="empresa" placeholder="Numero Cuenta"
                      ng-model="supplier.numcuenta">
                     </div>
                  
                       <div class="form-group" ng-class="{true: 'has-error'}[ supplierCreateForm.fechanac.$error.required && supplierCreateForm.$submitted || supplierCreateForm.fechanac.$dirty && supplierCreateForm.fechanac.$invalid]">
                    <label for="fechanac">Fecha de Nacimiento</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control" name="fechanac" ng-model="supplier.fechanac">
                      <label ng-show="supplierCreateForm.$submitted || supplierCreateForm.fechanac.$dirty && supplierCreateForm.fechanac.$invalid">
                      <span ng-show="supplierCreateForm.fechanac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                      </label>
                      </div>
                     </div>
                    <div class="form-group" >
                      <label for="ruc">Telefono Fijo</label>
                      <input type="text" class="form-control" name="ruc" placeholder="ruc"
                      ng-model="supplier.fijo">
                     </div>
                      <div class="form-group" >
                      <label for="codigo">Telefono Movil</label>
                      <input type="text" class="form-control" name="codigo" placeholder="Telfono Movil"
                      ng-model="supplier.movl">
                     </div>
                    <div class="form-group" >
                      <label for="ruc">E-mail</label>
                      <input type="text" class="form-control" name="ruc" placeholder="E-mail"
                      ng-model="supplier.email">
                     </div>
                     <div class="form-group" >
                      <label for="ruc">website</label>
                      <input type="text" class="form-control" name="ruc" placeholder="Website"
                      ng-model="supplier.website">
                     </div>
                    
                      <div class="form-group">
                                            <label>Género</label>
                                            <select name="genero" class="form-control" ng-model="supplier.genero">
                                             <option value="">-- elige género --</option>
                                             <option value="M">Masculino</option>
                                             <option value="F">Femenino</option>

                                            </select>
                      </div>
                       <div class="form-group" >
                      <label for="ruc">Direccion de Contacto</label>
                      <input type="text" class="form-control" name="ruc" placeholder="Direccion Contacto"
                      ng-model="supplier.direccontacto">
                     </div>
                    <div class="form-group" >
                      <label for="fijo">Twitter </label>
                      <input type="text" class="form-control" name="fijo" placeholder="###"
                      ng-model="supplier.twitter">
                     </div>
                    <div class="form-group" >
                      <label for="movil">Distrito</label>
                      <input type="text" class="form-control" name="movil" placeholder="###"
                      ng-model="supplier.distrito">
                     </div>
                    <div class="form-group" >
                      <label for="email">Provincia</label>
                      <input type="email" class="form-control" name="email" placeholder="Chiclayo"
                      ng-model="supplier.provincia">
                     </div>
                    <div class="form-group" >
                      <label for="website">Departamento</label>
                      <input type="text" class="form-control" name="website" placeholder="Lambayeque"
                      ng-model="supplier.departamento">
                     </div>
                    <div class="form-group" >
                      <label for="direccContac">Pais</label>
                      <input type="text" class="form-control" name="direccContac" placeholder="Peru"
                      ng-model="supplier.pais">
                     </div>
                     <div class="form-group" >
                      <label for="notas">Notas</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..."
                      ng-model="supplier.notas" rows="4" cols="50"></textarea>
                     </div>
                    
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateSupplier()">Modificar</button>
                    <a href="/suppliers" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->