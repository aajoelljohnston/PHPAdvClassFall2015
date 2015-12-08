'use strict';
var appControllers = angular.module('appControllers', []);
appControllers.controller('CorpsCtrl', ['$scope', '$log', 'corpsProvider',
    function ($scope, $log, corpsProvider) {
        
        $scope.corporations = [];

        function getCorporations() {
            corpsProvider.getAllCorporations().success(function (response) {
                $scope.corporations = response.data;
            }).error(function (response, status) {
                $log.log(response);
            });
        }
        ;

        getCorporations();

    }])

.controller('CorpsDetailCtrl', ['$scope', '$log', '$routeParams', 'corpsProvider',
    function($scope, $log, $routeParams, corpsProvider) {
    
       var corpsID = $routeParams.corpsId;
        
       function getCorporation() {    
            corpsProvider.getCorporation(corpsID).success(function(response) {
                $scope.corporations = response.data[0];
                $scope.corporations.incorp_dt = new Date($scope.corporations.incorp_dt);
                loadMap($scope.corporations.location);
                console.log($scope.corporations);
                console.log(corpsID);
            }).error(function (response, status) {
               $log.log(response);
            });
        };

        getCorporation();
        
        function loadMap(location) {

        var lat = location.split(',')[0];
        var long = location.split(',')[1];

            var myCenter = new google.maps.LatLng(lat, long);

                var mapProp = {
                    center: myCenter,
                    zoom: 6,
                    mapTypeId: google.maps.MapTypeId.ROADMAP, 
                };
                var map = new google.maps.Map(document.getElementById('googleMap'), mapProp);
                var marker = new google.maps.Marker({
                    position: myCenter
                });
                marker.setMap(map);

        }
        
        
    
}]);
    
       


