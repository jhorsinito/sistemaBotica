(function(){
    var app = angular.module('orders',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'orders.controllers',
        'crud.services.orders',
        'routes',
        'ui.bootstrap'
    ]);

angular.module('orders').controller('ModalInstanceCtrl', function ($scope,$log, $modalInstance,presentations,crudServiceOrders) {
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
        //alert("Hola");
        crudServiceOrders.setPres(row);
        crudServiceOrders.qewsdxxd();
        $scope.cancel();
        //$log.log(row);
          //alert($scope.atributoSelected.NombreAtributos);
        //$scope.row1=row;
    };
});


})();