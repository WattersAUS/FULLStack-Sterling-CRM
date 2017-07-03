var app = angular.module('sterlingSettingsApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('settingsCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function(id) {
        $http({
            method: 'POST',
            data: { 'id' : 1 },
            url: './api/settings/read_one.php'
        }).then(function successCallback(response) {
            $scope.data.id                     = response.data[0]["id"];
			$scope.data.companyName            = response.data[0]["companyName"];
			$scope.data.shortName              = response.data[0]["shortName"];
			$scope.data.companyRegNo           = response.data[0]["companyRegNo"];
			$scope.data.webSite                = response.data[0]["webSite"];
			$scope.data.defaultEmail           = response.data[0]["defaultEmail"];
			$scope.data.address1               = response.data[0]["address1"];
			$scope.data.address2               = response.data[0]["address2"];
			$scope.data.city                   = response.data[0]["city"];
			$scope.data.county                 = response.data[0]["county"];
			$scope.data.postcode               = response.data[0]["postcode"];
			$scope.data.telephoneNumber        = response.data[0]["telephoneNumber"];
			$scope.data.vatRate                = response.data[0]["vatRate"];
			$scope.data.defaultKPIQuoteRtndBy  = response.data[0]["defaultKPIQuoteRtndBy"];
			$scope.data.defaultCreditHardLimit = response.data[0]["defaultCreditHardLimit"];
			$scope.data.defaultCreditSoftLimit = response.data[0]["defaultCreditSoftLimit"];
			$scope.data.dateUpdated            = response.data[0]["dateUpdated"];
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the Settings record...');
        });
    }

    $scope.read = function(id) {
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'settingsEditCtrl',
            templateUrl: './dialogs/settings_edit.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

});

app.controller('settingsEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'id'                     : $scope.data.id,
                'companyName'            : $scope.data.companyName,
                'shortName'              : $scope.data.shortName,
				'companyRegNo'           : $scope.data.companyRegNo,
				'webSite'                : $scope.data.webSite,
				'defaultEmail'           : $scope.data.defaultEmail,
				'address1'               : $scope.data.address1,
				'address2'               : $scope.data.address2,
				'city'                   : $scope.data.city,
				'county'                 : $scope.data.county,
				'postcode'               : $scope.data.postcode,
				'telephoneNumber'        : $scope.data.telephoneNumber,
				'vatRate'                : $scope.data.vatRate,
				'defaultKPIQuoteRtndBy'  : $scope.data.defaultKPIQuoteRtndBy,
				'defaultCreditHardLimit' : $scope.data.defaultCreditHardLimit,
				'defaultCreditSoftLimit' : $scope.data.defaultCreditSoftLimit
            },
            url: './api/settings/update.php'
        }).then(function successCallback(response) {
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the settings record...');
        });
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
