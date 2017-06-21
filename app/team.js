var app = angular.module('sterlingTeamApp', ['angularUtils.directives.dirPagination']);
app.controller('teamCtrl', function($scope, $http) {

    $scope.updateTeam = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description
            },
            url: 'api/team/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-team-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readTeam = function(id) {
        $('#modal-team-title').text("Rename Team");
        $('#btn-update-team').show();
        $('#btn-create-team').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/team/read_one.php'
        }).then(function successCallback(response) {
            $scope.id          = response.data[0]["id"];
            $scope.description = response.data[0]["description"];
            $('#modal-team-form').modal('open');
        }, function errorCallback(repsonse) {
            Materialize.toast('Unable to retrieve Team record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/team/read.php'
        }).then(function successCallback(response) {
            $scope.teams = response.data.records;
        });
    }

    $scope.deleteTeam = function(id){
        if(confirm("Are you sure you want to remove this Team from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/team/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearForm();
        $('#modal-team-title').text("Add a Team to System");
        $('#btn-update-team').hide();
        $('#btn-create-team').show();
    }

    $scope.clearForm = function(){
        $scope.id          = "";
        $scope.description = "";
    }

    $scope.createTeam = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description
            },
            url: 'api/team/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-team-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
