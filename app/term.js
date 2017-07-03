var app = angular.module('sterlingTermApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('termCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/term/read.php'
        }).then(function successCallback(response) {
            $scope.data.terms = response.data.records;
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the term records...');
        });
    }

    $scope.create = function() {
        $scope.data.description  = "";
        $scope.data.days         = "";
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'termNewCtrl',
            templateUrl: './dialogs/term_new.html',
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
            data: { 'id' : id },
            url: './api/term/read_one.php'
        }).then(function successCallback(response) {
            $scope.data.id            = response.data[0]["id"];
            $scope.data.description   = response.data[0]["description"];
            $scope.data.days          = response.data[0]["days"];
            var modalInstance = $uibModal.open({
                animation:   true,
                controller:  'termEditCtrl',
                templateUrl: './dialogs/term_edit.html',
                scope:       $scope
            });
            modalInstance.result.then(function () {
                $scope.get();
            }, function () {
            });
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the term record...');
        });
    }

    $scope.delete = function(id) {
        if(confirm("Are you sure you want to remove this Term from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: './api/term/delete.php'
            }).then(function successCallback(response) {
                $scope.get();
            }, function errorCallback(response) {
                alert('There has been an error accessing the server, unable to remove the term record...');
            });
        }
    }

});

app.controller('termNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'description' : $scope.data.description,
                'days'        : $scope.data.days
            },
            url: './api/term/create.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to add the term record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('termEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.data.id,
                'description' : $scope.data.description,
                'days'        : $scope.data.days
            },
            url: './api/term/update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the term record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
