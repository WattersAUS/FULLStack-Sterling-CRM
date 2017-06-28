var app = angular.module('sterlingAssetApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('assetCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/asset/asset_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.assets = response.data.records;
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the asset records...');
        });
    }

    $scope.create = function() {
        $scope.data.asset_id                    = "";
        $scope.data.asset_type_id               = "";
        $scope.data.asset_employee_id           = "";
        $scope.data.asset_name                  = "";
        $scope.data.asset_date_allocated        = "";
        $scope.data.asset_date_to_service       = "";
        $scope.data.asset_make                  = "";
        $scope.data.asset_model                 = "";
        $scope.data.asset_serial_number         = "";
        $scope.data.asset_internal_id           = "";
        $scope.data.asset_in_service_date       = "";
        $scope.data.asset_total_cost            = "";
        $scope.data.asset_purchase_date         = "";
        $scope.data.asset_depreciation_years    = "";
        $scope.data.asset_depreciation_rate     = "";
        $scope.data.asset_book_value            = "";
        $scope.data.asset_supplier_id           = "";
        $scope.data.asset_tracker_id            = "";
        $scope.data.asset_allocated_employee_id = "";
        $scope.data.asset_allocation_status     = "";
        $scope.data.asset_location              = "";
        $scope.data.asset_notes                 = "";
        $scope.data.asset_condition             = "";
        $scope.getAssetTypes();
        $scope.getSuppliers();
        $scope.getEmployees();
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'assetNewCtrl',
            templateUrl: './dialogs/asset_new.html',
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
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Asset records were found in the database!');
			} else {
                $scope.data.asset_id                    = response.data.records[0]["asset_id"];
                $scope.data.asset_type_id               = response.data.records[0]["asset_type_id"];
                $scope.data.asset_employee_id           = response.data.records[0]["asset_employee_id"];
                $scope.data.asset_name                  = response.data.records[0]["asset_name"];
                $scope.data.asset_date_allocated        = response.data.records[0]["asset_date_allocated"];
                $scope.data.asset_date_to_service       = response.data.records[0]["asset_date_to_service"];
                $scope.data.asset_make                  = response.data.records[0]["asset_make"];
                $scope.data.asset_model                 = response.data.records[0]["asset_model"];
                $scope.data.asset_serial_number         = response.data.records[0]["asset_serial_number"];
                $scope.data.asset_internal_id           = response.data.records[0]["asset_internal_id"];
                $scope.data.asset_in_service_date       = response.data.records[0]["asset_in_service_date"];
                $scope.data.asset_total_cost            = response.data.records[0]["asset_total_cost"];
                $scope.data.asset_purchase_date         = response.data.records[0]["asset_purchase_date"];
                $scope.data.asset_depreciation_years    = response.data.records[0]["asset_depreciation_years"];
                $scope.data.asset_depreciation_rate     = response.data.records[0]["asset_depreciation_rate"];
                $scope.data.asset_book_value            = response.data.records[0]["asset_book_value"];
                $scope.data.asset_supplier_id           = response.data.records[0]["asset_supplier_id"];
                $scope.data.asset_tracker_id            = response.data.records[0]["asset_tracker_id"];
                $scope.data.asset_allocated_employee_id = response.data.records[0]["asset_allocated_employee_id"];
                $scope.data.asset_allocation_status     = response.data.records[0]["asset_allocation_status"];
                $scope.data.asset_location              = response.data.records[0]["asset_location"];
                $scope.data.asset_notes                 = response.data.records[0]["asset_notes"];
                $scope.data.asset_condition             = response.data.records[0]["asset_condition"];                $scope.getEmployees();
			}
            var modalInstance = $uibModal.open({
                animation:   true,
                controller:  'assetEditCtrl',
                templateUrl: './dialogs/asset_edit.html',
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
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('Assets were not found in the database!');
			} else {
                $scope.data.asset_id                    = response.data.records[0]["asset_id"];
                $scope.data.asset_type_id               = response.data.records[0]["asset_type_id"];
                $scope.data.asset_employee_id           = response.data.records[0]["asset_employee_id"];
                $scope.data.asset_name                  = response.data.records[0]["asset_name"];
                $scope.data.asset_date_allocated        = response.data.records[0]["asset_date_allocated"];
                $scope.data.asset_date_to_service       = response.data.records[0]["asset_date_to_service"];
                $scope.data.asset_make                  = response.data.records[0]["asset_make"];
                $scope.data.asset_model                 = response.data.records[0]["asset_model"];
                $scope.data.asset_serial_number         = response.data.records[0]["asset_serial_number"];
                $scope.data.asset_internal_id           = response.data.records[0]["asset_internal_id"];
                $scope.data.asset_in_service_date       = response.data.records[0]["asset_in_service_date"];
                $scope.data.asset_total_cost            = response.data.records[0]["asset_total_cost"];
                $scope.data.asset_purchase_date         = response.data.records[0]["asset_purchase_date"];
                $scope.data.asset_depreciation_years    = response.data.records[0]["asset_depreciation_years"];
                $scope.data.asset_depreciation_rate     = response.data.records[0]["asset_depreciation_rate"];
                $scope.data.asset_book_value            = response.data.records[0]["asset_book_value"];
                $scope.data.asset_supplier_id           = response.data.records[0]["asset_supplier_id"];
                $scope.data.asset_tracker_id            = response.data.records[0]["asset_tracker_id"];
                $scope.data.asset_allocated_employee_id = response.data.records[0]["asset_allocated_employee_id"];
                $scope.data.asset_allocation_status     = response.data.records[0]["asset_allocation_status"];
                $scope.data.asset_location              = response.data.records[0]["asset_location"];
                $scope.data.asset_notes                 = response.data.records[0]["asset_notes"];
                $scope.data.asset_condition             = response.data.records[0]["asset_condition"];
                $scope.getEmployees();
			}
            var modalInstance = $uibModal.open({
                animation:   true,
                controller:  'assetAllocCtrl',
                templateUrl: './dialogs/asset_alloc.html',
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
			$scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('Employees were not found in the database!');
			} else {
    	        $scope.data.employees = response.data.records;
			}
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, unable to retrieve the employee records...');
		});
	}

    $scope.getAssetTypes = function() {
        $http({
            method: 'GET',
            url: 'api/asset_type/read.php'
        }).then(function successCallback(response) {
            $scope.data.assettypes = response.data.records;
        });
    }

    $scope.getSuppliers = function() {
        $http({
            method: 'GET',
            url: 'api/supplier/read.php'
        }).then(function successCallback(response) {
            $scope.data.suppliers = response.data.records;
        });
    }

});

