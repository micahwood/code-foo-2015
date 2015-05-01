'use strict';

angular
  .module('codefooApp')
  .directive('articleList', articleList);

function articleList() {
  var directive = {
    restrict: 'E',
    templateUrl: 'scripts/articles/articleList.html',
    controller: 'List',
    controllerAs: 'vm'
  };

  return directive;
}
