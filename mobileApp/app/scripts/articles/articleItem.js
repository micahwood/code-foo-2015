'use strict';

angular
  .module('codefooApp')
  .directive('articleItem', articleItem);

function articleItem() {
  var directive = {
    restrict: 'E',
    templateUrl: 'views/articleItem.html',
  };

  return directive;
}
