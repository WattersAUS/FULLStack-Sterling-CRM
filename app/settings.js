var app = angular.module('sterlingSettingsApp', ['angularUtils.directives.dirPagination']);
app.controller('settingsCtrl', function($scope, $http) {

    $scope.updateSettings = function() {
        $http({
            method: 'POST',
            data: {
                'id'                     : $scope.id,
                'companyName'            : $scope.companyName,
                'shortName'              : $scope.shortName,
				'companyRegNo'           : $scope.companyRegNo,
				'webSite'                : $scope.webSite,
				'defaultEmail'           : $scope.defaultEmail,
				'address1'               : $scope.address1,
				'address2'               : $scope.address2,
				'city'                   : $scope.city,
				'county'                 : $scope.county,
				'postcode'               : $scope.postcode,
				'telephoneNumber'        : $scope.telephoneNumber,
				'vatRate'                : $scope.vatRate,
				'defaultKPIQuoteRtndBy'  : $scope.defaultKPIQuoteRtndBy,
				'defaultCreditHardLimit' : $scope.defaultCreditHardLimit,
				'defaultCreditSoftLimit' : $scope.defaultCreditSoftLimit
            },
            url: 'api/settings/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-settings-form').modal('close');
            $scope.clearForm();
            $scope.readSettings();
        });
    }

    $scope.readSettings = function(id) {
        $http({
            method: 'POST',
            data: { 'id' : 1 },
            url: 'api/settings/read_one.php'
        }).then(function successCallback(response) {
			$scope.id                     = response.data[0]["id"];
			$scope.companyName            = response.data[0]["companyName"];
			$scope.shortName              = response.data[0]["shortName"];
			$scope.companyRegNo           = response.data[0]["companyRegNo"];
			$scope.webSite                = response.data[0]["webSite"];
			$scope.defaultEmail           = response.data[0]["defaultEmail"];
			$scope.address1               = response.data[0]["address1"];
			$scope.address2               = response.data[0]["address2"];
			$scope.city                   = response.data[0]["city"];
			$scope.county                 = response.data[0]["county"];
			$scope.postcode               = response.data[0]["postcode"];
			$scope.telephoneNumber        = response.data[0]["telephoneNumber"];
			$scope.vatRate                = response.data[0]["vatRate"];
			$scope.defaultKPIQuoteRtndBy  = response.data[0]["defaultKPIQuoteRtndBy"];
			$scope.defaultCreditHardLimit = response.data[0]["defaultCreditHardLimit"];
			$scope.defaultCreditSoftLimit = response.data[0]["defaultCreditSoftLimit"];
			$scope.dateUpdated            = response.data[0]["dateUpdated"];
        }, function errorCallback(response) {
            Materialize.toast('Unable to retrieve System Settings record.', 4000);
        });
    }

    $scope.editSettings = function(id) {
        $('#modal-settings-title').text("Edit System Settings");
        $('#btn-update-settings').show();
        $('#modal-settings-form').modal('open');
    }

    $scope.clearForm = function(){
			$scope.id                     = "";
			$scope.companyName            = "";
			$scope.shortName              = "";
			$scope.companyRegNo           = "";
			$scope.webSite                = "";
			$scope.defaultEmail           = "";
			$scope.address1               = "";
			$scope.address2               = "";
			$scope.city                   = "";
			$scope.county                 = "";
			$scope.postcode               = "";
			$scope.telephoneNumber        = "";
			$scope.vatRate                = "";
			$scope.defaultKPIQuoteRtndBy  = "";
			$scope.defaultCreditHardLimit = "";
			$scope.defaultCreditSoftLimit = "";
			$scope.dateUpdated            = "";
	}
});
