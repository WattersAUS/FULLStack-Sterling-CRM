<!DOCTYPE html>
<!--suppress XmlInvalidId -->
<html>
    <head>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Read Customers</title>
         <!-- Bootstrap Core CSS -->
         <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

        <!-- MetisMenu CSS -->
        <link href="./assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet" />

        <!-- Custom CSS -->
        <link href="./assets/vendor/dist/css/sb-admin-2.css" rel="stylesheet" />

        <!-- Morris Charts CSS -->
        <link href="./assets/vendor/morrisjs/morris.css" rel="stylesheet" />

        <!-- Custom Fonts -->
        <link href=".,/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

          <!-- include material design CSS -->
        <link rel="stylesheet" href="./assets/css/materialize/css/materialize.css" />

        <!-- include material design icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

        <!-- include custom CSS -->
        <link rel="stylesheet" href="./assets/css/custom.css" />

        <!-- Sterling CSSS -->
        <link href="./assets/css/style.css" rel="stylesheet" type="text/css" />


    </head>
    <body  ng-app="myApp">
    <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header">
          <a class="navbar-brand" href="/sterling/index.php"><img src="/sterling/images/ss-logo.png"></a>
        </div>
        <!-- /.navbar-header -->
        <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button> -->
        <ul class="nav navbar-top-links navbar-right">
          <li> <a href="/sterling/index.php"> <i class="fa fa-home fa-fw"></i>
            <div class="nav_txt">Home</div>
            </a> </li>
          <!-- /.dropdown -->
          <li> <a href="/sterling/admin.php"> <i class="fa fa-users fa-fw"></i>
            <div class="nav_txt">Admin</div>
            </a> </li>
          <!-- /.dropdown -->
          <li> <a href="/sterling/records.php"> <i class="fa fa-tasks fa-fw"></i>
            <div class="nav_txt">Records</div>
            </a> </li>
          <!-- /.dropdown -->
          <li> <a href="#"> <i class="fa fa-envelope fa-fw"></i>
            <div class="nav_txt">e-Mail</div>
            </a> </li>
          <!-- /.dropdown -->
          <li> <a href="#"> <i class="fa fa-list-ol fa-fw"></i>
            <div class="nav_txt">PO's</div>
            </a> </li>
          <li> <a href="#"> <i class="fa fa-user fa-fw"></i>
            <div class="nav_txt">Resources</div>
            </a> </li>
          <li> <a href="#"> <i class="fa fa-list fa-fw"></i>
            <div class="nav_txt">Reports</div>
            </a> </li>
          <li> <a href="#"> <i class="fa fa-book fa-fw"></i>
            <div class="nav_txt">Buyers</div>
            </a> </li>
          <li> <a href="#"> <i class="fa fa-money fa-fw"></i>
            <div class="nav_txt">Payroll</div>
            </a> </li>
          <li> <a href="#"> <i class="fa fa-gbp fa-fw"></i>
            <div class="nav_txt">Quotes</div>
            </a> </li>
          <li> <a href="#"> <i class="fa fa-user fa-fw"></i>
            <div class="nav_txt">Hire</div>
            </a> </li>
          <li> <a href="#"> <i class="fa fa-user fa-fw"></i>
            <div class="nav_txt">Stock</div>
            </a> </li>
          <li> <a href="#"> <i class="fa fa-user fa-fw"></i>
            <div class="nav_txt">Old Sys</div>
            </a> </li>
          <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
      </nav>
    <div class="container" ng-controller="authCtrl" ng-init="userStatus()">
        <div ng-hide="isLoggedIn">
            Not logged in
        </div>
        <div ng-show="isLoggedIn">
            Logged in as {{userTitle}} {{userFirstName}} {{userLastName}}<br />
            <button ng-click="logout()">Logout</button>
        </div>
        <!-- modal for logint -->
        <div id="modal-login-form" class="modal">
            <div class="modal-content">
                <h4 id="modal-login-title">Login</h4>
                <div class="row">
                    <div class="input-field col s12">
                        <input ng-model="username" type="text" class="validate" id="form-username" placeholder="User Name here..." />
                        <label for="username">Username</label>
                    </div>
                    <div class="input-field col s12">
                        <input ng-model="password" type="password" class="validate" id="form-password" placeholder="" />
                        <label for="password">Password</label>
                    </div>
                    <div class="input-field col s12">
                        <a id="btn-login" class="waves-effect waves-light btn margin-bottom-1em" ng-click="login()"><i class="material-icons left">add</i>Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

         <div class="container" ng-controller="customersCtrl">
            <div class="row">
                <div class="col s12">
                    <h4>Customers</h4>

                    <!-- data from database will be here -->

                    <!-- used for searching the current list -->
                    <input type="text" ng-model="search" class="form-control" placeholder="Search customer...">

                    <!-- table that shows product record list -->
                    <table class="hoverable bordered">
                        <thead>
                            <tr>
                                <th class="text-align-center">ID</th>
                                <th class="width-30-pct">Name</th>
                                <th class="width-30-pct">Type</th>
                                <th class="width-30-pct">Website</th>
                                <th class="text-align-center">TermsId</th>
                                <th class="text-align-center">DaysToReview</th>
                            </tr>
                        </thead>
                        <tbody ng-init="getAll()">
                                 <!-- <tr ng-repeat="d in names | filter:search"> -->
                            <tr dir-paginate="d in names | filter:search | orderBy:sortKey:reverse | itemsPerPage:20" pagination-id="custx">
                                <td class="text-align-center">{{ d.Id }}</td>
                                <td>{{ d.Name }}</td>
                                <td>{{ d.Type }}</td>
                                <td>{{ d.Website }}</td>
                                <td class="text-align-center">{{ d.TermsId }}</td>
                                <td class="text-align-center">{{ d.DaysToReview }}</td>
                                <td>
                                    <a ng-click="readOne(d.Id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                                    <a ng-click="deleteCustomers(d.Id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                                </td>
                            </tr>
                             </tbody>
                              <!-- angular pagination -->
                                <dir-pagination-controls pagination-id="custx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>

                    </table>

                     <!-- modal for for creating new product -->
                    <div id="modal-product-form" class="modal">
                        <div class="modal-content">
                            <h4 id="modal-product-title">Create New Customer</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input ng-model="EmployeeId" type="text" class="validate" id="form-name" placeholder="User Name here..." />
                                    <label for="EmployeeId">EmployeeId</label>
                                </div>
                                <div class="input-field col s12">
                                    <textarea ng-model="Name" class="validate materialize-textarea" placeholder="First Name here..."></textarea>
                                    <label for="Name">Name</label>
                                </div>
                                <div class="input-field col s12">
                                    <textarea ng-model="Shortname" class="validate materialize-textarea" placeholder="Last Name here..."></textarea>
                                    <label for="Shortname">Shortname</label>
                                </div>
                                <div class="input-field col s12">
                                    <textarea ng-model="Type" class="validate materialize-textarea" placeholder="Email here..."></textarea>
                                    <label for="Type">Type</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="Companyregno" type="text" class="validate" id="form-price" placeholder="Status here..." />
                                    <label for="Companyregno">Status</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="Website" type="text" class="validate" id="form-Website" placeholder="Status here..." />
                                    <label for="Website">Website</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="KpiQuoteRtndBy" type="text" class="validate" id="form-KpiQuoteRtndBy" placeholder="Status here..." />
                                    <label for="KpiQuoteRtndBy">KpiQuoteRtndBy</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="ExperianScore" type="text" class="validate" id="form-ExperianScore" placeholder="Status here..." />
                                    <label for="ExperianScore">ExperianScore</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="CreditScore" type="text" class="validate" id="form-CreditScore" placeholder="Status here..." />
                                    <label for="CreditScore">CreditScore</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="CreditHardLimit" type="text" class="validate" id="form-CreditHardLimit" placeholder="Status here..." />
                                    <label for="CreditHardLimit">CreditHardLimit</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="CreditSoftLimit" type="text" class="validate" id="form-CreditSoftLimit" placeholder="Status here..." />
                                    <label for="CreditSoftLimit">CreditSoftLimit</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="CreditOutstanding" type="text" class="validate" id="form-CreditOutstanding" placeholder="Status here..." />
                                    <label for="CreditOutstanding">CreditOutstanding</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="TermsId" type="text" class="validate" id="form-TermsId" placeholder="Status here..." />
                                    <label for="TermsId">TermsId</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="KpiAgreed" type="text" class="validate" id="form-KpiAgreed" placeholder="Status here..." />
                                    <label for="KpiAgreed">KpiAgreed</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="QuoteBreakdownRqrd" type="text" class="validate" id="form-QuoteBreakdownRqrd" placeholder="Status here..." />
                                    <label for="QuoteBreakdownRqrd">QuoteBreakdownRqrd</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="QuoteRtnTrigger" type="text" class="validate" id="form-QuoteRtnTrigger" placeholder="Status here..." />
                                    <label for="QuoteRtnTrigger">QuoteRtnTrigger</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="DaysToReview" type="text" class="validate" id="formDaysToReview" placeholder="Status here..." />
                                    <label for="DaysToReview">DaysToReview</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="DateUpdated" type="text" class="validate" id="form-DateUpdated" placeholder="Status here..." />
                                    <label for="DateUpdated">DateUpdated</label>
                                </div>
                                <div class="input-field col s12">
                                    <a id="btn-create-product" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateCustomers()"><i class="material-icons left">add</i>Create</a>

                                    <a id="btn-update-product" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateCustomers()"><i class="material-icons left">edit</i>Save Changes</a>

                                    <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- floating button for creating product -->
                    <div class="fixed-action-btn" style="bottom:45px; right:24px;">
                        <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-product-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
                    </div>

                </div> <!-- end col s12 -->
            </div> <!-- end row -->
        </div> <!-- end container -->



        <!-- page content and controls will be here -->


    <!-- include angular js -->
    <script type="text/javascript" src="./assets/js/angular.js" ></script>
    <script type="text/javascript" src="./assets/js/ngStorage.min.js"></script>
    <!-- include angular pagination -->
    <script type="text/javascript" src="./assets/js/dirPagination.js" ></script>

    <!-- app -->
    <script type="text/javascript" src="./app/app.js"></script>

    <!-- include jquery -->
    <script type="text/javascript" src="./assets/js/jquery.js"></script>

    <script type="text/javascript" src="./assets/materialize/_js/materialize.js" ></script>

    <!-- custom js -->
    <script type="text/javascript" src="./assets/js/custom.js"></script>

    <!-- customers -->
    <script type="text/javascript" src="./app/customers/customers.js"></script>

     <!-- user -->
     <script type="text/javascript" src="./app/user/auth.js"></script>

    </body>
</html>
