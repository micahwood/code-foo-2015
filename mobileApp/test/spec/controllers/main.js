'use strict';

describe('Controller: MainCtrl', function () {

  // load the controller's module
  beforeEach(module('codefooApp'));

  var MainCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    MainCtrl = $controller('Main', {
      $scope: scope
    });
  }));

  it('should not be tested for now', function () {
    expect(3).toBe(3);
  });
});
