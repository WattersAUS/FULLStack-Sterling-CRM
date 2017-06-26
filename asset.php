<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asset Admin</title>
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
        <div class="container" ng-app="sterlingAssetApp" ng-controller="assetCtrl">
            <div >
                <div class="row input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input type="text" ng-model="search" class="form-control" placeholder="Search..." style="border: none">
                </div>
                <div >
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Asset</th>
                                <th>Allocated to</th>
                                <th>On date</th>
                            </tr>
                        </thead>
                        <tbody ng-init="get()">
                            <tr dir-paginate="asset in assets | filter:search | orderBy:sortKey | itemsPerPage:5" pagination-id="termx">
                                <td class="text-align-left">{{ asset.asset_name }} / {{ asset.asset_make }} / {{ asset.asset_model }}</td>
                                <td class="text-align-left">{{ asset.allocated_to_full_name }}</td>
                                <td class="text-align-left">{{ asset.asset_date_allocated }}</td>
                                <td align="right">
                                    <a ng-click="read(asset.asset_id)" class="waves-effect waves-light btn margin-bottom-1em">Edit</a>
                                    <a ng-click="allocate(asset.asset_id)" class="waves-effect waves-light btn margin-bottom-1em">Allocate</a>
                                    <a ng-click="delete(asset.asset_id)" class="waves-effect waves-light btn margin-bottom-1em">Delete</a>
                                </td>
                            </tr>
                        </tbody>

                        <!-- new asset modal -->
                        <script type="text/ng-template" id="newAsset.html">
                            <div class="row modal-header">
                                <h3 class="modal-title" id="modal-title">Add Asset</h4>
                            </div>
                            <div class="row modal-body" id="modal-body">
                                <div class="input-field">
                                    <label for="Description">description</label>
                                    <input ng-model="description" type="text" class="validate form-control" placeholder="Description here..." />
                                </div>
                                <div class="input-field">
                                    <label for="Days">days</label>
                                    <input ng-model="days" type="text" class="validate form-control" placeholder="Days here..." />
                                </div>
                            </div>
                            <div class="row modal-footer">
                                <a ng-click="save()" class="btn">Save</a>
                                <a ng-click="cancel()" class="btn">Cancel</a>
                            </div>
                        </script>

                        <!-- edit asset modal -->
                        <script type="text/ng-template" id="editAsset.html">
                            <div class="row modal-header">
                                <h3 class="modal-title" id="modal-title">Edit Asset</h4>
                            </div>
                            <div class="row modal-body" id="modal-body">
                                <div class="input-field">
                                    <label for="description">description</label>
                                    <input ng-model="description" type="text" class="validate form-control" placeholder="Description here..." />
                                </div>
                                <div class="input-field">
                                    <label for="days">days</label>
                                    <input ng-model="days" type="text" class="validate form-control" placeholder="Days here..." />
                                </div>
                            </div>
                            <div class="row modal-footer">
                                <a ng-click="save()" class="btn">Save</a>
                                <a ng-click="cancel()" class="btn">Cancel</a>
                            </div>
                        </script>

                        <!-- allocate asset modal -->
                        <script type="text/ng-template" id="allocAsset.html">
                            <div class="row modal-header">
                                <h3 class="modal-title" id="modal-title">Allocate Asset</h4>
                            </div>
                            <div class="row modal-body" id="modal-body">
                                <div class="input-field">
                                    <select class="form-control" name="selectemployee" id="selectemployee" ng-model="selectemployee" ng-options="e as e.full_name for e in employees" ng-change="onStatusSelect()">
                        					<option value="" disabled selected>Allocate to Employee</option>
                        			</select>
                                </div>
                                <div class="input-field">
                                    <label for="days">days</label>
                                    <input ng-model="days" type="text" class="validate form-control" placeholder="Days here..." />
                                </div>
                            </div>
                            <div class="row modal-footer">
                                <a ng-click="save()" class="btn">Save</a>
                                <a ng-click="cancel()" class="btn">Cancel</a>
                            </div>
                        </script>

                        <!-- angular pagination -->
                        <dir-pagination-controls pagination-id="termx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                    </table>
                </div>
                <div class="row" align="right">
                    <a href="#" class="btn" color="#FF0000" role="button" ng-click="create()">Add</a>
                </div>
            </div>
        </div> <!-- end container -->
        <!-- page content and controls will be here -->
        <!-- include angular js -->
        <script src="./assets/js/angular.min.js"></script>
        <!-- include angular js -->
        <script src="./assets/js/ui-bootstrap-tpls.min.js"></script>
        <!-- include angular pagination -->
        <script src="./assets/js/dirPagination.js"></script>
        <!-- include jquery -->
        <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
        <!-- user -->
        <script type="text/javascript" src="./app/asset.js"></script>
    </body>
</html>
