var app = angular.module('sterlingJobsDisplayApp', ['angularUtils.directives.dirPagination', 'ngStorage', 'angularModalService']);
app.controller('jobsdisplayCtrl', function($scope, $http, $localStorage, ModalService) {

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

		$scope.customers              = [];
		$scope.site                   = [];
		$scope.site_contacts          = [];

		$scope.saveDisabled           = false;
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

    $scope.getJobByID = function(job_id) {
        $http({
            method: 'POST',
            data: { 'job_id' : job_id },
            url: './api/job/job_by_id.php'
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
	            alert('No Job record matching the requested Job ID: ' + job_id + ' was found in the database!');
			} else {
				$scope.jobs                   = response.data.records;
				$scope.job_id                 = $scope.jobs[0]['job_id'];
				$scope.site_id                = $scope.jobs[0]['site_id'];
				$scope.employee_id            = $scope.jobs[0]['employee_id'];
				$scope.status_id              = $scope.jobs[0]['status_id'];
				$scope.closed                 = $scope.jobs[0]['closed'];
				$scope.date_updated           = $scope.jobs[0]['date_updated'];
				$scope.site_name              = $scope.jobs[0]['site_name'];
				$scope.customer_id            = $scope.jobs[0]['customer_id'];
				$scope.customer_name          = $scope.jobs[0]['customer_name'];
				$scope.employee_first_name    = $scope.jobs[0]['employee_first_name'];
				$scope.employee_last_name     = $scope.jobs[0]['employee_last_name'];
				$scope.job_status_description = $scope.jobs[0]['job_status_description'];
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
    }

	$scope.getJobByStoredID = function() {
		$scope.job_id = $localStorage.job_id;
		console.log('Loaded stored job id (' + $scope.job_id  + ')...');
		$scope.getJobByID($scope.job_id);
	}

	$scope.getJobsForCustomer = function(customer_id) {
        $http({
            method: 'POST',
            data: { 'customer_id' : customer_id },
            url: './api/job/job_for_customer.php'
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
				alert('No Jobs records matching the requested Customer ID: ' + customer_id + ' was found in the database!');
			} else {
				$scope.jobs = response.data.records;
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
    }

    $scope.getAllJobs = function() {
		$http({
			method: 'GET',
			url: './api/job/job_get_all.php'
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
	            alert('No Jobs records were found in the database!');
			} else {
    	        $scope.jobs = response.data.records;
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
	}

    $scope.getAllEmployees = function() {
		$http({
			method: 'GET',
			url: './api/employee/employee_get_all.php'
		}).then(function successCallback(response) {
			$scope.clearScope();
			$scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.recordCount == 0) {
	            alert('No Employee records were found in the database!');
			} else {
    	        $scope.employees = response.data.records;
				console.log('Loaded ' + $scope.recordCount + ' employee recs...');
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
	}

    $scope.getAllStatuses = function() {
		$http({
			method: 'GET',
			url: './api/job_status/job_status_get_all.php'
		}).then(function successCallback(response) {
			$scope.clearScope();
			$scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.recordCount == 0) {
	            alert('No Job Status records were found in the database!');
			} else {
    	        $scope.statuses = response.data.records;
				console.log('Loaded ' + $scope.recordCount + ' status recs...');
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
	}

	$scope.setJob = function($job_id) {
		$localStorage.job_id = $job_id;
	}

	$scope.initResultPageData = function() {
		$scope.getAllStatuses();
		$scope.getAllEmployees();
		$scope.getJobByStoredID();
	}

	$scope.onStatusSelect = function() {
		console.log("onStatusSelect() called");
		console.log("id: " + $scope.selectstatus.job_status_id + ", desc:" + $scope.selectstatus.job_status_description);
	}

	$scope.onEmployeeSelect = function() {
		console.log("onEmployeeSelect() called");
		console.log("id: " + $scope.selectemployee.employee_id + ", desc:" + $scope.selectemployee.full_name);
	}

	$scope.onCustomerSelect = function() {
		console.log("onCustomerSelect() called");
		console.log("id: " + $scope.selectcustomer.customer_id + ", name:" + $scope.selectcustomer.customer_name);
		$scope.getSitesForCustomer($scope.selectcustomer.customer_id);
		$scope.sitecontacts = [];
		//$scope.saveDisabled = $scope.disableSaveCheck();
	}

	$scope.onSiteSelect = function() {
		console.log("onSiteSelect() called");
		if ($scope.selectsite != null) {
			console.log("id: " + $scope.selectsite.site_id + ", name:" + $scope.selectsite.site_name);
			$scope.getSiteContactsForSite($scope.selectsite.site_id);
		}
		//$scope.saveDisabled = $scope.disableSaveCheck();
	}

	$scope.onSiteContactSelect = function() {
		console.log("onSiteContactSelect() called");
		if ($scope.selectsitecontact != null) {
			console.log("id: " + $scope.selectsitecontact.site_contact_id + ", name:" + $scope.selectsitecontact.contact_name);
		}
		//$scope.saveDisabled = $scope.disableSaveCheck();
	}

	$scope.newJob = function() {
		console.log("New Job...");
		$scope.getAllCustomers();
		//$scope.saveDisabled = $scope.disableSaveCheck();
		ModalService.showModal({
		    templateUrl: "modal.html",
		    controller: "jobslistCtrl",
			scope: $scope
		}).then(function(modal) {
		    //it's a bootstrap element, use 'modal' to show it
		    modal.element.modal();
		    modal.close.then(function(result) {
		    });
		});
		$scope.getAllJobs();
	}

	$scope.saveJob = function() {
		console.log("Save Job...");
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
            url: './api/job/job_insert.php'
        }).then(function successCallback(response) {
            $scope.getAllJobs();
        });
	}

	$scope.getAllCustomers = function() {
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

	$scope.getSiteContactsForSite = function(site_id) {
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

	$scope.disableSaveCheck = function() {
		if ($scope.selectcustomer == null) {
			console.log('selectcustomer is null...');
			return true;
		}
		console.log('selectcustomer is not null...');
		if ($scope.selectsite == null) {
			console.log('selectsite is null...');
			return true;
		}
		console.log('selectsite is not null...');
		if ($scope.selectsitecontact == null) {
			console.log('selectsitecontact is null...');
			return true;
		}
		console.log('selectsitecontact is not null...');
		return false;
	}

});
