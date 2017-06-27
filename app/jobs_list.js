var app = angular.module('sterlingJobsListApp', ['angularUtils.directives.dirPagination', 'ngStorage', 'ui.bootstrap']);
app.controller('jobsListCtrl', function($scope, $http, $localStorage, $uibModal) {

	$scope.clearScope = function() {
		$scope.recordCount            = 0;
		$scope.success                = "";
		$scope.jobs                   = [];
		$scope.job_id                 = "";
		$scope.site_id                = "";
		$scope.employee_id            = "";
		$scope.status_id              = "";
		$scope.closed                 = "";
		$scope.date_updated           = "";
		$scope.site_name              = "";
		$scope.customer_id            = "";
		$scope.customer_name          = "";
		$scope.employee_first_name    = "";
		$scope.employee_last_name     = "";
		$scope.job_status_description = "";
		$scope.setRecordCountText();
	}

	$scope.setRecordCountText = function() {
		if ($scope.recordCount == 0) {
			$scope.recordCountText = "No results shown...";
		} else if ($scope.recordCount == 1) {
			$scope.recordCountText = "One record shown...";
		} else {
			$scope.recordCountText = $scope.recordCount + " records shown...";
		}
	}

	$scope.setJob = function($job_id) {
		$localStorage.job_id = $job_id;
	}

	$scope.getCustomers = function() {
		$http({
			method: 'GET',
			url: './api/customers/customer_get_all.php'
		}).then(function successCallback(response) {
			$scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.recordCount == 0) {
	            alert('No Customer records were found in the database!');
			} else {
    	        $scope.customers = response.data.records;
				console.log('Loaded ' + $scope.recordCount + ' customer recs...');
				$scope.firstcustomername = $scope.customers[0].customer_name;
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
	}

	$scope.get = function() {
        $http({
            method: 'GET',
            url: 'api/job/job_get_all.php'
        }).then(function successCallback(response) {
			$scope.clearScope();
			$scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			$scope.setRecordCountText();
			if ($scope.recordCount == 0) {
	            alert('No Job records were found in the database!');
			} else {
    	        $scope.jobs = response.data.records;
			}
		}, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the job records...');
        });
    }

	$scope.set = function($job_id) {
		$localStorage.job_id = $job_id;
	}

    $scope.create = function() {
		console.log("Create job...");
		$scope.getCustomers();
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'newJobCtrl',
            templateUrl: 'newJob.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/term/read_one.php'
        }).then(function successCallback(response) {
            $scope.id            = response.data[0]["id"];
            $scope.description   = response.data[0]["description"];
            $scope.days          = response.data[0]["days"];
            var modalInstance = $uibModal.open({
                animation:   true,
                controller:  'editTermCtrl',
                templateUrl: 'editTerm.html',
                scope:       $scope
            });
            modalInstance.result.then(function () {
                $scope.get();
            }, function () {
            });
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the term record...');
        });
    }

});

app.controller('newJobCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.onCustomerSelect = function() {
		$scope.getSitesForCustomer($scope.selectcustomer.customer_id);
		$scope.sitecontacts = [];
		//$scope.saveDisabled = $scope.disableSaveCheck();
	}

	$scope.onSiteSelect = function() {
		if ($scope.selectsite != null) {
			$scope.getContactsForSite($scope.selectsite.site_id);
		}
		//$scope.saveDisabled = $scope.disableSaveCheck();
	}

	$scope.onSiteContactSelect = function() {
		if ($scope.selectsitecontact != null) {
			console.log("id: " + $scope.selectsitecontact.site_contact_id + ", name:" + $scope.selectsitecontact.contact_name);
		}
		//$scope.saveDisabled = $scope.disableSaveCheck();
	}

	$scope.getSitesForCustomer = function(customer_id) {
		$http({
			method: 'POST',
            data: { 'customer_id' : customer_id },
			url: './api/site/site_for_customer.php'
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
				console.log('Loaded ' + $scope.recordCount + ' site recs...');
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
	}

	$scope.getContactsForSite = function(site_id) {
		$http({
			method: 'POST',
            data: { 'site_id' : site_id },
			url: './api/site_contact/site_contact_for_site.php'
		}).then(function successCallback(response) {
			$scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.recordCount == 0) {
	            alert('No Site Contact records were found in the database!');
			} else {
    	        $scope.sitecontacts = response.data.records;
				console.log('Loaded ' + $scope.recordCount + ' site contact recs...');
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
	}

	$scope.save = function() {
        $http({
            method: 'POST',
            data: {
				'site_id'             : $scope.selectsite.site_id,
                'employee_id'         : 1,
                'status_id'           : 1,
				'job_customer_ref_no' : $scope.job_customer_ref_no,
				'site_contact_id'     : $scope.selectsitecontact.site_contact_id,
				'job_description'     : $scope.job_description,
				'closed'              : 0
            },
            url: 'api/job/job_insert.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to add the job record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
