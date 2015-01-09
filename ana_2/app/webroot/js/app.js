(function () {

  var app = angular.module('ana', [
    'ngRoute',
    'ana.filters',
    'ana.controllers',
    'ana.services',
  ]);

  app.run(function($rootScope) {
    
    $rootScope.class_body = 'home';

    $rootScope.css_name = 'style_home';

    $rootScope.data = {

      step : 1

    };
  
  })

  app.config(['$routeProvider', function ($routeProvider) {

    $routeProvider
      .when('/', {
        templateUrl: 'views/index.html',
        controller: 'HomeController'
      })
      .when('/form2', {
        templateUrl: 'views/form2.html',
        controller: 'Form2Controller'
      })
      .when('/form3', {
        templateUrl: 'views/form3.html',
        controller: 'Form3Controller'
      })
      .when('/form4', {
        templateUrl: 'views/form4.html',
        controller: 'Form4Controller'
      })
      .when('/form5', {
        templateUrl: 'views/form5.html',
        controller: 'Form5Controller'
      })
      .when('/llamar', {
        templateUrl: 'views/llamar.html',
        controller: 'LlamarController'
      })
      .when('/enviarCotizacion', {
        templateUrl: 'views/enviar_cotizacion.html',
        controller: 'EnviarCotizacionController'
      })
      .when('/gracias', {
        templateUrl: 'views/gracias.html',
        controller: 'GraciasController'
      })
      .when('/contratar', {
        templateUrl: 'views/contratar.html',
        controller: 'ContratarController'
      })
      .otherwise({
        redirectTo: '/'
      });

  }]);

})();
