<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Employee Holiday/Sickness</title>
    <!-- Bootstrap Core CSS -->
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="./assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="./assets/vendor/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <!--<link href="../../vendor/morrisjs/morris.css" rel="stylesheet">-->
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
    <script>
     $(function () {
       var bindDatePicker = function() {
        $(".date").datetimepicker({
            format:'YYYY-MM-DD',
          icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
          }
        }).find('input:first').on("blur",function () {
          // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
          // update the format if it's yyyy-mm-dd
          var date = parseDate($(this).val());

          if (! isValidDate(date)) {
            //create date based on momentjs (we have that)
            date = moment().format('YYYY-MM-DD');
          }

          $(this).val(date);
        });
      }

       var isValidDate = function(value, format) {
        format = format || false;
        // lets parse the date to the best of our knowledge
        if (format) {
          value = parseDate(value);
        }

        var timestamp = Date.parse(value);

        return isNaN(timestamp) == false;
       }

       var parseDate = function(value) {
        var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
        if (m)
          value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

        return value;
       }

       bindDatePicker();
     });
        </script>
    </head>

    <body>
    <div id="wrapper">
      <?php include './inc/headerNav.php';?>
      <div id="s-page-wrapper">
        <div class="row">
          <div class="col-lg-12 col-md-12 panel">



                <!-- START : COVER PANEL 1  -->
                <div class="col-lg-8 col-md-6">
                  <div class="panel panel-turq">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-9 text-left">
                          <div class="panelTitle">Contact</div>
                        </div>
                      </div>
                    </div>

                    <div class="panel-body">
                      <div class="form-group input-group"> <span class="input-group-addon">First Name</span>
                        <input type="text" class="form-control" value="">
                      </div>
                      <div class="form-group input-group"> <span class="input-group-addon">Last Name</span>
                        <input type="text" class="form-control" value="">
                      </div>
                      <div class="form-group input-group"> <span class="input-group-addon">Job Title</span>
                        <input type="text" class="form-control" value="">
                      </div>
                      <div class="form-group input-group"> <span class="input-group-addon">Holiday Entitlement</span>
                        <input type="text" class="form-control" value="" size="12">
                      </div>
                      <div class="form-group input-group"> <span class="input-group-addon">Holidays Remaining</span>
                        <input type="text" class="form-control" value="" size="12">
                      </div>
                      <div class="form-group input-group"> <span class="input-group-addon">Employee Email</span>
                        <input type="text" class="form-control" value="">
                      </div>
                      <div class="form-group input-group"> <span class="input-group-addon">Manager Email</span>
                        <input type="text" class="form-control" value="">
                      </div>







    <div class="row">
        Date formats: yyyy-mm-dd, yyyymmdd, dd-mm-yyyy, dd/mm/yyyy, ddmmyyyyy
      </div>
      <br />
        <div class="row">
            <div class='col-sm-3'>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>





                    </div>
                  </div>
                </div>
                <!-- END : COVER PANEL 1  -->


    <!-- START : COVER PANEL 2A  -->
                  <div class="col-lg-4 col-md-6">
                    <div class="panel panel-turq">
                     <div class="panel-heading">
                        <div class="row">
                         <div class="col-xs-9 text-left">
                           <div class="panelTitle">Holiday Booking</div>
                         </div>
                        </div>
                      </div>
                      <div class="panel-body">
                      <div class="form-group input-group"> <span class="input-group-addon">Date From</span>
                        <input type="text" class="form-control" value="">
                      </div>
                      <div class="form-group input-group"> <span class="input-group-addon">Date To</span>
                        <input type="text" class="form-control" value="">
                      </div>
                      <div class="form-group input-group"> <span class="input-group-addon">Days Requested</span>
                        <input type="text" class="form-control" value="" size="10"><span class="input-group-addon">Days Remaining</span>
                        <input type="text" class="form-control" value="" size="10">
                      </div>
                      <div class="form-group input-group"> <span class="input-group-addon">Reason</span>
                        <div class="form-group">

                                                <select class="form-control">
                                                    <option>Holiday</option>
                                                    <option>Sickness</option>
                                                </select>
                                            </div>
                      </div>

                      <div class="col-lg-12 col-md-12">
                            <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">Cancel</a>
                            <a ng-click="" class="waves-effect waves-light btn margin-bottom-1em">Send</a>
                        </div>
                      </div>
                    </div>
                  </div>
            <!-- END : COVER PANEL 2A  -->

                </div>
                <!-- END : COVER PANEL 1  -->


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
