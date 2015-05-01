'use strict';

angular
  .module('codefooApp')
  .directive('videoItem', videoItem);

function videoItem() {
  var directive = {
    restrict: 'E',
    templateUrl: 'scripts/videos/videoItem.html'
  };

  return directive;
}
