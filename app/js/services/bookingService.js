ptApp.service('bookingService', function ($http, Globals, $q) {

    "use strict";
    var url = Globals.remoteRootUrl + "index.php/api/";

    var quickBook = function (callback, errback) {
        $http({
            method: 'GET',
            url: url + 'booking/quickBook'
        }).success(callback).error(errback);
    };
    var bookingList = function (callback, errback, q) {
        $http({
            method: 'GET',
            url: url + 'booking/bookingList',
            params: {
                q: q
            }
        }).success(callback).error(errback);
    };
    var bookingListToday = function (callback, errback) {
        $http({
            method: 'GET',
            url: url + 'booking/bookingListToday'
        }).success(callback).error(errback);
    };
    var availableVehicles = function (callback, errback) {
        $http({
            method: 'GET',
            url: url + 'booking/availableVehicles'
        }).success(callback).error(errback);
    };
    var assignCab = function (callback, errback, bookingId, vdId) {
        $http({
            method: 'POST',
            url: url + 'booking/assignCab',
            data: {
                vdId: vdId,
                bookingId: bookingId
            }
        }).success(callback).error(errback);
    };
    var cancelAssignment = function (callback, errback, bookingId) {
        $http({
            method: 'GET',
            url: url + 'booking/cancelAssignment',
            params: {
                bookingId: bookingId
            }
        }).success(callback).error(errback);
    };
    var markBookingAsDone = function (callback, errback, bookingId) {
        $http({
            method: 'GET',
            url: url + 'booking/markBookingAsDone',
            params: {
                bookingId: bookingId
            }
        }).success(callback).error(errback);
    };
    var cancelBooking = function (callback, errback, bookingId) {
        $http({
            method: 'GET',
            url: url + 'booking/cancelBooking',
            params: {
                bookingId: bookingId
            }
        }).success(callback).error(errback);
    };

    return {
        quickBook: quickBook,
        cancelBooking: cancelBooking,
        markBookingAsDone: markBookingAsDone,
        cancelAssignment: cancelAssignment,
        assignCab: assignCab,
        availableVehicles: availableVehicles,
        bookingListToday: bookingListToday,
        bookingList: bookingList
    };
});