var app = angular.module('sterlingTeamApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('teamCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/team/team_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Team records were found in the database!');
			} else {
    	        $scope.data.teams = response.data.records;
			}
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the Team records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'team_id' : id },
            url: './api/team/team_by_id.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('Cannot find the Team record in the database!');
			} else {
                $scope.data.team_id            = response.data.records[0]["team_id"];
                $scope.data.team_description   = response.data.records[0]["team_description"];
                var modalInstance = $uibModal.open({
                    animation:   true,
                    controller:  'teamEditCtrl',
                    templateUrl: './dialogs/team_edit.html',
                    scope:       $scope
                });
                modalInstance.result.then(function () {
                    $scope.get();
                }, function () {
                });
			}
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the Team record...');
        });
    }

    $scope.create = function() {
        $scope.data.team_description  = "";
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'teamNewCtrl',
            templateUrl: './dialogs/team_new.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

    $scope.delete = function(id) {
        if(confirm("Are you sure you want to remove this Team from the System?")){
            $http({
                method: 'POST',
                data: { 'team_id' : id },
                url: './api/team/team_delete.php'
            }).then(function successCallback(response) {
                $scope.data.recordCount = response.data.count;
    			$scope.data.success     = response.data.success;
                if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
                    alert('Unable to access the Team record (ID = ' + id + ') in the database! If this persists please inform support!');
                }
                $scope.get();
            }, function errorCallback(response) {
                alert('There has been an error accessing the server, unable to remove the team record...');
            });
        }
    }

});

app.controller('teamNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'team_description' : $scope.data.team_description
            },
            url: './api/team/team_insert.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
	            alert('There was a problem adding the Team to the database! If this persists please inform support!');
			}
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to add the Team record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('teamEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'team_id'          : $scope.data.team_id,
                'team_description' : $scope.data.team_description
            },
            url: './api/team/team_update.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
	            alert('There was a problem updating the Team to the database! If this persists please inform support!');
			}
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the Team record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
