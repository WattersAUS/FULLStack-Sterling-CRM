app.controller('userCtrl', function($scope, $http) {
 
 
 // update product record / save changes
$scope.updateUser = function(){
    $http({
        method: 'POST',
        data: {
            'id' : $scope.id,
            'title' : $scope.title,
            'first_name' : $scope.first_name,
            'last_name' : $scope.last_name,
            'email_address' : $scope.email_address,
            'start_date' : $scope.start_date,
            'end_date' : $scope.end_date,
            'password' : $scope.password,
            'userGUID' : $scope.userGUID,
            'user_level' : $scope.user_level
        },
        url: 'api/user/update.php'
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
    $('#modal-product-title').text("Edit User");
 
    // show udpate product button
    $('#btn-update-product').show();
 
    // show create product button
    $('#btn-create-product').hide();
 
    // post id of product to be edited
    $http({
        method: 'POST',
        data: { 'id' : id },
        url: 'api/user/read_one.php'
    }).then(function successCallback(response) {
 
        // put the values in form
        $scope.id = response.data[0]["id"];
        $scope.title = response.data[0]["title"];
        $scope.first_name = response.data[0]["first_name"];
        $scope.last_name = response.data[0]["last_name"];
        $scope.email_address = response.data[0]["email_address"];
        $scope.start_date = response.data[0]["start_date"];
        $scope.end_date = response.data[0]["end_date"];
        $scope.password = response.data[0]["password"];
        $scope.userGUID = response.data[0]["userGUID"];
        $scope.user_level = response.data[0]["user_level"];

 
        // show modal
        $('#modal-product-form').modal('open');
    })
    .error(function(data, status, headers, config){
        Materialize.toast('Unable to retrieve record.', 4000);
    });
}

 
 // read user
$scope.getAll = function(){
    $http({
        method: 'GET',
        url: 'api/user/read.php'
    }).then(function successCallback(response) {
        $scope.names = response.data.records;
    });
}


  // delete user
$scope.deleteUser = function(id){
 
    // ask the user if he is sure to delete the record
    if(confirm("Are you sure?")){
 
        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/user/delete.php'
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
    $('#modal-product-title').text("Create New User");
 
    // hide update user button
    $('#btn-update-product').hide();
 
    // show create user button
    $('#btn-create-product').show();
 
}

// clear variable / form values
$scope.clearForm = function(){ 
    $scope.id = "";
    $scope.title = "";
    $scope.first_name = "";
    $scope.last_name = "";
    $scope.email_address = "";
    $scope.start_date = "";
    $scope.end_date = "";
    $scope.password = "";
    $scope.userGUID = "";
    $scope.user_level = "";
}


// create new user
$scope.createUser = function(){
 
    $http({
        method: 'POST',
        data: {
            'id' : $scope.id,
            'title' : $scope.title,
            'first_name' : $scope.first_name,
            'last_name' : $scope.last_name,
            'email_address' : $scope.email_address,
            'start_date' : $scope.start_date,
            'end_date' : $scope.end_date,
            'password' : $scope.password,
            'userGUID' : $scope.userGUID,
            'user_level' : $scope.user_level
        },
        url: 'api/user/create.php'
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