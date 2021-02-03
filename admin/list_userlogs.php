<?php

include('../config/db_config.php');
// include('sql_queries.php');
include('insert_dailypayment.php');
include('insert_yearlypayment.php');
session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
} else {
}


date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');
$now = new DateTime();

$btnSave = $btnEdit = "";

$ornomas = $amount = $date_payment = $entity_no = $objid = $firstname = $lastname = '';
// $entity_no = '';
//fetch user from database
$user_id = $_SESSION['id'];

$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $db_fullname = $result['fullname'];
}


// $get_all_individual_sql = "SELECT * FROM tbl_individual i inner join tbl_entity e on e.entity_no = i.entity_no order by i.lastname ASC ";
// $get_all_individual_data = $con->prepare($get_all_individual_sql);
// $get_all_individual_data->execute();
// while ($list_individual = $get_all_individual_data->fetch(PDO::FETCH_ASSOC)){
//   $entity_no =  $list_individual['entity_no'];
// }


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
      <div class="content-header"></div>

      <section class="content">
        <div class="card card-info">
          <div class="card-header  text-white bg-success">
            <h4> USER LOGS
          
              <a href="add_individual" id="add_individual" style="float:right;" type="button" class="btn btn-success bg-gradient-success" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square"></i></a>
              <!-- <a href="../cameracapture/capture.php" style="float:right;" type="button" class="btn btn-info bg-gradient-info" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square"></i></a> -->
            </h4>

          </div>

          <div class="card-body">
            <div class="box box-primary">
              <form role="form" method="get" action="">
                <div class="box-body">

                  <div class="table-responsive">
                    <!-- <div class="row">
                      <div class="col-md-3" id="combo"></div>
                    </div>
                    <br> -->


                    <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                      <thead align="center">

                        <th> ID </th>
                        
                        <th> DATE/TIME </th>
                        <th> PERSON_NAME </th>
                        <th> ACTIVITY </th>
                        <th> ORNO </th>
                        <th> AMOUNT </th>
           

                      </thead>
                      <tbody>




                      </tbody>
                    </table>
              
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </section>
      <br><br>

    </div><!-- /.content-wrapper -->


      

    <?php include('footer.php') ?>

  </div><!-- /.wrapper -->




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
    // $('#users').DataTable({
    //   'paging': true,
    //   'lengthChange': true,
    //   'searching': true,
    //   'ordering': true,
    //   'info': true,
    //   'autoWidth': true,
    //   'autoHeight': true
    // });
    // function checkViewHistory() {
    //   accountType = $('#accountType').val();
    //   if (accountType == 1) {
    //     return ' <button class="btn btn-outline-warning btn-sm" id = "viewHistory" style = "margin-right:10px;" data-placement="top" title="View History"><i class="fa fa-search"></i></button>';
    //   } else if (accountType == 3) {
    //     return '<button class="btn btn-outline-warning btn-sm" id = "viewHistory" style = "margin-right:10px;" data-placement="top" title="View History"><i class="fa fa-search"></i></button>';

    //   } else {
    //     return '';
    //   }

    // }

  
    var dataTable = $('#users').DataTable({

      page: true,
      stateSave: true,
      processing: true,
      serverSide: true,
      scrollX: false,

      ajax: {
        url: "search_userlogs.php",
        type: "post",
        error: function(xhr, b, c) {
          console.log(
            "xhr=" +
            xhr.responseText +
            " b=" +
            b.responseText +
            " c=" +
            c.responseText
            
          );
        }
      },
      // columnDefs: [{
      //     width: "159px",
      //     targets: -1,
      //     data: null,

      //     defaultContent: '<button class="btn btn-outline-success btn-sm editIndividual" style = "margin-right:10px;"  id = "modal" data-placement="top" title="ADD DAILY PAYMENT"> DY</i></button>'
      //      + '<button class="btn btn-outline-success btn-sm editIndividual" style = "margin-right:10px;"  id = "modal1" data-placement="top" title="ADD YEARLY PAYMENT"> YR</i></button>'
      //      +
      //     '<button class="btn btn-outline-success btn-sm editIndividual" style = "margin-right:10px;"  id = "view_dailypayment" data-placement="top" title="ADD"> <i class="fa fa-folder"></i></button>'
      //     + '<button class="btn btn-danger delete btn-sm" data-placement="top" title="Delete Record"><i class="fa fa-trash-o"></i></button>'

            
      //   },
      //   //   defaultContent: '<button class="btn btn-outline-success btn-sm editIndividual" style = "margin-right:10px;"  id = "viewIndividual" data-placement="top" title="Edit Individual"> <i class="fa fa-edit"></i></button>' +
      //   //     '<a class="btn btn-outline-success btn-sm printlink"  style = "margin-right:10px;" id="printlink" href ="../plugins/jasperreport/entity_id.php?entity_no=" data-placement="top" target="_blank" title="Print ID">  <i class="nav-icon fa fa-print"></i></a> ' + checkViewHistory() + checkDelete() +

      //   //     '<button class="btn btn-outline-success btn-sm editIndividual" style = "margin-right:10px;"  id = "modal" data-placement="top" title="ADD"> <i class="fa fa-edit"></i></button>',
      //   // },

      // ],
    });

    // $("#users tbody").on("click", "#view_dailypayment", function() {
    //   event.preventDefault();
    //   var currow = $(this).closest("tr");
    //   var objid = currow.find("td:eq(0)").text();
    //   var masname = currow.find("td:eq(1)").text();
    //   // $('#viewIndividual').attr("href", "view_individual.php?&id=" + entity, '_parent');
    //   window.open("view_dailypayment_member.php?&id=" + objid + "&masname=" +masname+"", '_parent');

    // });

    // $("#users tbody").on("click", "#modal", function() {
    //   event.preventDefault();
    //   var currow = $(this).closest("tr");

    //   var objid1 = currow.find("td:eq(0)").text();
    //   var fullname = currow.find("td:eq(1)").text();
    //   var barangay = currow.find("td:eq(2)").text();
   
      
     
    //   console.log("test");
    //   $('#modalupdate').modal('show');
    //   $('#objid1').val(objid1);
    //   $('#fullname1').val(fullname);
    

    // });


    // $("#users tbody").on("click", "#modal1", function() {
    //   event.preventDefault();
    //   var currow = $(this).closest("tr");

    //   var objid2 = currow.find("td:eq(0)").text();
    //   var yfullname = currow.find("td:eq(1)").text();

     
    //   console.log("test");
    //   $('#modalyeardue').modal('show');
    //   $('#objid2').val(objid2);
    //   $('#lastname').val(yfullname);
    

    // });

    // $("#users tbody").on("click", "#printlink", function() {
    //   // event.preventDefault();
    //   var currow = $(this).closest("tr");
    //   var entity = currow.find("td:eq(0)").text();
    //   $('.printlink').attr("href", "../plugins/jasperreport/entity_id.php?entity_no=" + entity, '_parent');
    //   // window.open("../plugins/jasperreport/entity_id.php?entity_no=" + entity, '_parent');

    // });

    // $("#users tbody").on("click", "#viewHistory", function() {
    //   event.preventDefault();
    //   var currow = $(this).closest("tr");
    //   var entity = currow.find("td:eq(0)").text();
    //   // $('#viewIndividual').attr("href", "view_individual.php?&id=" + entity, '_parent');
    //   window.open("view_individual_history.php?&entity_no=" + entity, '_parent');

    // });

    // $(function() {
    //   $(document).on('click', '.delete', function(e) {
    //     e.preventDefault();

    //     var currow = $(this).closest("tr");
    //     var objid5 = currow.find("td:eq(0)").text();
    //     $('#delete_member').modal('show');
    //     $('#objid5').val(objid5);
    //   });
    // });


    // $('#users').DataTable({
    //   'paging': true,
    //   'lengthChange': true,
    //   'searching': true,
    //   'ordering': true,
    //   'info': true,
    //   'autoWidth': true,
    //   'autoHeight': true,
    //   initComplete: function() {
    //     this.api().columns([4]).every(function() {
    //       var column = this;
    //       var select = $('<select class="form-control select2"><option value="">show all</option></select>')
    //         .appendTo('#combo')
    //         .on('change', function() {
    //           var val = $.fn.dataTable.util.escapeRegex(
    //             $(this).val()
    //           );
    //           column
    //             .search(val ? '^' + val + '$' : '', true, false)
    //             .draw();
    //         });
    //       column.data().unique().sort().each(function(d, j) {
    //         select.append('<option value="' + d + '">' + d + '</option>')
    //       });
    //     });
    //   }

    // });

    

    // $(document).on('click', 'button[data-role=delete_member]', function(event) {
    //   event.preventDefault();

    //   var objid = ($(this).data('objid'));

    //   $('#objid').val(objid);
    //   $('#delete_member').modal('show');

    // });

    // $('.select2').select2();

    // $('#addPUM').on('hidden.bs.modal', function() {
    //   $('#addPUM form')[0].reset();
    // });

    // $(function() {
    //   $('[data-toggle="datepicker"]').datepicker({
    //     autoHide: true,
    //     zIndex: 2048,
    //   });
    // });





    // $(document).ready(function() {
    //   $('#print').click(function() {
    //     var entity_no = $('#entity_no').val();
    //     console.log(entity_no);

    //     $('#printlink').attr("href", "../plugins/jasperreport/entity_id.php?entity_no=" + entity_no, '_parent');
    //   })
    // });




    // $('#users tbody').on('click', 'button.printlink', function() {
    //   // alert ('hello');
    //   // var row = $(this).closest('tr');
    //   var table = $('#users').DataTable();
    //   var data = table.row($(this).parents('tr')).data();
    //   //  alert (data[0]);
    //   //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
    //   var entity_no = data[0];
    //   window.open("entity_id.php?entity_no=" + entity_no, '_parent');
    // });

    // $('#add_individual').click(function() {
    //   generateID();
    // });

    // function generateID() {

    //   $.ajax({
    //     type: 'POST',
    //     data: {},
    //     url: 'generate_id.php',
    //     success: function(data) {
    //       //$('#entity_no').val(data);
    //       sessionStorage.setItem("entity_number", data);
    //     }
    //   });
    // }
    // window.onload = generateID;
  </script>
</body>

</html>