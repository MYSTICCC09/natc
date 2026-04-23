ptApp.service('loginService', function ($http, Globals, $q) {

    "use strict";
    var url = Globals.remoteRootUrl + "index.php/api/";

    var user = {};

    var test = function (callback, errback) {
        $http({
            method: 'GET',
            url: url + 'site/test'
        }).success(callback).error(errback);
    };
    var login = function (callback, errback, user) {
        $http({
            method: 'POST',
            url: url + 'site/login',
            data: user
        }).success(callback).error(errback);
    };

    var checkIfLoggedIn = function (callback, errback) {
//        $http({
//            method: 'GET',
//            url: url + 'site/checkLogin'
//        }).success(function (data) {
//            return data;
//        }).error(errback);

        return $http.get(url + 'site/checkLogin')
                .then(function (response) {
                    if (typeof response.data === 'object') {
                        return response.data;
                    } else {
                        // invalid response
                        return $q.reject(response.data);
                    }

                }, function (response) {
                    // something went wrong
                    return $q.reject(response.data);
                });
    };

    var checkIfAuthorized = function () {
        //var result = {}
        $http({
            method: 'GET',
            url: url + 'site/checkLogin'
        }).success(function (data) {
            return data;
        });

    };

    var logout = function (callback, errback) {
        $http({
            method: 'GET',
            url: url + 'site/logout'
        }).success(callback).error(errback);
    };


    return {
        test: test,
        checkIfLoggedIn: checkIfLoggedIn,
        checkIfAuthorized: checkIfAuthorized,
        logout: logout,
        login: login
    };
});