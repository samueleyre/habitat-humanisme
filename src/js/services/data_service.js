angular.module('Data')

.factory('DataService',
    ['$http', '$rootScope', '$timeout',
    function ($http, $rootScope, $timeout) {
        var service = {};

        service.GetData = function (studentId, surname, name, email, address, zipCode, city, gender, age, activity,donation, amount, callback) {
          var tdata = [surname, name, email, address, zipCode, city, gender, age, activity, donation];

          // if no input fill with unknown
          for (var index in tdata) {
            if (tdata[index] === "") {
              tdata[index] = "unknown";
            }
          }
          if (amount === "") {
            amount = 0;
          }
          var data = { id : studentId, surname : tdata[0], name : tdata[1], email : tdata[2], address : tdata[3], zipcode : tdata[4], city : tdata[5], gender : tdata[6], age : tdata[7], question : $rootScope["question"], activity: tdata[8], donation : tdata[9], amount : amount };


          data = Object.keys(data).map(function(k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
          }).join('&');

          console.log(data + "sent to "+ $rootScope.serverUrl+"data.php")

             $http({
                 method: 'POST',
                 url: $rootScope.serverUrl+'data.php',
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
