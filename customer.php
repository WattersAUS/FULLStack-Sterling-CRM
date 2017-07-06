<!DOCTYPE html>
<!--suppress XmlInvalidId -->
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Customer Admin</title>
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
        <!-- Navigation -->
        <?php include './inc/headerNav.php';?>
        <div class="container" ng-app="sterlingCustApp" ng-controller="custCtrl">
            <div class="row input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                <input type="text" ng-model="search" class="form-control" placeholder="Search..." style="border: none">
            </div>
            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="width-30-pct">Customer</th>
                            <th class="width-30-pct">Type</th>
                            <th class="width-30-pct">Terms</th>
                            <th class="width-30-pct">Last updated</th>
                            <th class="width-30-pct">By</th>
                        </tr>
                    </thead>
                    <tbody ng-init="get()">
                        <tr dir-paginate="c in data.customers | filter:search | orderBy:sortKey | itemsPerPage:5" pagination-id="custx">
                            <td class="text-align-left">{{ c.customer_name }}</td>
                            <td class="text-align-left">{{ c.customer_type }}</td>
                            <td class="text-align-left">{{ c.terms_description }}</td>
                            <td class="text-align-left">{{ c.customer_date_updated }}</td>
                            <td class="text-align-left">{{ c.user_full_name }}</td>
                            <td align="right">
                                <a ng-click="read(c.customer_id)" class="waves-effect waves-light btn margin-bottom-1em">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                        <!-- angular pagination -->
                    <dir-pagination-controls pagination-id="custx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
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
        <script type="text/javascript" src="./app/customer.js"></script>
    </body>
</html>
