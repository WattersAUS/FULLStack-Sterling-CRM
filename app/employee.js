var app = angular.module('sterlingEmployeeApp', ['angularUtils.directives.dirPagination']);
app.controller('employeeCtrl', function($scope, $http) {

    $scope.updateEmployee = function(){
        $http({
            method: 'POST',
            data: {
                'id'         : $scope.id,
                'name'       : $scope.division_id,
                'emp_no'     : $scope.emp_no,
                'is_manager' : $scope.is_manager,
                'job_role'   : $scope.job_role,
                'job_title'  : $scope.job_title,
                'manager_id' : $scope.manager_id,
                'team_id'    : $scope.team_id,
                'user_id'    : $scope.user_id
            },
            url: 'api/employee/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-employee-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readEmployee = function(id){
        $('#modal-employee-title').text("Edit Employee");
        $('#btn-update-employee').show();
        $('#btn-create-employee').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/employee/read_one.php'
        }).then(function successCallback(response) {
    		$scope.id          = response.data[0]["id"];
    		$scope.division_id = response.data[0]["division_id"];
    		$scope.emp_no      = response.data[0]["emp_no"];
    		$scope.is_manager  = response.data[0]["is_manager"];
    		$scope.job_role    = response.data[0]["job_role"];
    		$scope.job_title   = response.data[0]["job_title"];
    		$scope.manager_id  = response.data[0]["manager_id"];
    		$scope.team_id     = response.data[0]["team_id"];
    		$scope.user_id     = response.data[0]["user_id"];
            $('#modal-employee-form').modal('open');
        })
        .error(function(data, status, headers, config){
            Materialize.toast('Unable to retrieve record.', 4000);
        });
    }

    $scope.getAllEmployees = function() {
		$http({
			method: 'GET',
			url: './api/employee/employee_get_all.php'
		}).then(function successCallback(response) {
			$scope.clearForm();
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

    $scope.deleteEmployee = function(id){
        if(confirm("Are you sure?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/employee/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function(){
        $scope.clearForm();
        $('#modal-employee-title').text("New Employee");
        $('#btn-update-employee').hide();
        $('#btn-create-employee').show();
    }

    $scope.clearForm = function(){
        $scope.id          = "";
    	$scope.division_id = "";
    	$scope.emp_no      = "";
    	$scope.is_manager  = "";
    	$scope.job_role    = "";
    	$scope.job_title   = "";
    	$scope.manager_id  = "";
    	$scope.team_id     = "";
    	$scope.user_id     = "";
    }

    $scope.createEmployee = function(){
        $http({
            method: 'POST',
            data: {
                'id'         : $scope.id,
                'name'       : $scope.division_id,
                'emp_no'     : $scope.emp_no,
                'is_manager' : $scope.is_manager,
                'job_role'   : $scope.job_role,
                'job_title'  : $scope.job_title,
                'manager_id' : $scope.manager_id,
                'team_id'    : $scope.team_id,
                'user_id'    : $scope.user_id
            },
            url: 'api/employee/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-employee-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
