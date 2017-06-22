<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Admin</title>
        <!-- include material design CSS -->
        <link rel="stylesheet" href="./assets/materialize/css/materialize.css" />
        <!-- include material design icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <!-- include custom CSS -->
        <link rel="stylesheet" href="./assets/css/custom.css" />
        <!-- Bootstrap Core CSS -->
        <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="./assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="./assets/vendor/dist/css/sb-admin-2.css" rel="stylesheet">
        <!-- Morris Charts CSS -->
        <link href="./assets/vendor/morrisjs/morris.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="./assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Sterling CSSS -->
        <link href="./assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php include './inc/headerNav.php';?>
        <div class="container" ng-app="sterlingUserApp" ng-controller="userCtrl">
            <div class="row">
                <div class="col s12">
                    <h1>User Admin</h1>
                    <!-- used for searching the current list -->
                    <input type="text" ng-model="search" class="form-control" placeholder="Search user...">
                    <!-- table that shows record list -->
                    <table class="hoverable bordered">
                        <thead>
                            <tr>
                                <th class="width-30-pct">title</th>
                                <th class="width-30-pct">first_name</th>
                                <th class="width-30-pct">last_name</th>
                                <th class="text-align-center">email_address</th>
                                <th class="text-align-center">start_date</th>
                                <th class="text-align-center">end_date</th>
                                <th class="text-align-center">user_level</th>
                            </tr>
                        </thead>
                        <tbody ng-init="getAll()">
                    		<tr dir-paginate="d in names | filter:search | orderBy:sortKey:reverse | itemsPerPage:20" pagination-id="userx">
                                <td>{{ d.title }}</td>
                                <td>{{ d.first_name }}</td>
                                <td>{{ d.last_name }}</td>
                                <td class="text-align-center">{{ d.email_address }}</td>
                                <td class="text-align-center">{{ d.start_date }}</td>
                                <td class="text-align-center">{{ d.end_date }}</td>
                                <td class="text-align-center">{{ d.user_level }}</td>
                                <td>
                                    <a ng-click="readUser(d.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                                    <a ng-click="deleteUser(d.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        <!-- angular pagination -->
                        <dir-pagination-controls pagination-id="userx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                    </table>

                    <!-- modal for for creating new user -->
                    <div id="modal-user-form" class="modal">
                        <div class="modal-content">
                            <h4 id="modal-user-title">New User</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input ng-model="title" type="text" class="validate" id="form-name" placeholder="Title here..." />
                                    <label for="title">title</label>
                                </div>
                                <div class="input-field col s12">
                                    <textarea ng-model="first_name" type="text" class="validate materialize-textarea" placeholder="First Name here..."></textarea>
                                    <label for="first_name">first_name</label>
                                </div>
                                <div class="input-field col s12">
                                    <textarea ng-model="last_name" type="text" class="validate materialize-textarea" placeholder="Last Name here..."></textarea>
                                    <label for="last_name">last_name</label>
                                </div>
                                <div class="input-field col s12">
                                    <textarea ng-model="email_address" type="text" class="validate materialize-textarea" placeholder="Email here..."></textarea>
                                    <label for="email_address">email_address</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="start_date" type="text" class="validate" id="form-price" placeholder="Start Date here..." />
                                    <label for="start_date">start_date</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="end_date" type="text" class="validate" id="form-price" placeholder="End Date here..." />
                                    <label for="end_date">end_date</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="password" type="text" class="validate" id="form-price" placeholder="Password here..." />
                                    <label for="password">password</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="user_level" type="text" class="validate" id="form-price" placeholder="User Leve here..." />
                                    <label for="user_level">user_level</label>
                                </div>
                                <div class="input-field col s12">
                                    <a id="btn-create-user" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createUser()"><i class="material-icons left">add</i>Create</a>
                                    <a id="btn-update-user" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateUser()"><i class="material-icons left">edit</i>Save Changes</a>
                                    <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- floating button for creating user -->
                    <div class="fixed-action-btn" style="bottom:45px; right:24px;">
                        <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-user-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
                    </div>
                </div> <!-- end col s12 -->
            </div> <!-- end row -->
        </div> <!-- end container -->
        <!-- page content and controls will be here -->
        <!-- include angular js -->
        <script src="./assets/js/angular.min.js"></script>
        <!-- include angular pagination -->
        <script src="./assets/js/dirPagination.js"></script>
        <!-- include jquery -->
        <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
        <!-- material design js -->
        <script src="./assets/materialize/js/materialize.min.js"></script>
        <!-- custom js -->
        <script type="text/javascript" src="./assets/js/custom.js"></script>
        <!-- user -->
        <script type="text/javascript" src="./app/user.js"></script>
    </body>
</html>
