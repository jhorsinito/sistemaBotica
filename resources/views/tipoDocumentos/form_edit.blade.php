<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Documentos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/tipoDocumentos">Documentos</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Documento</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="TipoDocumentoEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                    <ul>
                    <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                       </ul>
                      </div>
                    

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group" ng-class="{true: 'has-error'}[ TipoDocumentoEditForm.nombreDocumento.$error.required && TipoDocumentoEditForm.$submitted || TipoDocumentoEditForm.nombreDocumento.$dirty && TipoDocumentoEditForm.nombreDocumento.$invalid]">
                      <label for="nombreDocumento">Nombre Documento</label>
                      <input type="text" class="form-control" name="nombreDocumento" placeholder="Nombre Documento" ng-model="tipoDocumento.nombreDocumento" required>
                      <label ng-show="TipoDocumentoEditForm.$submitted || TipoDocumentoEditForm.nombreDocumento.$dirty && TipoDocumentoEditForm.nombreDocumento.$invalid">
                        <span ng-show="TipoDocumentoEditForm.nombreDocumento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group" ng-class="{true: 'has-error'}[ TipoDocumentoEditForm.descripcion.$error.required && TipoDocumentoEditForm.$submitted || TipoDocumentoEditForm.descripcion.$dirty && TipoDocumentoEditForm.descripcion.$invalid]">
                      <label for="descripcion">Descripción</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Descripción" ng-model="tipoDocumento.descripcion" required>
                      <label ng-show="TipoDocumentoEditForm.$submitted || TipoDocumentoEditForm.descripcion.$dirty && TipoDocumentoEditForm.descripcion.$invalid">
                        <span ng-show="TipoDocumentoEditForm.descripcion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>
                  </div>
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateTipoDocumento()">Modificar</button>
                    <a href="/tipoDocumentos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->