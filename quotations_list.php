<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quotations List</title>
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
    <body ng-app="sterlingJobsListApp" ng-controller="jobsListCtrl">
        <?php include './inc/headerNav.php';?>
        <div id="wrapper" >
            <div id="s-page-wrapper">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-turq">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <h2>RFQ</h2>
                                    </div>
                                </div>
                            </div>
                            <a href ng-click="create()">
                                <div class="panel-footer">
                                    <span class="pull-left">Create</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6 panel">
                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" placeholder="Search records..." ng-model="search">
                        <div>{{ data.jobsLoadedText }}</div>
                    </div>

                    <div class="col-lg-12 col-md-6 panel" ng-init="get()">
                        <!-- START : RECORDS RESULTS -->
                        <a href="./jobs_display.php" ng-repeat="j in data.jobs | filter:search" ng-click="set(j.job_id)" on>
                            <div class="panel panel-green panel-margin3 panelHeight30">
                                <span class="result-crn fltlft"><span class="smlHd">Customer Ref:</span>{{j.customer_ref_no}}</span>
                                <span class="result-jobNo fltlft"><span class="smlHd">Job No:</span>{{j.job_id}}</span>
                                <span class="result-site fltlft"><span class="smlHd">Site:</span>{{j.site_name}}</span>
                                <div class="clear"></div>
                                <span class="result-crn fltlft"><span class="smlHd">Status:</span>{{j.job_status_description}}</span>
                                <span class="result-jobNo fltlft"><span class="smlHd">Job Type:</span> JOB TYPE GOES HERE</span>
                            </div>
                        </a>
                        <!-- END : RECORDS -->
                    </div>
                </div>
                <!-- / NESTED  -->
            </div>
        </div>
        <!-- /.row -->
    </div>
      <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

        <script src="./assets/js/angular.min.js"></script>
        <!-- include angular js -->
        <script src="./assets/js/ui-bootstrap-tpls.min.js"></script>
        <!-- include angular ngStorage -->
        <script src="./assets/js/ngStorage.min.js"></script>
        <!-- include angular pagination -->
        <script src="./assets/js/dirPagination.js"></script>
        <!-- include jquery -->
        <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
        <!-- user -->
        <script type="text/javascript" src="./app/jobs_list.js"></script>

    </body>
</html>
