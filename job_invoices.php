<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Invoices</title>
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
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>

<body>
<div id="wrapper">
  <?php include './inc/headerNav.php';?>
  <div id="s-page-wrapper">
    <div class="row">
      <div class="col-lg-12 col-md-12 panel">

        <!-- START : PANEL  -->
        <div class="col-lg-8 col-md-6">
          <div class="panel panel-turq">
            <div class="panel-body">
              <div> <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">New Invoices</a> </div>

              <!-- START : PANEL A  -->
              <div class="col-lg-8 col-md-6">
                <div class="panel panel-turq">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-9 text-left">
                        <div class="panelTitle">Invoices</div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <tbody>
                          <tr>
                            <td>INV1034</td>
                            <td>08/04/2017</td>
                            <td>New Invoice</td>
                            <td>£690.00</td>
                          </tr>
                          <tr>
                            <td colspan="2"></td>
                            <td><strong>Subtotal</strong></td>
                            <td>£690.00</td>
                          </tr>
                          <tr>
                            <td colspan="2"></td>
                            <td><strong>Balance</strong></td>
                            <td>£690.00</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->

                    <div class="form-group input-group"> <span class="input-group-addon">Date Invoice</span>
                      <input type="text" class="form-control" value="">
                      <span class="input-group-addon">Completed by</span>
                      <input type="text" class="form-control" value="">
                    </div>
                    <div class="form-group input-group"> <span class="input-group-addon">Invoice Description</span>
                      <input type="text" class="form-control" value="">
                    </div>
                    <div class="form-group input-group"> <span class="input-group-addon">Net</span>
                      <input type="text" class="form-control" value="">
                      <span class="input-group-addon">VAT</span>
                      <input type="text" class="form-control" value="">
                      <span class="input-group-addon">Gross</span>
                      <input type="text" class="form-control" value="">
                    </div>
                  </div>
                </div>
              </div>
              <!-- END : PANEL A  -->

              <!-- START : PANEL B  -->
              <div class="col-lg-4 col-md-6">
                <div class="panel panel-turq">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-9 text-left">
                        <div class="panelTitle">Doc Type</div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <label>Radio Buttons</label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                          Invoice 14 Days </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                          Invoice 30 Days </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                          Invoice 60 Days </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="optionsRadios3" value="option4">
                          Proforma Invoice </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="optionsRadios3" value="option5">
                          Credit </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END : PANEL B  -->

            </div>
          </div>

          <!-- START : PANEL  -->
          <div class="col-lg-12 col-md-6">
            <div class="panel panel-turq">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-9 text-left">
                    <div class="panelTitle">Invoice Line Items</div>
                  </div>
                </div>
              </div>
              <div class="panel-body">
              <div> <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">New Line Item</a> </div>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tbody>
                      <tr>
                        <th>Qty</th>
                        <th>Desc</th>
                        <th>Unit</th>
                        <th>Net</th>
                        <th>Rate</th>
                        <th>VAT</th>
                        <th>Rows</th>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>Test Description</td>
                        <td>£690.00</td>
                        <td>£690.00</td>
                        <td></td>
                        <td>£0.00</td>
                        <td>1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
            </div>
          </div>
          <!-- END : PANEL  -->








        </div>
        <!-- END : MAIN PANEL  -->

<!-- START : PANEL PO  -->
              <div class="col-lg-4 col-md-6">
                <div class="panel panel-turq">
                  <div class="panel-body">
                      PO
                  </div>
                </div>
              </div>
              <!-- END : PANEL PO  -->


  </div>
</div>
<!-- /.row -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="./assets/js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="./assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="./assets/vendor/metisMenu/metisMenu.min.js"></script>
<!-- Morris Charts JavaScript -->
<script src="./assets/vendor/raphael/raphael.min.js"></script>
<script src="./assets/vendor/morrisjs/morris.min.js"></script>
<script src="./assets/vendor/data/morris-data.js"></script>
<!-- Custom Theme JavaScript -->
<script src="./assets/vendor/dist/js/sb-admin-2.js"></script>

</body>
</html>
