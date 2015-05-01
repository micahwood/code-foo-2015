'use strict';

angular
  .module('codefooApp')
  .config(configure)
  .run(run);

function configure($routeProvider) {
  $routeProvider
    .when('/videos', {
      templateUrl: 'views/videos.html'
    })
    .when('/articles', {
      templateUrl: 'views/articles.html'
    })
    .otherwise('/videos');
}

function run($rootScope, $location) {
  $rootScope.$on('$routeChangeSuccess', function() {
    var section = normalizeSection($location.path());
    $rootScope.activeSection = section;
  });
}

function normalizeSection(str) {
  var section = str.substring(1);

  return section.charAt(0).toUpperCase() + section.substring(1);
}
