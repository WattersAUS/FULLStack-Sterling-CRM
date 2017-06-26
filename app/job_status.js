var app = angular.module('sterlingJobStatusApp', ['angularUtils.directives.dirPagination']);
app.controller('jobstatusCtrl', function($scope, $http) {

    $scope.updateJobStatus = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description,
                'template_page' : $scope.template_page
            },
            url: 'api/job_status/update.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-jobstatus-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }

    $scope.readJobStatus = function(id) {
        $('#modal-jobstatus-title').text("Update Job Status");
        $('#btn-update-jobstatus').show();
        $('#btn-create-jobstatus').hide();

        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/job_status/read_one.php'
        }).then(function successCallback(response) {
            $scope.id          = response.data[0]["id"];
            $scope.description = response.data[0]["description"];
            $scope.template_page = response.data[0]["template_page"];
            $('#modal-jobstatus-form').modal('open');
        })
        .error(function(data, status, headers, config){
            Materialize.toast('Unable to retrieve Job Status record.', 4000);
        });
    }

    $scope.getAll = function() {
        $http({
            method: 'GET',
            url: 'api/job_status/read.php'
        }).then(function successCallback(response) {
            $scope.jobstatuses = response.data.records;
        });
    }

    $scope.deleteJobStatus = function(id){
        if(confirm("Are you sure you want to remove this Job Status from the System?")){
            $http({
                method: 'POST',
                data: { 'id' : id },
                url: 'api/job_status/delete.php'
            }).then(function successCallback(response) {
                Materialize.toast(response.data, 4000);
                $scope.getAll();
            });
        }
    }

    $scope.showCreateForm = function() {
        $scope.clearForm();
        $('#modal-jobstatus-title').text("Add Job Status");
        $('#btn-update-jobstatus').hide();
        $('#btn-create-jobstatus').show();
    }

    $scope.clearForm = function(){
        $scope.id          = "";
        $scope.description = "";
        $scope.template_page = "";
    }

    $scope.createJobStatus = function() {
        $http({
            method: 'POST',
            data: {
                'id'          : $scope.id,
                'description' : $scope.description,
                'template_page' : $scope.template_page
            },
            url: 'api/job_status/create.php'
        }).then(function successCallback(response) {
            Materialize.toast(response.data, 4000);
            $('#modal-jobstatus-form').modal('close');
            $scope.clearForm();
            $scope.getAll();
        });
    }
});
