<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Purchase Order</title>
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

<body>
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
          <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">Quotation Details</a> <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">Quotation PDF</a>
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
            <div class="panel-body">
            <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">New Option</a>
              <div class="panel panel-turq panel-margin3"> <span class="result-20 fltlft">99999999</span> <span class="result-60 fltlft">TITLE OF JOB QUOTE</span> <span class="result-20 fltlft"><span class="result-20 fltlft"><button type="button" class="btn-acc btn-xs">Accepted</button></span></span> </div>
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
                    <tr>
                      <th>Materials Total</th>
                      <td>65</td>
                      <td>65</td>
                      <td>65</td>
                    </tr>
                    <tr>
                      <th>Plant Total</th>
                      <td>65</td>
                      <td>65</td>
                      <td>65</td>
                    </tr>
                    <tr>
                      <th>Transport Total</th>
                      <td>65</td>
                      <td>65</td>
                      <td>65</td>
                    </tr>
                    <tr>
                      <th>Accom Total</th>
                      <td>65</td>
                      <td>65</td>
                      <td>65</td>
                    </tr>
                    <tr>
                      <th>Sub Con Total</th>
                      <td>65</td>
                      <td>65</td>
                      <td>65</td>
                    </tr>
                    <tr>
                      <th>Waste</th>
                      <td>65</td>
                      <td>65</td>
                      <td>65</td>
                    </tr>
                    <tr>
                      <th>Other</th>
                      <td>65</td>
                      <td>65</td>
                      <td>65</td>
                    </tr>
                    <tr>
                      <th>Labour Hours</th>
                      <td>65</td>
                      <td>65</td>
                      <td>65</td>
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
      
          <!-- /.panel-heading -->
          <div class="panel-body"> 
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
              <li class="active"><a href="#tab1-pills" data-toggle="tab">Materials</a> </li>
              <li><a href="#tab2-pills" data-toggle="tab">Plant</a> </li>
              <li><a href="#tab3-pills" data-toggle="tab">Transport</a> </li>
              <li><a href="#tab4-pills" data-toggle="tab">Accomodation</a> </li>
              <li><a href="#tab5-pills" data-toggle="tab">Sub Contractors</a> </li>
              <li><a href="#tab6-pills" data-toggle="tab">Waste</a> </li>
              <li><a href="#tab7-pills" data-toggle="tab">Other</a> </li>
              <li><a href="#tab8-pills" data-toggle="tab">Labour</a> </li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane fade in active" id="tab1-pills"> 
              <p>&nbsp;</p>
                <!-- START : MATERIALS PANEL 1  -->
                <div class="col-lg-3 col-md-6">
                  <div class="panel panel-turq">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-9 text-left">
                          <div class="panelTitle">Nominal Codes</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div><input type="text" ng-model="search" class="form-control" placeholder="Search..."></div>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Title</th>
                              <th>Title</th>
                              <th>Title</th>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : MATERIALS PANEL 1  -->
                
                <!-- START : MATERIALS PANEL 2  -->
                <div class="col-lg-9 col-md-6">
                  <div class="panel panel-turq">
                  <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Information</div>
                </div>
              </div>
            </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Nom Code</th>
                              <th>Description</th>
                              <th>Supplier</th>
                              <th>Qty</th>
                              <th>Rate</th>
                              <th>Total</th>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//SUPPLIER//</td>
                              <td>//QTY//</td>
                              <td>//RATE//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//SUPPLIER//</td>
                              <td>//QTY//</td>
                              <td>//RATE//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//SUPPLIER//</td>
                              <td>//QTY//</td>
                              <td>//RATE//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            
                            
                            <tr>
                              <td colspan="4"></td>
                              <td><strong>Total Materials</strong></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="4"></td>
                              <td><strong>Markup</strong> <input type="text" value="%" size="4"></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="4"></td>
                              <td><strong>Grand Total</strong></td>
                              <td>£1000.00</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : MATERIALS PANEL 2  -->
              </div>
              <div class="tab-pane fade" id="tab2-pills">
                <p>&nbsp;</p>
                <!-- START :  PLANT PANEL 1  -->
                <div class="col-lg-3 col-md-6">
                  <div class="panel panel-turq">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-9 text-left">
                          <div class="panelTitle">Nominal Codes</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div><input type="text" ng-model="search" class="form-control" placeholder="Search..."></div>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Title</th>
                              <th>Title</th>
                              <th>Title</th>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : PLANT PANEL 1  -->
                
                <!-- START : PLANT PANEL 2  -->
                <div class="col-lg-9 col-md-6">
                  <div class="panel panel-turq">
                  <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Information</div>
                </div>
              </div>
            </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Nom Code</th>
                              <th>Description</th>
                              <th>Days/Weeks</th>
                              <th>Period</th>
                              <th>Qty</th>
                              <th>Rate</th>
                              <th>Total</th>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="DAYS" checked> Days <input type="radio" name="optionsRadios" id="optionsRadios1" value="WEEKS" checked> Weeks
                                             </td>
                              <td>//PERIOD//</td>
                              <td>//QTY//</td>
                              <td>//RATE//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            
                            
                            <tr>
                              <td colspan="5"></td>
                              <td><strong>Total Plant</strong></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="5"></td>
                              <td><strong>Markup</strong> <input type="text" value="%" size="4"></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="5"></td>
                              <td><strong>Grand Total</strong></td>
                              <td>£1000.00</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : PLANT PANEL 2  -->
              </div>
              <div class="tab-pane fade" id="tab3-pills">
                <p>&nbsp;</p>
                <!-- START :TRANSPORT PANEL 1  -->
                <div class="col-lg-3 col-md-6">
                  <div class="panel panel-turq">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-9 text-left">
                          <div class="panelTitle">Nominal Codes</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div><input type="text" ng-model="search" class="form-control" placeholder="Search..."></div>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Title</th>
                              <th>Title</th>
                              <th>Title</th>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : TRANSPORT PANEL 1  -->
                
                <!-- START : TRANSPORT PANEL 2  -->
                <div class="col-lg-9 col-md-6">
                  <div class="panel panel-turq">
                  <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Information</div>
                </div>
              </div>
            </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Nom Code</th>
                              <th>Description</th>
                              <th>Distance 1 Way</th>
                              <th>Fuel Cost</th>
                              <th>Total</th>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//DISTANCE//</td>
                              <td>//COST//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//DISTANCE//</td>
                              <td>//COST//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            
                            
                            <tr>
                              <td colspan="3"></td>
                              <td><strong>Total Transport</strong></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="3"></td>
                              <td><strong>Markup</strong> <input type="text" value="%" size="4"></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="3"></td>
                              <td><strong>Grand Total</strong></td>
                              <td>£1000.00</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : TRANSPORT PANEL 2  -->
              </div>
              <div class="tab-pane fade" id="tab4-pills">
                <p>&nbsp;</p>
                <!-- START :ACCOMMODATION PANEL 1  -->
                <div class="col-lg-3 col-md-6">
                  <div class="panel panel-turq">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-9 text-left">
                          <div class="panelTitle">Nominal Codes</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div><input type="text" ng-model="search" class="form-control" placeholder="Search..."></div>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Title</th>
                              <th>Title</th>
                              <th>Title</th>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : ACCOMMODATION PANEL 1  -->
                
                <!-- START : ACCOMMODATION PANEL 2  -->
                <div class="col-lg-9 col-md-6">
                  <div class="panel panel-turq">
                  <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Information</div>
                </div>
              </div>
            </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Nom Code</th>
                              <th>Description</th>
                              <th>Operative QTY</th>
                              <th>Night QTY</th>
                              <th>Room Cost</th>
                              <th>PD Value</th>
                              <th>Total</th>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//OP QTY//</td>
                              <td>//NT QTY//</td>
                              <td>//COST//</td>
                              <td>//PD//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//OP QTY//</td>
                              <td>//NT QTY//</td>
                              <td>//COST//</td>
                              <td>//PD//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//OP QTY//</td>
                              <td>//NT QTY//</td>
                              <td>//COST//</td>
                              <td>//PD//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            
                            <tr>
                              <td colspan="5"></td>
                              <td><strong>Total Transport</strong></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="5"></td>
                              <td><strong>Markup</strong> <input type="text" value="%" size="4"></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="5"></td>
                              <td><strong>Grand Total</strong></td>
                              <td>£1000.00</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : ACCOMMODATION PANEL 2  -->
              </div>
              <div class="tab-pane fade" id="tab5-pills">
                <p>&nbsp;</p>
                <!-- START :SUB CON PANEL 1  -->
                <div class="col-lg-3 col-md-6">
                  <div class="panel panel-turq">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-9 text-left">
                          <div class="panelTitle">Nominal Codes</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div><input type="text" ng-model="search" class="form-control" placeholder="Search..."></div>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Title</th>
                              <th>Title</th>
                              <th>Title</th>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : SUB CON PANEL 1  -->
                
                <!-- START : SUB CON PANEL 2  -->
                <div class="col-lg-9 col-md-6">
                  <div class="panel panel-turq">
                  <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Information</div>
                </div>
              </div>
            </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Nom Code</th>
                              <th>Description</th>
                              <th>Supplier</th>
                              <th>Rate</th>
                              <th>Markup</th>
                              <th>Total</th>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//SUPPLIER//</td>
                              <td>//RATE//</td>
                              <td>//MARKUP//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//SUPPLIER//</td>
                              <td>//RATE//</td>
                              <td>//MARKUP//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            
                            <tr>
                              <td colspan="4"></td>
                              <td><strong>Total Sub Con</strong></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="4"></td>
                              <td><strong>Markup</strong> <input type="text" value="%" size="4"></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="4"></td>
                              <td><strong>Grand Total</strong></td>
                              <td>£1000.00</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : SUB CON PANEL 2  -->
              </div>
              <div class="tab-pane fade" id="tab6-pills">
                <p>&nbsp;</p>
                <!-- START :WASTE PANEL 1  -->
                <div class="col-lg-3 col-md-6">
                  <div class="panel panel-turq">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-9 text-left">
                          <div class="panelTitle">Nominal Codes</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div><input type="text" ng-model="search" class="form-control" placeholder="Search..."></div>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Title</th>
                              <th>Title</th>
                              <th>Title</th>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : WASTE PANEL 1  -->
                
                <!-- START : WASTE PANEL 2  -->
                <div class="col-lg-9 col-md-6">
                  <div class="panel panel-turq">
                  <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Information</div>
                </div>
              </div>
            </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Nom Code</th>
                              <th>Description</th>
                              <th>QTY</th>
                              <th>Rate</th>
                              <th>Total</th>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//QTY//</td>
                              <td>//RATE//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//QTY//</td>
                              <td>//RATE//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//QTY//</td>
                              <td>//RATE//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            
                            <tr>
                              <td colspan="3"></td>
                              <td><strong>Total Waste</strong></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="3"></td>
                              <td><strong>Markup</strong> <input type="text" value="%" size="4"></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="3"></td>
                              <td><strong>Grand Total</strong></td>
                              <td>£1000.00</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : WASTE PANEL 2  -->
              </div>
              <div class="tab-pane fade" id="tab7-pills">
                <p>&nbsp;</p>
                <!-- START :OTHER PANEL 1  -->
                <div class="col-lg-3 col-md-6">
                  <div class="panel panel-turq">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-9 text-left">
                          <div class="panelTitle">Nominal Codes</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div><input type="text" ng-model="search" class="form-control" placeholder="Search..."></div>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Title</th>
                              <th>Title</th>
                              <th>Title</th>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : OTHER PANEL 1  -->
                
                <!-- START : OTHER PANEL 2  -->
                <div class="col-lg-9 col-md-6">
                  <div class="panel panel-turq">
                  <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Information</div>
                </div>
              </div>
            </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Nom Code</th>
                              <th>Description</th>
                              <th>QTY</th>
                              <th>Rate</th>
                              <th>Total</th>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//QTY//</td>
                              <td>//RATE//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//QTY//</td>
                              <td>//RATE//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//QTY//</td>
                              <td>//RATE//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            
                            <tr>
                              <td colspan="3"></td>
                              <td><strong>Total Other</strong></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="3"></td>
                              <td><strong>Markup</strong> <input type="text" value="%" size="4"></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="3"></td>
                              <td><strong>Grand Total</strong></td>
                              <td>£1000.00</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : OTHER PANEL 2  -->
              </div>
              <div class="tab-pane fade" id="tab8-pills">
                <p>&nbsp;</p>
                <!-- START :LABOUR PANEL 1  -->
                <div class="col-lg-3 col-md-6">
                  <div class="panel panel-turq">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-9 text-left">
                          <div class="panelTitle">Nominal Codes</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div><input type="text" ng-model="search" class="form-control" placeholder="Search..."></div>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Title</th>
                              <th>Title</th>
                              <th>Title</th>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                            <tr>
                              <td>Data</td>
                              <td>Data</td>
                              <td>Data</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : LABOUR PANEL 1  -->
                
                <!-- START : LABOUR PANEL 2  -->
                <div class="col-lg-9 col-md-6">
                  <div class="panel panel-turq">
                  <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Information</div>
                </div>
              </div>
            </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <th>Nom Code</th>
                              <th>Description</th>
                              <th>Rate</th>
                              <th>City Ops</th>
                              <th>City Days</th>
                              <th>HRS (per day)</th>
                              <th>Total HRS</th>
                              <th>Total</th>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//RATE//</td>
                              <td>//OPS//</td>
                              <td>//DAYS//</td>
                              <td>//HRS//</td>
                              <td>//TOTAL HRS//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//RATE//</td>
                              <td>//OPS//</td>
                              <td>//DAYS//</td>
                              <td>//HRS//</td>
                              <td>//TOTAL HRS//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            <tr>
                              <td>//CODE//</td>
                              <td>//DESC//</td>
                              <td>//RATE//</td>
                              <td>//OPS//</td>
                              <td>//DAYS//</td>
                              <td>//HRS//</td>
                              <td>//TOTAL HRS//</td>
                              <td>//TOTAL//</td>
                            </tr>
                            
                            <tr>
                              <td colspan="6"></td>
                              <td><strong>Total Labour</strong></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="6"></td>
                              <td><strong>Markup</strong> <input type="text" value="%" size="4"></td>
                              <td>£1000.00</td>
                            </tr>
                            <tr>
                              <td colspan="6"></td>
                              <td><strong>Grand Total</strong></td>
                              <td>£1000.00</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive --> 
                    </div>
                  </div>
                </div>
                <!-- END : LABOUR PANEL 2  -->
              </div>
            </div>
          </div>
          <!-- /.panel-body --> 
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

<!-- jQuery --> 
<script src="/assets/vendor/jquery/jquery.min.js"></script> 

<!-- Bootstrap Core JavaScript --> 
<script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script> 

<!-- Metis Menu Plugin JavaScript --> 
<script src="/assets/vendor/metisMenu/metisMenu.min.js"></script> 

<!-- Morris Charts JavaScript --> 
<script src="/assets/vendor/raphael/raphael.min.js"></script> 
<script src="/assets/vendor/morrisjs/morris.min.js"></script> 
<script src="/assets/data/morris-data.js"></script> 

<!-- Custom Theme JavaScript --> 
<script src="/dist/js/sb-admin-2.js"></script>
</body>
</html>
