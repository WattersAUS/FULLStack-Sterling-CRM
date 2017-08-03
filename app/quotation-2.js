var app = angular.module('sterlingQuoteApp', ['ngStorage', 'ui.bootstrap', 'xeditable']);

app.run(function(editableOptions) {
  editableOptions.theme = 'bs3';
});

app.directive('input', [function() {
    return {
        restrict: 'E',
        require: '?ngModel',
        link: function(scope, element, attrs, ngModel) {
            if (
                   'undefined' !== typeof attrs.type
                && 'number' === attrs.type
                && ngModel
            ) {
                ngModel.$formatters.push(function(modelValue) {
                    return Number(modelValue);
                });

                ngModel.$parsers.push(function(viewValue) {
                    return Number(viewValue);
                });
            }
        }
    }
}]);

app.controller('quoteCtrl', function($scope, $http, $localStorage, $uibModal) {

	$scope.data = {};
	$scope.data.categories        = [];
	$scope.data.activecategory    = {};
	$scope.data.workoptions       = [];
    $scope.data.workoptionselect  = {};
    $scope.data.quoteoptions      = [];
    $scope.data.activequoteoption = {};
	$scope.data.quoteworkoptions  = [];
	$scope.data.editqwo           = [];
    $scope.data.editqwoselect     = {};
    $scope.data.qwochanged        = false;
    $scope.data.qwoinsert         = false;

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
		return { id: obj.qwo_id, qo_id: obj.qwo_quote_option_id, wo_id: obj.qwo_work_option_id, wo_code: obj.wo_code, description: obj.qwo_description, quantity: obj.qwo_quantity, pricing: obj.qwo_pricing };
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

    $scope.newQuoteOption = function() {
        var qo_description = prompt("Please enter a description for this New Quote Option", "<description here>");
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
				if ($scope.data.success != 'Ok') {
					alert('There was a problem accessing the database! If this persists please inform support!');
				}
                $scope.getQuoteOptions();
	        }, function errorCallback(response) {
	            alert('There has been an error accessing the server, unable to update the Job Status record...');
	        });
		}
    }

    $scope.setActiveQuoteOption = function(index, id) {
        $scope.data.activequoteoption = angular.copy($scope.data.quoteoptions[index]);
        $scope.loadQuoteOption(id);
    }

	$scope.loadQuoteOption = function(id) {
		$scope.data.quoteworkoptions = [];
		$scope.data.editqwo      = [];
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
			if ($scope.data.recordCount >= 0) {
				$scope.data.quoteworkoptions = response.data.records;
				for (i = 0; i < $scope.data.quoteworkoptions.length; i ++) {
                    $scope.data.quoteworkoptions[i].changed = false;
					if ($scope.data.quoteworkoptions[i].category_id == $scope.data.activecategory.category_id) {
						$scope.data.editqwo.push(optionArrayData($scope.data.quoteworkoptions[i]));
					}
				}
                $scope.data.qwochanged = false;
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
	}

    clearActiveEdits = function() {
        if (! $scope.data.qwoinsert)
            return;
        $scope.cancelInsertQWO();
    }

	setActiveQWOForTab = function(id) {
		$scope.data.editqwo = [];
		for (i = 0; i < $scope.data.quoteworkoptions.length; i++) {
			if ($scope.data.quoteworkoptions[i].category_id === id) {
				$scope.data.editqwo.push(optionArrayData($scope.data.quoteworkoptions[i]));
			}
		}
	}

	$scope.selectCategory = function(id) {
		clearNonActiveTab(id);
		setActiveTab(id);
        clearActiveEdits();
		setActiveQWOForTab(id);
	}

    // gets the template to ng-include for a table row / item
    $scope.getQWOTemplate = function (eo) {
        if (eo.id === 0)
            return 'qwoadd';
        if (eo.id === $scope.data.editqwoselect.id)
            return 'qwoedit';
        return 'qwodisplay';
    };

    $scope.editQWOption = function (eo) {
        $scope.data.editqwoselect = angular.copy(eo);
    };

    refreshQuoteWorkOption = function(id) {
        for (i = 0; i < $scope.data.quoteworkoptions.length; i++) {
            if ($scope.data.quoteworkoptions[i].qwo_id === id) {
                $scope.data.quoteworkoptions[i].qwo_description = $scope.data.editqwoselect.description;
                $scope.data.quoteworkoptions[i].qwo_quantity    = $scope.data.editqwoselect.quantity;
                $scope.data.quoteworkoptions[i].qwo_pricing     = $scope.data.editqwoselect.pricing;
                $scope.data.quoteworkoptions[i].changed         = true;
                return;
            }
        }
    }

    $scope.updateQWOption = function (index, id) {
        $scope.data.editqwo[index] = angular.copy($scope.data.editqwoselect);
        refreshQuoteWorkOption(id);
        $scope.data.qwochanged     = true;
        $scope.data.editqwoselect  = {};
    };

    $scope.cancelUpdateQWO = function() {
        $scope.data.editqwoselect  = {};
    }

    $scope.addQWOption = function() {
        var item = {
            id          : 0,
            qo_id       : 0,
            wo_id       : 0,
            wo_code     : 'Dummy',
            description : 'To be selected',
            quantity    : 1,
            pricing     : 0.00,
            changed     : true
        }
        $scope.data.editqwo.push(item);
        $scope.data.editqwoselect = angular.copy(item);
        $scope.data.qwoinsert     = true;
    }

    $scope.insertQWOption = function() {
        $scope.data.editqwo[$scope.data.editqwo.length - 1].id          = (-1 * ($scope.data.quoteworkoptions.length + 1));
        $scope.data.editqwo[$scope.data.editqwo.length - 1].qo_id       = $scope.data.activequoteoption.qo_id;
        $scope.data.editqwo[$scope.data.editqwo.length - 1].wo_id       = $scope.data.editqwoselect.wo_id;
        $scope.data.editqwo[$scope.data.editqwo.length - 1].wo_code     = $scope.data.editqwoselect.wo_code;
        $scope.data.editqwo[$scope.data.editqwo.length - 1].description = $scope.data.editqwoselect.description;
        $scope.data.editqwo[$scope.data.editqwo.length - 1].quantity    = $scope.data.editqwoselect.quantity;
        $scope.data.editqwo[$scope.data.editqwo.length - 1].pricing     = $scope.data.editqwoselect.pricing;
        $scope.data.editqwo[$scope.data.editqwo.length - 1].changed     = true;
        var item = {
            qwo_id              : $scope.data.editqwo[$scope.data.editqwo.length - 1].id,
            qwo_quote_option_id : $scope.data.activequoteoption.qo_id,
            qwo_work_option_id  : $scope.data.editqwoselect.wo_id,
            qwo_description     : $scope.data.editqwoselect.description,
            qwo_quantity        : $scope.data.editqwoselect.quantity,
            qwo_pricing         : $scope.data.editqwoselect.pricing,
            qo_id               : $scope.data.activequoteoption.qo_id,
            wo_id               : $scope.data.editqwoselect.wo_id,
            wo_category_id      : $scope.data.activecategory.category_id,
            wo_code             : $scope.data.editqwoselect.wo_code,
            category_id         : $scope.data.activecategory.category_id,
            changed             : true
        }
        $scope.data.quoteworkoptions.push(item);
        $scope.data.qwochanged    = true;
        $scope.data.editqwoselect = {};
        $scope.data.qwoinsert     = false;
    }

    $scope.cancelInsertQWO = function() {
        $scope.data.editqwo.pop();
        $scope.data.editqwoselect = {};
        $scope.data.qwoinsert     = false;
    }

    $scope.disableQuoteOption = function(id) {
        if(confirm("Are you sure you want to disable the quote_option, (" + $scope.data.activequoteoption.qo_description + ") as it will become unavailable to use if you continue?")) {
            $http({
                method: 'POST',
                data: { 'qo_id' : id },
                url: './api/quote_option/quote_option_disable.php'
            }).then(function successCallback(response) {
                $scope.getQuoteOptions();
            }, function errorCallback(response) {
                alert('There has been an error accessing the server, unable to disable the selected quote option...');
            });
        }
    }

    $scope.matchCategory = function(element) {
        return (element.work_option_category_id === $scope.data.activecategory.category_id) ? true : false;
    }

    $scope.onWorkOptionSelect = function() {
        $scope.data.editqwoselect.wo_id       = $scope.data.workoptionselect.work_option_id;
        $scope.data.editqwoselect.wo_code     = $scope.data.workoptionselect.work_option_code;
        $scope.data.editqwoselect.description = $scope.data.workoptionselect.work_option_description;
        $scope.data.editqwoselect.quantity    = $scope.data.workoptionselect.work_option_default_quantity;
        $scope.data.editqwoselect.pricing     = $scope.data.workoptionselect.work_option_default_pricing;
	}

    checkQuoteWorkOptionChanged = function() {
        for (i = 0; i < $scope.data.quoteworkoptions.length; i++) {
            if ($scope.data.quoteworkoptions[i].changed) {
                console.log("id: " + $scope.data.quoteworkoptions[i].qwo_id + ", changed..." + $scope.data.quoteworkoptions[i].changed);
                return true;
            }
            console.log("id: " + $scope.data.quoteworkoptions[i].qwo_id + ", not changed..." + $scope.data.quoteworkoptions[i].changed);
        }
        return false;
    }

    $scope.saveQWOptionChanges = function() {
        if (checkQuoteWorkOptionChanged() === false) {
            return;
        }
        if (confirm('Save any changes made to the Quote Option: ' + $scope.data.activequoteoption.qo_description) === false)
            return;
        for (i = 0; i < $scope.data.quoteworkoptions.length; i++) {
            if ($scope.data.quoteworkoptions[i].changed === true) {
                console.log("ID: " + $scope.data.quoteworkoptions[i].qwo_id + ", desc: " + $scope.data.quoteworkoptions[i].qwo_description + ", quantity: " + $scope.data.quoteworkoptions[i].qwo_quantity + ", pricing " + $scope.data.quoteworkoptions[i].qwo_pricing);
            } else {
                console.log("ID: " + $scope.data.quoteworkoptions[i].qwo_id + " no changes...");
            }
        }

    }

});