app.controller('assetNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        // hack
        $scope.data.asset_employee_id = 2;

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

    // date handling
    $scope.dateOptions = {
        dateDisabled: disabled,
        formatYear: 'yy',
        maxDate: new Date(2099,12, 31),
        minDate: new Date(2016, 1, 1),
        startingDay: 1
    };

    // disable weekend selection
    function disabled(data) {
        var date = data.date, mode = data.mode;
        return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
    }

    $scope.calendar = function($event) {
        $scope.opened = true;
    };

    $scope.format          = 'dd-MMMM-yyyy';
    $scope.altInputFormats = ['M!/d!/yyyy'];

});

app.controller('assetEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'asset_id'                    : $scope.data.asset_id,
                'asset_type_id'               : $scope.data.asset_type_id,
                'asset_employee_id'           : $scope.data.asset_employee_id,
                'asset_name'                  : $scope.data.asset_name,
                'asset_date_allocated'        : $scope.data.asset_date_allocated,
                'asset_date_to_service'       : $scope.data.asset_date_to_service,
                'asset_make'                  : $scope.data.asset_make,
                'asset_model'                 : $scope.data.asset_model,
                'asset_serial_number'         : $scope.data.asset_serial_number,
                'asset_internal_id'           : $scope.data.asset_internal_id,
                'asset_in_service_date'       : $scope.data.asset_in_service_date,
                'asset_total_cost'            : $scope.data.asset_total_cost,
                'asset_purchase_date'         : $scope.data.asset_purchase_date,
                'asset_depreciation_years'    : $scope.data.asset_depreciation_years,
                'asset_depreciation_rate'     : $scope.data.asset_depreciation_rate,
                'asset_book_value'            : $scope.data.asset_book_value,
                'asset_supplier_id'           : $scope.data.asset_supplier_id,
                'asset_tracker_id'            : $scope.data.asset_tracker_id,
                'asset_allocated_employee_id' : $scope.data.asset_allocated_employee_id,
                'asset_allocation_status'     : $scope.data.asset_allocation_status,
                'asset_location'              : $scope.data.asset_location,
                'asset_notes'                 : $scope.data.asset_notes,
                'asset_condition'             : $scope.data.asset_condition
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

app.controller('assetAllocCtrl', function($scope, $http, $uibModalInstance) {

    $scope.allocate = function() {
        $http({
            method: 'POST',
            data: {
                'asset_id'                    : $scope.data.asset_id,
                'asset_employee_id'           : $scope.data.asset_employee_id,
                'asset_date_allocated'        : $scope.data.asset_date_allocated,
                'asset_allocated_employee_id' : $scope.data.asset_allocated_employee_id
            },
            url: './api/asset/asset_allocate.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
            $scope.data.success     = response.data.success;
            if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
                alert('There was a problem allocating the asset! If this persists please inform support!');
            }
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to allocate the asset record...');
        });
    }

    $scope.deallocate = function() {
        $http({
            method: 'POST',
            data: {
                'asset_id'                    : $scope.data.asset_id,
                'asset_employee_id'           : $scope.data.asset_employee_id
            },
            url: './api/asset/asset_deallocate.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
            $scope.data.success     = response.data.success;
            if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
                alert('There was a problem deallocating the asset! If this persists please inform support!');
            }
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to deallocate the asset record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

    // date handling
    $scope.dateOptions = {
        dateDisabled: disabled,
        formatYear: 'yy',
        maxDate: new Date(2099,12, 31),
        minDate: new Date(2016, 1, 1),
        startingDay: 1
    };

    // disable weekend selection
    function disabled(data) {
        var date = data.date, mode = data.mode;
        return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
    }

    $scope.calendar = function($event) {
        $scope.opened = true;
    };

    $scope.format          = 'dd-MMMM-yyyy';
    $scope.altInputFormats = ['M!/d!/yyyy'];

});
