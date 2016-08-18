angular.module('Subscription')

.factory('SubscriptionService',
    ['$http', '$rootScope',
    function ($http, $rootScope) {
        var service = {};

        service.Subscribe = function (surname, name, email, school, password, callback) {


          var data = { surname : surname, name : name, email: email, school: school, password: password };
          data = Object.keys(data).map(function(k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
          }).join('&');


              console.log(data + "sent to "+ $rootScope.serverUrl+"subscribe.php")

                 $http({
                     method: 'POST',
                     url: $rootScope.serverUrl+'subscribe.php',
                     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                     data: data
                   }).then(function successCallback(response) {
                     console.log(response)
                       callback(response.data);
                     }, function errorCallback(response) {
                     });

        };

        service.GetSchools = function (callback) {
          var data = {schools : "true"};
          data = Object.keys(data).map(function(k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
          }).join('&');


          console.log(data + "sent to "+ $rootScope.serverUrl+"schools.php")

          $http({
              method: 'POST',
              url: $rootScope.serverUrl+'schools.php',
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
