(function(){
    var app = angular.module('sales',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'sales.controllers',
        'crud.services.orders',
        'routes',
        'ui.bootstrap' 
    ]);

angular.module('sales').controller('ModalInstanceCtrl', function ($scope,$log, $modalInstance,presentations,crudServiceOrders) {
	$scope.presentations = presentations;
	//$log.log($scope.presentations+"Hola");
/*
  $scope.items = items;
  $scope.selected = {
    item: $scope.items[0]
  };
*/
  $scope.ok = function () {
    $modalInstance.close($scope.selected.item);
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
   $scope.AsignarCompra = function(row){
        //$log.log(row);
        crudServiceOrders.setPres(row);

        crudServiceOrders.AsignarCom();
        $scope.cancel();
        //$log.log(row);
          //alert($scope.atributoSelected.NombreAtributos);
        //$scope.row1=row;
    };
});


})();