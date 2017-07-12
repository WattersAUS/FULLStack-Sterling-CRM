var app = angular.module('sterlingJobsDisplayApp', ['angularUtils.directives.dirPagination', 'ngStorage', 'ui.bootstrap']);

app.controller('jobsDisplayCtrl', function($scope, $http, $localStorage, $uibModal) {

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

	// on with the rest of the code
	$scope.initPage = function() {
		$scope.getAllStatuses();
		$scope.getEmployees();
		$scope.getJobByStoredID();
	}

	$scope.getAllStatuses = function() {
		$http({
			method: 'GET',
			url: './api/job_status/job_status_get_manual.php'
		}).then(function successCallback(response) {
			$scope.data.statusCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.statusCount == 0) {
	            alert('No Job Status records were found in the database!');
			} else {
    	        $scope.data.statuses = response.data.records;
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
	}

	$scope.getEmployees = function() {
		$http({
			method: 'GET',
			url: './api/employee/employee_get_all.php'
		}).then(function successCallback(response) {
			$scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Employee records were found in the database!');
			} else {
    	        $scope.data.employees = response.data.records;
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
	}

	$scope.getJobByStoredID = function() {
		$scope.data.job_id = $localStorage.job_id;
		$scope.getJobByID($scope.data.job_id);
		$scope.getJobHistoryByJobID($scope.data.job_id);
	}

	$scope.getJobByID = function(job_id) {
        $http({
            method: 'POST',
            data: { 'job_id' : job_id },
            url: './api/job/job_by_id.php'
        }).then(function successCallback(response) {
			$scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Job record matching the requested Job ID: ' + job_id + ' was found in the database!');
			} else {
				$scope.data.job_id                 = response.data.records[0]['job_id'];
				$scope.data.job_site_id            = response.data.records[0]['job_site_id'];
				$scope.data.job_employee_id        = response.data.records[0]['job_employee_id'];
				$scope.data.job_status_id          = response.data.records[0]['job_status_id'];
				$scope.data.job_status_change      = response.data.records[0]['job_status_change'];
				$scope.data.job_customer_ref_no    = response.data.records[0]['job_customer_ref_no'];
				$scope.data.job_site_contact_id    = response.data.records[0]['job_site_contact_id'];
				$scope.data.job_description        = response.data.records[0]['job_description'];
				$scope.data.job_closed             = response.data.records[0]['job_closed'];
				$scope.data.job_date_updated       = response.data.records[0]['job_date_updated'];
				$scope.data.site_name              = response.data.records[0]['site_name'];
				$scope.data.customer_id            = response.data.records[0]['customer_id'];
				$scope.data.customer_name          = response.data.records[0]['customer_name'];
				$scope.data.employee_first_name    = response.data.records[0]['employee_first_name'];
				$scope.data.employee_last_name     = response.data.records[0]['employee_last_name'];
				$scope.data.job_status_description = response.data.records[0]['job_status_description'];
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
    }

	$scope.getJobHistoryByJobID = function(job_id) {
        $http({
            method: 'POST',
            data: { 'job_id' : job_id },
            url: './api/job_history/job_history_for_job.php'
        }).then(function successCallback(response) {
			$scope.data.recordCount        = response.data.count;
			$scope.data.success            = response.data.success;
			$scope.data.job_histories      = [];
			// need to strip first entry to give first line to be displayed then rest are handled by ng-repeat
			$scope.data.job_history_id              = response.data.records[0]['job_history_id'];
			$scope.data.job_history_job_id          = response.data.records[0]['job_history_job_id'];
			$scope.data.job_history_site_id         = response.data.records[0]['job_history_site_id'];
			$scope.data.job_history_employee_id     = response.data.records[0]['job_history_employee_id'];
			$scope.data.job_history_status_id       = response.data.records[0]['job_history_status_id'];
			$scope.data.job_history_status_change   = response.data.records[0]['job_history_status_change'];
			$scope.data.job_history_customer_ref_no = response.data.records[0]['job_history_customer_ref_no'];
			$scope.data.job_history_site_contact_id = response.data.records[0]['job_history_site_contact_id'];
			$scope.data.job_history_description     = response.data.records[0]['job_history_description'];
			$scope.data.job_history_closed          = response.data.records[0]['job_history_closed'];
			$scope.data.job_history_date_updated    = response.data.records[0]['job_history_date_updated'];
			$scope.data.site_name                   = response.data.records[0]['site_name'];
			$scope.data.customer_id                 = response.data.records[0]['customer_id'];
			$scope.data.customer_name               = response.data.records[0]['customer_name'];
			$scope.data.employee_first_name         = response.data.records[0]['employee_first_name'];
			$scope.data.employee_last_name          = response.data.records[0]['employee_last_name'];
			$scope.data.job_status_description      = response.data.records[0]['job_status_description'];
			// now put the rest (if any) in object array for rest of displayed
			if ($scope.data.recordCount > 1) {
				var i;
				for (i = 1; i < $scope.data.recordCount; i++) {
					$scope.data.job_histories.push(response.data.records[i]);
				}
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
    }

	$scope.onStatusSelect = function() {
		if ($scope.data.selectstatus.job_status_id < $scope.data.status_id) {
			alert("You cannot currently move a job back in 'Status'!");
		} else {
			$scope.statusChange($scope.data.selectstatus.job_status_id, $scope.data.selectstatus.job_status_template_page);
		}
	}

	$scope.onEmployeeSelect = function() {
	}

    $scope.statusChange = function($id, $template) {
		$scope.getJobByID($scope.data.job_id);
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  $template+"Ctrl",
            templateUrl: "./dialogs/"+$template+".html",
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.getJobHistoryByJobID($scope.data.job_id);
        }, function () {
        });
    }

});

app.controller('awaitJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('visitJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.calendar = function($event) {
		$scope.data.opened = true;
	};

	$scope.save = function() {
		var month = $scope.data.datePicker.getMonth() + 1;
		$scope.data.job_status_change = $scope.data.datePicker.getFullYear() + '-' + month + '-' + $scope.data.datePicker.getDate() + ' 00:00';
		$scope.data.job_description   = "Site visit carried out by " + $scope.data.visitor.user_full_name;
		$http({
            method: 'POST',
            data: {
				'job_id'              : $scope.data.job_id,
				'job_site_id'         : $scope.data.job_site_id,
                'job_employee_id'     : 1,
                'job_status_id'       : 2,
				'job_status_change'   : $scope.data.job_status_change,
				'job_customer_ref_no' : $scope.data.job_customer_ref_no,
				'job_site_contact_id' : $scope.data.job_site_contact_id,
				'job_description'     : $scope.data.job_description,
				'job_closed'          : 1
            },
            url: './api/job/job_update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the job record...');
        });
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('quoteJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('tenderJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('cpoQJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('cpoTJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('programJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('inProgJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('completedJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.calendar = function($event) {
		$scope.data.opened = true;
	};

	$scope.save = function() {
		var month = $scope.data.datePicker.getMonth() + 1;
		$scope.data.job_status_change = $scope.data.datePicker.getFullYear() + '-' + month + '-' + $scope.data.datePicker.getDate() + ' 00:00';
		$scope.data.job_description   = "Job Completed by " + $scope.data.completed.user_full_name;
		$http({
            method: 'POST',
            data: {
				'job_id'              : $scope.data.job_id,
				'job_site_id'         : $scope.data.job_site_id,
                'job_employee_id'     : 1,
                'job_status_id'       : 10,
				'job_status_change'   : $scope.data.job_status_change,
				'job_customer_ref_no' : $scope.data.job_customer_ref_no,
				'job_site_contact_id' : $scope.data.job_site_contact_id,
				'job_description'     : $scope.data.job_description,
				'job_closed'          : 1
            },
            url: './api/job/job_update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the job record...');
        });
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('awaitJobSheetJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.calendar = function($event) {
		$scope.data.opened = true;
	};

	$scope.save = function() {
		var month = $scope.data.datePicker.getMonth() + 1;
		$scope.data.job_status_change = $scope.data.datePicker.getFullYear() + '-' + month + '-' + $scope.data.datePicker.getDate() + ' 00:00';
		$scope.data.job_description   = "Waiting for Job Sheet, Job Completed by " + $scope.data.completed.user_full_name;
		$http({
            method: 'POST',
            data: {
				'job_id'              : $scope.data.job_id,
				'job_site_id'         : $scope.data.job_site_id,
                'job_employee_id'     : 1,
                'job_status_id'       : 11,
				'job_status_change'   : $scope.data.job_status_change,
				'job_customer_ref_no' : $scope.data.job_customer_ref_no,
				'job_site_contact_id' : $scope.data.job_site_contact_id,
				'job_description'     : $scope.data.job_description,
				'job_closed'          : 1
            },
            url: './api/job/job_update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the job record...');
        });
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('furtherWorkReqJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.calendar = function($event) {
		$scope.data.opened = true;
	};

	$scope.save = function() {
		var month = $scope.data.datePicker.getMonth() + 1;
		$scope.data.job_status_change = $scope.data.datePicker.getFullYear() + '-' + month + '-' + $scope.data.datePicker.getDate() + ' 00:00';
		$scope.data.job_description   = "Job Completed by " + $scope.data.completed.user_full_name + " but led to further work";
		$http({
            method: 'POST',
            data: {
				'job_id'              : $scope.data.job_id,
				'job_site_id'         : $scope.data.job_site_id,
                'job_employee_id'     : 1,
                'job_status_id'       : 10,
				'job_status_change'   : $scope.data.job_status_change,
				'job_customer_ref_no' : $scope.data.job_customer_ref_no,
				'job_site_contact_id' : $scope.data.job_site_contact_id,
				'job_description'     : $scope.data.job_description,
				'job_closed'          : 1
            },
            url: './api/job/job_update.php'
        }).then(function successCallback(response) {
			if(confirm("Raise a Job to cover the Further Work Required?")){
				$http({
		            method: 'POST',
		            data: { 'job_history_job_id' : $scope.data.job_id },
		            url: './api/job_history/job_history_for_job_first_record.php'
		        }).then(function successCallback(response) {
					$scope.data.recordCount = response.data.count;
					$scope.data.success     = response.data.success;
					if ($scope.data.success != 'Ok') {
			            alert('1. There was a problem accessing the database! If this persists please inform support!');
						return;
					}
					if ($scope.data.recordCount == 0) {
			            alert('No Job History initial record matching the requested Job ID: ' + job_id + ' was found in the database!');
					} else {
						$scope.data.new_job_id             = response.data.records[0]['job_history_id'];
						$scope.data.new_site_id            = response.data.records[0]['job_history_site_id'];
						$scope.data.new_employee_id        = response.data.records[0]['job_history_employee_id'];
						$scope.data.new_status_id          = response.data.records[0]['job_history_status_id'];
						$scope.data.new_status_change      = response.data.records[0]['job_history_status_change'];
						$scope.data.new_customer_ref_no    = response.data.records[0]['job_history_customer_ref_no'];
						$scope.data.new_site_contact_id    = response.data.records[0]['job_history_site_contact_id'];
						$scope.data.new_description        = response.data.records[0]['job_history_description'];
						$http({
				            method: 'POST',
				            data: {
								'job_site_id'         : $scope.data.new_site_id,
				                'job_employee_id'     : 1,
				                'job_status_id'       : 1,
								'job_status_change'   : $scope.data.new_status_change,
								'job_customer_ref_no' : $scope.data.new_customer_ref_no,
								'job_site_contact_id' : $scope.data.new_site_contact_id,
								'job_description'     : "Further Work added from Job ID: " + $scope.data.job_id,
								'job_closed'          : 0
				            },
				            url: './api/job/job_insert.php'
				        }).then(function successCallback(response) {
							$scope.data.newId = response.data.id;
							alert('A new Job ID: ' + $scope.data.newId + ' has been raised to cover the new work required!');
				        }, function errorCallback(response) {
				            alert('2. There has been an error accessing the server, unable to add the job record...');
			        	});
					}
				}, function errorCallback(response) {
					alert('3. There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
				});
	        }
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('4. There has been an error accessing the server, unable to update the job record...');
        });
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('invoicedJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('cancelJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

 	$scope.calendar = function($event) {
 		$scope.data.opened = true;
 	};

	$scope.cancelJob = function() {
		var month = $scope.data.datePicker.getMonth() + 1;
		$scope.data.job_status_change = $scope.data.datePicker.getFullYear() + '-' + month + '-' + $scope.data.datePicker.getDate() + ' 00:00';
		$http({
            method: 'POST',
            data: {
				'job_id'              : $scope.data.job_id,
				'job_site_id'         : $scope.data.job_site_id,
                'job_employee_id'     : 1,
                'job_status_id'       : 12,
				'job_status_change'   : $scope.data.job_status_change,
				'job_customer_ref_no' : $scope.data.job_customer_ref_no,
				'job_site_contact_id' : $scope.data.job_site_contact_id,
				'job_description'     : $scope.data.job_description,
				'job_closed'          : 1
            },
            url: './api/job/job_update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the job record...');
        });
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
