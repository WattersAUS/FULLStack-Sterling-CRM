var app = angular.module('sterlingTeamApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('teamCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/team/read.php'
        }).then(function successCallback(response) {
            $scope.data.teams = response.data.records;
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the Team records...');
        });
    }

    $scope.create = function() {
        $scope.data.description  = "";
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'teamNewCtrl',
            templateUrl: './dialogs/team_new.html',
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
            url: './api/team/read_one.php'
        }).then(function successCallback(response) {
            $scope.data.id            = response.data[0]["id"];
            $scope.data.description   = response.data[0]["description"];
            var modalInstance = $uibModal.open({
                animation:   true,
                controller:  'teamEditCtrl',
                templateUrl: './dialogs/team_edit.html',
                scope:       $scope
            });
            modalInstance.result.then(function () {
                $scope.get();
            }, function () {
            });
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the Team record...');
        });
    }

    $scope.delete = function(id) {
        if(confirm("Are you sure you want to remove this Team from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: './api/team/delete.php'
            }).then(function successCallback(response) {
                $scope.get();
            }, function errorCallback(response) {
                alert('There has been an error accessing the server, unable to remove the term record...');
            });
        }
    }

});

app.controller('teamNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'description'   : $scope.data.description
            },
            url: './api/team/create.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to add the Team record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('teamEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'id'            : $scope.data.id,
                'description'   : $scope.data.description
            },
            url: './api/team/update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the Team record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
