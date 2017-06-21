app.controller('motCtrl', function($scope, $http) {

    $scope.updateTerm = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'asset_id'          : $scope.asset_id,
                'due_date' : $scope.due_date,
                'notes' : $scope.notes,
                'booked_date' : $scope.booked_date,
                'booked_garage' : $scope.booked_garage,
                'cost'        : $scope.cost
            },
            url: 'api/mot/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-term-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readOne = function(id) {
        $('#modal-term-title').text("Edit Term");
        $('#btn-update-term').show();
        $('#btn-create-term').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/mot/read_one.php'
        }).then(function successCallback(response) {
            $scope.id          = response.data[0]["id"];
            $scope.asset_id = response.data[0]["due_date"];
            $scope.notes = response.data[0]["notes"];
            $scope.booked_date = response.data[0]["booked_date"];
            $scope.booked_garage = response.data[0]["booked_garage"];
            $scope.cost        = response.data[0]["cost"];
            $('#modal-term-form').modal('open');
        }, function errorCallback(repsonse) {
            Materialize.toast('Unable to retrieve Term record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/mot/read.php'
        }).then(function successCallback(response) {
            $scope.terms = response.data.records;
        });
    }

    $scope.deleteTerm = function(id){
        if(confirm("Are you sure you want to remove this MOT from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/mot/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearForm();
        $('#modal-term-title').text("Add a MOT to System");
        $('#btn-update-term').hide();
        $('#btn-create-term').show();
    }

    $scope.clearForm = function(){
        $scope.id          = "";
        $scope.asset_id = "";
        $scope.due_date = "";
        $scope.notes = "";
        $scope.booked_date = "";
        $scope.booked_garage = "";
        $scope.cost        = "";
    }


    $scope.createTerm = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'asset_id' : $scope.description,
                'due_date' : $scope.description,
                'notes' : $scope.description,
                'booked_date' : $scope.description,
                'booked_garage' : $scope.description,
                'cost'        : $scope.days
            },
            url: 'api/mot/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-term-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
