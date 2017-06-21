var app = angular.module('sterlingUserApp', ['angularUtils.directives.dirPagination']);
app.controller('userCtrl', function($scope, $http) {

    $scope.updateUser = function(){
        $http({
            method: 'POST',
            data: {
                'id'            : $scope.id,
                'title'         : $scope.title,
                'first_name'    : $scope.first_name,
                'last_name'     : $scope.last_name,
                'email_address' : $scope.email_address,
                'start_date'    : $scope.start_date,
                'end_date'      : $scope.end_date,
                'password'      : $scope.password,
                'userGUID'      : $scope.userGUID,
                'user_level'    : $scope.user_level
            },
            url: 'api/user/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-user-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    // retrieve record to fill out the form
    $scope.readUser = function(id){
        console.log("Read User...");

        $('#modal-user-title').text("Edit User");
        $('#btn-update-user').show();
        $('#btn-create-user').hide();
        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/user/read_one.php'
        }).then(function successCallback(response) {
            // put the values in form
            $scope.id            = response.data[0]["id"];
            $scope.title         = response.data[0]["title"];
            $scope.first_name    = response.data[0]["first_name"];
            $scope.last_name     = response.data[0]["last_name"];
            $scope.email_address = response.data[0]["email_address"];
            $scope.start_date    = response.data[0]["start_date"];
            $scope.end_date      = response.data[0]["end_date"];
            $scope.password      = response.data[0]["password"];
            $scope.userGUID      = response.data[0]["userGUID"];
            $scope.user_level    = response.data[0]["user_level"];
            // show modal
            $('#modal-user-form').modal('open');
        });
    }

    $scope.getAll = function(){
        $http({
            method: 'GET',
            url: 'api/user/read.php'
        }).then(function successCallback(response) {
            $scope.names = response.data.records;
        });
    }

    $scope.deleteUser = function(id){
        // ask the user if he is sure to delete the record
        if(confirm("Are you sure?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/user/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function(){
        $scope.clearForm();
        $('#modal-user-title').text("New User");
        $('#btn-update-user').hide();
        $('#btn-create-user').show();
    }

    $scope.clearForm = function(){
        $scope.id            = "";
        $scope.title         = "";
        $scope.first_name    = "";
        $scope.last_name     = "";
        $scope.email_address = "";
        $scope.start_date    = "";
        $scope.end_date      = "";
        $scope.password      = "";
        $scope.userGUID      = "";
        $scope.user_level    = "";
    }

    $scope.createUser = function(){
        $http({
            method: 'POST',
            data: {
                'id'            : $scope.id,
                'title'         : $scope.title,
                'first_name'    : $scope.first_name,
                'last_name'     : $scope.last_name,
                'email_address' : $scope.email_address,
                'start_date'    : $scope.start_date,
                'end_date'      : $scope.end_date,
                'password'      : $scope.password,
                'userGUID'      : $scope.userGUID,
                'user_level'    : $scope.user_level
            },
            url: 'api/user/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-user-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
