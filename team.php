<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Team Admin</title>
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
        <div class="container" ng-app="sterlingTeamApp" ng-controller="teamCtrl">
            <div class="row">
                <div class="col s12">
                    <h4>Teams</h4>
                    <!-- used for searching the current list -->
                    <input type="text" ng-model="search" class="form-control" placeholder="Search...">

                    <!-- table that shows product record list -->
                    <table class="hoverable bordered">
                        <thead>
                            <tr>
                                <th class="width-30-pct">Description</th>
                            </tr>
                        </thead>
                        <tbody ng-init="getAll()">
                            <!-- <tr ng-repeat="d in names | filter:search"> -->
                            <tr dir-paginate="team in teams | filter:search | orderBy:sortKey | itemsPerPage:5" pagination-id="teamx">
                                <td class="width-30-pct">{{ team.description }}</td>
                                <td align="right">
                                    <a ng-click="readTeam(team.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Rename</a>
                                    <a ng-click="deleteTeam(team.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        <!-- angular pagination -->
                        <dir-pagination-controls pagination-id="teamx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                    </table>

                    <!-- modal for for creating new user -->
                    <div id="modal-team-form" class="modal">
                        <div class="modal-content">
                            <h4 id="modal-team-title">Add Team</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input ng-model="description" type="text" class="validate" id="form-name" placeholder="Description here..." />
                                    <label for="description">description</label>
                                </div>
                                <div class="input-field col s12">
                                    <a id="btn-create-team" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createTeam()"><i class="material-icons left">add</i>Create</a>
                                    <a id="btn-update-team" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateTeam()"><i class="material-icons left">edit</i>Save Changes</a>
                                    <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- floating button for creating product -->
                    <div class="fixed-action-btn" style="bottom:45px; right:24px;">
                        <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-team-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
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
        <script type="text/javascript" src="./app/team.js"></script>
    </body>
</html>