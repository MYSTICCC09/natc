ptApp.service('adminPanelService', function ($http, Globals, $q) {

    "use strict";
    var url = Globals.remoteRootUrl + "index.php/api/";

    var user = {};

    var test = function (callback, errback) {
        $http({
            method: 'GET',
            url: url + 'site/test'
        }).success(callback).error(errback);
    };

    var listUsers = function(callback, errback){
        $http({
            method: 'GET',
            url: url + 'adminPanel/listUsers'
        }).success(callback).error(errback);
    };
    var addUser = function(callback, errback, form){
        $http({
            method: 'POST',
            url: url + 'adminPanel/addUser',
            data: form
        }).success(callback).error(errback);
    };

    return {
        listUsers: listUsers,
        addUser: addUser,
        test: test
    };
});