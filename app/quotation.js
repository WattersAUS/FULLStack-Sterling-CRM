var app = angular.module('sterlingQuoteApp', ['ngStorage', 'ui.bootstrap', 'xeditable']);

app.run(function(editableOptions) {
  editableOptions.theme = 'bs3';
});

app.controller('quoteCtrl', function($scope, $http, $localStorage, $uibModal) {

	$scope.data = {};
	$scope.data.categories       = [];
	$scope.data.activecategory   = {};
	$scope.data.quoteoptions     = [];
	$scope.data.workoptions      = [];
	$scope.data.quoteworkoptions = [];
	$scope.data.editoptions      = [];

	$scope.set = function($job_id) {
		$localStorage.job_id = $job_id;
	}

	$scope.initPage = function() {
		$scope.getQuoteOptions();
		$scope.getWorkOptions();
	}

	checkCategory = function (id, categories) {
		for (j = 0; j < categories.length; j++) {
			var inst = categories[j];
			if (id == inst.category_id) {
				return true;
			}
		}
		return false;
	}

	extractCategories = function() {
		var categories = [];
		for (i = 0; i < $scope.data.workoptions.length; i++) {
			var inst = $scope.data.workoptions[i];
			if (checkCategory(inst.category_id, categories) == false) {
				categories.push({category_id:inst.category_id, category_code: inst.category_code, category_description: inst.category_description});
			}
		}
		return categories;
	}

	optionArrayData = function(obj) {

		console.log("ID: " + obj.qwo_id);
		console.log("QO: " + obj.qwo_quote_option_id);
		console.log("WO: " + obj.qwo_work_option_id);
		console.log("CO: " + obj.wo_code);
		console.log("DS: " + obj.qwo_description);
		console.log("QU: " + obj.qwo_quantity);
		console.log("PR: " + obj.qwo_pricing);

		return { id: obj.qwo_id, qo_id: obj.qwo_quote_option_id, wo_id: obj.qwo_work_option_id, wo_code: obj.wo_code, description: obj.qwo_description, quantity: obj.qwo_quantity, pricing: obj.qwo_pricing, changed: false };
	}

	$scope.getQuoteOptions = function() {
		$http({
			method: 'POST',
            data: { 'job_id' : 40 },
			url: './api/quote_option/quote_option_for_job.php'
		}).then(function successCallback(response) {
			$scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('There was a problem accessing the database getting the quote options! If this persists please inform support!');
				return;
			}
	        $scope.data.quoteoptions = response.data.records;
		}, function errorCallback(response) {
			alert('There has been an error accessing the server, unable to retrieve the Quote Option records...');
		});
    }

	$scope.getWorkOptions = function() {
		$http({
            method: 'GET',
            url: './api/work_option/work_option_get_all.php'
        }).then(function successCallback(response) {
            $scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
	            alert('Unable to access the Work Option records! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
	            alert('No Work Option records were found in the database!');
			} else {
    	        $scope.data.workoptions = response.data.records;
				$scope.data.categories  = extractCategories();
				if ($scope.data.categories.length > 0) {
					$scope.data.activecategory = $scope.data.categories[0];
				}
			}
        }, function errorCallback(response) {
            alert('Unable to access the Work Option records...');
        });
	}

    $scope.createQuoteOption = function() {
        var modalInstance = $uibModal.open({
            animation:   true,
            controller:  'quoteOptionCtrl',
            templateUrl: './dialogs/quotation_option_new.html',
            scope:       $scope
        });
        modalInstance.result.then(function () {
            $scope.getQuoteOptions();
        }, function () {
        });
    }

	$scope.loadQuoteOption = function(id) {
		$scope.data.quoteworkoptions = [];
		$scope.data.editoptions      = [];
		$http({
			method: 'POST',
			data: { 'quote_option_id' : id },
			url: './api/quote_work_option/quote_work_option_for_quote_option.php'
		}).then(function successCallback(response) {
			$scope.data.recordCount = response.data.count;
			$scope.data.success     = response.data.success;
			if ($scope.data.success != 'Ok') {
				alert('Unable to access the Quote Work Option records! If this persists please inform support!');
				return;
			}
			if ($scope.data.recordCount == 0) {
				alert('No Quote Work Option records were found for the supplied ID: ' + id + '!');
			} else {
				$scope.data.quoteworkoptions = response.data.records;
				for (i = 0; i < $scope.data.quoteworkoptions.length; i ++) {
					if ($scope.data.quoteworkoptions[i].category_id == $scope.data.activecategory.category_id) {
						$scope.data.editoptions.push(optionArrayData($scope.data.quoteworkoptions[i]));
					}
				}
			}
		}, function errorCallback(response) {
			alert('Unable to access the Quote Work Option records...');
		});
	}

	clearNonActiveTab = function(id) {
		for (j = 0; j < $scope.data.categories.length; j++) {
			var inst = $scope.data.categories[j];
			if (id != inst.category_id) {
				if (document.getElementById("category-"+inst.category_id).classList.contains('active')) {
					document.getElementById("category-"+inst.category_id).classList.remove('active');
					document.getElementById("tab-"+inst.category_id).classList.remove('active');
				}
			}
		}
	}

	setActiveTab = function(id) {
		for (j = 0; j < $scope.data.categories.length; j++) {
			var inst = $scope.data.categories[j];
			if (id == inst.category_id) {
				$scope.data.activecategory = inst;
			}
		}
		document.getElementById("category-"+id).classList.add('active');
		document.getElementById("tab-"+id).classList.add('active');
	}

	setEditOptions = function(id) {
		$scope.data.editoptions = [];
		for (i = 0; i < $scope.data.quoteworkoptions.length; i ++) {
			if ($scope.data.quoteworkoptions[i].category_id == id) {
				$scope.data.editoptions.push(optionArrayData($scope.data.quoteworkoptions[i]));
			}
		}
	}

	$scope.selectCategory = function(id) {
		clearNonActiveTab(id);
		setActiveTab(id);
		setEditOptions(id);
	}

	$scope.addQuoteOptionMessage = function(id) {
		console.log("Double Click");
		clearActiveTab(id);
		document.getElementById("category-"+id).classList.add('active');
	}

	$scope.newWorkOption = function(id) {
		console.log("Add option for category ID: " + id);
		$scope.editoptions = [];
	}

});

