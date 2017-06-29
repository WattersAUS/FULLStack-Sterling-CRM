var app = angular.module('sterlingUserApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('userCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/user/user_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No User records were found in the database!');
			} else {
    	        $scope.data.users = response.data.records;
			}
		}, function errorCallback(response) {
            alert('Unable to access the User records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'user_id' : id },
            url: './api/user/user_by_id.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
            $scope.data.success     = response.data.success;
            if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
                alert('Unable to access the User record (ID = ' + id + ') in the database! If this persists please inform support!');
            } else {
                $scope.data.user_id            = response.data.records[0]["user_id"];
                $scope.data.user_title         = response.data.records[0]["user_title"];
                $scope.data.user_first_name    = response.data.records[0]["user_first_name"];
                $scope.data.user_last_name     = response.data.records[0]["user_last_name"];
                $scope.data.user_email_address = response.data.records[0]["user_email_address"];
                $scope.data.user_start_date    = response.data.records[0]["user_start_date"];
                $scope.data.user_end_date      = response.data.records[0]["user_end_date"];
                $scope.data.user_password      = response.data.records[0]["user_password"];
                $scope.data.user_level         = response.data.records[0]["user_level"];
                var modalInstance = $uibModal.open({
                    animation:   true,
                    controller:  'usrEditCtrl',
                    templateUrl: './dialogs/user_edit.html',
                    scope:       $scope
                });
                modalInstance.result.then(function () {
                    $scope.get();
                }, function () {
                });
            }
        }, function errorCallback(response) {
            alert('Unable to access the User records...');
        });
    }

    $scope.create = function() {
        $scope.data.user_title         = "";
        $scope.data.user_first_name    = "";
        $scope.data.user_last_name     = "";
        $scope.data.user_email_address = "";
        $scope.data.user_password      = "";
        $scope.data.user_userGUID      = "";
        $scope.data.user_user_level    = 0;
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'usrNewCtrl',
            templateUrl: './dialogs/user_new.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

});

app.controller('usrNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'user_title'         : $scope.data.user_title,
                'user_first_name'    : $scope.data.user_first_name,
                'user_last_name'     : $scope.data.user_last_name,
                'user_email_address' : $scope.data.user_email_address,
                'user_password'      : $scope.data.user_password,
                'user_level'         : $scope.data.user_level
            },
            url: './api/user/user_insert.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
            if ($scope.data.success != 'Ok' || $scope.data.recordCount != 1)  {
                alert('Unable to insert a new User record in the database! If this persists please inform support!');
            }
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the User records...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('usrEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'user_id'            : $scope.data.user_id,
                'user_title'         : $scope.data.user_title,
                'user_first_name'    : $scope.data.user_first_name,
                'user_last_name'     : $scope.data.user_last_name,
                'user_email_address' : $scope.data.user_email_address,
                'user_password'      : $scope.data.user_password,
                'user_level'         : $scope.data.user_level
            },
            url: './api/user/user_update.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
            if ($scope.data.success != 'Ok')  {
                alert('Unable to update the User record (ID = ' + $scope.data.id + ') in the database! If this persists please inform support!');
            }
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the User records...');
        });
    }

    $scope.deactivate = function() {
        if(confirm("Are you sure you want to deactive this user?")){
            $http({
                method: 'POST',
                data: {
                    'user_id' : $scope.data.user_id
                },
                url: './api/user/user_deactivate.php'
            }).then(function successCallback(response) {
                $scope.data.recordCount = response.data.count;
    			$scope.data.success     = response.data.success;
                if ($scope.data.success != 'Ok')  {
                    alert('Unable to update the User record (ID = ' + $scope.data.user_id + ') in the database! If this persists please inform support!');
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

});
