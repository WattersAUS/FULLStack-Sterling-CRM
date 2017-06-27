var app = angular.module('sterlingAssetApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('assetCtrl', function($scope, $http, $uibModal) {

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/asset/asset_get_all.php'
        }).then(function successCallback(response) {
            $scope.assets = response.data.records;
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the asset records...');
        });
    }

    $scope.create = function() {
        $scope.asset_id                    = "";
        $scope.asset_type_id               = "";
        $scope.asset_employee_id           = "";
        $scope.asset_name                  = "";
        $scope.asset_date_allocated        = "";
        $scope.asset_date_to_service       = "";
        $scope.asset_make                  = "";
        $scope.asset_model                 = "";
        $scope.asset_serial_number         = "";
        $scope.asset_internal_id           = "";
        $scope.asset_in_service_date       = "";
        $scope.asset_total_cost            = "";
        $scope.asset_purchase_date         = "";
        $scope.asset_depreciation_years    = "";
        $scope.asset_depreciation_rate     = "";
        $scope.asset_book_value            = "";
        $scope.asset_supplier_id           = "";
        $scope.asset_tracker_id            = "";
        $scope.asset_allocated_employee_id = "";
        $scope.asset_allocation_status     = "";
        $scope.asset_location              = "";
        $scope.asset_notes                 = "";
        $scope.asset_condition             = "";
        $scope.getAllEmployees();
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'newAssetCtrl',
            templateUrl: 'newAsset.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'asset_id' : id },
            url: './api/asset/asset_by_id.php'
        }).then(function successCallback(response) {
            $scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.recordCount == 0) {
	            alert('No Asset records were found in the database!');
			} else {
                $scope.asset_id                    = response.data.records[0]["asset_id"];
                $scope.asset_type_id               = response.data.records[0]["asset_type_id"];
                $scope.asset_employee_id           = response.data.records[0]["asset_employee_id"];
                $scope.asset_name                  = response.data.records[0]["asset_name"];
                $scope.asset_date_allocated        = response.data.records[0]["asset_date_allocated"];
                $scope.asset_date_to_service       = response.data.records[0]["asset_date_to_service"];
                $scope.asset_make                  = response.data.records[0]["asset_make"];
                $scope.asset_model                 = response.data.records[0]["asset_model"];
                $scope.asset_serial_number         = response.data.records[0]["asset_serial_number"];
                $scope.asset_internal_id           = response.data.records[0]["asset_internal_id"];
                $scope.asset_in_service_date       = response.data.records[0]["asset_in_service_date"];
                $scope.asset_total_cost            = response.data.records[0]["asset_total_cost"];
                $scope.asset_purchase_date         = response.data.records[0]["asset_purchase_date"];
                $scope.asset_depreciation_years    = response.data.records[0]["asset_depreciation_years"];
                $scope.asset_depreciation_rate     = response.data.records[0]["asset_depreciation_rate"];
                $scope.asset_book_value            = response.data.records[0]["asset_book_value"];
                $scope.asset_supplier_id           = response.data.records[0]["asset_supplier_id"];
                $scope.asset_tracker_id            = response.data.records[0]["asset_tracker_id"];
                $scope.asset_allocated_employee_id = response.data.records[0]["asset_allocated_employee_id"];
                $scope.asset_allocation_status     = response.data.records[0]["asset_allocation_status"];
                $scope.asset_location              = response.data.records[0]["asset_location"];
                $scope.asset_notes                 = response.data.records[0]["asset_notes"];
                $scope.asset_condition             = response.data.records[0]["asset_condition"];
                $scope.getEmployees();
			}
            var modalInstance = $uibModal.open({
                animation:   true,
                controller:  'editAssetCtrl',
                templateUrl: 'editAsset.html',
                scope:       $scope
            });
            modalInstance.result.then(function () {
                $scope.get();
            }, function () {
            });
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the asset record...');
        });
    }

    $scope.allocate = function(id) {
        $http({
            method: 'POST',
            data: { 'asset_id' : id },
            url: './api/asset/asset_by_id.php'
        }).then(function successCallback(response) {
            $scope.recordCount = response.data.count;
			$scope.success     = response.data.success;
			if ($scope.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.recordCount == 0) {
	            alert('No Asset records were found in the database!');
			} else {
                $scope.asset_id                    = response.data.records[0]["asset_id"];
                $scope.asset_type_id               = response.data.records[0]["asset_type_id"];
                $scope.asset_employee_id           = response.data.records[0]["asset_employee_id"];
                $scope.asset_name                  = response.data.records[0]["asset_name"];
                $scope.asset_date_allocated        = response.data.records[0]["asset_date_allocated"];
                $scope.asset_date_to_service       = response.data.records[0]["asset_date_to_service"];
                $scope.asset_make                  = response.data.records[0]["asset_make"];
                $scope.asset_model                 = response.data.records[0]["asset_model"];
                $scope.asset_serial_number         = response.data.records[0]["asset_serial_number"];
                $scope.asset_internal_id           = response.data.records[0]["asset_internal_id"];
                $scope.asset_in_service_date       = response.data.records[0]["asset_in_service_date"];
                $scope.asset_total_cost            = response.data.records[0]["asset_total_cost"];
                $scope.asset_purchase_date         = response.data.records[0]["asset_purchase_date"];
                $scope.asset_depreciation_years    = response.data.records[0]["asset_depreciation_years"];
                $scope.asset_depreciation_rate     = response.data.records[0]["asset_depreciation_rate"];
                $scope.asset_book_value            = response.data.records[0]["asset_book_value"];
                $scope.asset_supplier_id           = response.data.records[0]["asset_supplier_id"];
                $scope.asset_tracker_id            = response.data.records[0]["asset_tracker_id"];
                $scope.asset_allocated_employee_id = response.data.records[0]["asset_allocated_employee_id"];
                $scope.asset_allocation_status     = response.data.records[0]["asset_allocation_status"];
                $scope.asset_location              = response.data.records[0]["asset_location"];
                $scope.asset_notes                 = response.data.records[0]["asset_notes"];
                $scope.asset_condition             = response.data.records[0]["asset_condition"];
                $scope.getEmployees();
			}
            var modalInstance = $uibModal.open({
                animation:   true,
                controller:  'allocAssetCtrl',
                templateUrl: 'allocAsset.html',
                scope:       $scope
            });
            modalInstance.result.then(function () {
                $scope.get();
            }, function () {
            });
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the asset record...');
        });
    }

    $scope.delete = function(id) {
        if(confirm("Are you sure you want to remove this Asset from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: './api/asset/asset_delete.php'
            }).then(function successCallback(response) {
                $scope.get();
            }, function errorCallback(response) {
                alert('There has been an error accessing the server, unable to remove the asset record...');
            });
        }
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
			alert('There has been an error accessing the server, unable to retrieve the employee records...');
		});
	}

});

