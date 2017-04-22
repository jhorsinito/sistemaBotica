<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Comprobantes
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/comprobantes">Comprobantes</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Comprobantes</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="comprobanteEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                 <ul>
                  <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                 </ul>
                 </div>
                    
                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ comprobanteEditForm.nombreComprobante.$error.required && comprobanteEditForm.$submitted || comprobanteEditForm.nombreComprobante.$dirty && comprobanteEditForm.nombreComprobante.$invalid]">
                      <label for="nombreComprobante">Nombre Comprobante</label>
                      <input type="text" class="form-control" name="nombreComprobante" placeholder="Nombre Comprobante"
                      ng-model="comprobante.nombreComprobante">
                      <label ng-show="comprobanteEditForm.$submitted || comprobanteEditForm.nombreDocumento.$dirty && comprobanteEditForm.nombreDocumento.$invalid">
                        <span ng-show="comprobanteEditForm.nombreDocumento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="comprobante.descripcion" rows="4" cols="50"></textarea>
                     </div>
                </div>
                </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateComprobante()">Modificar</button>
                    <a href="/comprobantes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->