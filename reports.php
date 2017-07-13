<!doctype html>
<html lang="en" ng-app="angularTable">
  <head>
    <meta charset="utf-8">
    <title>Report Builder</title>


    <!--<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <!--<link rel="stylesheet" type="text/css" href="css/styles.css">-->


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
<div id="wrapper">

 <?php include './inc/headerNav.php';?>
  <div id="s-page-wrapper">

  <div class="row">

  <div class="col-lg-12 col-md-6 panel">
        <div class="panel panel-turq">
          <div class="panel-heading">
            <div class="row">
             <?php include './inc/subNav.php';?>
             </div>
          </div>
        </div>

    <!-- /.row -->

	<div role="main" class="container theme-showcase">
      <div class="" style="margin-top:90px;">
        <div class="col-lg-8">
			<div class="page-header">
				<h2 id="tables">Report Builder</h2>
			</div>
			<div class="bs-component" ng-controller="demoCtrl as demo">
				<div class="alert alert-info">
					<p>Skill String : {{demo.skill}}</p>
					<p>Status String : {{demo.status}}</p>
				</div>
				<form class="form-inline">
					<div class="form-group">
						<label >Search BY</label>
						<input type="text" ng-model="demo.skill" class="form-control" placeholder="Search by Skill">
					</div>
					<div class="form-group">
						<label >AND </label>
						<input type="text" ng-model="demo.status" class="form-control" placeholder="Search by Status">
					</div>
				</form>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Id
							</th>
							<th>Name
							</th>
							<th>Skill
							</th>
							<th>Status
							</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="user in demo.users|customSearch:demo.skill:demo.status">
							<td>{{user.id}}</td>
							<td>{{user.first_name}}</td>
							<td>{{user.skill}}</td>
							<td>{{user.status}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
      </div>
    </div>
    </div>
  <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
        <script src="./assets/js/angular.min.js"></script>
		<script src="app/appTableSearch.js"></script>
    </body>
</html>
