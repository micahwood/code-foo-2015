'use strict';

angular
  .module('codefooApp')
  .directive('videoList', videoList);

function videoList() {
  var directive = {
    restrict: 'E',
    templateUrl: 'views/videoList.html',
    controller: 'List',
    controllerAs: 'vm'
  };

  return directive;
}
