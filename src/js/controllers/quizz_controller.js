angular.module('Quizz', [])

.controller('QuizzController', ['$scope', '$rootScope', '$location', 'QuizzService',
    function ($scope, $rootScope, $location, QuizzService) {

        $scope.nextQuestion = false;
        $scope.questionNumber =  Number($location.path().replace("/",""));
        $scope.nextLink = $scope.questionNumber;
        if ($scope['questionNumber'] === 5) {
          $scope.nextLink = "/coordonnees";
        } else {
          $scope.nextLink = $scope.questionNumber + 1;
        }
        if ( $scope['questionNumber'] === 2) {
          $scope.previousLink = "/";
        } else {
          $scope.previousLink = $scope.questionNumber - 1;
        }
        QuizzService.GetQuizzJson(function (response) {
          $scope.quizzJson = response[$scope.questionNumber - 2];
        });



        $scope.checkAnswers = function () {
            QuizzService.CheckAnswers($scope.quizzJson, function (newQuizzJson) {
              $scope.quizzJson = newQuizzJson;
              $scope.hideQuestion = true;
              $scope.nextQuestion = true;
            });
        };


    }]);
