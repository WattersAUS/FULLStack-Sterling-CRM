var app = angular.module('sterlingDeliveryOptionApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('deliveryOptionCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/delivery_option/read.php'
        }).then(function successCallback(response) {
            $scope.data.deliveryoptions = response.data.records;
		}, function errorCallback(response) {
            alert('Unable to access the Delivery Option records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'id' : id },
            url: './api/delivery_option/read_one.php'
        }).then(function successCallback(response) {
            $scope.data.id          = response.data[0]["id"];
            $scope.data.description = response.data[0]["description"];
            var modalInstance = $uibModal.open({
                animation:   true,
                controller:  'doEditCtrl',
                templateUrl: './dialogs/delivery_option_edit.html',
                scope:       $scope
            });
            modalInstance.result.then(function () {
                $scope.get();
            }, function () {
            });
        }, function errorCallback(response) {
            alert('Unable to access the Delivery Option records...');
        });
    }

    $scope.create = function() {
        $scope.data.id          = 0;
        $scope.data.description = "";
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'doNewCtrl',
            templateUrl: './dialogs/delivery_option_new.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

    $scope.delete = function(id) {
        if(confirm("Are you sure you want to remove this Delivery Option from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: './api/delivery_option/delete.php'
            }).then(function successCallback(response) {
                $scope.get();
            }, function errorCallback(response) {
                alert('Unable to access the Delivery Option records...');
            });
        }
    }

});

app.controller('doNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'description' : $scope.data.description
            },
            url: './api/delivery_option/create.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the Delivery Option records...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('doEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.data.id,
                'description' : $scope.data.description
            },
            url: './api/delivery_option/update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the Delivery Option records...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
