/**
 * Created by Ohmel on 7/29/2015.
 */
// configure our routes
ptApp.config(function ($routeProvider) {
    $routeProvider

        // route for the home page
        .when('/', {
            templateUrl: 'app/js/pages/home.html',
            controller: 'mainController',
            resolve: {
                load: function ($q, loginService, $rootScope) {
                    var defer = $q.defer();
                    loginService.checkIfLoggedIn().then(
                        function (success) {
                            if (success.data.isGuest === false) {
                                $rootScope.user = success.data;
                                defer.resolve();
                            } else {
                                defer.reject("not_logged_in");
                            }
                        },
                        function (error) {
                        });
                    return defer.promise;
                }
            }
        })
        .when('/bookings', {
            templateUrl: 'app/js/pages/bookings.html',
            controller: 'bookingController',
            resolve: {
                load: function ($q, loginService, $rootScope) {
                    var defer = $q.defer();
                    loginService.checkIfLoggedIn().then(
                        function (success) {
                            if (success.data.isGuest === false) {
                                $rootScope.user = success.data;
                                defer.resolve();
                            } else {
                                defer.reject("not_logged_in");
                            }
                        },
                        function (error) {
                        });
                    return defer.promise;
                }
            }
        })
        .when('/driversAndVehicles', {
            templateUrl: 'app/js/pages/dAndV.html',
            controller: 'driverAndVehiclesController',
            resolve: {
                load: function ($q, loginService, $rootScope) {
                    var defer = $q.defer();
                    loginService.checkIfLoggedIn().then(
                        function (success) {
                            $rootScope.user = success.data;
                            if (success.data.isGuest === false && success.data.userType == 'Admin') {
                                defer.resolve();
                            } else {
                                defer.reject("not_logged_in");
                            }
                        },
                        function (error) {
                        });
                    return defer.promise;
                }
            }
        })
        .when('/adminPanel', {
            templateUrl: 'app/js/pages/adminPanel.html',
            controller: 'adminPanelController',
            resolve: {
                load: function ($q, loginService, $rootScope) {
                    var defer = $q.defer();
                    loginService.checkIfLoggedIn().then(
                        function (success) {
                            $rootScope.user = success.data;
                            if (success.data.isGuest === false && success.data.userType == 'Admin') {
                                defer.resolve();
                            } else {
                                defer.reject("not_logged_in");
                            }
                        },
                        function (error) {
                        });
                    return defer.promise;
                }
            }
        })
//             route for the login page
        .when('/login', {
            templateUrl: 'app/js/pages/login.html',
            controller: 'loginController',
            resolve: {
                load: function ($q, loginService, $rootScope) {
                    var defer = $q.defer();
                    $rootScope.user = {
                        isLoggedIn:false,
                        isGuest:true,
                        userId:null,
                        name:null
                    };
                    defer.resolve();
                    return defer.promise;
                }
            }
        })
        .when('/logout', {
            templateUrl: 'app/js/pages/logout.html',
            controller: 'loginController'
        });
});