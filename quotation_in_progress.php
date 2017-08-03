<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Quotation Control</title>
        <!-- include custom CSS -->
        <link rel="stylesheet" href="./assets/css/custom.css" />
        <!-- Bootstrap Core CSS -->
        <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- xEdittable CSS -->
        <link href="./assets/css/xeditable.min.css" rel="stylesheet" type="text/css">
        <!-- MetisMenu CSS -->
        <link href="./assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="./assets/vendor/dist/css/sb-admin-2.css" rel="stylesheet">
        <!-- Morris Charts CSS -->
        <link href="./assets/vendor/morrisjs/morris.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="./assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Sterling CSS -->
        <link href="./assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body ng-app="sterlingQuoteApp" ng-controller="quoteCtrl" ng-init="initPage()">
        <div id="wrapper">
            <?php include './inc/headerNav.php';?>
            <div id="s-page-wrapper">
                <div class="row">
                    <div class="col-lg-12 col-md-12 panel">
                        <div class="panel panel-turq">
                            <div class="panel-heading">
                                <div class="row">
                                    <?php include './inc/subNav.php';?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 panel">
                            <div class="row">
                                <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">Quotation Details</a> <a ng-click="" href="quotation-option-PDF.php"  class="waves-effect waves-light btn margin-bottom-1em">Quotation PDF</a>
                                <!-- /.col-lg-12 -->
                            </div>
                        </div>

                        <!-- START : OUTER PANEL 1&2  -->
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <!-- START : COVER PANEL 1  -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="panel panel-turq">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-9 text-left">
                                                    <div class="panelTitle">QUOTATIONS</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">New Quotation</a>
                                            <div class="panel panel-turq panel-margin3"> <span class="result-20 fltlft">99999999</span> <span class="result-60 fltlft">TITLE OF JOB QUOTE</span> <span class="result-20 fltlft"><button type="button" class="btn-acc btn-xs">Accepted</button></div>
                                            <div class="panel panel-turq panel-margin3"> <span class="result-20 fltlft">99999999</span> <span class="result-60 fltlft">TITLE OF JOB QUOTE</span> <span class="result-20 fltlft"><button type="button" class="btn-acc btn-xs">Accepted</button></span> </div>
                                            <div class="panel panel-turq panel-margin3"> <span class="result-20 fltlft">99999999</span> <span class="result-60 fltlft">TITLE OF JOB QUOTE</span> <span class="result-20 fltlft"><button type="button" class="btn-acc btn-xs">Accepted</button></span> </div>
                                            <div class="panel panel-turq panel-margin3"> <span class="result-20 fltlft">99999999</span> <span class="result-60 fltlft">TITLE OF JOB QUOTE</span> <span class="result-20 fltlft"><button type="button" class="btn-dis btn-xs">Disabled</button></span> </div>
                                            <div class="panel panel-turq panel-margin3"> <span class="result-20 fltlft">99999999</span> <span class="result-60 fltlft">TITLE OF JOB QUOTE</span> <span class="result-20 fltlft"><button type="button" class="btn-dis btn-xs">Disabled</button></span> </div>
                                            <div class="panel panel-turq panel-margin3"> <span class="result-20 fltlft">99999999</span> <span class="result-60 fltlft">TITLE OF JOB QUOTE</span> <span class="result-20 fltlft"><button type="button" class="btn-dis btn-xs">Disabled</button></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END : COVER PANEL 1  -->

                                <!-- START : COVER PANEL 2  -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="panel panel-turq">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-9 text-left">
                                                    <div class="panelTitle">QUOTATION DETAILS - 99999999</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">Disable Quote</a>
                                            <div class="form-group input-group"> <span class="input-group-addon" style="width:120px;">Date</span>
                                                <input type="text" class="form-control" value="">
                                            </div>
                                            <div class="form-group input-group"> <span class="input-group-addon" style="width:120px;">Quote</span>
                                                <input type="text" class="form-control" value="">
                                            </div>
                                            <div class="form-group input-group"> <span class="input-group-addon" style="width:120px;">No.</span>
                                                <input type="text" class="form-control" value="">
                                            </div>
                                            <div class="form-group input-group"> <span class="input-group-addon" style="width:120px;">By</span>
                                                <input type="text" class="form-control" value="">
                                            </div>
                                            <div class="form-group input-group"> <span class="input-group-addon" style="width:120px;">Client</span>
                                                <input type="text" class="form-control" value="">
                                            </div>
                                            <div class="form-group input-group"> <span class="input-group-addon" style="width:120px;">Brief</span>
                                                <input type="text" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END : COVER PANEL 2  -->
                            </div>
                        </div>
                        <!-- END : OUTER PANEL 1&2  -->

                        <!-- START : COVER PANEL 3  -->
                        <div class="col-lg-4 col-md-6">
                            <!-- START : PANEL -->
                            <div class="panel panel-turq">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-9 text-left">
                                            <div class="panelTitle">Our Report</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body"> INFO </div>
                            </div>
                            <!-- END : PANEL -->

                            <!-- START : PANEL -->
                            <div class="panel panel-black">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-9 text-left">
                                            <div class="panelTitle">Options Summary</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>SS Cost</th>
                                                    <th>Retail</th>
                                                    <th>Profit</th>
                                                    <th>&#37;</th>
                                                </tr>
                                                <tr>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>16.20%</td>
                                                </tr>
                                                <tr>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>16.20%</td>
                                                </tr>
                                                <tr>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>16.20%</td>
                                                </tr>
                                                <tr>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>16.20%</td>
                                                </tr>
                                                <tr>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>16.20%</td>
                                                </tr>
                                                <tr>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>16.20%</td>
                                                </tr>
                                                <tr>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>16.20%</td>
                                                </tr>
                                                <tr>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>£1000.00</td>
                                                    <td>16.20%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                            <!-- END : PANEL -->
                        </div>
                        <!-- END : COVER PANEL 2  -->
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- /.col-lg-6 -->
                    <div class="col-lg-12">
                        <!-- START : COVER PANEL 1A  -->
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-turq">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-9 text-left">
                                            <div class="panelTitle">QUOTATION OPTIONS</div>
                                        </div>
                                    </div>
                                </div>



                                <!--<div class="panel-body" ng-init="getQuoteOptions()">-->
                                <div class="panel-body">
                                    <a ng-click="createQuoteOption()" class="waves-effect waves-light btn margin-bottom-1em">New Option</a>
                                    <div class="panel panel-turq panel-margin3" ng-repeat="qo in data.quoteoptions">

                                        <div class="row" ng-click="loadQuoteOption(qo.qo_id)">
                                            <span class="result-20 fltlft">{{qo.qo_id}}</span>
                                            <span class="result-60 fltlft">{{qo.qo_description}}</span>
                                            <span class="result-20 fltlft">
                                                <button type="button" class="btn-acc btn-xs">Accepted</button>
                                            </span>
                                        </div>

                                    </div>
                                </div>




                            </div>
                        </div>
                        <!-- END : COVER PANEL 1A  -->

                        <!-- START : COVER PANEL 2A  -->
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-turq">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-9 text-left">
                                            <div class="panelTitle">QUOTATION OPTIONS 1</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group input-group"> <span class="input-group-addon" style="width:60px;">By</span>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group input-group"> <span class="input-group-addon" style="width:60px;">Date</span>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group input-group"> <span class="input-group-addon" style="width:60px;">Type</span>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <p><a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">Disable</a></p>
                                </div>
                            </div>
                        </div>
                        <!-- END : COVER PANEL 2A  -->

                        <!-- START : COVER PANEL 3A  -->
                        <div class="col-lg-5 col-md-6">
                            <div class="panel panel-turq">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-9 text-left">
                                            <div class="panelTitle">OPTIONS SUMMARY</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr ng-repeat="c in data.categories">
                                                    <th>{{ c.category_description }} Total</th>
                                                    <td>{{ c.category_code }}</td>
                                                    <td>{{ c.category_id }}</td>
                                                    <td>...</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                        </div>
                        <!-- END : COVER PANEL 3A  -->
                    </div>
                </div>
                <!-- /.col-lg-12 -->

                <div class="row">
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        <div class="panel panel-default">

                            <form editable-form name="optionform" onaftersave="saveOptions()" oncancel="cancelOptionChanges()">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-pills">
                                        <li ng-attr-id="{{'category-'+c.category_id}}" ng-repeat="c in data.categories" ng-click="selectCategory(c.category_id)"><a href="#{{'tab-'+c.category_id}}" data-toggle="tab">{{c.category_description}}</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div id="{{'tab-'+c.category_id}}" class="tab-pane fade in" ng-repeat="c in data.categories">

                                            <table class="table table-bordered table-hover table-condensed">
                                                <tr style="font-weight: bold">
                                                    <td style="width:15%">Code</td>
                                                    <td style="width:45%">Description</td>
                                                    <td style="width:20%">Quantity</td>
                                                    <td style="width:20%">Price each</td>
                                                </tr>
                                                <tr ng-repeat="eo in data.editoptions">
                                                    <td style="width:15%">{{eo.wo_code}}</td>
                                                    <td style="width:45%">
                                                        <span editable-text="eo.description" e-name="desc" e-form="rowform">{{ eo.description || 'empty' }}</span>
                                                    </td>
                                                    <td style="width:20%">{{eo.quantity}}</td>
                                                    <td style="width:20%">{{eo.pricing}}</td>
                                                </tr>
                                            </table>

                                            <button type="button" class="btn btn-default" ng-click="newWorkOption(c.category_id)">+</button>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-body -->
                            </form>
                        </div>
                        <!-- /.panel -->
                    </div>
                  <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- include angular pagination -->
        <!--<script src="./assets/js/dirPagination.js"></script>-->
        <!-- include jquery -->
        <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="./assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <!-- include angular js -->
        <script src="./assets/js/angular.min.js"></script>
        <!-- include angular js -->
        <script src="./assets/js/ui-bootstrap-tpls.min.js"></script>
        <!-- include angular xEditable -->
        <script src="./assets/js/xeditable.min.js"></script>
        <!-- include angular ngStorage -->
        <script src="./assets/js/ngStorage.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="./assets/vendor/metisMenu/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="./assets/vendor/dist/js/sb-admin-2.js"></script>
        <!-- user -->
        <script type="text/javascript" src="./app/quotation.js"></script>
    </body>
</html>
