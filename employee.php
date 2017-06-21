`<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Employee Admin</title>
        <!-- include material design CSS -->
        <link rel="stylesheet" href="./assets/vendor/materialize/css/materialize.css" />
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
        <div class="container" ng-app="sterlingEmployeeApp" ng-controller="employeeCtrl">
            <div class="row">
                <div class="col s12">
                    <h1>Employee</h1>
                    <!-- used for searching the current list -->
                    <input type="text" ng-model="search" class="form-control" placeholder="Search employee...">

                    <!-- table that shows product record list -->
                    <table class="hoverable bordered">
                        <thead>
                            <tr>
                                <th class="text-align-center">Name</th>
                                <th class="text-align-center">Division</th>
                                <th class="text-align-center">Emp No.</th>
                                <th class="text-align-center">Role</th>
                                <th class="text-align-center">Manager</th>
                                <th class="text-align-center">Team</th>
                            </tr>
                        </thead>
                        <tbody ng-init="getAllEmployees()">
                    		<tr dir-paginate="employee in employees | filter:search | orderBy:sortKey:reverse | itemsPerPage:20" pagination-id="employeex">
                                <td>{{ employee.full_name }}</td>
                                <td>{{ employee.division_description }}</td>
                                <td>{{ employee.emp_no }}</td>
                                <td>{{ employee.job_role }}</td>
                                <td>{{ employee.manager_last_name }}, {{ employee.manager_first_name }}</td>
                                <td>{{ employee.team_description }}</td>
                                <td>
                                    <a ng-click="readEmployee(employee.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                                    <a ng-click="deleteEmployee(employee.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        <!-- angular pagination -->
                        <dir-pagination-controls pagination-id="employeex" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                    </table>

                    <!-- modal for for creating new product -->
                    <div id="modal-employee-form" class="modal">
                        <div class="modal-content">
                            <h4 id="modal-employee-title">Create New Employee</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input ng-model="division_id" type="text" class="validate" id="form-name" placeholder="Type division id here..." />
                                    <label for="division_id">division_id</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="emp_no" type="text" class="validate" id="form-name" placeholder="Type name here..." />
                                    <label for="emp_no">emp_no</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="is_manager" type="text" class="validate" id="form-name" placeholder="Type is manager here..." />
                                    <label for="is_manager">is_manager</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="job_role" type="text" class="validate" id="form-name" placeholder="Type job_role here..." />
                                    <label for="job_role">job_role</label>
                                </div>
                    			<div class="input-field col s12">
                                    <input ng-model="job_title" type="text" class="validate" id="form-name" placeholder="Type job_title here..." />
                                    <label for="job_title">job_title</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="manager_id" type="text" class="validate" id="form-name" placeholder="Type manager_id here..." />
                                    <label for="manager_id">manager_id</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="team_id" type="text" class="validate" id="form-name" placeholder="Type team_id here..."/>
                                    <label for="team_id">team_id</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="user_id" type="text" class="validate" id="form-name" placeholder="Type user_id here..." />
                                    <label for="user_id">user_id</label>
                                </div>
                                <div class="input-field col s12">
                                    <a id="btn-create-employee" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createEmployee()"><i class="material-icons left">add</i>Create</a>
                                    <a id="btn-update-employee" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateEmployee()"><i class="material-icons left">edit</i>Save Changes</a>
                                    <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- floating button for creating product -->
                    <div class="fixed-action-btn" style="bottom:45px; right:24px;">
                        <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-employee-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
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
        <script src="./assets/vendor/materialize/js/materialize.min.js"></script>
        <!-- custom js -->
        <script type="text/javascript" src="./assets/js/custom.js"></script>
        <!-- user -->
        <script type="text/javascript" src="./app/employee.js"></script>
    </body>
</html>
`
