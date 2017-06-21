<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asset Types Admin</title>
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
        <div class="container" ng-app="sterlingAssetTypeApp" ng-controller="atCtrl">
            <div class="row">
                <div class="col s12">
                    <h4>Asset Type</h4>
                    <!-- used for searching the current list -->
                    <input type="text" ng-model="search" class="form-control" placeholder="Search...">

                    <!-- table that shows product record list -->
                    <table class="hoverable bordered">
                        <thead>
                            <tr>
                                <th class="width-30-pct">Type</th>
                                <th class="width-30-pct">Days to Review</th>
                            </tr>
                        </thead>
                        <tbody ng-init="getAll()">
                            <tr dir-paginate="assetType in assetTypes | filter:search | orderBy:sortKey | itemsPerPage:5" pagination-id="assettypex">
                                <td class="text-align-left">{{ assetType.type }}</td>
                                <td class="text-align-left">{{ assetType.daysToReview }}</td>
                                <td align="right">
                                    <a ng-click="readAssetType(assetType.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                                    <a ng-click="deleteAssetType(assetType.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        <!-- angular pagination -->
                        <dir-pagination-controls pagination-id="assettypex" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                    </table>

           <!-- modal for for creating new user -->
                    <div id="modal-assettype-form" class="modal">
                        <div class="modal-content">
                            <h1 id="modal-assettype-title">Add Asset Type</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input ng-model="type" type="text" class="validate" id="form-name" placeholder="Asset Type..." />
                                    <label for="type">Type</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="daysToReview" type="text" class="validate" id="form-name" placeholder="Days to Review..." />
                                    <label for="daysToReview">Days To Review</label>
                                </div>
                                <div class="input-field col s12">
                                    <a id="btn-create-assettype" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createAssetType()"><i class="material-icons left">add</i>Create</a>
                                    <a id="btn-update-assettype" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateAssetType()"><i class="material-icons left">edit</i>Save Changes</a>
                                    <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- floating button for creating product -->
                    <div class="fixed-action-btn" style="bottom:45px; right:24px;">
                        <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-assettype-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
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
        <script type="text/javascript" src="./app/asset_type.js"></script>
    </body>
</html>
