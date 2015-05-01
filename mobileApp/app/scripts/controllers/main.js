'use strict';

/**
 * @ngdoc function
 * @name codefooApp.controller:Main
 * @description
 * # Main
 * Controller of the codefooApp
 */
angular
  .module('codefooApp')
  .controller('Main', Main);

function Main($rootScope) {
  var main = this;

  main.sections = [
    {title: 'Videos', link: '#/videos'},
    {title: 'Articles', link: '#/articles'}
  ];
  main.activeSection = '';
  main.isActive = isActive;

  activate();

  function activate() {
    $rootScope.$watch('activeSection', function(section) {
      main.activeSection = section;
    });
  }

  function isActive(section) {
    return section === main.activeSection ? 'active' : '';
  }
}
