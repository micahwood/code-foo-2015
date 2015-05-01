'use strict';

angular
  .module('codefooApp')
  .controller('List', List);

function List(IgnDataService, $location) {
  var vm = this;

  vm.articles = IgnDataService.articles();
  vm.videos = IgnDataService.videos();
  vm.loadArticles = loadArticles;
  vm.loadVideos = loadVideos;

  activate();

  function activate() {
    var path = $location.path();
    if (! vm.articles.length && path === '/articles') {
      loadArticles();
    }
    if (! vm.videos.length && path === '/videos') {
      loadVideos();
    }
  }

  function loadArticles() {
    IgnDataService.getArticles().then(function(articles) {
      vm.articles = articles;
    });
  }

  function loadVideos() {
    IgnDataService.getVideos().then(function(videos) {
      vm.videos = videos;
    });
  }
}
