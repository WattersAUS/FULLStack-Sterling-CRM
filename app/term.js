var app = angular.module('sterlingTermApp', ['angularUtils.directives.dirPagination']);
app.controller('termCtrl', function($scope, $http) {

    $scope.updateTerm = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description,
                'days'        : $scope.days
            },
            url: 'api/term/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-term-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readTerm = function(id) {
        $('#modal-term-title').text("Edit Term");
        $('#btn-update-term').show();
        $('#btn-create-term').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/term/read_one.php'
        }).then(function successCallback(response) {
            $scope.id          = response.data[0]["id"];
            $scope.description = response.data[0]["description"];
            $scope.days        = response.data[0]["days"];
            $('#modal-term-form').modal('open');
        }, function errorCallback(repsonse) {
            Materialize.toast('Unable to retrieve Term record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/term/read.php'
        }).then(function successCallback(response) {
            $scope.terms = response.data.records;
        });
    }

    $scope.deleteTerm = function(id){
        if(confirm("Are you sure you want to remove this Term from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/term/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearForm();
        $('#modal-term-title').text("Add a Term to System");
        $('#btn-update-term').hide();
        $('#btn-create-term').show();
    }

    $scope.clearForm = function(){
        $scope.id          = "";
        $scope.description = "";
        $scope.days        = "";
    }


    $scope.createTerm = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description,
                'days'        : $scope.days
            },
            url: 'api/term/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-term-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
