<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>System Settings</title>
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
        <div class="container" ng-app="sterlingSettingsApp" ng-controller="settingsCtrl">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="width-30-pct">Company</th>
                        <th class="width-30-pct">Short Name</th>
                        <th class="width-30-pct">Reg No.</th>
                    </tr>
                </thead>
                <tbody ng-init="get()">
                    <tr>
                        <td class="width-30-pct">{{ data.companyName }}</td>
                        <td class="width-30-pct">{{ data.shortName }}</td>
                        <td class="width-30-pct">{{ data.companyRegNo }}</td>
                        <td align="right">
                            <a ng-click="read()" class="waves-effect waves-light btn margin-bottom-1em">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
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
        <script type="text/javascript" src="./app/settings.js"></script>
    </body>
</html>
