var app = angular.module('sterlingCustApp', ['angularUtils.directives.dirPagination', 'ui.bootstrap']);

app.controller('custCtrl', function($scope, $http, $uibModal) {

    $scope.data = {};

    $scope.get = function() {
        $http({
            method: 'GET',
            url: './api/customer/customer_get_all.php'
        }).then(function successCallback(response) {
			$scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Customer records were found in the database!');
			} else {
    	        $scope.data.customers = response.data.records;
			}
		}, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the customer records...');
        });
    }

    $scope.read = function(id) {
        console.log("read cust: " + id);
        $http({
            method: 'POST',
            data: { 'customer_id' : id },
            url: './api/customer/customer_by_id.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('Cannot find the Customer record in the database!');
			} else {
                $scope.data.customer_id                   = response.data.records[0]["customer_id"];
                $scope.data.customer_employee_id          = response.data.records[0]["customer_employee_id"];
                $scope.data.customer_name                 = response.data.records[0]["customer_name"];
                $scope.data.customer_shortname            = response.data.records[0]["customer_shortname"];
                $scope.data.customer_type                 = response.data.records[0]["customer_type"];
                $scope.data.customer_companyregno         = response.data.records[0]["customer_companyregno"];
                $scope.data.customer_website              = response.data.records[0]["customer_website"];
                $scope.data.customer_quote_email          = response.data.records[0]["customer_quote_email"];
                $scope.data.customer_kpi_quote_rtnd_by    = response.data.records[0]["customer_kpi_quote_rtnd_by"];
                $scope.data.customer_experian_score       = response.data.records[0]["customer_experian_score"];
                $scope.data.customer_credit_score         = response.data.records[0]["customer_credit_score"];
                $scope.data.customer_credit_hard_limit    = response.data.records[0]["customer_credit_hard_limit"];
                $scope.data.customer_credit_soft_limit    = response.data.records[0]["customer_credit_soft_limit"];
                $scope.data.customer_credit_outstanding   = response.data.records[0]["customer_credit_outstanding"];
                $scope.data.customer_terms_id             = response.data.records[0]["customer_terms_id"];
                $scope.data.customer_kpi_agreed           = response.data.records[0]["customer_kpi_agreed"];
                $scope.data.customer_quote_breakdown_rqrd = response.data.records[0]["customer_quote_breakdown_rqrd"];
                $scope.data.customer_quote_rtn_trigger    = response.data.records[0]["customer_quote_rtn_trigger"];
                $scope.data.customer_days_to_review       = response.data.records[0]["customer_days_to_review"];
                $scope.data.customer_date_updated         = response.data.records[0]["customer_date_updated"];
                $scope.getTerms();
                var modalInstance = $uibModal.open({
                    animation:   true,
                    controller:  'custEditCtrl',
                    templateUrl: './dialogs/customer_edit.html',
                    scope:       $scope
                });
                modalInstance.result.then(function () {
                    $scope.get();
                }, function () {
                });
			}
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the site record...');
        });
    }

    $scope.create = function() {
        $scope.data.customer_employee_id          = 0;
        $scope.data.customer_name                 = "";
        $scope.data.customer_shortname            = "";
        $scope.data.customer_type                 = 0;
        $scope.data.customer_companyregno         = "";
        $scope.data.customer_website              = "";
        $scope.data.customer_quote_email          = "";
        $scope.data.customer_kpi_quote_rtnd_by    = 0;
        $scope.data.customer_experian_score       = "";
        $scope.data.customer_credit_score         = "";
        $scope.data.customer_credit_hard_limit    = 0;
        $scope.data.customer_credit_soft_limit    = 0;
        $scope.data.customer_credit_outstanding   = 0;
        $scope.data.customer_terms_id             = 0;
        $scope.data.customer_kpi_agreed           = 0;
        $scope.data.customer_quote_breakdown_rqrd = 0;
        $scope.data.customer_quote_rtn_trigger    = 0;
        $scope.data.customer_days_to_review       = 0;
        $scope.data.terms                         = [];
        $scope.getTerms();
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'custNewCtrl',
            templateUrl: './dialogs/customer_new.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.get();
        }, function () {
        });
    }

	$scope.getTerms = function() {
        $http({
            method: 'GET',
            url: './api/term/read.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
            $scope.data.terms = response.data.records;
		}, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to retrieve the customer records...');
        });
    }

});

