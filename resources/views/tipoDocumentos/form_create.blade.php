<section class="content-header">
          <h1>
            Tipo de Documentos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/tipoDocumentos">Tipo de Documentos</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Documento</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="tipoDocumentoCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                   <ul>
                     <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                   </ul>
                  </div>
                    
                <div class="row">
                  <div class="col-md-6">
                   <div class="form-group" ng-class="{true: 'has-error'}[ tipoDocumentoCreateForm.nombreDocumento.$error.required && tipoDocumentoCreateForm.$submitted || tipoDocumentoCreateForm.nombreDocumento.$dirty && tipoDocumentoCreateForm.nombreDocumento.$invalid]">
                      <label for="nombreDocumento">Nombre de Documento</label>
                      <input type="text" class="form-control" name="nombreDocumento" placeholder="Nombre de Documento" ng-model="tipoDocumento.nombreDocumento" required>
                      <label ng-show="tipoDocumentoCreateForm.$submitted || tipoDocumentoCreateForm.nombreDocumento.$dirty && tipoDocumentoCreateForm.nombreDocumento.$invalid">
                        <span ng-show="tipoDocumentoCreateForm.nombreDocumento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="tipoDocumento.descripcion" rows="4" cols="50"></textarea>
                     </div>
                     </div>
                     </div>
                    </div>
                    </div>
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createTipoDocumento()">Crear</button>
                    <a href="/tipoDocumentos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!--

