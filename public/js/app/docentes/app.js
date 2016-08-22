 (function(){
    var app = angular.module('docentes',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'docentes.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
    app.directive('uploaderModel', ["$parse", function ($parse) {
	return {
		restrict: 'A',
		link: function (scope, iElement, iAttrs) 
		{
			iElement.on("change", function(e)
			{
				$parse(iAttrs.uploaderModel).assign(scope, iElement[0].files[0]);
			});
		}
	};
	}])
})();

