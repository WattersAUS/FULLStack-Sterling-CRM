var app = angular.module('sterlingWorkOptApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('workOptCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/work_option/work_option_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('Unable to access the Work Option records! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Work Option records were found in the database!');
			} else {
    	        $scope.data.workoptions = response.data.records;
			}
        }, function errorCallback(response) {
            alert('Unable to access the Work Option records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'work_option_id' : id },
            url: './api/work_option/work_option_by_id.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
            $scope.data.success     = response.data.success;
            if ($scope.data.success != 'Ok') {
                alert('Unable to access the Work Option record! If this persists please inform support!');
                return;
            }
            if ($scope.data.recordCount == 0) {
                alert('Cannot find the Work Option record in the database!');
            } else {
                $scope.data.work_option_id               = response.data.records[0]["work_option_id"];
                $scope.data.work_option_category_id      = response.data.records[0]["work_option_category_id"];
                $scope.data.work_option_description      = response.data.records[0]["work_option_description"];
                $scope.data.work_option_code             = response.data.records[0]["work_option_code"];
                $scope.data.work_option_default_quantity = response.data.records[0]["work_option_default_quantity"];
                $scope.data.work_option_default_pricing  = response.data.records[0]["work_option_default_pricing"];
                $scope.getCategories();
                var modalInstance = $uibModal.open({
                    animation:   true,
                    controller:  'workOptEditCtrl',
                    templateUrl: './dialogs/work_option_edit.html',
                    scope:       $scope
                });
                modalInstance.result.then(function () {
                    $scope.get();
                }, function () {
                });
            }
        }, function errorCallback(response) {
            alert('Unable to access the Work Option records...');
        });
    }

    $scope.create = function() {
        $scope.data.work_option_id               = "";
        $scope.data.work_option_category_id      = "0";
        $scope.data.work_option_description      = "";
        $scope.data.work_option_code             = "";
        $scope.data.work_option_default_quantity = "1";
        $scope.data.work_option_default_pricing  = "0.00";
        $scope.getCategories();
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'workOptNewCtrl',
            templateUrl: './dialogs/work_option_edit.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

    $scope.delete = function(id) {
        if(confirm("Are you sure you want to remove this Work Option from the System?")){
            $http({
                method: 'POST',
                data: { 'work_option_id' : id },
                url: './api/work_option/work_option_delete.php'
            }).then(function successCallback(response) {
                $scope.get();
            }, function errorCallback(response) {
                alert('Unable to access the Work Option records...');
            });
        }
    }

	$scope.getCategories = function() {
        $http({
            method: 'GET',
            url: './api/category/read.php'
        }).then(function successCallback(response) {
            $scope.data.categories = response.data.records;
		}, function errorCallback(response) {
            alert('Unable to access the Category records...');
        });
    }

});

app.controller('workOptNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'work_option_category_id'      : $scope.data.work_option_category_id,
                'work_option_code'             : $scope.data.work_option_code,
                'work_option_description'      : $scope.data.work_option_description,
                'work_option_default_quantity' : $scope.data.work_option_default_quantity,
                'work_option_default_pricing'  : $scope.data.work_option_default_pricing
            },
            url: './api/work_option/work_option_insert.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to add the work option record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('workOptEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'work_option_id'               : $scope.data.work_option_id,
                'work_option_category_id'      : $scope.data.work_option_category_id,
                'work_option_code'             : $scope.data.work_option_code,
                'work_option_description'      : $scope.data.work_option_description,
                'work_option_default_quantity' : $scope.data.work_option_default_quantity,
                'work_option_default_pricing'  : $scope.data.work_option_default_pricing
            },
            url: './api/work_option/work_option_update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the work option record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
