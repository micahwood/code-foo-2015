'use strict';

angular
  .module('codefooApp')
  .factory('IgnDataService', IgnDataService);

function IgnDataService($http, $q) {
  var BASE_URL = 'http://ign-apis.herokuapp.com',
    ITEM_COUNT = 10,
    JSONP_SUPPORT = '&callback=JSON_CALLBACK',
    articles = [],
    articleEndpoint = '/articles',
    articleStartIndex = 0,
    videos = [],
    videoEndpoint = '/videos',
    videoStartIndex = 0;

  var service = {
    articles: loadedArticles,
    getArticles: getArticles,
    videos: loadedVideos,
    getVideos: getVideos
  };

  return service;

  function loadedArticles() {
    return articles;
  }

  function loadedVideos() {
    return videos;
  }

  function getArticles() {
    var deferred = $q.defer();
    request(articleEndpoint, articleStartIndex).success(function (response) {
      articles = articles.concat(normalizeData(response.data));
      articleStartIndex += ITEM_COUNT;
      deferred.resolve(articles);
    });
    return deferred.promise;
  }

  function getVideos() {
    var deferred = $q.defer();
    request(videoEndpoint, videoStartIndex).success(function (response) {
      videos = videos.concat(normalizeData(response.data));
      videoStartIndex += ITEM_COUNT;
      deferred.resolve(videos);
    });
    return deferred.promise;
  }

  function request(endpoint, startIndex) {
    var url = BASE_URL + endpoint + '?count=' + ITEM_COUNT + '&startIndex=' + startIndex + JSONP_SUPPORT;
    return $http.jsonp(url);
  }

  function normalizeData(data) {
    return data.map(function(item) {
      return item.metadata;
    });
  }
}
