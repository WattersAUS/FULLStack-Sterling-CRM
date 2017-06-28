<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jobs Display</title>
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
    <body ng-app="sterlingJobsDisplayApp" ng-controller="jobsDisplayCtrl" ng-init="initPage()">
        <?php include './inc/headerNav.php';?>

        <div id="wrapper">
            <div id="s-page-wrapper">
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 panel">
                        <div class="panel panel-turq">
                            <div class="panel-heading">
                                <div class="row">
                                <?php include '../inc/subNav.php';?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12">
                        <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">New note</a>
                        <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em fltrt">Instruction</a>
                    </div>

            		<div class="col-lg-3 col-md-6">
            			<select class="form-control" name="selectstatus" id="selectstatus" ng-model="selectstatus" ng-options="s as s.job_status_description for s in statuses" ng-change="onStatusSelect()">
            					<option value="" disabled selected>Status</option>
            			</select>
            		</div>

            		<div class="col-lg-3 col-md-6">
            			<select class="form-control" name="selectemployee" id="selectemployee" ng-model="selectemployee" ng-options="e as e.full_name for e in employees" ng-change="onEmployeeSelect()">
            					<option value="" disabled selected>Estimator assigned to</option>
            			</select>
            		</div>

                    <!-- RESULT -->
                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-black">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-9 text-left">
                                        <div class="panelTitle">Job Details- {{ job_id }} / {{ employee_first_name }} / {{ employee_last_name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-turq panel-margin3">
                                <span class="result-jobNo fltlft"><span class="smlHd">Date:</span> 28/05/17</span>
                                <span class="result-site fltlft"><span class="smlHd">Time:</span> 11:01:15</span>
                                <span class="result-crn fltlft"><span class="smlHd">Status:</span> Jack Stewart</span>
                                <span class="result-crn fltlft"><span class="smlHd">Cancelled date:</span> 29/05/17</span>
                                <span class="result-crn fltlft"><span class="smlHd">Cancelled by:</span> Jack Stewart</span>
                            </div>
                            <div class="jobInfo">This job has now been cancelled</div>
                        </div>
                    </div>
                    <!-- / RESULT  -->

                    <!-- RESULT -->
                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-9 text-left">
                                        <div class="panelTitle">Job completed- No job sheet</div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-turq panel-margin3">
                                <span class="result-jobNo fltlft"><span class="smlHd">Date:</span> 28/05/17</span>
                                <span class="result-site fltlft"><span class="smlHd">Time:</span> 11:01:15</span>
                                <span class="result-crn fltlft"><span class="smlHd">Status:</span> Jack Stewart</span>
                                <span class="result-crn fltlft"><span class="smlHd">Cancelled date:</span> N/A</span>
                                <span class="result-crn fltlft"><span class="smlHd">Cancelled by:</span> N/A</span>
                            </div>
                            <div class="jobInfo">INformation to appear here</div>
                        </div>
                    </div>
                    <!-- / RESULT  -->

                    <!-- RESULT -->
                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-9 text-left">
                                        <div class="panelTitle">Note</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-turq panel-margin3">
                                    <span class="result-jobNo fltlft"><span class="smlHd">Date:</span> 24/05/17</span>
                                    <span class="result-site fltlft"><span class="smlHd">Time:</span> 09:01:01</span>
                                    <span class="result-crn fltlft"><span class="smlHd">Status:</span> Jack Stewart</span>
                                    <span class="result-crn fltlft"><span class="smlHd">Cancelled date:</span> N/A</span>
                                    <span class="result-crn fltlft"><span class="smlHd">Cancelled by:</span> N/A</span>
                                </div>
                                <div class="jobInfo">Plan budget was changed from <strong>£1,000.00</strong> to <strong>£10,000</strong> bacause no bedget was originally set</div>
                            </div>
                        </div>
                    <!-- / RESULT  -->

                    <!-- RESULT -->
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-9 text-left">
                                            <div class="panelTitle">Purchase Order Instruction</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-turq panel-margin3">
                                    <span class="result-jobNo fltlft"><span class="smlHd">Date:</span> 22/05/17</span>
                                    <span class="result-site fltlft"><span class="smlHd">Time:</span> 14:12:01</span>
                                    <span class="result-crn fltlft"><span class="smlHd">Status:</span> Craig Hill</span>
                                </div>

                                <div class="panel panel-turq panel-margin3">
                                    <span class="result-jobNo fltlft"><span class="smlHd">CPO Received:</span> 16/05/17</span>
                                    <span class="result-site fltlft"><span class="smlHd">CPO:</span> 3453456845</span>
                                    <span class="result-crn fltlft"><span class="smlHd">PO Value:</span> £9199.85</span>
                                    <span class="result-crn fltlft"><span class="smlHd">Job Budget:</span> £7999.99</span>
                                </div>

                                <div class="jobInfo">99100 - Quote 4, Orrel Park Phase 3 Bootle<br/>Option 2 - Choose this option</div>
                            </div>
                        </div>
                    <!-- / RESULT  -->


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
        <script type="text/javascript" src="./app/jobs_display.js"></script>

    </body>
</html>
