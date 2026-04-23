ptApp.service('driverAndVehiclesService', function ($http, Globals, $q) {

    "use strict";
    var url = Globals.remoteRootUrl + "index.php/api/";

    var driverList = function (callback, errback, q) {
        $http({
            method: 'GET',
            url: url + 'driverAndVehicles/driverList',
            params: {
                q: q
            }
        }).success(callback).error(errback);
    };

    var vehiclesList = function (callback, errback, q) {
        $http({
            method: 'GET',
            url: url + 'driverAndVehicles/vehiclesList',
            params: {
                q: q
            }
        }).success(callback).error(errback);
    };
    var assignVehicle = function (callback, errback, driver, vehicle) {
        $http({
            method: 'POST',
            url: url + 'driverAndVehicles/assignVehicle',
            data: {
                driverId: driver.head.driver_id,
                vehicleId: vehicle.vehicle_id
            }
        }).success(callback).error(errback);
    };
    var revokeVehicle = function (callback, errback, dId) {
        $http({
            method: 'GET',
            url: url + 'driverAndVehicles/revokeVehicle',
            params: {
                driverId: dId
            }
        }).success(callback).error(errback);
    };
    var addVehicle = function (callback, errback, form) {
        $http({
            method: 'POST',
            url: url + 'driverAndVehicles/addVehicle',
            data: form
        }).success(callback).error(errback);
    };
    var addDrivers = function (callback, errback, form) {
        $http({
            method: 'POST',
            url: url + 'driverAndVehicles/addDrivers',
            data: form
        }).success(callback).error(errback);
    };
    return {
        addDrivers: addDrivers,
        addVehicle: addVehicle,
        revokeVehicle: revokeVehicle,
        assignVehicle: assignVehicle,
        vehiclesList: vehiclesList,
        driverList: driverList
    };
});