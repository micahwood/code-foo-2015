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

function Main() {
  var main = this;

  main.sections = [
    {title: 'Videos', link: '#/videos'},
    {title: 'Articles', link: '#/articles'}
  ];
  main.activeSection = main.sections[0].title;
  main.isActive = isActive;
  main.updateSection = updateSection;

  function isActive(section) {
    return section === main.activeSection ? 'active' : '';
  }

  function updateSection(section) {
    main.activeSection = section;
  }
}
