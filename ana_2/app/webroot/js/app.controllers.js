(function (_) {

  angular.module('ana.controllers', [])

    .controller('HomeController', ['$scope', '$rootScope','$routeParams' , '$location' ,'AnaService' , function ($scope, $rootScope , $routeParams , $location , AnaService) {

      $rootScope.class_body = 'home';

      $rootScope.css_name = 'style_home';

      $scope.error_cp = false;

      $scope.seguro = 0;

      $scope.checkCP = function()
      {

        var CP = $scope.codigo_postal;

        if(!CP)
        {
          $scope.error_cp = 'Debes ingresar un código postal';
        }
        else
        {

          var params = {
            'CP' : CP
          };

          AnaService.API('checkCP' , params).then(function (data) {            

            if(data)
            {
              $scope.error_cp = false;

              $scope.data = data;

              $scope.data.seguro = $scope.seguro;

              $scope.data.step = 2;

              $rootScope.data = $scope.data;

              $location.path( "/form2" );  
              
            }
            else
            {
              $scope.error_cp = 'Debes ingresar un código postal válido';
            }

          })

        }

      }

    }])

    .controller('Form2Controller', ['$scope', '$rootScope' , '$location' ,'AnaService' , function ($scope, $rootScope , $location , AnaService) { 

      $rootScope.class_body = 'cotiza';

      $rootScope.css_name = 'style_cotiza';

      $scope.data = $rootScope.data;

      if($scope.data.step != 2)
      {
        $location.path( "/" );  
      }

      $scope.error_form = false;

      $scope.checkForm = function(valid)
      {

        if(valid)
        {
          $scope.error_form = false;

          $scope.data.datos = $scope.datos;

          AnaService.sendCRM(

            $scope.data

          ).then(function (data) {   

            $scope.data.CRMId = data; 

            $scope.data.step = 3;

            $rootScope.data = $scope.data;

            $location.path( "/form3" ); 

          }) 


        }
        else
        {
          $scope.error_form = 'Existen errores en el formulario';
        }

      }


    }])

    .controller('Form3Controller', ['$scope', '$rootScope' , '$location' ,'AnaService' , function ($scope, $rootScope , $location , AnaService) { 

      $rootScope.class_body = 'datos_coche';

      $rootScope.css_name = 'datos_coche';

      $scope.data = $rootScope.data;
      
      if($scope.data.step != 3)
      {
        $location.path( "/" );  
      }

      $scope.years = false;

      $scope.brands = false;

      $scope.subbrands = false;

      $scope.vehicles = false;

      AnaService.API('getYears' , {}).then(function (data) {            
            
        $scope.years = data; 

      })

      $scope.getBrands = function()
      {

        AnaService.API('getBrands' , 
                      {
                        'year' : $scope.car.year
                      }
                  )
                  .then(function (data) {            
            
                    $scope.brands = data; 

                  });
      }

      $scope.getSubBrands = function()
      {

        AnaService.API('getSubBrands' , 
                      {
                        'year' : $scope.car.year , 
                        'brand' : $scope.car.brand
                      }
                  )
                  .then(function (data) {            
            
                    $scope.subbrands = data; 

                  });

      }

      $scope.getVehicles = function()
      {

        AnaService.API('getVehicles' , 
                      {
                        'year' : $scope.car.year , 
                        'brand' : $scope.car.brand,
                        'subbrand' : $scope.car.subbrand,
                      }
                  )
                  .then(function (data) {            
            
                    $scope.vehicles = data;

                  });

      }

      $scope.setDescription = function()
      {
        console.log($scope.vehicles[$scope.car.vehicle]);
        $scope.car.description = $scope.vehicles[$scope.car.vehicle];

      }

      $scope.checkForm = function(valid)
      { 

        if(valid)
        { 
          $scope.error_form = false;

          $scope.data.car = $scope.car;

          AnaService.sendCRM(

            $scope.data

          ).then(function (data) {  

            AnaService.API('getCotizacion' , 
              {
                'car' : JSON.stringify($scope.car) , 
                'data' : JSON.stringify($scope.data) , 
              } ,
              true
            )
            .then(function (data) { 
              

              $scope.data.cotizacion = data;

              $scope.data.step = 4;

              $rootScope.data = $scope.data;   

              $location.path( "/form4" );                      

            });

          })
        }
        else
        {
          $scope.error_form = 'Existen errores en el formulario';
        }

      }

    }])

    .controller('Form4Controller', ['$scope', '$rootScope' , '$location' , '$filter' , 'AnaService' , function ($scope, $rootScope , $location , $filter , AnaService) { 

      $rootScope.class_body = 'cobertura';

      $rootScope.css_name = 'cobertura';

      $scope.data = $rootScope.data;   
      
      if($scope.data.step != 4)
      {
        $location.path( "/" );  
      }   

      $scope.checkForm = function()
      {

        $rootScope.data.pago = $scope.pago;

        $rootScope.data.cobertura = $scope.cobertura;

        $rootScope.data.cotizacionFinal = $rootScope.data.cotizacion[$scope.cobertura];

         AnaService.sendCRM(

            $rootScope.data

          ).then(function (data) {  

            $rootScope.data.step = 5;

            $location.path( "/form5" );  

          })


      }

    }])

    .controller('Form5Controller', ['$scope', '$rootScope' , '$location' , '$filter' , 'AnaService' , function ($scope, $rootScope , $location , $filter , AnaService) { 

      if($scope.data.step != 5)
      {
        //$location.path( "/" );  
      }   

      $rootScope.class_body = 'cobertura';

      $rootScope.css_name = 'cobertura';

      $scope.data = $rootScope.data;  

      $scope.llamar = 'si'; 

      $rootScope.data.step = 6;

      $scope.contratarForm = function()
      {

        $rootScope.data.step = 'contratar';

        $location.path( "/contratar" );  

      }

      $scope.contratar = function()
      {

        $location.path( "/contratar" );         

      }


      $scope.next = function()
      {
        if($scope.llamar == 'si')
        {
          $location.path( "/llamar" ); 
        }
        else if($scope.llamar == 'no')
        {
          $location.path( "/enviarCotizacion" ); 
        }
      }

    }])

    .controller('LlamarController', ['$scope', '$rootScope' , '$location' , '$filter' , 'AnaService' , function ($scope, $rootScope , $location , $filter , AnaService) { 

      if($scope.data.step != 6)
      {
        $location.path( "/" );  
      } 

      $rootScope.class_body = 'llamar';

      $rootScope.css_name = 'llamar';

      $scope.data = $rootScope.data;  


    }])

    .controller('EnviarCotizacionController', ['$scope', '$rootScope' , '$location' , '$filter' , 'AnaService' , function ($scope, $rootScope , $location , $filter , AnaService) { 

      if($scope.data.step != 6)
      {
        $location.path( "/" );  
      } 
      
      $rootScope.class_body = 'llamar';

      $rootScope.css_name = 'llamar';

      $scope.data = $rootScope.data;  

      $scope.data.tipo_envio = 'email';

      $scope.data.fax = '';

      $scope.send = function()
      {

        AnaService.sendCotizacion( 
            $scope.data.tipo_envio,

            $scope.data.fax,

            {
              'data' : $scope.data 
            } 
          )
          .then(function (data) {  

            $rootScope.data.step = 7;

            $location.path( "/gracias" );                      

          });

      }

    }])

    .controller('GraciasController', ['$scope', '$rootScope' , '$location' , '$filter' , 'AnaService' , function ($scope, $rootScope , $location , $filter , AnaService) { 

      if($scope.data.step != 7)
      {
        $location.path( "/" );  
      } 

      $rootScope.class_body = 'llamar';

      $rootScope.css_name = 'llamar';

      $scope.data = $rootScope.data;  

    }])

    .controller('ContratarController', ['$scope', '$rootScope' , '$location' , '$filter' , 'AnaService' , function ($scope, $rootScope , $location , $filter , AnaService) { 

      if($scope.data.step != 6)
      {
        //$location.path( "/" );  
      } 

      $rootScope.class_body = 'cobertura';

      $rootScope.css_name = 'cobertura';

      $scope.data = $rootScope.data;  

    }])

})();
