app.controller('employeeCtrl', function($scope, $http) {
 
 
 
 // update product record / save changes
$scope.updateEmployee = function(){
    $http({
        method: 'POST',
        data: {
            'id' : $scope.id,
            'name' : $scope.division_id,
            'emp_no' : $scope.emp_no,
            'is_manager' : $scope.is_manager,
            'job_role' : $scope.job_role,
            'job_title' : $scope.job_title,
            'manager_id' : $scope.manager_id,
            'team_id' : $scope.team_id,
            'user_id' : $scope.user_id
        },
        url: 'api/employee/update.php'
    }).then(function successCallback(response) {
 
        // tell the user product record was updated
        Materialize.toast(response.data, 4000);
 
        // close modal
        $('#modal-product-form').modal('close');
 
        // clear modal content
        $scope.clearForm();
 
        // refresh the product list
        $scope.getAll();
    });
}
 
 
 // retrieve record to fill out the form
$scope.readOne = function(id){
 
    // change modal title
    $('#modal-product-title').text("Edit Product");
 
    // show udpate product button
    $('#btn-update-product').show();
 
    // show create product button
    $('#btn-create-product').hide();
 
    // post id of product to be edited
    $http({
        method: 'POST',
        data: { 'id' : id },
        url: 'api/employee/read_one.php'
    }).then(function successCallback(response) {
 
        // put the values in form
        
		$scope.id = response.data[0]["id"];
		$scope.division_id = response.data[0]["division_id"];
		$scope.emp_no = response.data[0]["emp_no"];
		$scope.is_manager = response.data[0]["is_manager"];
		$scope.job_role = response.data[0]["job_role"];
		$scope.job_title = response.data[0]["job_title"];
		$scope.manager_id = response.data[0]["manager_id"];
		$scope.team_id = response.data[0]["team_id"];
		$scope.user_id = response.data[0]["user_id"];
 
        // show modal
        $('#modal-product-form').modal('open');
    })
    .error(function(data, status, headers, config){
        Materialize.toast('Unable to retrieve record.', 4000);
    });
}

 
 // read employee
$scope.getAll = function(){
    $http({
        method: 'GET',
        url: 'api/employee/read.php'
    }).then(function successCallback(response) {
        $scope.names = response.data.records;
    });
}


  // delete product
$scope.deleteEmployee = function(id){
 
    // ask the user if he is sure to delete the record
    if(confirm("Are you sure?")){
 
        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/employee/delete.php'
        }).then(function successCallback(response) {
 
            // tell the user product was deleted
            Materialize.toast(response.data, 4000);
 
            // refresh the list
            $scope.getAll();
        });
    }
}

 
 $scope.showCreateForm = function(){
 
    // clear form
    $scope.clearForm();
 
    // change modal title
    $('#modal-product-title').text("Create New Employee");
 
    // hide update product button
    $('#btn-update-product').hide();
 
    // show create product button
    $('#btn-create-product').show();
 
}

// clear variable / form values
$scope.clearForm = function(){
    $scope.id = "";
	$scope.division_id = "";
	$scope.emp_no = "";
	$scope.is_manager = "";
	$scope.job_role = "";
	$scope.job_title = "";
	$scope.manager_id = "";
	$scope.team_id = "";
	$scope.user_id = "";
}


// create new product
$scope.createEmployee = function(){
 
    $http({
        method: 'POST',
        data: {
            'id' : $scope.id,
            'name' : $scope.division_id,
            'emp_no' : $scope.emp_no,
            'is_manager' : $scope.is_manager,
            'job_role' : $scope.job_role,
            'job_title' : $scope.job_title,
            'manager_id' : $scope.manager_id,
            'team_id' : $scope.team_id,
            'user_id' : $scope.user_id
        },
        url: 'api/employee/create.php'
    }).then(function successCallback(response) {
 
        // tell the user new product was created
        Materialize.toast(response.data, 4000);
 
        // close modal
        $('#modal-product-form').modal('close');
 
        // clear modal content
        $scope.clearForm();
 
        // refresh the list
        $scope.getAll();
    });
}


 
 
});