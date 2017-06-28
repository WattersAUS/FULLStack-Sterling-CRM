var app = angular.module('standardApp', ['angularUtils.directives.dirPagination']);
app.controller('customersCtrl', function($scope, $http) {


 // retrieve record to fill out the form
$scope.readOne = function(id){

    // change modal title
    $('#modal-product-title').text("Edit Customer");

    // show udpate product button
    $('#btn-update-product').show();

    // show create product button
    $('#btn-create-product').hide();

    // post id of product to be edited
    $http({
        method: 'GET',
        url: '/ssdata_api/customer/' + id
    }).then(function successCallback(response) {

        // put the values in form
        $scope.CustomerId = response.data.Id;
        $scope.EmployeeId = response.data.EmployeeId;
        $scope.Name = response.data.Name;
        $scope.Shortname = response.data.Shortname;
        $scope.Type = response.data.Type;
        $scope.Companyregno = response.data.Companyregno;
        $scope.Website = response.data.Website;
        $scope.KpiQuoteRtndBy = response.data.KpiQuoteRtndBy;
        $scope.ExperianScore = response.data.ExperianScore;
        $scope.CreditScore = response.data.CreditScore;
        $scope.CreditHardLimit = response.data.CreditHardLimit;
        $scope.CreditSoftLimit = response.data.CreditSoftLimit;
        $scope.CreditOutstanding = response.data.CreditOutstanding;
        $scope.TermsId = response.data.TermsId;
        $scope.KpiAgreed = response.data.KpiAgreed;
        $scope.QuoteBreakdownRqrd = response.data.QuoteBreakdownRqrd;
        $scope.QuoteRtnTrigger = response.data.QuoteRtnTrigger;
        $scope.DaysToReview = response.data.DaysToReview;
        $scope.DateUpdated = response.data.DateUpdated;

        // show modal
        $('#modal-product-form').modal('open');
    });
    //.error(function(data, status, headers, config){
    //    Materialize.toast('Unable to retrieve record.', 4000);
    //});
}


 // read customers
$scope.getAll = function(){
    $http({
        method: 'GET',
        url: '/ssdata_api/customers'
    }).then(function successCallback(response) {
        $scope.names = response.data.Customers;
    });
}


  // delete customers
$scope.deleteCustomers = function(id){

    // ask the user if he is sure to delete the record
    if(confirm("Are you sure?")){

        $http({
            method: 'POST',
            data: { 'Id' : id },
            url: '/ssdata_api/customerDelete'
        }).then(function successCallback(response) {

            // tell the user product was deleted
            Materialize.toast(response.data, 4000);

            // refresh the list
            $scope.getAll();
        });
    }
}


 $scope.showCreateForm = function(){

    // clear form
    $scope.clearForm();

    // change modal title
    $('#modal-product-title').text("Create New Customer");

    // hide update customers button
    $('#btn-update-product').hide();

    // show create customers button
    $('#btn-create-product').show();

}

// clear variable / form values
$scope.clearForm = function(){
    // put the values in form
    $scope.CustomerId = '';
    $scope.EmployeeId = '';
    $scope.Name = '';
    $scope.Shortname = '';
    $scope.Type = '';
    $scope.Companyregno = '';
    $scope.Website = '';
    $scope.KpiQuoteRtndBy = '';
    $scope.ExperianScore = '';
    $scope.CreditScore = '';
    $scope.CreditHardLimit = '';
    $scope.CreditSoftLimit = '';
    $scope.CreditOutstanding = '';
    $scope.TermsId = '';
    $scope.KpiAgreed = '';
    $scope.QuoteBreakdownRqrd = '';
    $scope.QuoteRtnTrigger = '';
    $scope.DaysToReview = '';
    $scope.DateUpdated = '';
}


// create new customers
$scope.upsertCustomer = function(){

    $http({
        method: 'POST',
        data: {
            "Id" : $scope.CustomerId,
            "EmployeeId" : $scope.EmployeeId,
            "Name" : $scope.Name,
            "Shortname" : $scope.Shortname,
            "Type" : $scope.Type,
            "Companyregno" : $scope.Companyregno,
            "Website" : $scope.Website,
            "KpiQuoteRtndBy" : $scope.KpiQuoteRtndBy,
            "ExperianScore" : $scope.ExperianScore,
            "CreditScore" : $scope.CreditScore,
            "CreditHardLimit" : $scope.CreditHardLimit,
            "CreditSoftLimit" : $scope.CreditSoftLimit,
            "CreditOutstanding" : $scope.CreditOutstanding,
            "TermsId" : $scope.TermsId,
            "KpiAgreed" : $scope.KpiAgreed,
            "QuoteBreakdownRqrd" : $scope.QuoteBreakdownRqrd,
            "QuoteRtnTrigger" : $scope.QuoteRtnTrigger,
            "DaysToReview" : $scope.DaysToReview,
            "DateUpdated" : $scope.DateUpdated
        },
        url: '/ssdata_api/customerUpdate'
    }).then(function successCallback(response) {

        // tell the user new product was created
        Materialize.toast(response.data, 4000);

        // close modal
        $('#modal-product-form').modal('close');

        // clear modal content
        $scope.clearForm();

        // refresh the list
        $scope.getAll();
    });
}

// Listen to 'myEvent' from any parent controller
    $scope.$on('UserLogInEvent', function(event, data){
        $scope.getAll();
    });

});
