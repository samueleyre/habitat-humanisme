angular.module('Data')

.directive('focusMe', function() {
  return {
    link: function(scope, element, attrs) {
      scope.$watch(attrs.focusMe, function(value) {
        if(value === true) {
          // console.log('value=',value);
            element[0].focus();
            scope[attrs.focusMe] = false;
        }
      });
    }
  };
});
