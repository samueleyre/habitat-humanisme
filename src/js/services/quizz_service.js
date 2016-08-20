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
        // We don't verify the answers...
        for (var i = 0; i < quizzJson.responses.length; i++) {
          if (quizzJson.responses[i].answer) {
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
