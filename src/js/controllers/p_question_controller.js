angular.module('PreliminaryQuestion', [])

.controller('PreliminaryQuestionController', ['$scope', '$rootScope', '$location', 'DataService',
    function($scope, $rootScope) {

      $scope.setQuestionValue = function (pAnswer) {
          $rootScope.question = pAnswer;
      }

}]);
