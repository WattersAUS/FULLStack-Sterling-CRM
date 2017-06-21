var app = angular.module('sterlingDivisionApp', ['angularUtils.directives.dirPagination']);
app.controller('divisionCtrl', function($scope, $http) {

    $scope.updateDivision = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description
            },
            url: 'api/division/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-division-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readDivision = function(id) {
        $('#modal-division-title').text("Rename Division");
        $('#btn-update-division').show();
        $('#btn-create-division').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/division/read_one.php'
        }).then(function successCallback(response) {
            $scope.id          = response.data[0]["id"];
            $scope.description = response.data[0]["description"];
            $('#modal-division-form').modal('open');
        }, function errorCallback(repsonse) {
            Materialize.toast('Unable to retrieve Division record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/division/read.php'
        }).then(function successCallback(response) {
            $scope.divisions = response.data.records;
        });
    }

    $scope.deleteDivision = function(id){
        if(confirm("Are you sure you want to remove this Division from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/division/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearForm();
        $('#modal-division-title').text("Add a Division to System");
        $('#btn-update-division').hide();
        $('#btn-create-division').show();
    }

    $scope.clearForm = function(){
        $scope.id          = "";
        $scope.description = "";
    }

    $scope.createDivision = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description
            },
            url: 'api/division/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-division-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
