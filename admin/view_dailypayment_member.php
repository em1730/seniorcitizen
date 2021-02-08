<?php

include('../config/db_config.php');
include('sql_queries.php');

include('deletepayment.php');
include('deleteyearly.php');
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
  $contact_number  = $fullname = $date_from = $date_to = $street = $mobile_no = $ydate_from = $ydate_to = '';

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $db_fullname = $result['fullname'];
}

$objid = $_GET['id'];



$get_data_sql = "SELECT * from masdailypayment m inner join registration r on r.objid = m.id where m.id = '$objid'";
$get_data_data = $con->prepare($get_data_sql);
$get_data_data->execute([':id' => $objid]);

while ($result = $get_data_data->fetch(PDO::FETCH_ASSOC)) {

  $masname1 = $result['masname'];
  $objid = $result['objid'];
  $barangay = $result['barangay'];
  $street = $result['address'];
}







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
      <div class="content-header"></div>
      <section class="content">
        <div class="card">


          <div class="card-header p-2 bg-success text-white">

            <div class="nav nav-pills" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-dailypayment" role="tab" aria-controls="nav-home" aria-selected="true">DAILY PAYMENT</a>
              <a class="nav-item nav-link" id="nav-yearly-tab" data-toggle="tab" href="#nav-yearly" role="tab" aria-controls="nav-yearly" aria-selected="false">YEARLY PAYMENT </a>


            </div>
          </div>

          <div class="card-body">

            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-dailypayment" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="card">
                  <div class="card-header  text-white bg-success">
                    <h5> Daily Payment |<br> ID: <?php echo $objid; ?> <input hidden id="masname1" value="<?php echo $masname1; ?>"> <br> NAME: <?php echo $masname1; ?> <br> STREET: <?php echo $street; ?> <br> BARANGAY: <?php echo $barangay; ?>
                      <a class="btn btn-danger btn-sm" style="float:right;" target="blank" id="printlink" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/dailypayment.php?objid=<?php echo $objid; ?>&masname=<?php echo $masname1; ?>&datefrom=<?php echo $date_from; ?>&dateto=<?php echo $date_to; ?>">
                        <i class="nav-icon fa fa-print"></i></a>
                    </h5>
                  </div>





                  <div class="card-body">
                    <div class="box box-primary">

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

                              <button id="view_dailypayment_member" onClick="loadhistory()" class="btn btn-success"><i class="fa fa-search"></i></button>
                              <input hidden id="objid" value="<?php echo $objid; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="table-responsive">



                          <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                            <thead alignment="center">



                              <th> OBJID </th>
                              <th> DATE PAYMENT</th>
                              <th> OR#</th>
                              <th> AMOUNT </th>
                              <th> Options </th>

                            </thead>
                            <tbody id="daily_payment">

                            </tbody>
                          </table>


                        </div>

                      </div>
                    </div>

                  </div>

                </div>
              </div>



              <!-- YEARLY PAYMENT -->

              <div class="tab-pane fade " id="nav-yearly" role="tabpanel" aria-labelledby="nav-yearly-tab">
                <div class="card">
                  <div class="card-header  text-white bg-success">
                    <h5> Yearly Payment |<br> ID: <?php echo $objid; ?> <input hidden id="masname1" value="<?php echo $masname1; ?>"> <br> NAME: <?php echo $masname1; ?> <br> STREET: <?php echo $street; ?> <br> BARANGAY: <?php echo $barangay; ?>
                      <a class="btn btn-danger btn-sm" style="float:right;" target="blank" id="printlink" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/dailypayment.php?objid=<?php echo $objid; ?>&datefrom=<?php echo $date_from; ?>&dateto=<?php echo $date_to; ?>">
                        <i class="nav-icon fa fa-print"></i></a>
                    </h5>
                  </div>

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
                                <input type="text" style="margin-right:50px;" class="form-control col-3 " data-provide="datepicker" autocomplete="off" name="dateto1" id="ydteto" value="<?php echo $ydate_to; ?>">

                                <button id="view_yearlypayment_member" onClick="loadhistory1()" class="btn btn-success"><i class="fa fa-search"></i></button>
                                <input hidden id="objid5" value="<?php echo $objid; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="table-responsive">



                            <table style="overflow-x: auto;" id="users1" name="user" class="table table-bordered table-striped">
                              <thead align="center">



                                <th> OBJID </th>
                                <th> DATE PAYMENT</th>
                                <th> OR#</th>
                                <th> AMOUNT </th>
                                <th> Options </th>

                              </thead>
                              <tbody id="yearly_payment">

                              </tbody>
                            </table>


                          </div>
                      </form>
                    </div>
                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>







      </section>
      <br>
    </div>
    <!-- /.content-wrapper -->
    <?php include('footer.php') ?>

  </div>


  <!-- DAILY PAYMENT MODAL -->
  <div class="modal fade" id="delete_membermodal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>

        </div>
        <form method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?> ">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Delete Record?</label>
                <input readonly="true" type="text" name="payment_delete" id="payment_delete" class="form-control">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
            <input type="submit" name="deletepayment" class="btn btn-danger" value="Yes">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- YEARLY PAYMENT MODAL -->
  <div class="modal fade" id="delete_yearlymodal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>

        </div>
        <form method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Delete Record sa yearly?</label>
                <input readonly="true" type="text" name="yearly_delete" id="yearly_delete" class="form-control">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
            <input type="submit" name="deleteyearly" class="btn btn-danger" value="Yes">
          </div>
        </form>
      </div>
    </div> <!-- /.modal-content -->
  </div>
  <!-- /.mod
  </div>






  <!- jQuery -->
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
      'autoHeight': true,

    });


    $('#users1').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true,

    });

    $('.select2').select2();

    // $('#addPUM').on('hidden.bs.modal', function() {
    //   $('#addPUM form')[0].reset();
    // });

    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });

    // $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
    //   event.preventDefault();

    //   var user_id = ($(this).data('id'));

    //   $('#user_id').val(user_id);
    //   $('#delete_PUMl').modal('toggle');

    // });

    function loadhistory() {
      event.preventDefault();
      var objid = $('#objid').val();
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();

      $('#daily_payment').load("load_dailypayment.php", {
          objid: objid,
          date_from: date_from,
          date_to: date_to,



        },


        function(response, status, xhr) {
          if (status == "error") {
            alert(msg + xhr.status + " " + xhr.statusText);
            console.log(msg + xhr.status + " " + xhr.statusText);
            console.log("xhr=" + xhr.responseText);
          }
        });





    }

    function loadhistory1() {
      console.log("test");
      event.preventDefault();
      var objid5 = $('#objid5').val(); // dri ka mo kuha  so ok nani nard salamat kayo galibog pako ani
      var ydate_from = $('#ydtefrom').val();
      var ydate_to = $('#ydteto').val();

      $('#yearly_payment').load("load_yearlypayment.php", {
          objid5: objid5, //objid 1 man imong gi gmit dri kuan nard abi nako diri sa itaas kwaon
          ydate_from: ydate_from,
          ydate_to: ydate_to,


        },
        function(response, status, xhr) {
          if (status == "error") {
            alert(msg + xhr.status + " " + xhr.statusText);
            console.log(msg + xhr.status + " " + xhr.statusText);
            console.log("xhr=" + xhr.responseText);
          }
        });


    }


    // DELETE DAILYPAYMENT
    $(function() {
      $(document).on('click', '.delete_dailypayment', function(e) {
        e.preventDefault();

        var currow = $(this).closest("tr");
        var objid = currow.find("td:eq(0)").text();
        $('#delete_membermodal').modal('show');
        $('#payment_delete').val(objid);
      });
    });



    // DELETE YEARLY PAYMENT
    $(function() {
      $(document).on('click', '.delete_yearlypayment', function(e) {
        e.preventDefault();

        var currow = $(this).closest("tr");
        var objid = currow.find("td:eq(0)").text();
        $('#delete_yearlymodal').modal('show');
        $('#yearly_delete').val(objid);
      });
    });




    // $('#users tbody').on('click', 'button.printlink', function() {
    //   // alert ('hello');
    //   // var row = $(this).closest('tr');
    //   var table = $('#users').DataTable();
    //   var data = table.row($(this).parents('tr')).data();
    //   //  alert (data[0]);
    //   //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
    //   var entity_no = data[0];
    //   window.open("individual_history.php?entity_no=" + entity_no + '_parent');
    // });



    $('#printlink').click(function() {
      var objid = $('#objid').val();
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();
      var masname1 = $('#masname1').val();

      console.log(objid);
      var param = "objid=" + objid + "&masname1=" + masname1 + "&datefrom=" + date_from + "&dateto=" + date_to + "";
      $('#printlink').attr("href", "../plugins/jasperreport/dailypayment.php?" + param, '_parent');
    })
  </script>
</body>

</html>