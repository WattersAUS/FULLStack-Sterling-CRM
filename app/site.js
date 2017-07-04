var app = angular.module('sterlingSiteApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('siteCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/site/site_get_all.php'
        }).then(function successCallback(response) {
			$scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Site records were found in the database!');
			} else {
    	        $scope.data.sites = response.data.records;
			}
		}, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the site records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'site_id' : id },
            url: './api/site/site_by_id.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('Cannot find the site record in the database!');
			} else {
                $scope.data.site_id          = response.data.records[0]["site_id"];
                $scope.data.site_customer_id = response.data.records[0]["site_customer_id"];
                $scope.data.site_name        = response.data.records[0]["site_name"];
                $scope.data.site_shortname   = response.data.records[0]["site_shortname"];
                $scope.data.site_address1    = response.data.records[0]["site_address1"];
                $scope.data.site_address2    = response.data.records[0]["site_address2"];
                $scope.data.site_city        = response.data.records[0]["site_city"];
                $scope.data.site_county      = response.data.records[0]["site_county"];
                $scope.data.site_postcode    = response.data.records[0]["site_postcode"];
                $scope.data.customer_id      = response.data.records[0]["customer_id"];
                $scope.data.customer_name    = response.data.records[0]["customer_name"];
                $scope.getCustomers();
                var modalInstance = $uibModal.open({
                    animation:   true,
                    controller:  'siteEditCtrl',
                    templateUrl: './dialogs/site_edit.html',
                    scope:       $scope
                });
                modalInstance.result.then(function () {
                    $scope.get();
                }, function () {
                });
			}
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the site record...');
        });
    }

    $scope.create = function() {
        $scope.data.site_id          = 0;
        $scope.data.site_customer_id = 0;
        $scope.data.site_name        = "";
        $scope.data.site_shortname   = "";
        $scope.data.site_address1    = "";
        $scope.data.site_address2    = "";
        $scope.data.site_city        = "";
        $scope.data.site_county      = "";
        $scope.data.site_postcode    = "";
        $scope.data.customer_id      = "";
        $scope.data.customer_name    = "";
        $scope.data.customers        = [];
        $scope.getCustomers();
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'siteNewCtrl',
            templateUrl: './dialogs/site_new.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

    $scope.delete = function(id) {
        if(confirm("Are you sure you want to remove this Site from the System?")){
            $http({
                method: 'POST',
                data: { 'site_id' : id },
                url: './api/site/site_delete.php'
            }).then(function successCallback(response) {
                $scope.data.recordCount = response.data.count;
    			$scope.data.success     = response.data.success;
                if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
                    alert('Unable to access the Site record (ID = ' + id + ') in the database! If this persists please inform support!');
                }
                $scope.get();
            }, function errorCallback(response) {
                alert('There has been an error accessing the server, unable to remove the site record...');
            });
        }
    }

	$scope.getCustomers = function() {
        $http({
            method: 'GET',
            url: './api/customers/customer_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Customer records were found in the database!');
                return;
			}
            $scope.data.customers = response.data.records;
		}, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the customer records...');
        });
    }

});

app.controller('siteNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        if ($scope.data.site_customer_id == "") {
            alert('Please select a customer for this site, before attempting to save your changes...');
        } else {
            $http({
                method: 'POST',
                data: {
                    'site_customer_id' : $scope.data.site_customer_id,
                    'site_name'        : $scope.data.site_name,
                    'site_shortname'   : $scope.data.site_shortname,
                    'site_address1'    : $scope.data.site_address1,
                    'site_address2'    : $scope.data.site_address2,
                    'site_city'        : $scope.data.site_city,
                    'site_county'      : $scope.data.site_county,
                    'site_postcode'    : $scope.data.site_postcode
                },
                url: './api/site/site_insert.php'
            }).then(function successCallback(response) {
                $scope.data.recordCount = response.data.count;
    			$scope.data.success     = response.data.success;
    			if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
    	            alert('There was a problem adding the new site to the database! If this persists please inform support!');
    			}
                $uibModalInstance.close();
            }, function errorCallback(response) {
                alert('There has been an error accessing the server, unable to add the site record...');
            });
        }
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('siteEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'site_id'          : $scope.data.site_id,
                'site_customer_id' : $scope.data.site_customer_id,
                'site_name'        : $scope.data.site_name,
                'site_shortname'   : $scope.data.site_shortname,
                'site_address1'    : $scope.data.site_address1,
                'site_address2'    : $scope.data.site_address2,
                'site_city'        : $scope.data.site_city,
                'site_county'      : $scope.data.site_county,
                'site_postcode'    : $scope.data.site_postcode
            },
            url: './api/site/site_update.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
	            alert('There was a problem updating the site to the database! If this persists please inform support!');
			}
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the site record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
