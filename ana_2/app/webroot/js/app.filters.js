(function () {

  angular.module('ana.filters', [])

    .filter('round', function () {

      return function (input) {
        
        return Math.round(input);

      };
    });

})();
