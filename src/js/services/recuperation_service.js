angular.module('Recuperation')

.factory('RecuperateService',
    ['$http','$rootScope',
    function ($http, $rootScope) {
        var service = {};

        service.RecuperatePwd = function (email, callback) {

          var data = { email : email }

          data = Object.keys(data).map(function(k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
          }).join('&');

          // console.log(data + "sent to "+ $rootScope.serverUrl+"recuperate.php")

             $http({
                 method: 'POST',
                 url: $rootScope.serverUrl+'recuperate.php',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data: data
               }).then(function successCallback(response) {
                //  console.log(response)
                   callback(response.data);
                 }, function errorCallback(response) {
                 });


        };
        return service;
    }]);
