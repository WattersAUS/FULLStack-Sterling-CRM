var app = angular.module('sterlingDeliveryOptionApp', ['angularUtils.directives.dirPagination']);
app.controller('deliveryOptionCtrl', function($scope, $http) {

    $scope.updateDeliveryOption = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description
            },
            url: 'api/delivery_option/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-deliveryoption-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readDeliveryOption = function(id) {
        $('#modal-deliveryoption-title').text("Rename Option");
        $('#btn-update-deliveryoption').show();
        $('#btn-create-deliveryoption').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/delivery_option/read_one.php'
        }).then(function successCallback(response) {
            $scope.id          = response.data[0]["id"];
            $scope.description = response.data[0]["description"];
            $('#modal-deliveryoption-form').modal('open');
        }, function errorCallback(repsonse) {
            Materialize.toast('Unable to retrieve Delivery Option record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/delivery_option/read.php'
        }).then(function successCallback(response) {
            $scope.deliveryOptions = response.data.records;
        });
    }

    $scope.deleteDeliveryOption = function(id){
        if(confirm("Are you sure you want to remove this Delivery Option from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/delivery_option/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearForm();
        $('#modal-deliveryoption-title').text("Add a Delivery Option to System");
        $('#btn-update-deliveryoption').hide();
        $('#btn-create-deliveryoption').show();
    }

    $scope.clearForm = function(){
        $scope.id          = "";
        $scope.description = "";
    }

    $scope.createDeliveryOption = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description
            },
            url: 'api/delivery_option/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-deliveryoption-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