app.controller('newAssetCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'asset_type_id'               : $scope.asset_type_id,
                'asset_employee_id'           : $scope.asset_employee_id,
                'asset_name'                  : $scope.asset_name,
                'asset_date_allocated'        : $scope.asset_date_allocated,
                'asset_date_to_service'       : $scope.asset_date_to_service,
                'asset_make'                  : $scope.asset_make,
                'asset_model'                 : $scope.asset_model,
                'asset_serial_number'         : $scope.asset_serial_number,
                'asset_internal_id'           : $scope.asset_internal_id,
                'asset_in_service_date'       : $scope.asset_in_service_date,
                'asset_total_cost'            : $scope.asset_total_cost,
                'asset_purchase_date'         : $scope.asset_purchase_date,
                'asset_depreciation_years'    : $scope.asset_depreciation_years,
                'asset_depreciation_rate'     : $scope.asset_depreciation_rate,
                'asset_book_value'            : $scope.asset_book_value,
                'asset_supplier_id'           : $scope.asset_supplier_id,
                'asset_tracker_id'            : $scope.asset_tracker_id,
                'asset_allocated_employee_id' : $scope.asset_allocated_employee_id,
                'asset_allocation_status'     : $scope.asset_allocation_status,
                'asset_location'              : $scope.asset_location,
                'asset_notes'                 : $scope.asset_notes,
                'asset_condition'             : $scope.asset_condition
            },
            url: './api/asset/asset_insert.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to add the asset record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('editAssetCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'asset_id'                    : $scope.asset_id,
                'asset_type_id'               : $scope.asset_type_id,
                'asset_employee_id'           : $scope.asset_employee_id,
                'asset_name'                  : $scope.asset_name,
                'asset_date_allocated'        : $scope.asset_date_allocated,
                'asset_date_to_service'       : $scope.asset_date_to_service,
                'asset_make'                  : $scope.asset_make,
                'asset_model'                 : $scope.asset_model,
                'asset_serial_number'         : $scope.asset_serial_number,
                'asset_internal_id'           : $scope.asset_internal_id,
                'asset_in_service_date'       : $scope.asset_in_service_date,
                'asset_total_cost'            : $scope.asset_total_cost,
                'asset_purchase_date'         : $scope.asset_purchase_date,
                'asset_depreciation_years'    : $scope.asset_depreciation_years,
                'asset_depreciation_rate'     : $scope.asset_depreciation_rate,
                'asset_book_value'            : $scope.asset_book_value,
                'asset_supplier_id'           : $scope.asset_supplier_id,
                'asset_tracker_id'            : $scope.asset_tracker_id,
                'asset_allocated_employee_id' : $scope.asset_allocated_employee_id,
                'asset_allocation_status'     : $scope.asset_allocation_status,
                'asset_location'              : $scope.asset_location,
                'asset_notes'                 : $scope.asset_notes,
                'asset_condition'             : $scope.asset_condition
            },
            url: './api/asset/asset_update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the asset record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('allocAssetCtrl', function($scope, $http, $uibModalInstance) {

    $scope.allocate = function() {
        $http({
            method: 'POST',
            data: {
                'asset_id'                    : $scope.asset_id,
                'asset_employee_id'           : $scope.asset_employee_id,
                'asset_date_allocated'        : $scope.asset_date_allocated,
                'asset_allocated_employee_id' : $scope.asset_allocated_employee_id
            },
            url: './api/asset/asset_allocate_by_id'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to allocate the asset record...');
        });
    }

    $scope.deallocate = function() {
        $http({
            method: 'POST',
            data: {
                'asset_id'                    : $scope.asset_id,
                'asset_employee_id'           : $scope.asset_employee_id
            },
            url: './api/asset/asset_deallocate_by_id.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to deallocate the asset record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});