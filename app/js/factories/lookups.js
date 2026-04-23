/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ptApp.service('lookups', function($http, Globals, $q) {
    //root folder Url
    "use strict";
    var url = Globals.remoteRootUrl + "index.php/api/";
    var listVendors = function (callback, errback) {
        $http({
            method: 'GET',
            url: url + 'lookUp/vendorList'
        }).success(callback).error(errback);
    };
    var listCategory = function (callback, errback) {
        $http({
            method: 'GET',
            url: url + 'lookUp/categoryList'
        }).success(callback).error(errback);
    };
    var mapBreakdown = function(callback, errback, qty, wbId){
        $http({
            method: 'GET',
            url: url + 'lookUp/mapBreakdown',
            params: {
                qty: qty,
                wbId: wbId
            }
        }).success(callback).error(errback);
    };
  return {
      listVendors: listVendors,
      mapBreakdown: mapBreakdown,
      listCategory: listCategory
  };
});

