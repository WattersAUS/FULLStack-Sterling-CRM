var app = angular.module('sterlingDivisionApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('divisionCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/division/division_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Division records were found in the database!');
			} else {
    	        $scope.data.divisions = response.data.records;
			}
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the Divisions records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'division_id' : id },
            url: './api/division/division_by_id.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('Cannot find the Division record in the database!');
			} else {
                $scope.data.division_id            = response.data.records[0]["division_id"];
                $scope.data.division_description   = response.data.records[0]["division_description"];
                var modalInstance = $uibModal.open({
                    animation:   true,
                    controller:  'divEditCtrl',
                    templateUrl: './dialogs/division_edit.html',
                    scope:       $scope
                });
                modalInstance.result.then(function () {
                    $scope.get();
                }, function () {
                });
			}
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the Division record...');
        });
    }

    $scope.create = function() {
        $scope.data.division_id          = 0;
        $scope.data.division_description = "";
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'divNewCtrl',
            templateUrl: './dialogs/division_new.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

    $scope.delete = function(id) {
        if(confirm("Are you sure you want to remove this Division from the System?")){
            $http({
                method: 'POST',
                data: { 'division_id' : id },
                url: './api/division/division_delete.php'
            }).then(function successCallback(response) {
                $scope.data.recordCount = response.data.count;
    			$scope.data.success     = response.data.success;
                if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
                    alert('Unable to access the Division record (ID = ' + id + ') in the database! If this persists please inform support!');
                }
                $scope.get();
            }, function errorCallback(response) {
                alert('There has been an error accessing the server, unable to remove the Division record...');
            });
        }
    }

});

app.controller('divNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'division_description' : $scope.data.division_description
            },
            url: './api/division/division_insert.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
	            alert('There was a problem adding the Division to the database! If this persists please inform support!');
			}
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the Division records...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('divEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'division_id'          : $scope.data.division_id,
                'division_description' : $scope.data.division_description
            },
            url: './api/division/division_update.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
	            alert('There was a problem updating the Division to the database! If this persists please inform support!');
			}
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the Division records...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
