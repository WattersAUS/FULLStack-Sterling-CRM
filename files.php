<!DOCTYPE html>
<html lang="en" data-ng-app="FileManagerApp">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Sterling Services - Files</title>

  <!-- third party -->
    <script src="bower_components/angular/angular.min.js"></script>
    <script src="bower_components/angular-translate/angular-translate.min.js"></script>
    <script src="bower_components/ng-file-upload/ng-file-upload.min.js"></script>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bower_components/bootswatch/paper/bootstrap.min.css" />
  <!-- /third party -->

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

 <!-- Comment if you need to use raw source code -->
    <link href="dist/angular-filemanager.min.css" rel="stylesheet">
    <script src="dist/angular-filemanager.min.js"></script>
  <!-- /Comment if you need to use raw source code -->

  <script type="text/javascript">
    //example to override angular-filemanager default config
    angular.module('FileManagerApp').config(['fileManagerConfigProvider', function (config) {
      var defaults = config.$get();
      config.set({
        appName: 'angular-filemanager',
        pickCallback: function(item) {
          var msg = 'Picked %s "%s" for external use'
            .replace('%s', item.type)
            .replace('%s', item.fullPath());
          window.alert(msg);
        },

        allowedActions: angular.extend(defaults.allowedActions, {
          pickFiles: false,
          pickFolders: false,
        }),
      });
    }]);
  </script>

</head>



<body class="ng-cloak">
  <angular-filemanager></angular-filemanager>


<div id="wrapper">

 <?php include '../inc/headerNav.php';?>
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
                  <div class="panelTitle">Miscellaneous</div>
                </div>
              </div>
             </div>
          <!--  <angular-filemanager></angular-filemanager> -->
          <div class="panel panel-drkgry panel-margin3">
          <angular-filemanager></angular-filemanager>
          <span class="result-jobNo fltlft"><span class="smlHd">Tester 3</span></span>
          </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-site fltlft"><span class="smlHd">Tester 2</span></span>
          </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-crn fltlft"><span class="smlHd">Test 1</span></span>
          </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-crn fltlft"><span class="smlHd">111beforeandafter.jpg</span></span>
          </div>


           </div>
           <!-- END : PANEL -->

           <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Health &amp; Safety</div>
                </div>
              </div>
             </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">My Folder</span></span>
          </div>
           </div>
           <!-- END : PANEL -->

           <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Job Survey</div>
                </div>
              </div>
             </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
           </div>
           <!-- START : PANEL -->



        </div>
        <!-- END : COVER PANEL 1  -->

        <!-- START : COVER PANEL 2  -->
        <div class="col-lg-4 col-md-6">


          <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Quotes</div>
                </div>
              </div>
             </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Tester 3</span></span>
          </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-site fltlft"><span class="smlHd">Tester 2</span></span>
          </div>

           </div>
           <!-- END : PANEL -->

           <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Correspondance</div>
                </div>
              </div>
             </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Mail delivery failed</span></span>
          </div>
           </div>
           <!-- END : PANEL -->

           <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Purchase Orders</div>
                </div>
              </div>
             </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
           </div>
           <!-- START : PANEL -->

           <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Job Sheets</div>
                </div>
              </div>
             </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
           </div>
           <!-- START : PANEL -->

           <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Invoices</div>
                </div>
              </div>
             </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
           </div>
           <!-- START : PANEL -->

        </div>
        <!-- END : COVER PANEL 2  -->

        <!-- START : COVER PANEL 3  -->
        <div class="col-lg-4 col-md-6">


          <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Quotes</div>
                </div>
              </div>
             </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Tester 3</span></span>
          </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-site fltlft"><span class="smlHd">Tester 2</span></span>
          </div>

           </div>
           <!-- END : PANEL -->

           <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Correspondance</div>
                </div>
              </div>
             </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Mail delivery failed</span></span>
          </div>
           </div>
           <!-- END : PANEL -->

           <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Purchase Orders</div>
                </div>
              </div>
             </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
           </div>
           <!-- START : PANEL -->

           <!-- START : PANEL -->
          <div class="panel panel-turq">

            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-9 text-left">
                  <div class="panelTitle">Data Sheets/Invoices</div>
                </div>
              </div>
             </div>

          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
          <div class="panel panel-drkgry panel-margin3">
          <span class="result-jobNo fltlft"><span class="smlHd">Empty</span></span>
          </div>
           </div>
           <!-- START : PANEL -->

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
