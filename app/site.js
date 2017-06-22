var app = angular.module('sterlingSiteApp', ['angularUtils.directives.dirPagination']);
app.controller('siteCtrl', function($scope, $http) {

    $scope.updateSite = function() {
        $http({
            method: 'POST',
            data: {
                'id'        : $scope.id,
                'name'      : $scope.name,
                'shortName' : $scope.shortName,
				'address1'  : $scope.address1,
				'address2'  : $scope.address2,
				'city'      : $scope.city,
				'county'    : $scope.county,
				'postcode'  : $scope.postcode
            },
            url: 'api/site/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-site-update-form').modal('close');
            $scope.clearUpdateForm();
            $scope.getAll();
        });
    }

    $scope.clearUpdateForm = function() {
        $scope.id        = "";
        $scope.name      = "";
        $scope.shortName = "";
        $scope.address1  = "";
        $scope.address2  = "";
        $scope.city      = "";
        $scope.county    = "";
        $scope.postcode  = "";
    }

    $scope.readSite = function(id) {
        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/site/read_one.php'
        }).then(function successCallback(response) {
			$scope.id        = response.data[0]["id"];
			$scope.name      = response.data[0]["name"];
			$scope.shortName = response.data[0]["shortName"];
			$scope.address1  = response.data[0]["address1"];
			$scope.address2  = response.data[0]["address2"];
			$scope.city      = response.data[0]["city"];
			$scope.county    = response.data[0]["county"];
			$scope.postcode  = response.data[0]["postcode"];
            $('#modal-site-update-form').modal('open');
        }, function errorCallback(response) {
            Materialize.toast('Unable to retrieve Site Record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/site/read.php'
        }).then(function successCallback(response) {
            $scope.sites = response.data.records;
        });
    }

    $scope.deleteSite = function(id){
        if(confirm("Are you sure you want to remove this Site from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/site/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearCreateForm();
		$scope.getAllCustomers();
		$(document).ready(function() {
		    $('select').material_select();
		});
        console.log("Option Selected: " + $scope.customer);
    }

    $scope.createSite = function() {
        $http({
            method: 'POST',
            data: {
				'customerId': $scope.customerId,
                'name'      : $scope.name,
                'shortName' : $scope.shortName,
                'address1'  : $scope.address1,
                'address2'  : $scope.address2,
                'city'      : $scope.city,
                'county'    : $scope.county,
                'postcode'  : $scope.postcode
            },
            url: 'api/site/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-site-create-form').modal('close');
            $scope.clearCreateForm();
            $scope.getAll();
        });
    }

    $scope.clearCreateForm = function() {
        $scope.customerId   = 0;
        $scope.customer     = [];
        $scope.name         = "";
        $scope.shortName    = "";
        $scope.address1     = "";
        $scope.address2     = "";
        $scope.city         = "";
        $scope.county       = "";
        $scope.postcode     = "";
        console.log("Option Selected: " + $scope.customer);
    }

	$scope.getAllCustomers = function() {
        $http({
            method: 'GET',
            url: 'api/customers/customer_get_all.php'
        }).then(function successCallback(response) {
            $scope.customers = response.data.records;
        });
    }

    $scope.onSelectAction = function() {
        console.log("Option Selected: " + $scope.customer);
    };
});
