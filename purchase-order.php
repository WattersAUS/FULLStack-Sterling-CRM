<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Purchase Order</title>
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

    <!-- /.row -->
    <div class="row">


      <div class="col-lg-12 col-md-12 panel">
        <div class="panel panel-turq">
          <div class="panel-heading">
            <div class="row">
            <?php include './inc/subNav.php';?>
             </div>
          </div>
        </div>
        <div class="row">

          <!-- /.col-lg-12 -->
        </div>
        <!-- START : COVER PANEL 1  -->
        <div class="col-lg-4 col-md-6">


 <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Purchase Orders</div>
                </div>
              </div>
             </div>

          <div class="panel-body">

<p><button type="submit" class="btn btn-default">New Purchase Order</button></p>
            <div class="form-group input-group">
                <span class="input-group-addon" style="width:120px;">SSPO Budget</span>
                <input type="text" class="form-control" value="£16,995">
                </div>
                <div class="form-group input-group">
                <span class="input-group-addon" style="width:120px;">Total PO's</span>
                <input type="text" class="form-control" value="£16,995">
                </div>

<div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td colspan"4"><a href="#"><strong>A1 Stremline RoadMarkings Ltd</strong></a><br />
                                            SS991000-HS1180<br />
                                            <strong>Materials</strong></td>
                                            <td>Budget:<br />Bal:</td>
                                            <td>£10,000<br />
                                            £8,000</td>
                                        </tr>
                                        <tr>
                                            <td colspan"4"><a href="#"><strong>Premier Inn</strong></a><br />
                                            SS991000-PIN1158<br />
                                            <strong>Accommodation</strong></td>
                                            <td>Budget:<br />Bal:</td>
                                            <td>£100<br />
                                            £0.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

          </div>
           </div>
           <!-- END : PANEL -->

        </div>
        <!-- END : COVER PANEL 1  -->




        <!-- START : COVER PANEL 2  -->
        <div class="col-lg-3 col-md-6">


          <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Purchase Order Details</div>
                </div>
              </div>
             </div>

          <div class="panel-body">
          <form role="form">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="width:120px;">PO Number</span>
                                            <input type="text" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="width:120px;">CPO Number</span>
                                            <input type="text" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="width:120px;">PO Value</span>
                                            <input type="text" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="width:120px;">PO Balance</span>
                                            <input type="text" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="width:120px;">Supplier</span>
                                            <input type="text" class="form-control" placeholder="Username">
                                        </div>
                                    </form>

          </div>
           </div>
           <!-- END : PANEL -->

           <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Purchase Order Call Offs</div>
                </div>
              </div>
             </div>

          <div class="panel-body">
          <form role="form">
                                 <div class="form-group">
                                            <textarea class="form-control" rows="22"></textarea>
                                        </div>
                                    </form>

          </div>
           </div>
           <!-- END : PANEL -->

        </div>
        <!-- END : COVER PANEL 2  -->

        <!-- START : COVER PANEL 3  -->
        <div class="col-lg-5 col-md-6">

          <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">PDF</div>
                </div>
              </div>
             </div>

          <div class="panel-body">

!!!!!!PDF HERE!!!!!!

          </div>
           </div>
           <!-- END : PANEL -->

        </div>
        <!-- END : COVER PANEL 3  -->


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
