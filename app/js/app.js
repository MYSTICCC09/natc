/**
 * Created by Ohmel on 7/29/2015.
 */
// app.js

// create the module and name it scotchApp
var ptApp = angular.module('ptApp', ['angularFileUpload', 'ngRoute', 'ngAnimate', 'ngDialog', 'ngNotify', 'ngCookies', 'ui.bootstrap', 'ngMessages']);
ptApp.filter('to_trusted', ['$sce', function ($sce) {
        return function (text) {
            return $sce.trustAsHtml(text);
        };
    }]);
ptApp.filter('startFrom', function () {
    return function (input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
});
ptApp.run(['$rootScope', '$location', 'loginService', function ($rootScope, $location, loginService) {
        $rootScope.$on('$routeChangeStart', function (event, next) {
//        console.log(next);
            //console.log($rootScope.user.isLoggedIn);

            if (next.access !== undefined) {
                if (next.access.requiresLogin === true) {

                }
            } else {

                return false;
            }
        })
    }]);
// create the controller and inject Angular's $scope
