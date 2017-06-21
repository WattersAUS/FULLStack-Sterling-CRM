var app = angular.module('sterlingSupplierApp', ['angularUtils.directives.dirPagination']);
app.controller('supplierCtrl', function($scope, $http) {

    $scope.updateSupplier = function() {
        $http({
            method: 'POST',
            data: {
                'id'              : $scope.id,
                'name'     : $scope.name,
                'shortname'            : $scope.shortname,
                'website'     : $scope.website,
                'quoteemail'     : $scope.quoteemail,
                'companyregno'     : $scope.companyregno,
                'experianscore'     : $scope.experianscore,
                'creditscore'     : $scope.creditscore,
                'credithardlimit'     : $scope.credithardlimit,
                'creditsoftlimit'     : $scope.creditsoftlimit,
                'creditoutstanding' : $scope.creditoutstanding
            },
            url: 'api/supplier/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-supplier-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readSupplier = function(id) {
        $('#modal-supplier-title').text("Rename Supplier");
        $('#btn-update-supplier').show();
        $('#btn-create-supplier').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/supplier/read_one.php'
        }).then(function successCallback(response) {
            $scope.id              = response.data[0]["id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.category_id     = response.data[0]["category_id"];
            $scope.code            = response.data[0]["code"];
            $scope.description     = response.data[0]["description"];
            $scope.default_pricing = response.data[0]["default_pricing"];
            $('#modal-supplier-form').modal('open');
        })
        .error(function(data, status, headers, config){
            Materialize.toast('Unable to retrieve supplier record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/supplier/read.php'
        }).then(function successCallback(response) {
            $scope.supplier = response.data.records;
        });
    }

    $scope.deleteSupplier = function(id){
        if(confirm("Are you sure you want to remove this Supplier from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/supplier/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearForm();
        $('#modal-supplier-title').text("Add Supplier");
        $('#btn-update-supplier').hide();
        $('#btn-create-supplier').show();
    }

    $scope.clearForm = function(){
        $scope.id              = "";
        $scope.category_id     = "";
        $scope.code            = "";
        $scope.description     = "";
        $scope.default_pricing = "";
    }

    $scope.createSupplier = function() {
        $http({
            method: 'POST',
            data: {
                'id'              : $scope.id,
                'category_id'     : $scope.category_id,
                'code'            : $scope.code,
                'description'     : $scope.description,
                'default_pricing' : $scope.default_pricing
            },
            url: 'api/supplier/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-supplier-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
