'use strict';

angular
  .module('codefooApp')
  .filter('pad', pad);

function pad() {
  return function(number, increment) {
    if (increment) {
      number += increment;
    }
    number = number.toString(10);
    if (number.length < 2) {
      number = '0' + number;
    }
    return number;
  };
}
