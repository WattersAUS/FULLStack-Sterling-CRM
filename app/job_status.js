var app = angular.module('sterlingJobStatApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('jobStatCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/job_status/job_status_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('Unable to access the Job Status records! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Job Status records were found in the database!');
			} else {
    	        $scope.data.jobstatuses = response.data.records;
			}
        }, function errorCallback(response) {
            alert('Unable to access the Job Status records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'job_status_id' : id },
            url: './api/job_status/job_status_by_id.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
            $scope.data.success     = response.data.success;
            if ($scope.data.success != 'Ok') {
                alert('Unable to access the Job Status record! If this persists please inform support!');
                return;
            }
            if ($scope.data.recordCount == 0) {
                alert('Cannot find the Job Status record in the database!');
            } else {
                $scope.data.job_status_id            = response.data.records[0]["job_status_id"];
                $scope.data.job_status_description   = response.data.records[0]["job_status_description"];
                $scope.data.job_status_template_page = response.data.records[0]["job_status_template_page"];
                var modalInstance = $uibModal.open({
                    animation:   true,
                    controller:  'jobStatEditCtrl',
                    templateUrl: './dialogs/job_status_edit.html',
                    scope:       $scope
                });
                modalInstance.result.then(function () {
                    $scope.get();
                }, function () {
                });
            }
        }, function errorCallback(response) {
            alert('Unable to access the Job Status records...');
        });
    }

    $scope.create = function() {
        $scope.data.job_status_id            = "";
        $scope.data.job_status_description   = "";
        $scope.data.job_status_template_page = "";
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'jobStatNewCtrl',
            templateUrl: './dialogs/job_status_edit.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

    $scope.delete = function(id) {
        if(confirm("Are you sure you want to remove this Job Status from the System?")){
            $http({
                method: 'POST',
                data: { 'job_status_id' : id },
                url: './api/job_status/job_status_delete.php'
            }).then(function successCallback(response) {
                $scope.get();
            }, function errorCallback(response) {
                alert('Unable to access the Job Status records...');
            });
        }
    }

});

app.controller('jobStatNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'job_status_description'   : $scope.data.job_status_description,
                'job_status_template_page' : $scope.data.job_status_template_page
            },
            url: './api/job_status/job_status_insert.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to add the Job Status record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('jobStatEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'job_status_id'            : $scope.data.job_status_id,
                'job_status_description'   : $scope.data.job_status_description,
                'job_status_template_page' : $scope.data.job_status_template_page
            },
            url: './api/job_status/job_status_update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the Job Status record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
