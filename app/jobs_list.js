var app = angular.module('sterlingJobsListApp', ['angularUtils.directives.dirPagination', 'ngStorage', 'ui.bootstrap']);

app.controller('jobsListCtrl', function($scope, $http, $localStorage, $uibModal) {

	$scope.data = {};
	$scope.data.dateFormat     = 'yyyy-MM-dd HH:mm';
	$scope.data.altDateFormats = [];
	$scope.data.datePicker = {
		date: new Date()
	};

	// date handling
	$scope.dateOptions = {
		dateDisabled: disabledDates,
		formatYear: 'yy',
		maxDate: new Date(2099,12, 31),
		minDate: new Date(2016, 1, 1),
		startingDay: 1
	};

	// disable weekend selection
	function disabledDates(data) {
		var date = data.date, mode = data.mode;
		return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
	}

	$scope.setJobsLoadedText = function() {
		if ($scope.data.recordCount == 0) {
			$scope.data.jobsLoadedText = "No jobs shown...";
		} else if ($scope.data.recordCount == 1) {
			$scope.data.jobsLoadedText = "One job shown...";
		} else {
			$scope.data.jobsLoadedText = $scope.data.recordCount + " jobs shown...";
		}
	}

	$scope.set = function($job_id) {
		$localStorage.job_id = $job_id;
	}

	$scope.get = function() {
        $http({
            method: 'GET',
            url: './api/job/job_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Job records were found in the database!');
			} else {
    	        $scope.data.jobs = response.data.records;
			}
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the Job records...');
        });
    }

	$scope.getCustomers = function() {
		$http({
			method: 'GET',
			url: './api/customer/customer_get_all.php'
		}).then(function successCallback(response) {
			$scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Customer records were found in the database!');
			} else {
    	        $scope.data.customers = response.data.records;
				console.log('Loaded ' + $scope.recordCount + ' customer recs...');
				$scope.data.firstcustomername = $scope.data.customers[0].customer_name;
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
	}

	$scope.set = function($job_id) {
		$localStorage.job_id = $job_id;
	}

    $scope.create = function() {
		$scope.getCustomers();
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'jobsListNewCtrl',
            templateUrl: './dialogs/jobs_list_new.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

});

app.controller('jobsListNewCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

//	$scope.data.format          = 'yyyy-MM-dd';
// 	$scope.data.altInputFormats = [];

	// date handling
//	$scope.dateOptions = {
// 		dateDisabled: disabled,
//		formatYear: 'yy',
// 		maxDate: new Date(2099,12, 31),
// 		minDate: new Date(2016, 1, 1),
// 		startingDay: 1
// 	};

 	// disable weekend selection
// 	function disabled(data) {
// 		var date = data.date, mode = data.mode;
// 		return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
// 	}

 	$scope.calendar = function($event) {
 		$scope.data.opened = true;
 	};


	// dropdowns to select customer/site/contact
	$scope.onCustomerSelect = function() {
		$scope.getSitesForCustomer($scope.data.selectcustomer.customer_id);
		$scope.data.sitecontacts = [];
		//$scope.saveDisabled = $scope.disableSaveCheck();
	}

	$scope.onSiteSelect = function() {
		if ($scope.data.selectsite != null) {
			$scope.getContactsForSite($scope.data.selectsite.site_id);
		}
		//$scope.saveDisabled = $scope.disableSaveCheck();
	}

	$scope.onSiteContactSelect = function() {
		if ($scope.data.selectsitecontact != null) {
			console.log("id: " + $scope.data.selectsitecontact.site_contact_id + ", name:" + $scope.data.selectsitecontact.contact_name);
		}
		//$scope.saveDisabled = $scope.disableSaveCheck();
	}

	$scope.getSitesForCustomer = function(customer_id) {
		$http({
			method: 'POST',
            data: { 'customer_id' : customer_id },
			url: './api/site/site_for_customer.php'
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
				console.log('Loaded ' + $scope.data.recordCount + ' site recs...');
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
			$scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Site Contact records were found in the database!');
			} else {
    	        $scope.data.sitecontacts = response.data.records;
				console.log('Loaded ' + $scope.data.recordCount + ' site contact recs...');
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
	}

	$scope.save = function() {
		var month = $scope.data.datePicker.getMonth() + 1;
		$scope.data.job_status_change = $scope.data.datePicker.getFullYear() + '-' + month + '-' + $scope.data.datePicker.getDate() + ' 00:00';
        $http({
            method: 'POST',
            data: {
				'job_site_id'         : $scope.data.selectsite.site_id,
                'job_employee_id'     : 1,
                'job_status_id'       : 1,
				'job_status_change'   : $scope.data.job_status_change,
				'job_customer_ref_no' : $scope.data.job_customer_ref_no,
				'job_site_contact_id' : $scope.data.selectsitecontact.site_contact_id,
				'job_description'     : $scope.data.job_description,
				'job_closed'          : 0
            },
            url: './api/job/job_insert.php'
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
