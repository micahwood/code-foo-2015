'use strict';

angular
  .module('codefooApp')
  .filter('time', time);

function time(padFilter) {
  function timeConvert(input) {
    var minutes = Math.floor(input / 60);
    var seconds = padFilter(input - minutes * 60);

    return minutes + ':' + seconds;
  }

  return timeConvert;
}
