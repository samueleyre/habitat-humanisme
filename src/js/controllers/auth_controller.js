angular.module('Authentication', [])

.controller('LoginController', ['$scope', '$rootScope', '$location', 'AuthenticationService',
    function ($scope, $rootScope, $location, AuthenticationService) {
        // reset login status
        AuthenticationService.ClearCredentials();

        $scope.hideLogin = true;
        $scope.login = function () {
            $scope.dataLoading = true;
            AuthenticationService.Login($scope.email, $scope.password, function (response) {
              // console.log(response, response.data.surname, response.data.name)
              if (response.success) {
                    AuthenticationService.SetCredentials(response.data.id, response.data.surname, response.data.name, $scope.email, $scope.password);
                    $location.path('/');
                } else {
                    $scope.error = response.message;
                    $scope.dataLoading = false;
                }
            });
        };
        var code = $location.search().code;
        if (code) {
          AuthenticationService.confirm_code(code, function(success) {
            if (success) {
              $scope.message_confirmation = "Inscription confirmée.";
            } else {
              $scope.message_confirmation = "Une erreur est survenue... Veuillez réessayer plus tard.";
            }
            $location.search('code', null);
          });
        }


    }]);
