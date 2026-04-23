/**
 * Created by Ohmel on 7/29/2015.
 */
ptApp.controller('mainController', function ($location, $scope, Globals, ngDialog, ngNotify, $rootScope, $cookies, loginService, $route) {

    // create a message to display in our view
    $scope.route = $route.current;
    $scope.globals = Globals;
    $scope.isLoggedIn = false;
    $scope.angular = angular;
    
    $rootScope.home = 'yes';
    
    $scope.message = "Angular JS works";

    loginService.checkIfLoggedIn().then(
        function (success) {
            $rootScope.user = success.data;
            $scope.userNav = success.data;
        },
        function (error) {
        });

    $scope.$on("$routeChangeError", function (evt, current, previous, rejection) {
        if (rejection == "not_logged_in") {
            $location.path("/login");
        }
    });

    $scope.viewMap = function () {
            ngDialog.open({
                template: 'app/js/pages/popups/map.html',
                className: 'ngdialog-theme-default'
            });
        };
    
//    jobsService.listRecentJobs(function (success) {
//                $scope.jobs = success.data;
//        }, function (error) {
//            ngNotify.set(error.message, 'error');
//        });

    $scope.findItems = function (query) {
        $location.path("/items/" + query);
    };

    $scope.logout = function () {

        loginService.logout(function (success) {
            $rootScope.user = success.data;
            $location.path("/login");
        }, function (error) {

        });
    };


    

    //ngDialog.open({
    //    template: '<p>Hello World! I am a dialog box!</p>',
    //    plain: true
    //});
});