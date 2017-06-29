var app = angular.module('sterlingDivisionApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('divisionCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/division/read.php'
        }).then(function successCallback(response) {
            $scope.data.divisions = response.data.records;
		}, function errorCallback(response) {
            alert('Unable to access the Division records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'id' : id },
            url: './api/division/read_one.php'
        }).then(function successCallback(response) {
            $scope.data.id          = response.data[0]["id"];
            $scope.data.description = response.data[0]["description"];
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
        }, function errorCallback(response) {
            alert('Unable to access the Division records...');
        });
    }

    $scope.create = function() {
        $scope.data.id          = 0;
        $scope.data.description = "";
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
                data: { 'id' : id },
                url: './api/division/delete.php'
            }).then(function successCallback(response) {
                $scope.get();
            }, function errorCallback(response) {
                alert('Unable to access the Division records...');
            });
        }
    }

});

app.controller('divNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'description' : $scope.data.description
            },
            url: './api/division/create.php'
        }).then(function successCallback(response) {
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
                'id'          : $scope.data.id,
                'description' : $scope.data.description
            },
            url: './api/division/update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the Division records...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
