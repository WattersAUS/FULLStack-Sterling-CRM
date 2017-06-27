<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Site Admin</title>
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
        <div class="container" ng-app="sterlingSiteApp" ng-controller="siteCtrl">
            <div >
                <div class="row input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input type="text" ng-model="search" class="form-control" placeholder="Search..." style="border: none">
                </div>
                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="width-30-pct">Customer</th>
                                <th class="width-30-pct">Site</th>
                                <th class="width-30-pct">Address</th>
                                <th class="width-30-pct">Postcode</th>
                            </tr>
                        </thead>
                        <tbody ng-init="get()">
                            <tr dir-paginate="site in sites | filter:search | orderBy:sortKey | itemsPerPage:5" pagination-id="sitex">
                                <td class="width-30-pct">{{ site.customer_name }}</td>
                                <td class="width-30-pct">{{ site.site_name }}</td>
                                <td class="width-30-pct">{{ site.site_address1 }}, {{ site.site_city }}</td>
                                <td class="width-30-pct">{{ site.site_postcode }}</td>
                                <td align="right">
                                    <a ng-click="read(site.site_id)" class="waves-effect waves-light btn margin-bottom-1em">Edit</a>
                                    <a ng-click="delete(site.site_id)" class="waves-effect waves-light btn margin-bottom-1em">Delete</a>
                                </td>
                            </tr>
                        </tbody>

                    <!-- angular pagination -->
                    <dir-pagination-controls pagination-id="sitex" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                </table>
            </div>
            <div class="row" align="right">
                <a href="#" class="btn" color="#FF0000" role="button" ng-click="create()">Add</a>
            </div>

            <!-- edit site modal -->
            <script type="text/ng-template" id="newSite.html">
                <div class="row modal-header">
                    <h3 class="modal-title" id="modal-title">New Site</h4>
                </div>
                <div class="row modal-body" id="modal-body">
                    <div class="input-field">
                        <select ng-model="site_customer_id">
                            <option ng-repeat="c in customers" value="{{c.customer_id}}">{{c.customer_name}}</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="site_name">Site Name</label>
                        <input ng-model="site_name" type="text" class="validate form-control" placeholder="Site Name..."/>
                    </div>
                    <div class="input-field">
                        <label for="site_shortname">Short Name</label>
                        <input ng-model="site_shortname" type="text" class="validate form-control" placeholder="Short..." />
                    </div>
                    <div class="input-field">
                        <label for="site_address1">Address Line 1</label>
                        <input ng-model="site_address1" type="text" class="validate form-control" placeholder="Line 1..." />
                    </div>
                    <div class="input-field">
                        <label for="site_address2">Address Line 2</label>
                        <input ng-model="site_address2" type="text" class="validate form-control" placeholder="Line 2..." />
                    </div>
                    <div class="input-field">
                        <label for="site_city">City</label>
                        <input ng-model="site_city" type="text" class="validate form-control" placeholder="City..." />
                    </div>
                    <div class="input-field">
                        <label for="site_county">County</label>
                        <input ng-model="site_county" type="text" class="validate form-control" placeholder="Country..." />
                    </div>
                    <div class="input-field">
                        <label for="site_postcode">Postcode</label>
                        <input ng-model="site_postcode" type="text" class="validate form-control" placeholder="Postcode..." />
                    </div>
                </div>
                <div class="row modal-footer">
                    <a ng-click="save()" class="btn">Save</a>
                    <a ng-click="cancel()" class="btn">Cancel</a>
                </div>
            </script>

            <script type="text/ng-template" id="editSite.html">
                <div class="row modal-header">
                    <h3 class="modal-title" id="modal-title">Edit Site</h4>
                </div>
                <div class="row modal-body" id="modal-body">
                    <div class="input-field">
                        <select ng-model="site_customer_id">
                            <option ng-repeat="c in customers" value="{{c.customer_id}}" ng-selected="c.customer_id === site_customer_id">{{c.customer_name}}</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="site_name">Site Name</label>
                        <input ng-model="site_name" type="text" class="validate form-control" placeholder="Site Name..."/>
                    </div>
                    <div class="input-field">
                        <label for="site_shortname">Short Name</label>
                        <input ng-model="site_shortname" type="text" class="validate form-control" placeholder="Short..." />
                    </div>
                    <div class="input-field">
                        <label for="site_address1">Address Line 1</label>
                        <input ng-model="site_address1" type="text" class="validate form-control" placeholder="Line 1..." />
                    </div>
                    <div class="input-field">
                        <label for="site_address2">Address Line 2</label>
                        <input ng-model="site_address2" type="text" class="validate form-control" placeholder="Line 2..." />
                    </div>
                    <div class="input-field">
                        <label for="site_city">City</label>
                        <input ng-model="site_city" type="text" class="validate form-control" placeholder="City..." />
                    </div>
                    <div class="input-field">
                        <label for="site_county">County</label>
                        <input ng-model="site_county" type="text" class="validate form-control" placeholder="Country..." />
                    </div>
                    <div class="input-field">
                        <label for="site_postcode">Postcode</label>
                        <input ng-model="site_postcode" type="text" class="validate form-control" placeholder="Postcode..." />
                    </div>
                </div>
                <div class="row modal-footer">
                    <a ng-click="save()" class="btn">Save</a>
                    <a ng-click="cancel()" class="btn">Cancel</a>
                </div>
            </script>

        </div>
    </div> <!-- end container -->
    <!-- include angular js -->
    <script src="./assets/js/angular.min.js"></script>
    <!-- include angular js -->
    <script src="./assets/js/ui-bootstrap-tpls.min.js"></script>
    <!-- include angular pagination -->
    <script src="./assets/js/dirPagination.js"></script>
    <!-- include jquery -->
    <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
    <!-- user -->
    <script type="text/javascript" src="./app/site.js"></script>
</body>
</html>
