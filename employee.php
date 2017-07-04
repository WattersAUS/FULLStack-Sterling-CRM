<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Employee Admin</title>
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
        <div class="container" ng-app="sterlingEmpApp" ng-controller="empCtrl">
            <div class="row input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                <input type="text" ng-model="search" class="form-control" placeholder="Search..." style="border: none">
            </div>
            <div class="row">
                <table class="table table-hover">
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
                    <tbody ng-init="get()">
                        <tr dir-paginate="e in data.employees | filter:search | orderBy:sortKey | itemsPerPage:5" pagination-id="empx">
                            <td>{{ e.user_full_name }}</td>
                            <td>{{ e.division_description }}</td>
                            <td>{{ e.employee_emp_no }}</td>
                            <td>{{ e.employee_job_role }}</td>
                            <td>{{ e.manager_last_name }}, {{ e.manager_first_name }}</td>
                            <td>{{ e.team_description }}</td>
                            <td>
                                <a ng-click="read(e.employee_id)" class="waves-effect waves-light btn margin-bottom-1em">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                        <!-- angular pagination -->
                    <dir-pagination-controls pagination-id="empx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                </table>
            </div>
            <div class="row" align="right">
                <a href="#" class="btn" color="#FF0000" role="button" ng-click="create()">Add</a>
            </div>
        </div> <!-- end container -->
        <!-- include angular js -->
        <script src="./assets/js/angular.min.js"></script>
        <!-- include angular js -->
        <script src="./assets/js/ui-bootstrap-tpls.min.js"></script>
        <!-- include angular pagination -->
        <script src="./assets/js/dirPagination.js"></script>
        <!-- include jquery -->
        <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
    <!-- user -->
        <script type="text/javascript" src="./app/employee.js"></script>
    </body>
</html>
