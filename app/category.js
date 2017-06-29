var app = angular.module('sterlingCategoryApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('categoryCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/category/read.php'
        }).then(function successCallback(response) {
            $scope.data.categories = response.data.records;
		}, function errorCallback(response) {
            alert('Unable to access the Category records...');
        });
    }

    $scope.read = function(id) {
        $http({
            method: 'POST',
            data: { 'id' : id },
            url: './api/category/read_one.php'
        }).then(function successCallback(response) {
            $scope.data.id          = response.data[0]["id"];
            $scope.data.code        = response.data[0]["code"];
            $scope.data.description = response.data[0]["description"];
            var modalInstance = $uibModal.open({
                animation:   true,
                controller:  'catEditCtrl',
                templateUrl: './dialogs/category_edit.html',
                scope:       $scope
            });
            modalInstance.result.then(function () {
                $scope.get();
            }, function () {
            });
        }, function errorCallback(response) {
            alert('Unable to access the Category records...');
        });
    }

    $scope.create = function() {
        $scope.data.id          = 0;
        $scope.data.code        = "";
        $scope.data.description = "";
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'catNewCtrl',
            templateUrl: './dialogs/category_new.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

    $scope.delete = function(id) {
        if(confirm("Are you sure you want to remove this Category from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: './api/category/delete.php'
            }).then(function successCallback(response) {
                $scope.get();
            }, function errorCallback(response) {
                alert('Unable to access the Category records...');
            });
        }
    }

});

app.controller('catNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'code'        : $scope.data.code,
                'description' : $scope.data.description
            },
            url: './api/category/create.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the Category records...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('catEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.data.id,
                'code'        : $scope.data.code,
                'description' : $scope.data.description
            },
            url: './api/category/update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('Unable to access the Category records...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
