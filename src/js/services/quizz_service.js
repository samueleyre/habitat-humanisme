angular.module('Quizz')

.factory('QuizzService',
    ['$http', '$rootScope',
    function ($http, $rootScope) {
        var service = {};

      service.GetQuizzJson = function(callback) {

        $http.get('quizz/quizz.json')
        .then(function(res){
          callback(res.data);
        });

      };

      service.CheckAnswers = function(quizzJson, callback) {
        for (var i = 0; i < quizzJson.responses.length; i++) {
          if (quizzJson.responses[i].user.toString() === quizzJson.responses[i].answer.toString()) {
            quizzJson.responses[i].result = "green";
          }
          else {
            quizzJson.responses[i].result = "red";
          }
        }
        callback(quizzJson);
      };

        return service;
    }]);
