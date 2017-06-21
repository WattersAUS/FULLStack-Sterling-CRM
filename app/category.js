var app = angular.module('sterlingCategoryApp', ['angularUtils.directives.dirPagination']);
app.controller('categoryCtrl', function($scope, $http) {

    $scope.updateCategory = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description,
                'code'        : $scope.code
            },
            url: 'api/category/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-category-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readCategory = function(id) {
        $('#modal-category-title').text("Edit Category");
        $('#btn-update-category').show();
        $('#btn-create-category').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/category/read_one.php'
        }).then(function successCallback(response) {
            $scope.id          = response.data[0]["id"];
            $scope.description = response.data[0]["description"];
            $scope.code        = response.data[0]["code"];
            $('#modal-category-form').modal('open');
        }, function errorCallback(repsonse) {
            Materialize.toast('Unable to retrieve Category record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/category/read.php'
        }).then(function successCallback(response) {
            $scope.categories = response.data.records;
        });
    }

    $scope.deleteCategory = function(id){
        if(confirm("Are you sure you want to remove this Category from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/category/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearForm();
        $('#modal-category-title').text("Add a Category to System");
        $('#btn-update-category').hide();
        $('#btn-create-category').show();
    }

    $scope.clearForm = function(){
        $scope.id          = "";
        $scope.description = "";
        $scope.code        = "";
    }

    $scope.createCategory = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description,
                'code'        : $scope.code
            },
            url: 'api/category/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-category-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
