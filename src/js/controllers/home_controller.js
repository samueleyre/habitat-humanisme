angular.module('Home', [])

.controller('HomeController', ['$scope', '$rootScope', '$location', 'HomeService', 'QuizzService',
    function ($scope, $rootScope, $location, HomeService, QuizzService) {

        $scope.results = {
          "respondents" : "0",
          "totalAmount": "0"
        };

            HomeService.GetResults($rootScope.globals.currentUser.id, function (response) {
                if (response.success) {
                  $scope.results.respondents = response.data.respondents;
                  $scope.results.totalAmount = response.data.totalamount;
                }
            });

    }]);
