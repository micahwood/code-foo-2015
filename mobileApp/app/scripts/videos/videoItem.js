'use strict';

angular
  .module('codefooApp')
  .directive('videoItem', videoItem);

function videoItem() {
  var directive = {
    restrict: 'E',
    templateUrl: 'views/videoItem.html'
  };

  return directive;
}
