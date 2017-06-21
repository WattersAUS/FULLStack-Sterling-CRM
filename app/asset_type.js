var app = angular.module('sterlingAssetTypeApp', ['angularUtils.directives.dirPagination']);
app.controller('atCtrl', function($scope, $http) {

    $scope.updateAssetType = function() {
        $http({
            method: 'POST',
            data: {
                'id'           : $scope.id,
                'daysToReview' : $scope.daysToReview,
                'type'         : $scope.type
            },
            url: 'api/asset_type/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-assettype-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readAssetType = function(id) {
        $('#modal-assettype-title').text("Edit Asset Type");
        $('#btn-update-assettype').show();
        $('#btn-create-assettype').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/asset_type/read_one.php'
        }).then(function successCallback(response) {
            $scope.id           = response.data[0]["id"];
            $scope.daysToReview = response.data[0]["daysToReview"];
            $scope.type         = response.data[0]["type"];
            $('#modal-assettype-form').modal('open');
        }, function errorCallback(repsonse) {
            Materialize.toast('Unable to retrieve Asset Type record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/asset_type/read.php'
        }).then(function successCallback(response) {
            $scope.assetTypes = response.data.records;
        });
    }

    $scope.deleteAssetType = function(id){
        if(confirm("Are you sure you want to remove this Asset Type from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/asset_type/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearForm();
        $('#modal-assettype-title').text("Add a Asset Type to System");
        $('#btn-update-assettype').hide();
        $('#btn-create-assettype').show();
    }

    $scope.clearForm = function(){
        $scope.id           = "";
        $scope.daysToReview = "";
        $scope.type         = "";
    }

    $scope.createAssetType = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.daysToReview,
                'type'        : $scope.type
            },
            url: 'api/asset_type/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-assettype-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
