//
// angular.module('Authentication', []);


angular.module('MyApp', [
  'Authentication',
  'Subscription',
  'Home',
  'PreliminaryQuestion',
  'Quizz',
  "Data",
  'ngRoute',
  'ngCookies',
  'mobile-angular-ui'
])


.config(['$routeProvider', function ($routeProvider) {

    $routeProvider
        .when('/login', {
            controller: 'LoginController',
            templateUrl: 'login.html',
            reloadOnSearch: false
        })
        .when('/inscription', {
            controller: 'SubscriptionController',
            templateUrl: 'subscription.html',
            reloadOnSearch: false
        })
        .when('/', {
            controller: 'HomeController',
            templateUrl: 'home.html',
            reloadOnSearch: false
        })
        .when('/1', {
            controller: 'PreliminaryQuestionController',
            templateUrl: 'preliminaryQuestion.html',
            reloadOnSearch: false
        })
        .when('/info', {
            templateUrl: 'info.html',
            reloadOnSearch: false
        })
        .when('/2', {
          controller: 'QuizzController',
          templateUrl:'quizz.html',
          reloadOnSearch: false
        })
        .when('/3', {
          controller: 'QuizzController',
          templateUrl:'quizz.html',
          reloadOnSearch: false
        })
        .when('/4', {
          controller: 'QuizzController',
          templateUrl:'quizz.html',
          reloadOnSearch: false
        })
        .when('/5', {
          controller: 'QuizzController',
          templateUrl:'quizz.html',
          reloadOnSearch: false
        })
        .when('/coordonnees', {
          controller: 'DataController',
          directive: 'focusMe',
          templateUrl:'data.html',
          reloadOnSearch: false})

        .otherwise({ redirectTo: '/login' });
}])

.run(['$rootScope', '$location', '$cookieStore', '$http',
    function ($rootScope, $location, $cookieStore, $http) {
        // keep user logged in after page refresh
        $rootScope.globals = $cookieStore.get('globals') || {};
        if ($rootScope.globals.currentUser) {
            $http.defaults.headers.common['Authorization'] = 'Basic' + $rootScope.globals.currentUser.authdata; // jshint ignore:line
        }

        $rootScope.$on('$locationChangeStart', function (event, next, current) {
            // redirect to login page if not logged in
            if ($location.path() !== '/login' && !$rootScope.globals.currentUser && $location.path() !== '/inscription') {
                $location.path('/login');
            }
        });

        // memorize first answer
        $rootScope.question = "unknown";

        //define url
        // testing Amel
        // $rootScope.serverUrl = "http://localhost:8888/";

        // local
        // $rootScope.serverUrl = "http://localhost/server-side/";

        // real
        $rootScope.serverUrl = "http://www.samueleyre.com/work/habethu/server/";



    }]);
