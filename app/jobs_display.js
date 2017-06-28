var app = angular.module('sterlingJobsDisplayApp', ['angularUtils.directives.dirPagination', 'ngStorage', 'ui.bootstrap'] );
app.controller('jobsDisplayCtrl', function($scope, $http, $localStorage, $uibModal) {

	$scope.initPage = function() {
		$scope.getStatuses();
		$scope.getEmployees();
		$scope.getJobByStoredID();
	}

	$scope.getStatuses = function() {
		$http({
			method: 'GET',
			url: './api/job_status/job_status_get_all.php'
		}).then(function successCallback(response) {
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
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, Code: ' + response.status + ', Message: ' + response.statusText);
		});
	}

	$scope.getJobByStoredID = function() {
		$scope.job_id = $localStorage.job_id;
		$scope.getJobByID($scope.job_id);
	}

	$scope.getJobByID = function(job_id) {
        $http({
            method: 'POST',
            data: { 'job_id' : job_id },
            url: './api/job/job_by_id.php'
        }).then(function successCallback(response) {
			$scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
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

	$scope.onStatusSelect = function() {
		console.log("onStatusSelect() called");
		console.log("id: " + $scope.selectstatus.job_status_id + ", desc:" + $scope.selectstatus.job_status_description + "temp:" + $scope.selectstatus.job_status_template_page);

		if ($scope.selectstatus.job_status_id < $scope.status_id) {
			alert("You cannot currently move a job back in 'Status'!");
		} else {
			$scope.statusChange($scope.selectstatus.job_status_id, $scope.selectstatus.job_status_template_page);
		}
	}

	$scope.onEmployeeSelect = function() {
		console.log("onEmployeeSelect() called");
		console.log("id: " + $scope.selectemployee.employee_id + ", desc:" + $scope.selectemployee.full_name);
	}

    $scope.statusChange = function($id, $template) {
		console.log("Status change...");
		console.log("ID: " + $id + "Template: " + $template);
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  $template+"Ctrl",
            templateUrl: "./dialogs/"+$template+".html",
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

});

app.controller('awaitJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('visitJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('quoteJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('tenderJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('cpoQJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('cpoTJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('programJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('inProgJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('completedJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('invoicedJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('cancelJobDisplayCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.save = function() {
		$uibModalInstance.close();
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
