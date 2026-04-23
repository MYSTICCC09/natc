/**
 * Created by Ohmel on 7/29/2015.
 */
ptApp.controller('adminPanelController', function ($location, $scope, Globals, ngDialog, ngNotify, $rootScope, $cookies, adminPanelService, $route) {

    // create a message to display in our view
    $scope.route = $route.current;
    $scope.globals = Globals;
    $scope.isLoggedIn = false;
    $scope.angular = angular;
    
    $rootScope.home = 'yes';
    
    $scope.message = "Angular JS works";

    adminPanelService.listUsers(function(success){
       $scope.users = success.data;
    }, function(error){
        ngNotify.set(error.message, 'error');
    });

    $scope.addUser = function(){

        $scope.addUserSubmit = function(form){
            adminPanelService.addUser(function(success){
                adminPanelService.listUsers(function(success){
                    $scope.users = success.data;
                    ngDialog.closeAll();
                }, function(error){
                    ngNotify.set(error.message, 'error');
                });
            }, function(error){
                ngNotify.set(error.message, 'error');
            }, form);
        };

        ngDialog.open({
            template: 'app/js/pages/popups/addUser.html?v=' + Date.now(),
            className: 'ngdialog-theme-mobile',
            scope: $scope
        });
    };


    $scope.$on("$routeChangeError", function (evt, current, previous, rejection) {
        if (rejection == "not_logged_in") {
            $location.path("/login");
        }
    });



    //ngDialog.open({
    //    template: '<p>Hello World! I am a dialog box!</p>',
    //    plain: true
    //});
});