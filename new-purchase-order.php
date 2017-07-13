<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>New Purchase Order</title>
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

<body>
<div id="wrapper">

 <?php include 'inc/headerNav.php';?>
  <div id="s-page-wrapper">

    <!-- /.row -->
    <div class="row">


      <div class="col-lg-12 col-md-12 panel">
        <div class="panel panel-turq">
          <div class="panel-heading">
            <div class="row">
            <?php include 'inc/subNav.php';?>
             </div>
          </div>
        </div>
        <div class="row">

          <!-- /.col-lg-12 -->
        </div>
        <!-- START : COVER PANEL 1  -->
        <div class="col-lg-4 col-md-6">
        <p>
          <button type="submit" class="btn btn-default">New Supplier</button>
          <button type="reset" class="btn btn-default">Cancel</button>
          </p>
          <p><input type="text" ng-model="search" class="form-control" placeholder="Search user..."></p>
          <!-- START : PANEL -->

          <div class="panel panel-turq">


          <div class="panel panel-drkgry panel-margin3">
          <span class="result-name fltlft">Travis Perkins</span>
          <span class="result-name fltrt" style="text-align: right;"><a href="">Edit</a></span>
          </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-name fltlft">Travis Perkins hire</span>
          <span class="result-name fltrt" style="text-align: right;"><a href="">Edit</a></span>
          </div>


           </div>
           <!-- END : PANEL -->





        </div>
        <!-- END : COVER PANEL 1  -->




        <!-- START : COVER PANEL 2  -->
        <div class="col-lg-4 col-md-6">

          <h1>New Purchase Order</h1>
          <form role="form">
                                        <div class="form-group">
                                            <label>SSPO Type</label>
                                            <input class="form-control" placeholder="Enter type">
                                        </div>
                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <input class="form-control" placeholder="Enter supplier">
                                        </div>
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <input class="form-control" placeholder="Enter branch">
                                        </div>
                                        <div class="form-group">
                                            <label>Branch Address</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Supplier Tel.</label>
                                            <input class="form-control" placeholder="Enter branch">
                                        </div>
                                        <div class="form-group">
                                            <label>Supplier Prefix</label>
                                            <input class="form-control" placeholder="Enter prefix (3 Uppercase Letters)">
                                        </div>
                                        <div class="form-group">
                                            <label>Budget Balance</label>
                                            <input class="form-control" placeholder="Enter budget balance">
                                        </div>
                                        <div class="form-group">
                                            <label>Supplier Gross Budget</label>
                                            <input class="form-control" placeholder="Enter gross budget">
                                        </div>
                                        <div class="form-group">
                                            <label>Brief Description</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>


                                        <button type="submit" class="btn btn-default">Continue</button>
                                        <button type="reset" class="btn btn-default">Cancel</button>
                                    </form>



        </div>
        <!-- END : COVER PANEL 2  -->

        <!-- START : COVER PANEL 3  -->
        <div class="col-lg-4 col-md-6">



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