app.controller('custNewCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        if ($scope.data.customer_term_id == "") {
            alert('Please select a term for this customer, before attempting to save your changes...');
        } else {
            $http({
                method: 'POST',
                data: {
                    'customer_employee_id'          : 2,
                    'customer_name'                 : $scope.data.customer_name,
                    'customer_shortname'            : $scope.data.customer_shortname,
                    'customer_type'                 : 2,
                    'customer_companyregno'         : $scope.data.customer_companyregno,
                    'customer_website'              : $scope.data.customer_website,
                    'customer_quote_email'          : $scope.data.customer_quote_email,
                    'customer_kpi_quote_rtnd_by'    : $scope.data.customer_kpi_quote_rtnd_by,
                    'customer_experian_score'       : $scope.data.customer_experian_score,
                    'customer_credit_score'         : $scope.data.customer_credit_score,
                    'customer_credit_hard_limit'    : $scope.data.customer_credit_hard_limit,
                    'customer_credit_soft_limit'    : $scope.data.customer_credit_soft_limit,
                    'customer_credit_outstanding'   : $scope.data.customer_credit_outstanding,
                    'customer_terms_id'             : $scope.data.customer_terms_id,
                    'customer_kpi_agreed'           : $scope.data.customer_kpi_agreed,
                    'customer_quote_breakdown_rqrd' : $scope.data.customer_quote_breakdown_rqrd,
                    'customer_quote_rtn_trigger'    : $scope.data.customer_quote_rtn_trigger,
                    'customer_days_to_review'       : $scope.data.customer_days_to_review
                },
                url: './api/customer/customer_insert.php'
            }).then(function successCallback(response) {
                $scope.data.recordCount = response.data.count;
    			$scope.data.success     = response.data.success;
    			if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
    	            alert('There was a problem adding the new customer to the database! If this persists please inform support!');
    			}
                $uibModalInstance.close();
            }, function errorCallback(response) {
                alert('There has been an error accessing the server, unable to add the site record...');
            });
        }
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});

app.controller('custEditCtrl', function($scope, $http, $uibModalInstance) {

    $scope.save = function() {
        $http({
            method: 'POST',
            data: {
                'customer_id'                   : $scope.data.customer_id,
                'customer_employee_id'          : $scope.data.customer_employee_id,
                'customer_name'                 : $scope.data.customer_name,
                'customer_shortname'            : $scope.data.customer_shortname,
                'customer_type'                 : 2,
                'customer_companyregno'         : $scope.data.customer_companyregno,
                'customer_website'              : $scope.data.customer_website,
                'customer_quote_email'          : $scope.data.customer_quote_email,
                'customer_kpi_quote_rtnd_by'    : $scope.data.customer_kpi_quote_rtnd_by,
                'customer_experian_score'       : $scope.data.customer_experian_score,
                'customer_credit_score'         : $scope.data.customer_credit_score,
                'customer_credit_hard_limit'    : $scope.data.customer_credit_hard_limit,
                'customer_credit_soft_limit'    : $scope.data.customer_credit_soft_limit,
                'customer_credit_outstanding'   : $scope.data.customer_credit_outstanding,
                'customer_terms_id'             : $scope.data.customer_terms_id,
                'customer_kpi_agreed'           : $scope.data.customer_kpi_agreed,
                'customer_quote_breakdown_rqrd' : $scope.data.customer_quote_breakdown_rqrd,
                'customer_quote_rtn_trigger'    : $scope.data.customer_quote_rtn_trigger,
                'customer_days_to_review'       : $scope.data.customer_days_to_review
            },
            url: './api/customer/customer_update.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
	            alert('There was a problem updating the site to the database! If this persists please inform support!');
			}
            $uibModalInstance.close();
        }, function errorCallback(response) {
            alert('There has been an error accessing the server, unable to update the site record...');
        });
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
