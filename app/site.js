var app = angular.module('sterlingSiteApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('siteCtrl', function($scope, $http, $uibModal) {

    $scope.get = function() {
        $http({
            method: 'GET',
            url: 'api/site/site_get_all.php'
        }).then(function successCallback(response) {
			$scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.recordCount == 0) {
	            alert('No Site records were found in the database!');
			} else {
    	        $scope.sites = response.data.records;
			}
		}, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the site records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'site_id' : id },
            url: 'api/site/site_by_id.php'
        }).then(function successCallback(response) {
            $scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.recordCount == 0) {
	            alert('Cannot find the site record in the database!');
			} else {
                $scope.site_id          = response.data.records[0]["site_id"];
                $scope.site_customer_id = response.data.records[0]["site_customer_id"];
                $scope.site_name        = response.data.records[0]["site_name"];
                $scope.site_shortname   = response.data.records[0]["site_shortname"];
                $scope.site_address1    = response.data.records[0]["site_address1"];
                $scope.site_address2    = response.data.records[0]["site_address2"];
                $scope.site_city        = response.data.records[0]["site_city"];
                $scope.site_county      = response.data.records[0]["site_county"];
                $scope.site_postcode    = response.data.records[0]["site_postcode"];
                $scope.customer_id      = response.data.records[0]["customer_id"];
                $scope.customer_name    = response.data.records[0]["customer_name"];
                $scope.getCustomers();
                var modalInstance = $uibModal.open({
                    animation:   true,
                    controller:  'editSiteCtrl',
                    templateUrl: 'editSite.html',
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

    $scope.getIdOfCurrentCustomer = function($id) {
        for (i = 0; i < $scope.customers.length; i++) {
            if ($scope.site_customer_id === $scope.customers[i].customer_id) {
                return i;
            }
        }
        return -1;
    }

    $scope.create = function() {
        $scope.site_id          = 0;
        $scope.site_customer_id = 0;
        $scope.site_name        = "";
        $scope.site_shortname   = "";
        $scope.site_address1    = "";
        $scope.site_address2    = "";
        $scope.site_city        = "";
        $scope.site_county      = "";
        $scope.site_postcode    = "";
        $scope.customer_id      = "";
        $scope.customer_name    = "";
        $scope.customers        = [];
        $scope.getCustomers();
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'newSiteCtrl',
            templateUrl: 'newSite.html',
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
                url: 'api/site/site_delete.php'
            }).then(function successCallback(response) {
                if ($scope.success != 'Ok') {
    	            alert('There was a problem accessing the database! If this persists please inform support!');
    				return;
    			}
    			if ($scope.recordCount == 0) {
    	            alert('No Site record was removed from the database!');
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
            url: 'api/customers/customer_get_all.php'
        }).then(function successCallback(response) {
            $scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.recordCount == 0) {
	            alert('No Customer records were found in the database!');
                return;
			}
            $scope.customers = response.data.records;
		}, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the customer records...');
        });
    }

});

app.controller('newSiteCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        if ($scope.site_customer_id == "") {
            alert('Please select a customer for this site, before attempting to save your changes...');
        } else {
            $http({
                method: 'POST',
                data: {
                    'site_customer_id' : $scope.site_customer_id,
                    'site_name'        : $scope.site_name,
                    'site_shortname'   : $scope.site_shortname,
                    'site_address1'    : $scope.site_address1,
                    'site_address2'    : $scope.site_address2,
                    'site_city'        : $scope.site_city,
                    'site_county'      : $scope.site_county,
                    'site_postcode'    : $scope.site_postcode
                },
                url: 'api/site/site_insert.php'
            }).then(function successCallback(response) {
                $scope.recordCount = response.data.count;
    			$scope.success     = response.data.success;
    			if ($scope.success != 'Ok' || $scope.recordCount == 0)  {
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

app.controller('editSiteCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'site_id'          : $scope.site_id,
                'site_customer_id' : $scope.site_customer_id,
                'site_name'        : $scope.site_name,
                'site_shortname'   : $scope.site_shortname,
                'site_address1'    : $scope.site_address1,
                'site_address2'    : $scope.site_address2,
                'site_city'        : $scope.site_city,
                'site_county'      : $scope.site_county,
                'site_postcode'    : $scope.site_postcode
            },
            url: 'api/site/site_update.php'
        }).then(function successCallback(response) {
            $scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok' || $scope.recordCount == 0)  {
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
