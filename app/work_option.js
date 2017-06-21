var app = angular.module('sterlingWorkOptionApp', ['angularUtils.directives.dirPagination']);
app.controller('workoptionCtrl', function($scope, $http) {

    $scope.updateWorkOption = function() {
        $http({
            method: 'POST',
            data: {
                'id'              : $scope.id,
                'category_id'     : $scope.category_id,
                'code'            : $scope.code,
                'description'     : $scope.description,
                'default_pricing' : $scope.default_pricing
            },
            url: 'api/work_option/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-workoption-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readWorkOption = function(id) {
        $('#modal-workoption-title').text("Rename Work Option");
        $('#btn-update-workoption').show();
        $('#btn-create-workoption').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/work_option/read_one.php'
        }).then(function successCallback(response) {
            $scope.id              = response.data[0]["id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.code            = response.data[0]["code"];
            $scope.description     = response.data[0]["description"];
            $scope.default_pricing = response.data[0]["default_pricing"];
            $('#modal-workoption-form').modal('open');
        })
        .error(function(data, status, headers, config){
            Materialize.toast('Unable to retrieve Work Option record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/work_option/read.php'
        }).then(function successCallback(response) {
            $scope.workoptions = response.data.records;
        });
    }

    $scope.deleteWorkOption = function(id){
        if(confirm("Are you sure you want to remove this Work Option from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/work_option/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearForm();
        $('#modal-workoption-title').text("Add a Work Option to System");
        $('#btn-update-workoption').hide();
        $('#btn-create-workoption').show();
    }

    $scope.clearForm = function(){
        $scope.id              = "";
        $scope.category_id     = "";
        $scope.code            = "";
        $scope.description     = "";
        $scope.default_pricing = "";
    }

    $scope.createWorkOption = function() {
        $http({
            method: 'POST',
            data: {
                'id'              : $scope.id,
                'category_id'     : $scope.category_id,
                'code'            : $scope.code,
                'description'     : $scope.description,
                'default_pricing' : $scope.default_pricing
            },
            url: 'api/work_option/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-workoption-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
