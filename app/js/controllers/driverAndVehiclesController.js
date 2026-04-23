/**
 * Created by Ohmel on 7/29/2015.
 */
ptApp.controller('driverAndVehiclesController', function ($location, $scope, Globals, ngDialog, ngNotify, $rootScope, $cookies, driverAndVehiclesService, $route) {

    // create a message to display in our view
    $scope.route = $route.current;
    $scope.globals = Globals;
    $scope.isLoggedIn = false;
    
    $rootScope.home = 'yes';
    
    $scope.message = "Angular JS works";

    $scope.$on("$routeChangeError", function (evt, current, previous, rejection) {
        if (rejection == "not_logged_in") {
            $location.path("/login");
        }
    });

    driverAndVehiclesService.driverList(function (success) {
                $scope.drivers = success.data;
        }, function (error) {
            ngNotify.set(error.message, 'error');
        });
    driverAndVehiclesService.vehiclesList(function (success) {
                $scope.vehicles = success.data;
        }, function (error) {
            ngNotify.set(error.message, 'error');
        });
    //
    $scope.searchDriver = function(q){
        driverAndVehiclesService.driverList(function (success) {
            $scope.drivers = success.data;
        }, function (error) {
            ngNotify.set(error.message, 'error');
        }, q);
    };
    $scope.searchVehicle = function(q){
        driverAndVehiclesService.vehiclesList(function (success) {
            $scope.vehicles = success.data;
        }, function (error) {
            ngNotify.set(error.message, 'error');
        }, q);
    };

    $scope.assignDriverToVehicles = function(driver){
        $scope.driverSelected = driver;
        ngDialog.open({
            template: 'app/js/pages/popups/assignDriverToVehicles.html?v=' + Date.now(),
            className: 'ngdialog-theme-mobile',
            scope: $scope
        });
    };
    $scope.assignDriver = function(){
        ngDialog.closeAll();
        ngDialog.open({
            template: 'app/js/pages/popups/assignDriver.html?v=' + Date.now(),
            className: 'ngdialog-theme-mobile',
            scope: $scope
        });
    };
    $scope.assignVehicle = function(vehicle){
        driverAndVehiclesService.assignVehicle(function(success){
            ngDialog.closeAll();
            $route.reload();
        }, function(error){
            ngNotify.set(error.message, 'error');
        }, $scope.driverSelected, vehicle);

    };
    $scope.revokeVehicle = function(){
        driverAndVehiclesService.revokeVehicle(function(success){
            ngDialog.closeAll();
            $route.reload();
        }, function(error){
            ngNotify.set(error.message, 'error');
        }, $scope.driverSelected.head.driver_id);

    };

    $scope.addVehicles = function(){
        $scope.addVehicleSubmit = function(form){
            driverAndVehiclesService.addVehicle(function(success){
                ngDialog.closeAll();
                $route.reload();
            }, function(error){
                ngNotify.set(error.message, 'error');
            }, form);
        };
        ngDialog.open({
            template: 'app/js/pages/popups/addVehicle.html?v=' + Date.now(),
            className: 'ngdialog-theme-mobile',
            scope: $scope
        });
    };

    $scope.addDrivers = function(){
        $scope.addDriverSubmit = function(form){
            driverAndVehiclesService.addDrivers(function(success){
                ngDialog.closeAll();
                $route.reload();
            }, function(error){
                ngNotify.set(error.message, 'error');
            }, form);
        };
        ngDialog.open({
            template: 'app/js/pages/popups/addDrivers.html?v=' + Date.now(),
            className: 'ngdialog-theme-mobile',
            scope: $scope
        });
    };

    //ngDialog.open({
    //    template: '<p>Hello World! I am a dialog box!</p>',
    //    plain: true
    //});
});