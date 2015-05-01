'use strict';

angular
  .module('codefooApp')
  .directive('articleItem', articleItem);

function articleItem() {
  var directive = {
    restrict: 'E',
    templateUrl: 'scripts/articles/articleItem.html',
  };

  return directive;
}
