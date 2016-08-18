angular.module('Data', [])

.controller('DataController', ['$scope', '$rootScope', '$location', 'DataService',
    function ($scope, $rootScope, $location, DataService) {

        $scope.focusInput = false;
        $scope.showPopUp = false;
        $scope.data = {"surname" : "",
                        "name": "",
                        "gender": "",
                        "email": "",
                        "adress": "",
                        "zipCode": "",
                        "city": "",
                        "age": "",
                        "activity": "",
                        "donation": "",
                        "amount": ""
                      };

        $scope.getData = function () {
          DataService.GetData($rootScope.globals.currentUser.id, $scope.data.surname, $scope.data.name, $scope.data.email, $scope.data.adress, $scope.data.zipCode, $scope.data.city, $scope.data.gender, $scope.data.age, $scope.data.activity, $scope.data.donator, $scope.data.amount, function (response) {
          });
        };
        $scope.showModal = function () {
          $scope.showPopUp = true;
        }
        $scope.cancel = function () {
          $scope.showPopUp = false;
        }

    }]);
