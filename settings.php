<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>System Settings</title>
        <!-- include material design CSS -->
        <link rel="stylesheet" href="./assets/materialize/css/materialize.css" />
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
        <div class="container" ng-app="sterlingSettingsApp" ng-controller="settingsCtrl">
            <div class="row">
                <div class="col s12">
                    <h4>System Settings</h4>
                    <!-- table that shows product record list -->
                    <table class="hoverable bordered">
                        <thead>
                            <tr>
                                <th class="width-30-pct">Company</th>
                                <th class="width-30-pct">Short Name</th>
                                <th class="width-30-pct">Reg No.</th>
                            </tr>
                        </thead>
                        <tbody ng-init="readSettings()">
                    		<tr>
                                <td class="width-30-pct">{{ companyName }}</td>
                                <td class="width-30-pct">{{ shortName }}</td>
                                <td class="width-30-pct">{{ companyRegNo }}</td>
                                <td align="right">
                                    <a ng-click="editSettings()" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                                </td>
                            </tr>
                        </tbody>
                        <!-- angular pagination -->
                        <!--<dir-pagination-controls pagination-id="settingsx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>-->
                    </table>

                     <!-- modal for for creating new user -->
                    <div id="modal-settings-form" class="modal">
                        <div class="modal-content">
                            <h4 id="modal-settings-title">Update Settings</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input ng-model="companyName" type="text" class="validate" id="form-name" placeholder="Company Name..." />
                                    <label for="companyName">Company Name</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="shortName" type="text" class="validate" id="form-name" placeholder="Short..." />
                                    <label for="shortName">Short Name</label>
                                </div>
                                <div class="input-field col s12">
                                    <input ng-model="companyRegNo" type="text" class="validate" id="form-name" placeholder="Reg001..." />
                                    <label for="companyRegNo">Company Reg No</label>
                                </div>
                    			<div class="input-field col s12">
                                    <input ng-model="webSite" type="text" class="validate" id="form-name" placeholder="http:..." />
                                    <label for="webSite">Web Site URL</label>
                                </div>
                    			<div class="input-field col s12">
                                    <input ng-model="defaultEmail" type="text" class="validate" id="form-name" placeholder="comp@work.co.uk..." />
                                    <label for="defaultEmail">Email</label>
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
                                    <input ng-model="telephoneNumber" type="text" class="validate" id="form-name" placeholder="Tel..." />
                                    <label for="telephoneNumber">Telephone</label>
                                </div>
                    			<div class="input-field col s12">
                                    <input ng-model="vatRate" type="text" class="validate" id="form-name" placeholder="Vat Rate..." />
                                    <label for="vatRate">Vat Rate</label>
                                </div>
                    			<div class="input-field col s12">
                                    <input ng-model="defaultKPIQuoteRtndBy" type="text" class="validate" id="form-name" placeholder="10..." />
                                    <label for="defaultKPIQuoteRtndBy">KPI Quote Returned by</label>
                                </div>
                    			<div class="input-field col s12">
                                    <input ng-model="defaultCreditHardLimit" type="text" class="validate" id="form-name" placeholder="0000..." />
                                    <label for="defaultCreditHardLimit">Credit Hard Limit</label>
                                </div>
                    			<div class="input-field col s12">
                                    <input ng-model="defaultCreditSoftLimit" type="text" class="validate" id="form-name" placeholder="000..." />
                                    <label for="defaultCreditSoftLimit">Credit Soft Limit</label>
                                </div>
                    			<div class="input-field col s12">
                                    <input ng-model="dateUpdated" type="text" class="validate" id="form-name" placeholder="date..." readonly />
                                    <label for="dateUpdated">Date last updated</label>
                                </div>
                                <div class="input-field col s12">
                                    <a id="btn-update-settings" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateSettings()"><i class="material-icons left">edit</i>Save Changes</a>
                                    <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                                </div>
                            </div>
                        </div>
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
        <script src="./assets/materialize/js/materialize.min.js"></script>
        <!-- custom js -->
        <script type="text/javascript" src="./assets/js/custom.js"></script>
        <!-- user -->
        <script type="text/javascript" src="./app/settings.js"></script>
    </body>
</html>
