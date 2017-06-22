var app = angular.module('sterlingTermApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('termCtrl', function($scope, $http, $uibModal) {

    $scope.get = function() {
        $http({
            method: 'GET',
            url: 'api/term/read.php'
        }).then(function successCallback(response) {
            $scope.terms = response.data.records;
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the term records...');
        });
    }

    $scope.create = function() {
        $scope.id           = "";
        $scope.description  = "";
        $scope.days         = "";
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'newTermCtrl',
            templateUrl: 'newTerm.html',
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
            url: 'api/term/read_one.php'
        }).then(function successCallback(response) {
            $scope.id            = response.data[0]["id"];
            $scope.description   = response.data[0]["description"];
            $scope.days          = response.data[0]["days"];
            var modalInstance = $uibModal.open({
                animation:   true,
                controller:  'editTermCtrl',
                templateUrl: 'editTerm.html',
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
                url: 'api/term/delete.php'
            }).then(function successCallback(response) {
                $scope.get();
            }, function errorCallback(response) {
                alert('There has been an error accessing the server, unable to remove the term record...');
            });
        }
    }

});

app.controller('newTermCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description,
                'days'        : $scope.days
            },
            url: 'api/term/create.php'
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

app.controller('editTermCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description,
                'days'        : $scope.days
            },
            url: 'api/term/update.php'
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
