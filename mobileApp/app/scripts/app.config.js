'use strict';

angular
  .module('codefooApp')
  .config(configure);

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
