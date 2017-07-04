var app = angular.module('sterlingEmpApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('empCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
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
            alert('There has been an error accessing the server, unable to retrieve the site records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'employee_id' : id },
            url: './api/employee/employee_by_id.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the Employee! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('Cannot find the Employee record in the database!');
			} else {
                $scope.data.employee_id          = response.data.records[0]["employee_id"];
                $scope.data.employee_is_manager  = response.data.records[0]["employee_is_manager"];
                $scope.data.employee_emp_no      = response.data.records[0]["employee_emp_no"];
                $scope.data.employee_job_role    = response.data.records[0]["employee_job_role"];
                $scope.data.employee_job_title   = response.data.records[0]["employee_job_title"];
                $scope.data.employee_manager_id  = response.data.records[0]["employee_manager_id"];
                $scope.data.employee_division_id = response.data.records[0]["employee_division_id"];
                $scope.data.employee_team_id     = response.data.records[0]["employee_team_id"];
                $scope.data.user_full_name       = response.data.records[0]["user_full_name"];
                $scope.data.user_start_date      = response.data.records[0]["user_start_date"];
                $scope.data.user_end_date        = response.data.records[0]["user_end_date"];
                $scope.getUsers();
                $scope.getManagers();
                $scope.getDivisions();
                $scope.getTeams();
                var modalInstance = $uibModal.open({
                    animation:   true,
                    controller:  'empEditCtrl',
                    templateUrl: './dialogs/employee_edit.html',
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
        $scope.data.employee_user_id      = 0;
        $scope.data.employee_is_manager   = 0;
        $scope.data.employee_emp_no       = "";
        $scope.data.employee_job_role     = "";
        $scope.data.employee_job_title    = "";
        $scope.data.employee_manager_id   = 0;
        $scope.data.employee_division_id  = 0;
        $scope.data.employee_team_id      = 0;
        $scope.getUsers();
        $scope.getManagers();
        $scope.getDivisions();
        $scope.getTeams();
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'empNewCtrl',
            templateUrl: './dialogs/employee_new.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

	$scope.getUsers = function() {
        $http({
            method: 'GET',
            url: './api/user/user_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the Users! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No User records were found in the database!');
                return;
			}
            $scope.data.users = response.data.records;
		}, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the User records...');
        });
    }

	$scope.getManagers = function() {
        $http({
            method: 'GET',
            url: './api/employee/employee_get_managers.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the Managers! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No User records were found in the database!');
                return;
			}
            $scope.data.managers = response.data.records;
		}, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the Manager records...');
        });
    }

    $scope.getDivisions = function() {
        $http({
            method: 'GET',
            url: './api/division/division_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the Divisions! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Division records were found in the database!');
                return;
			}
            $scope.data.divisions = response.data.records;
		}, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the Division records...');
        });
    }

    $scope.getTeams = function() {
        $http({
            method: 'GET',
            url: './api/team/team_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the Teams! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Team records were found in the database!');
                return;
			}
            $scope.data.teams = response.data.records;
		}, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the Team records...');
        });
    }

});

app.controller('empNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'employee_user_id'     : $scope.data.employee_user_id,
                'employee_is_manager'  : $scope.data.employee_is_manager,
                'employee_emp_no'      : $scope.data.employee_emp_no,
                'employee_job_role'    : $scope.data.employee_job_role,
                'employee_job_title'   : $scope.data.employee_job_title,
                'employee_manager_id'  : $scope.data.employee_manager_id,
                'employee_division_id' : $scope.data.employee_division_id,
                'employee_team_id'     : $scope.data.employee_team_id
            },
            url: './api/employee/employee_insert.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
            if ($scope.data.success != 'Ok' || $scope.data.recordCount != 1)  {
                alert('Unable to insert a new Employee record in the database! If this persists please inform support!');
            }
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the Employee records...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

    $scope.isManager = function () {
        if (document.getElementById("data.is_manager").checked == true) {
            $scope.data.employee_is_manager = 1;
        } else {
            $scope.data.employee_is_manager = 0;
        }
    }

});

app.controller('empEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'employee_id'          : $scope.data.employee_id,
                'employee_is_manager'  : $scope.data.employee_is_manager,
                'employee_emp_no'      : $scope.data.employee_emp_no,
                'employee_job_role'    : $scope.data.employee_job_role,
                'employee_job_title'   : $scope.data.employee_job_title,
                'employee_manager_id'  : $scope.data.employee_manager_id,
                'employee_division_id' : $scope.data.employee_division_id,
                'employee_team_id'     : $scope.data.employee_team_id
            },
            url: './api/employee/employee_update.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
            if ($scope.data.success != 'Ok')  {
                alert('Unable to update the Employee record (ID = ' + $scope.data.employee_id + ') in the database! If this persists please inform support!');
            }
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the Employee records...');
        });
    }

    $scope.deactivate = function() {
        if(confirm("Are you sure you want to deactivate this employee?")){
            $http({
                method: 'POST',
                data: {
                    'user_id' : $scope.data.employee_user_id
                },
                url: './api/user/user_deactivate.php'
            }).then(function successCallback(response) {
                $scope.data.recordCount = response.data.count;
    			$scope.data.success     = response.data.success;
                if ($scope.data.success != 'Ok')  {
                    alert('Unable to update the User record (ID = ' + $scope.data.employee_user_id + ') in the database! If this persists please inform support!');
                }
                $uibModalInstance.close();
            }, function errorCallback(response) {
                alert('Unable to access the User records...');
            });
        }
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

    $scope.isManager = function () {
        if (document.getElementById("data.is_manager").checked == true) {
            $scope.data.employee_is_manager = 1;
        } else {
            $scope.data.employee_is_manager = 0;
        }
    }

});
