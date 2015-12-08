 'use strict';

var myApp = angular.module('myApp', [
  'ngRoute',
  'appControllers',
  'appServices'
]);

myApp.constant('config', {
    "endpoints": {
       "corps" : 'http://localhost/PHPAdvClassFall2015/week5/demo/api/v1/corps',
    },              
    "models" : {
        "corps" : {
           "corp": '',
           "incorp_dt": '',  
           "email": '',
           "owner": '',
           "phone": '',
           "location": ''          
        } 
    }        
});

myApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
        when('/', {        
            templateUrl: 'partials/corporations.html',
            controller: 'CorpsCtrl'
        }).
        when('/corps/:corpsId', {
            templateUrl: 'partials/corps-detail.html',
            controller: 'CorpsDetailCtrl'
        }).
        otherwise({
          redirectTo: '/'
        });
  }]);
  

