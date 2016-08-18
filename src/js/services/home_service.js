angular.module('Home')

.factory('HomeService',
    ['$http', '$rootScope',
    function ($http, $rootScope) {
        var service = {};

        service.GetResults = function (studentId, callback) {
          var data = { id : studentId };
          data = Object.keys(data).map(function(k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
          }).join('&');


              console.log(data + "sent to "+ $rootScope.serverUrl+"results.php")

                 $http({
                     method: 'POST',
                     url: $rootScope.serverUrl+'results.php',
                     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                     data: data
                   }).then(function successCallback(response) {
                     console.log(response)
                       callback(response.data);
                     }, function errorCallback(response) {
                     });


        };
        return service;
    }]);
