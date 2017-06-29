var app = angular.module('sterlingAssetTypeApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('atCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/asset_type/read.php'
        }).then(function successCallback(response) {
            $scope.data.assettypes = response.data.records;
		}, function errorCallback(response) {
            alert('Unable to access the Asset Types records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'id' : id },
            url: './api/asset_type/read_one.php'
        }).then(function successCallback(response) {
            $scope.data.id    = response.data[0]["id"];
            $scope.data.days  = response.data[0]["daysToReview"];
            $scope.data.type  = response.data[0]["type"];
            var modalInstance = $uibModal.open({
                animation:   true,
                controller:  'atEditCtrl',
                templateUrl: './dialogs/asset_type_edit.html',
                scope:       $scope
            });
            modalInstance.result.then(function () {
                $scope.get();
            }, function () {
            });
        }, function errorCallback(response) {
            alert('Unable to access the Asset Types records...');
        });
    }

    $scope.create = function() {
        $scope.data.id    = 0;
        $scope.data.days  = 0;
        $scope.data.type  = "";
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'atNewCtrl',
            templateUrl: './dialogs/asset_type_new.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

    $scope.delete = function(id) {
        if(confirm("Are you sure you want to remove this Asset Type from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: './api/asset_type/delete.php'
            }).then(function successCallback(response) {
                $scope.get();
            }, function errorCallback(response) {
                alert('Unable to access the Asset Types records...');
            });
        }
    }

});

app.controller('atNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'daysToReview' : $scope.data.days,
                'type'         : $scope.data.type
            },
            url: './api/asset_type/create.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the Asset Types records...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('atEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'id'           : $scope.data.id,
                'daysToReview' : $scope.data.days,
                'type'         : $scope.data.type
            },
            url: './api/asset_type/update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the Asset Types records...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
