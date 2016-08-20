angular.module('Recuperation', [])

.controller('RecuperationController', ['$scope', 'RecuperateService',
    function ($scope, RecuperateService) {


        $scope.hideEmailInput = false;

        $scope.recuperatePwd = function () {
            RecuperateService.RecuperatePwd($scope.recupe_email, function (response) {
                if (response.success) {
                    $scope.message_confirmation = "Mot de passe envoyée.";
                    $scope.hideEmailInput = true;
                } else {
                    $scope.message_confirmation = "Cet email n'est pas dans la base de donnée...";
                }
            });
        };


    }]);
