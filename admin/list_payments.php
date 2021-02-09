<?php

include('../config/db_config.php');
include('sql_queries.php');

include('delete_payment.php');
include('delete_yearlypayment.php');


// include('list_individual.php');




session_start();
$user_id = $_SESSION['id'];

include('verify_admin.php');
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
} else {
}



date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');
$now = new DateTime();

$objid = $objid1 = $masname = $person_status =  $entity_no  =  $address  =
  $contact_number  = $fullname = $date_from = $date_to = $ornomas = $mobile_no = $ydate_from = $ydate_to = $barangay = $ornomas1 = $yornomas = '';

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $db_fullname = $result['fullname'];
}


$get_all_brgy_sql = "SELECT * FROM barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();

$get_all_brgy1_sql = "SELECT * FROM barangay";
$get_all_brgy1_data = $con->prepare($get_all_brgy1_sql);
$get_all_brgy1_data->execute();

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SENIOR CITIZEN | DAILY PAYMENT </title>
  <?php include('heading.php'); ?>


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


      <!-- <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div> -->

      <section class="content">

        <br>
        <div class="card-header p-2 bg-success text-white">

          <div class="nav nav-pills" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-daily" role="tab" aria-controls="nav-home" aria-selected="true">DAILY PAYMENT REPORTS</a>
            <a class="nav-item nav-link" id="nav-yearly-tab" data-toggle="tab" href="#nav-yearly" role="tab" aria-controls="nav-yearly" aria-selected="true">YEARLY PAYMENT REPORTS </a>


          </div>
        </div>

