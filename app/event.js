app.controller('eventCtrl', function($scope, $http) {

    $scope.updateEvent = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description
            },
            url: 'api/event/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-event-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readOne = function(id) {
        $('#modal-event-title').text("Rename event");
        $('#btn-update-event').show();
        $('#btn-create-event').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/event/read_one.php'
        }).then(function successCallback(response) {
            $scope.id          = response.data[0]["id"];
            $scope.description = response.data[0]["description"];
            $('#modal-event-form').modal('open');
        })
        .error(function(data, status, headers, config){
            Materialize.toast('Unable to retrieve event record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/event/read.php'
        }).then(function successCallback(response) {
            $scope.event = response.data.records;
        });
    }

    $scope.deleteEvent = function(id){
        if(confirm("Are you sure you want to remove this event from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/event/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearForm();
        $('#modal-event-title').text("Add a event to System");
        $('#btn-update-event').hide();
        $('#btn-create-event').show();
    }

    $scope.clearForm = function(){
        $scope.id          = "";
        $scope.description = "";
    }

    $scope.createEvent = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description
            },
            url: 'api/event/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-event-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
