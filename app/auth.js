/**
 * Created by davew on 06/05/2017.
 */

app.controller('authCtrl', function($scope, $http) {

    $scope.login = function() {
        $http({
            method: 'POST',
            data: {
                'username' : $scope.username,
                'password' : $scope.password
            },
            url: '/ssdata_api/login'
        }).then(function successCallback(response) {

            // tell the user usser record was updated
            Materialize.toast(response.data.Status, 4000);

            // close modal
            $('#modal-login-form').modal('close');

            // clear modal content
            $scope.clearLoginForm();
            $scope.userStatus();
            $scope.$broadcast('UserLogInEvent', 'response.data.Status');

        });
    }

    $scope.showLoginForm = function(){

        // clear form
        $scope.clearLoginForm();

    }

// clear variable / form values
    $scope.clearLoginForm = function(){
        $scope.username = "";
        $scope.password = "";
    }

    $scope.logout = function() {
        $http({
            method: 'GET',
            url: '/ssdata_api/logout'
        }).then(function successCallback(response) {
            $scope.names = null;
            $scope.clearLoginForm();
            $scope.userStatus();
            $scope.$broadcast('UserLogInEvent', 'response.data.Status');

        });
    }

    $scope.userStatus = function() {
        $http({
            method: 'GET',
            url: '/ssdata_api/userStatus'
        }).then(function successCallback(response) {
            $scope.isLoggedIn = (response.data.Status == 'Logged In');

            if ($scope.isLoggedIn) {
                $scope.userTitle = response.data.User.title;
                $scope.userFirstName = response.data.User.firstName;
                $scope.userLastName = response.data.User.lastName;
            } else {
                $scope.userTitle = "";
                $scope.userFirstName = "";
                $scope.userLastName = "";
            }

            if (!$scope.isLoggedIn) {
                // show modal
                $('#modal-login-form').modal('open');
            }
        });
    }
});