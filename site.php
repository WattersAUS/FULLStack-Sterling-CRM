<!DOCTYPE html>
<html>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Site Admin</title>
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
        <!-- Navigation -->
        <?php include './inc/headerNav.php';?>
        <div class="container" ng-app="sterlingSiteApp" ng-controller="siteCtrl">
            <div class="row">
                <div class="col s12">
                    <h4>Sites</h4>
                    <!-- used for searching the current list -->
                    <input type="text" ng-model="search" class="form-control" placeholder="Search...">

                    <!-- table that shows product record list -->
                    <table class="hoverable bordered">
                        <thead>
                            <tr>
                                <th class="width-30-pct">Customer</th>
                                <th class="width-30-pct">Site</th>
                                <th class="width-30-pct">Address</th>
                                <th class="width-30-pct">Postcode</th>
                            </tr>
                        </thead>
                        <tbody ng-init="getAll()">
                            <tr dir-paginate="site in sites | filter:search | orderBy:sortKey | itemsPerPage:5" pagination-id="sitex">
                                <td class="width-30-pct">{{ site.customerName }}</td>
                                <td class="width-30-pct">{{ site.name }}</td>
                                <td class="width-30-pct">{{ site.address1 }}, {{ site.city }}</td>
                                <td class="width-30-pct">{{ site.postcode }}</td>
                                <td align="right">
                                    <a ng-click="readSite(site.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                                    <a ng-click="deleteSite(site.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        <!-- angular pagination -->
                        <dir-pagination-controls pagination-id="sitex" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                        </table>
                        <!-- modal for for creating new user -->
                        <div id="modal-site-create-form" class="modal">
                            <div class="modal-content">
                                <h4 id="modal-site-create">Create Site</h4>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="customer" id="customer" ng-model="customer" ng-options="c as c.name for c in customers" ng-change="onSelectAction()">
                                            <option value="">--Select Customer--</option>
                                        </select>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="name" type="text" class="validate" id="form-name" placeholder="Site Name..."/>
                                        <label for="name">Site Name</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="shortName" type="text" class="validate" id="form-name" placeholder="Short..." />
                                        <label for="shortName">Short Name</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="address1" type="text" class="validate" id="form-name" placeholder="Line 1..." />
                                        <label for="address1">Address Line 1</label>
                                    </div>
                        			<div class="input-field col s12">
                                        <input ng-model="address2" type="text" class="validate" id="form-name" placeholder="Line 2..." />
                                        <label for="address2">Address Line 2</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="city" type="text" class="validate" id="form-name" placeholder="City..." />
                                        <label for="city">City</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="county" type="text" class="validate" id="form-name" placeholder="Country..." />
                                        <label for="county">County</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="postcode" type="text" class="validate" id="form-name" placeholder="Postcode..." />
                                        <label for="postcode">Postcode</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <a id="btn-create-site" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createSite()"><i class="material-icons left">add</i>Create</a>
                                        <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- modal for updating site -->
                        <div id="modal-site-update-form" class="modal">
                            <div class="modal-content">
                                <h4 id="modal-site-update">Update Site</h4>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input ng-model="name" type="text" class="validate" id="form-name" placeholder="Site Name..." />
                                        <label for="name">Site Name</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="shortName" type="text" class="validate" id="form-name" placeholder="Short..." />
                                        <label for="shortName">Short Name</label>
                                    </div>
	                                <div class="input-field col s12">
                                        <input ng-model="address1" type="text" class="validate" id="form-name" placeholder="Line 1..." />
                                        <label for="address1">Address Line 1</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="address2" type="text" class="validate" id="form-name" placeholder="Line 2..." />
                                        <label for="address2">Address Line 2</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="city" type="text" class="validate" id="form-name" placeholder="City..." />
                                        <label for="city">City</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="county" type="text" class="validate" id="form-name" placeholder="Country..." />
                                        <label for="county">County</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="postcode" type="text" class="validate" id="form-name" placeholder="Postcode..." />
                                        <label for="postcode">Postcode</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <a id="btn-update-site" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateSite()"><i class="material-icons left">edit</i>Save Changes</a>
                                        <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- floating button for creating product -->
                        <div class="fixed-action-btn" style="bottom:45px; right:24px;">
                            <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-site-create-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
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
            <script type="text/javascript" src="./app/site.js"></script>
    </body>
</html>