<!-- DAILY PAYMENT -->
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-daily" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="card">

              <div class="card-body">
                <div class="box box-primary">
                  <form role="form" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-12" style="margin-bottom:30px;padding:auto;">


                          <div class="input-group date">
                            <label style="padding-right:10px;padding-left: 10px">From: </label>
                            <div style="padding-right:10px" class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input style="margin-right:10px;" type="text" data-provide="datepicker" class="form-control col-3 " style="font-size:13px" autocomplete="off" name="datefrom" id="dtefrom" value="<?php echo $date_from; ?>">

                            <label style="padding-right:10px">To:</label>
                            <div style="padding-right:10px" class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" style="margin-right:50px;" class="form-control col-3 " data-provide="datepicker" autocomplete="off" name="dateto" id="dteto" value="<?php echo $date_to; ?>">


                          </div><br>

                          <div class="input-group date">


                            <label style="padding-right:10px;padding-left: 10px">OR No: </label>
                            <div style="padding-right:12px" class="input-group-addon">

                            </div>
                            <div class="col-md-3">
                              <input type="text" class="form-control" id="ornomas" name="ornomas" placeholder="OR NO." value="<?php echo $ornomas; ?>" required>
                            </div>
                          </div><br>


                          <div class="input-group date">
                            <label style="padding-right:30px;padding-left: 10px">BRGY: </label>


                            <div class="col-md-3">
                              <!-- <label>Barangay: </label> -->
                              <select class="form-control select2" id="barangay" style="width: 100%;" name="barangay" value="<?php echo $barangay; ?>" required>
                                <option value="" selected="selected">Select Barangay</option>
                                <?php while ($get_brgy = $get_all_brgy_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                  <option value="<?php echo $get_brgy['brgy']; ?>"><?php echo $get_brgy['brgy']; ?></option>

                                <?php } ?>

                              </select>


                            </div>


                            <button id="list_payments" onClick="loadhistory()" class="btn btn-success"><i class="fa fa-search"></i></button>
                            <!-- <input  id="person_ornomas" value="<?php echo $ornomas; ?>"> -->
                            <label style="padding-right:10px;padding-left: 10px"> </label>
                            <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/payments.php?ornomas=<?php echo $ornomas; ?>&datefrom=<?php echo $date_from; ?>&dateto=<?php echo $date_to; ?>">

                              <i class="nav-icon fa fa-print"></i></a>
                          </div><br> 

                          <div class="input-group date">


                            <label style="padding-right:10px;padding-left: 5px">COUNT: </label>
                            <div style="padding-right:12px" class="input-group-addon">

                            </div>
                            <div class="col-md-1">
                              <input type="text" readonly class="form-control" id="count" name="count" placeholder="count">
                            </div>

                            <label style="padding-right:10px;padding-left: 5px">TOTAL: </label>
                            <div style="padding-right:5px" class="input-group-addon">

                            </div>
                            <div class="col-md-1">
                              <input type="text" readonly class="form-control" id="amount" name="amount" placeholder="Amount">
                            </div>
                          </div><br>



                          <div class="table-responsive">



                            <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                              <thead align="center">



                                <th> OBJID </th>
                                <th> NAME</th>
                                <th> DATE</th>
                                <th> OR#</th>
                                <th> AMOUNT </th>
                                <th> BRGY. </th>
                                <th> Options </th>


                              </thead>
                              <tbody id="daily_payment">

                              </tbody>
                            </table>


                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

            </div>

          </div>


          <!-- YEARLY PAYMENT -->
          <div class="tab-pane fade" id="nav-yearly" role="tabpanel" aria-labelledby="nav-yearly-tab">
            <div class="card">
              <div class="card-body">
                <div class="box box-primary">
                  <form role="form" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-12" style="margin-bottom:30px;padding:auto;">


                          <div class="input-group date">
                            <label style="padding-right:10px;padding-left: 10px">From: </label>
                            <div style="padding-right:10px" class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input style="margin-right:10px;" type="text" data-provide="datepicker" class="form-control col-3 " style="font-size:13px" autocomplete="off" name="ydatefrom" id="ydtefrom" value="<?php echo $ydate_from; ?>">

                            <label style="padding-right:10px">To:</label>
                            <div style="padding-right:10px" class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" style="margin-right:50px;" class="form-control col-3 " data-provide="datepicker" autocomplete="off" name="ydateto" id="ydteto" value="<?php echo $ydate_to; ?>">


                          </div><br>

                          <div class="input-group date">


                            <label style="padding-right:10px;padding-left: 10px">OR No: </label>
                            <div style="padding-right:12px" class="input-group-addon">

                            </div>
                            <div class="col-md-3">
                              <input type="text" class="form-control" id="yornomas" name="yornomas" placeholder="OR NO." value="<?php echo $yornomas; ?>">
                            </div>
                          </div><br>


                          <div class="input-group date">
                            <label style="padding-right:30px;padding-left: 10px">BRGY: </label>


                            <div class="col-md-3">
                              <!-- <label>Barangay: </label> -->
                              <select class="form-control select2" id="ybarangay" style="width: 100%;" name="ybarangay" value="<?php echo $ybarangay; ?>">
                                <option value="" selected="selected">Select Barangay</option>
                                <?php while ($get_brgy1 = $get_all_brgy1_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                  <option value="<?php echo $get_brgy1['brgy']; ?>"><?php echo $get_brgy1['brgy']; ?></option>

                                <?php } ?>

                              </select>


                            </div>


                            <button id="ylist_payments" onClick="yloadhistory()" class="btn btn-success"><i class="fa fa-search"></i></button>
                            <!-- <input  id="person_ornomas" value="<?php echo $ornomas; ?>"> -->
                            <label style="padding-right:10px;padding-left: 10px"> </label>
                            <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/payments.php?ornomas=<?php echo $ornomas; ?>&datefrom=<?php echo $date_from; ?>&dateto=<?php echo $date_to; ?>">

                              <i class="nav-icon fa fa-print"></i></a>
                          </div><br>

                          <div class="input-group date">


                            <label style="padding-right:10px;padding-left: 5px">COUNT: </label>
                            <div style="padding-right:12px" class="input-group-addon">

                            </div>
                            <div class="col-md-1">
                              <input type="text" readonly class="form-control" id="count" name="count" placeholder="count">
                            </div>

                            <label style="padding-right:10px;padding-left: 5px">TOTAL: </label>
                            <div style="padding-right:5px" class="input-group-addon">

                            </div>
                            <div class="col-md-1">
                              <input type="text" readonly class="form-control" id="amount" name="amount" placeholder="Amount">
                            </div>
                          </div><br>



                          <div class="table-responsive">



                            <table style="overflow-x: auto;" id="users2" name="user" class="table table-bordered table-striped">
                              <thead align="center">



                                <th> OBJID </th>
                                <th> NAME</th>
                                <th> DATE</th>
                                <th> OR#</th>
                                <th> AMOUNT </th>
                                <th> BRGY. </th>
                                <th> Options </th>


                              </thead>
                              <tbody id="yearly_payment">

                              </tbody>
                            </table>


                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>


        </div>
      </section>




    </div>

    <?php include('footer.php') ?>

  </div>


  <div class="modal fade" id="delete_member" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Delete Record?</label>
                <input readonly="true" type="text" name="fullname2" id="fullname2" class="form-control">
                <input readonly="true" type="text" name="objid5" id="objid5" class="form-control">
              </div>



            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
            <input type="submit" name="delete_payment" class="btn btn-danger" value="Yes">
          </div>
        </form>


      </div>
    </div> <!-- /.modal-content -->
  </div> <!-- /.modal-dialog -->



  <div class="modal fade" id="delete_yearlypayment" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Delete Record?</label>
                <input readonly="true" type="text" name="yfullname2" id="yfullname2" class="form-control">
                <input readonly="true" type="text" name="yobjid" id="yobjid" class="form-control">
              </div>
            </div>
          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
            <!-- <button type="submit" name="delete_user" class="btn btn-danger">Yes</button> -->
            <input type="submit" name="delete_yearly" class="btn btn-danger" value="Yes">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>






  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- datepicker -->
  <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <!-- DataTables Bootstrap -->
  <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/select2.full.min.js"></script>

  <script>
    $('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true
     

    });
    $('.select2').select2();

    $('#users2').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true
   

    });


    // $('#addPUM').on('hidden.bs.modal', function() {
    //   $('#addPUM form')[0].reset();
    // });

    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });



    function loadhistory() {
      event.preventDefault();
      var ornomas = $('#ornomas').val();
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();
      var barangay = $('#barangay').val();
      var amount = $('#amount').val();



      $('#daily_payment').load("load_dailypaymentreport.php", {
          ornomas: ornomas,
          date_from: date_from,
          date_to: date_to,
          barangay: barangay,
          amount: amount




        },


        function(response, status, xhr) {
          if (status == "error") {
            alert(msg + xhr.status + " " + xhr.statusText);
            console.log(msg + xhr.status + " " + xhr.statusText);
            console.log("xhr=" + xhr.responseText);
          }


        });

    }



    function yloadhistory() {
      event.preventDefault();
      var yornomas = $('#yornomas').val();
      var ydate_from = $('#ydtefrom').val();
      var ydate_to = $('#ydteto').val();
      var ybarangay = $('#ybarangay').val();
      var yamount = $('#yamount').val();



      $('#yearly_payment').load("load_yearlyreport.php", {
          yornomas: yornomas,
          ydate_from: ydate_from,
          ydate_to: ydate_to,
          ybarangay: ybarangay,
          yamount: yamount




        },


        function(response, status, xhr) {
          if (status == "error") {
            alert(msg + xhr.status + " " + xhr.statusText);
            console.log(msg + xhr.status + " " + xhr.statusText);
            console.log("xhr=" + xhr.responseText);
          }


        });

    }
    


//DELETE DAILYPAYMENT
    $(function() {
      $(document).on('click', '.delete_daily', function(e) {
        e.preventDefault();

        var currow = $(this).closest("tr");
        var objid5 = currow.find("td:eq(0)").text();
        var fullname2 = currow.find("td:eq(1)").text();
        $('#delete_member').modal('show');
        $('#objid5').val(objid5);
        $('#fullname2').val(fullname2);
      });
    });


    //DELETE YEARLYPAYMENT
    $(function() {
      $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        var currow = $(this).closest("tr");
        var yobjid = currow.find("td:eq(0)").text();
        var yfullname2 = currow.find("td:eq(1)").text();
        $('#delete_yearlypayment').modal('show');
        $('#yobjid').val(yobjid);
        $('#yfullname2').val(yfullname2);
      });
    });




    $('#printlink').click(function() {
      var ornomas = $('#ornomas').val();
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();

      console.log(ornomas);
      var param = "ornomas=" + ornomas + "&datefrom=" + date_from + "&dateto=" + date_to + "";
      $('#printlink').attr("href", "../plugins/jasperreport/payments.php?" + param, '_parent');
    })
  </script>
</body>

</html>