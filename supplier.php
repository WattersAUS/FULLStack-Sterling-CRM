<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Supplier Admin</title>
        <!-- include material design CSS -->
        <link rel="stylesheet" href="./assets/vendor/materialize/css/materialize.css" />
        <!-- include material design icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
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
        <?php include './inc/headerNav.php';?>
        <div class="container" ng-app="sterlingSupplierApp" ng-controller="supplierCtrl">
            <div class="row">
                <div class="col s12">
                    <h4>Suppliers</h4>
                    <!-- used for searching the current list -->
                    <input type="text" ng-model="search" class="form-control" placeholder="Search...">
                    <!-- table that shows product record list -->
                    <table class="hoverable bordered">
                        <thead>
                            <tr>
                                <th class="width-30-pct">Name</th>
                                <th class="width-30-pct">ShortName</th>
                                <th class="width-30-pct">Company RegNo</th>
                                <th class="width-30-pct">Website</th>
                                <th class="width-30-pct">Quote Email</th>
                            </tr>
                        </thead>
                        <tbody ng-init="getAll()">
                            <!-- <tr ng-repeat="d in names | filter:search"> -->
		                       <tr dir-paginate="supplier in supplier | filter:search | orderBy:sortKey | itemsPerPage:5" pagination-id="supplierx">
                                <td class="width-30-pct">{{ supplier.name }}</td>
                                <td class="width-30-pct">{{ supplier.shortname }}</td>
                                <td class="width-30-pct">{{ supplier.companyregno }}</td>
                                <td class="width-30-pct">{{ supplier.website }}</td>
                                <td class="width-30-pct">{{ supplier.quoteemail }}</td>
                                <td align="right">
                                    <a ng-click="readSupplier(supplier.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                                    <a ng-click="deleteSupplier(supplier.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        <!-- angular pagination -->
                        <dir-pagination-controls pagination-id="supplierx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                    </table>

                    <!-- modal for for creating new user -->
                    <div id="modal-supplier-form" class="modal">
                        <div class="modal-content">
                            <h4 id="modal-supplier-title">Add Supplier</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input ng-model="name" type="text" class="validate" id="form-name" placeholder="Supplier Name here..." />
                                    <label for="name">Supplier Name</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="shortname" type="text" class="validate" id="form-name" placeholder="Short Name here..." />
                                    <label for="shortname">Short Name</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="companyregno" type="text" class="validate" id="form-name" placeholder="Company Reg no here..." />
                                    <label for="companyregno">Company Reg no</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="website" type="text" class="validate" id="form-name" placeholder="Website here..." />
                                    <label for="website">Website</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="quoteemail" type="text" class="validate" id="form-name" placeholder="quoteemail here..." />
                                    <label for="quoteemail">quoteemail</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="experianscore" type="text" class="validate" id="form-name" placeholder="experianscore here..." />
                                    <label for="experianscore">experianscore</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="creditscore" type="text" class="validate" id="form-name" placeholder="creditscore here..." />
                                    <label for="creditscore">creditscore</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="credithardlimit" type="text" class="validate" id="form-name" placeholder="credithardlimit here..." />
                                    <label for="credithardlimit">credithardlimit</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="creditsoftlimit" type="text" class="validate" id="form-name" placeholder="creditsoftlimit here..." />
                                    <label for="creditsoftlimit">creditsoftlimit</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="creditoutstanding" type="text" class="validate" id="form-name" placeholder="creditoutstanding here..." />
                                    <label for="creditoutstanding">creditoutstanding</label>
                                </div>
                                <div class="input-field col s12">
                                    <a id="btn-create-supplier" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createSupplier()"><i class="material-icons left">add</i>Create</a>
                                    <a id="btn-update-supplier" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateSupplier()"><i class="material-icons left">edit</i>Save Changes</a>
                                    <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- floating button for creating product -->
                    <div class="fixed-action-btn" style="bottom:45px; right:24px;">
                        <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-supplier-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
                    </div>
                </div> <!-- end col s12 -->
            </div> <!-- end row -->
        </div> <!-- end container -->
        <!-- page content and controls will be here -->
        <!-- include angular js -->
        <script src="./assets/js/angular.min.js"></script>
        <!-- include angular pagination -->
        <script src="./assets/js/dirPagination.js"></script>
        <!-- include jquery -->
        <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
        <!-- material design js -->
        <script src="./assets/vendor/materialize/js/materialize.min.js"></script>
        <!-- custom js -->
        <script type="text/javascript" src="./assets/js/custom.js"></script>
        <!-- user -->
        <script type="text/javascript" src="./app/supplier.js"></script>
    </body>
</html>
