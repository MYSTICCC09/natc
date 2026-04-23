/**
 * Created by Ohmel on 7/29/2015.
 */
ptApp.controller('loginController', function ($location, $rootScope,$scope, Globals, ngDialog, ngNotify, loginService) {

    // create a message to display in our view
    $scope.globals = Globals;
    $scope.perms = [];

    if(Globals.isNothing($rootScope.user) != true){
        if($rootScope.user.isGuest == false){
            $location.path( "/");
        }
    }

    $scope.login = function () {
        //alert("ASDf");
        if ($scope.globals.isNothing($scope.user) || $scope.user.length === 0) {
            ngDialog.open({
                template: '<p>Please put login details!</p>',
                plain: true
            });
        } else {
            loginService.login(
                function (success) {
                    $rootScope.user = success.data;
                    $location.path( "/");
                }, function (error) {
                    ngNotify.set(error.message, 'error')
                    $rootScope.user = {};
                }, $scope.user);
        }
    }

    $scope.findItems = function(query){
        $location.path("/items/"+query);
    }

});