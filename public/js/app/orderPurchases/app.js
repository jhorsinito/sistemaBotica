(function(){
    var app = angular.module('orderPurchases',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'orderPurchases.controllers',
        'crudPurchases.services',
        'routes',
        'ui.bootstrap',
        'xeditable'
    ]);
    app.run(function(editableOptions) {
  editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
});
})();
