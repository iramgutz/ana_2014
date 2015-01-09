(function () {

  angular.module('ana.services', [])

    .factory('AnaService', ['$http', '$q', '$filter' , function ($http, $q , $filter) {     
      

      function API( method , params, get) 
      {

        var deferred = $q.defer();

        var url = 'API/';

        url += method;

        if(get)
          url += '?';

        angular.forEach( params , function(value, key) {

          if(!get)
            url +=  '/' + value;
          else
            url +=  key+ '=' + value+'&';

        });

        $http.get(url)
          .success(function (data) {
            deferred.resolve(data);
          });

        return deferred.promise;

      }

      function sendCotizacion(tipo_envio, fax ,params)
      {

        var deferred = $q.defer();

        var url = 'site/sendCotizacion';

        if(tipo_envio == 'email')
          url = 'site/sendCotizacion';
        else if(tipo_envio == 'fax')
          url = 'site/sendFax';

        $http({
            method: 'POST',
            url: url,
            data: $.param(params),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })

        //$http.post(url , $.param(params))
          .success(function (data) {

            deferred.resolve(data);

          });

        return deferred.promise;

      }

      function sendCRM(params)
      {

        var deferred = $q.defer();

        var url = 'crm/store-prospect-ajax';

        $http({
            method: 'POST',
            url: url,
            data: $.param(params),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function (data) {

          deferred.resolve(data);

        });

        return deferred.promise;

      }

      /*25507

      pagos 1827 14

      n pagos 1104 48 

      52992

      viridiana ochoa*/

      return {
        API : API,
        sendCotizacion : sendCotizacion ,
        sendCRM : sendCRM
      };

    }]);

})();
