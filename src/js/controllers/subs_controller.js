angular.module('Subscription', [])

.controller('SubscriptionController', ['$scope', '$rootScope', '$location', 'SubscriptionService',
    function ($scope, $rootScope, $location, SubscriptionService) {


        $scope.subscribe = function () {
            $scope.dataLoading = true;
            SubscriptionService.Subscribe($scope.subSurname, $scope.subName, $scope.subEmail, $scope.school, $scope.subPassword, function (response) {
                if (response.success) {
                  $location.path('/login');
                } else {
                    $scope.error = response.message;
                    $scope.dataLoading = false;
                }
            });
        };

        SubscriptionService.GetSchools(function(response) {
          if (response.success) {
            $scope.schools = response.data.schools;
            console.log($scope['schools']);
          }
        });
    }]);