app.controller('quoteOptionCtrl', function($scope, $http, $localStorage, $uibModalInstance) {

	$scope.data.selected = {};
	$scope.data.options = [];

	$scope.initDialog = function() {
		$scope.isCollapsed = true;
	}

	$scope.selectWorkOption = function($work_option_id) {
		for (i = 0; i < $scope.data.workoptions.length; i ++) {
			if ($work_option_id == $scope.data.workoptions[i].work_option_id) {
				$scope.data.selected = { wo_id: $work_option_id, wo_description: $scope.data.workoptions[i].work_option_description, wo_pricing: $scope.data.workoptions[i].work_option_default_pricing };
			}
		}
	}

	$scope.addWorkOption = function() {
		$scope.data.options.push($scope.data.selected);
	}

	$scope.save = function() {
		var qo_description = prompt("Please enter a description for this Quote Option", "<description here>");
		if (qo_description != null && qo_description != "") {
			$http({
	            method: 'POST',
	            data: {
					'qo_employee_id' : 2,
			        'qo_job_id'      : 40,
					'qo_description' : qo_description
	            },
	            url: './api/quote_option/quote_option_insert.php'
	        }).then(function successCallback(response) {

				$scope.data.newId = response.data.id;
				alert('A ID: ' + $scope.data.newId + ' has been raised to cover the new Quote Option!');

				if ($scope.data.success != 'Ok') {
					alert('There was a problem accessing the database! If this persists please inform support!');
					return;
				}
				if ($scope.data.recordCount == 0) {
					alert('No Job History initial record matching the requested Job ID: ' + job_id + ' was found in the database!');
				} else {
					for (i = 0; i < $scope.data.options.length; i++) {
						$http({
						    method: 'POST',
						    data: {
						        'qwo_quote_option_id' : $scope.data.newId,
						        'qwo_work_option_id'  : $scope.data.options[i].wo_id,
						        'qwo_description'     : $scope.data.options[i].wo_description,
						        'qwo_pricing'         : $scope.data.options[i].wo_pricing
						    },
						    url: './api/quote_work_option/quote_work_option_insert.php'
						}).then(function successCallback(response) {
						    $scope.data.recordCount = response.data.count;
						    $scope.data.success     = response.data.success;
						    if ($scope.data.success != 'Ok' || $scope.data.recordCount == 0)  {
						        alert('There was a problem adding the new qwo to the database! If this persists please inform support!');
						    }
						}, function errorCallback(response) {
						    alert('There has been an error accessing the server, unable to add the qwo record...');
						});
					}
				}
	            $uibModalInstance.close();
	        }, function errorCallback(response) {
	            alert('There has been an error accessing the server, unable to update the Job Status record...');
	        });
		}
    }

    $scope.exit = function() {
        $uibModalInstance.dismiss('cancel');
    }

});
