/**
 * Created by Ohmel on 7/29/2015.
 */
ptApp.controller('bookingController', function ($location, $scope, Globals, ngDialog, ngNotify, $rootScope, $cookies, bookingService, $route) {

    // create a message to display in our view
    $scope.route = $route.current;
    $scope.globals = Globals;
    $scope.isLoggedIn = false;

    $rootScope.home = 'yes';
    $rootScope.withBooking = 0;

    $scope.message = "Angular JS works";

    $scope.$on("$routeChangeError", function (evt, current, previous, rejection) {
        if (rejection == "not_logged_in") {
            $location.path("/login");
        }
    });


    $scope.quickBook = function(){
        bookingService.quickBook(function (success) {
            bookingService.bookingListToday(function (success) {
                $scope.bookingsToday = success.data;
                ngDialog.closeAll();
                ngNotify.set("Successfully Qicked Booked", 'success');
            }, function (error) {
                ngNotify.set(error.message, 'error');
            });
        }, function (error) {
            ngNotify.set(error.message, 'error');
        });
    };
    $scope.dispatch = function (booking) {
        $scope.booking = booking;
        $scope.cabSelected = 0;

        $scope.cabSelect = function (cab) {
            $scope.cabSelected = 1;
            $scope.cab = cab;
        };
        $scope.cancelCabSelection = function () {
            $scope.cabSelected = 0;
            $scope.cab = {};
        };
        $scope.assignCab = function () {
            bookingService.assignCab(function (success) {

                bookingService.bookingListToday(function (success) {
                    $scope.bookingsToday = success.data;
                    ngDialog.closeAll();
                    ngNotify.set("Successfully Assigned Booking to a Cab", 'success');
                }, function (error) {
                    ngNotify.set(error.message, 'error');
                });

            }, function (error) {
                ngNotify.set(error.message, 'error');
            }, $scope.booking.booking_id, $scope.cab.vd_id);
        };
        bookingService.availableVehicles(function (success) {
            $scope.availableCars = success.data;
            ngDialog.open({
                template: 'app/js/pages/popups/dispatch.html?v=' + Date.now(),
                className: 'ngdialog-theme-mobile',
                scope: $scope
            });
        }, function (error) {
            ngDialog.closeAll();
            ngDialog.open({
                template: 'app/js/pages/popups/noAvailableVehicles.html?v=' + Date.now(),
                className: 'ngdialog-theme-mobile',
                scope: $scope
            });
        });

    };

    $scope.bookingStatus = function (booking) {
        $scope.booking = booking;
        $scope.cab = {};
        $scope.cabSelected = 0;

        $scope.cancelAssignment = function (bookingId) {
            bookingService.cancelAssignment(function (success) {
                bookingService.bookingListToday(function (success) {
                    $scope.bookingsToday = success.data;
                    ngDialog.closeAll();
                    ngNotify.set("Successfully Cancelled Booking Assignement", 'success');
                }, function (error) {
                    ngNotify.set(error.message, 'error');
                });
            }, function (error) {
                ngNotify.set(error.message, 'error');
            }, bookingId);
        };

        $scope.markBookingAsDone = function (bookingId) {
            bookingService.markBookingAsDone(function (success) {
                bookingService.bookingListToday(function (success) {
                    $scope.bookingsToday = success.data;
                    ngDialog.closeAll();
                    ngNotify.set("Successfully Cancelled Booking Assignement", 'success');
                }, function (error) {
                    ngNotify.set(error.message, 'error');
                });
            }, function (error) {
                ngNotify.set(error.message, 'error');
            }, bookingId);
        };


        ngDialog.open({
            template: 'app/js/pages/popups/bookingStatus.html?v=' + Date.now(),
            className: 'ngdialog-theme-mobile',
            scope: $scope
        });
    };

    bookingService.bookingList(function (success) {
        $scope.bookings = success.data;
    }, function (error) {
        ngNotify.set(error.message, 'error');
    });
    bookingService.bookingListToday(function (success) {
        $scope.bookingsToday = success.data;



        $scope.checkIfThereArePending = function(){
            for(var a = 0; a < $scope.bookingsToday.length; a++){
                if($scope.bookingsToday[a].assigned == 'no'){
                    return "yes";
                }
            }
            return "no";
        }
    }, function (error) {
        ngNotify.set(error.message, 'error');
    });

    $scope.searchBooking = function (q) {
        bookingService.bookingList(function (success) {
            $scope.bookings = success.data;
        }, function (error) {
            ngNotify.set(error.message, 'error');
        }, q);
    };

    $scope.cancelBooking = function (bookingId) {
        bookingService.cancelBooking(function (success) {
            bookingService.bookingListToday(function (success) {
                $scope.bookingsToday = success.data;
                ngDialog.closeAll();
                ngNotify.set("Successfully Cancelled Booking", 'success');
            }, function (error) {
                ngNotify.set(error.message, 'error');
            });
            bookingService.bookingList(function (success) {
                $scope.bookings = success.data;
            }, function (error) {
                ngNotify.set(error.message, 'error');
            });
        }, function (error) {
            ngNotify.set(error.message, 'error');
        }, bookingId);
    };

    //ngDialog.open({
    //    template: '<p>Hello World! I am a dialog box!</p>',
    //    plain: true
    //});
});