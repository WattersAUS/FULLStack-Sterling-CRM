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



            <!-- START : COVER PANEL 1  -->
            <div class="col-lg-7 col-md-6">
              <div class="panel panel-turq">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-xs-9 text-left">
                      <div class="panelTitle">Site Details</div>
                    </div>
                  </div>
                </div>

                                <div class="panel-body">
                               <div><a ng-click="new_site.php" class="waves-effect waves-light btn margin-bottom-1em">New site</a>
                                <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">Amend site</a></div>


                  <div class="form-group input-group"> <span class="input-group-addon">Site Name</span>
                    <input type="text" class="form-control" value="ASDA Leeds">
                  </div>
                  <div class="form-group input-group"> <span class="input-group-addon">Address 1</span>
                    <input type="text" class="form-control" value="">
                  </div>
                  <div class="form-group input-group"> <span class="input-group-addon">Address 2</span>
                    <input type="text" class="form-control" value="">
                  </div>
                  <div class="form-group input-group"> <span class="input-group-addon">Address 3</span>
                    <input type="text" class="form-control" value="">
                  </div>
                  <div class="form-group input-group"> <span class="input-group-addon">City</span>
                    <input type="text" class="form-control" value="">
                  </div>
                  <div class="form-group input-group"> <span class="input-group-addon">County</span>
                    <input type="text" class="form-control" value="">
                  </div>
                  <div class="form-group input-group"> <span class="input-group-addon">Postcode</span>
                    <input type="text" class="form-control" value="">
                  </div>
                </div>
              </div>


<!-- START : COVER PANEL 2A  -->
              <div class="col-lg-12 col-md-6">
                <div class="panel panel-turq">
                 <div class="panel-heading">
                    <div class="row">
                     <div class="col-xs-9 text-left">
                       <div class="panelTitle">Notes</div>
                     </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <textarea rows="5"></textarea>
                  </div>
                </div>
              </div>
        <!-- END : COVER PANEL 2A  -->

            </div>
            <!-- END : COVER PANEL 1  -->

            <!-- START : COVER PANEL 2  -->
            <div class="col-lg-5 col-md-6">
              <div class="panel panel-turq">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-xs-9 text-left">
                      <div class="panelTitle">Primary Contact</div>
                    </div>
                  </div>
                </div>

                <div class="panel-body">
                  <div class="form-group input-group"> <span class="input-group-addon">Contact Name</span>
                    <input type="text" class="form-control" value="ASDA Leeds">
                  </div>
                  <div class="form-group input-group"> <span class="input-group-addon">Telephone 1</span>
                    <input type="text" class="form-control" value="">
                  </div>
                  <div class="form-group input-group"> <span class="input-group-addon">Telephone 2</span>
                    <input type="text" class="form-control" value="">
                  </div>
                  <div class="form-group input-group"> <span class="input-group-addon">Primary Email</span>
                    <input type="text" class="form-control" value="">
                  </div>
                </div>
              </div>
            </div>
            <!-- END : COVER PANEL 2  -->


        <!-- START : COVER PANEL 3  -->
        <div class="col-lg-5 col-md-6">



          <!-- START : COVER PANEL 2  -->

              <div class="panel panel-turq">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-xs-9 text-left">
                      <div class="panelTitle">Contacts</div>
                    </div>
                  </div>
                </div>
                <div class="panel-body">
                <div><input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" placeholder="Search contacts..." ng-model="search"><br /></div>
                  <a href="view_contact.php"><div class="panel panel-turq panel-margin3"> <span class="result-60 fltlft">CONTACT NAME</span> <span class="result-20 fltlft">EMAIL</span> </div></a>
                  <a href="view_contact.php"><div class="panel panel-turq panel-margin3"> <span class="result-60 fltlft">CONTACT NAME</span> <span class="result-20 fltlft">EMAIL</span> </div></a>
                  <a href="view_contact.php"><div class="panel panel-turq panel-margin3"> <span class="result-60 fltlft">CONTACT NAME</span> <span class="result-20 fltlft">EMAIL</span> </div></a>
                  <a href="view_contact.php"><div class="panel panel-turq panel-margin3"> <span class="result-60 fltlft">CONTACT NAME</span> <span class="result-20 fltlft">EMAIL</span> </div></a>
                  <a href="view_contact.php"><div class="panel panel-turq panel-margin3"> <span class="result-60 fltlft">CONTACT NAME</span> <span class="result-20 fltlft">EMAIL</span> </div></a>
                  <a href="view_contact.php"><div class="panel panel-turq panel-margin3"> <span class="result-60 fltlft">CONTACT NAME</span> <span class="result-20 fltlft">EMAIL</span> </div></a>

                   <div>
                        <br /><a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">New contact</a>
                    </div>


                </div>




              </div>



            <!-- END : COVER PANEL 2  -->


        </div>
        <!-- END : COVER PANEL 2  -->

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
