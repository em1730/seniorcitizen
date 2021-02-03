<?php

include('../config/db_config.php');
include('insert_user.php');
session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}


date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$now = new DateTime();
$time = date('H:i:s');

$btnSave = $btnEdi = $user_name = $entity_no = $btn_enabled =
    $firstname = $middlename = $lastname =
    $symptoms = $patient = $person_status = $entity_no = '';

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $db_fullname = $result['fullname'];
}

$get_all_data_sql = "SELECT * FROM tbl_department ";
$get_all_data_data = $con->prepare($get_all_data_sql);
$get_all_data_data->execute();

$get_all_account_sql = "SELECT * FROM tbl_account ";
$get_all_account_data = $con->prepare($get_all_account_sql);
$get_all_account_data->execute();





?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VAMOS | User Credentials Form </title>
    <?php include('heading.php'); ?>



</head>



<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">
            <div class="content-header"></div>


            <section class="content ">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h4> User Credentials Forms </h4>
                    </div>

                    <div class="card-body">
                        <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                            <div class="box-body">
                                <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                <div class="card ">
                                    <div class="card-header">
                                        <h6>USERS INFORMATION</h6>
                                    </div>
                                    <div class="box-body">
                                        <br>

                                        <div class="row">
                                            <div class="col-md-1"></div>

                                            <div>
                                                <label>Date Registered: </label>
                                            </div>

                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <div class="col-md-3">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" readonly class="form-control pull-right" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $now->format('Y-m-d') ?>">
                                                </div>
                                            </div>

                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;

                                            <div class="col-md-2">
                                                <label> Time Registered:</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input readonly type="text" class="form-control" <?php echo $btn_enabled ?> name="time" id="time" placeholder="Time Registered" value="<?php echo $time; ?>" required>
                                            </div>




                                        </div></br>

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div>
                                                <label>Username : </label>
                                            </div>


                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" onblur="checkUsername()" value="<?php echo $user_name; ?>" required>
                                                <div id="status"></div>
                                            </div>

                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;
                                            <div class="col-md-2">
                                                <label>Entity ID : </label>
                                            </div>
                                            <div class="col-md-2">
                                                <input readonly type="text" class="form-control" <?php echo $btn_enabled ?> name="entity_no" id="entity_no" placeholder="Entity ID" value="<?php echo $entity_no; ?>" required>
                                            </div>
                                        </div><br>

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div>
                                                <label>Department/Office:</label>
                                            </div>

                                            &nbsp;&nbsp;&nbsp;&nbsp;

                                            <div class="col-md-4">
                                                <select class="form-control select2" id="department" name="department" value="<?php echo $brgy; ?>">
                                                    <option selected="selected">Select Department/Office</option>
                                                    <?php while ($get_data = $get_all_data_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <option value="<?php echo $get_data['objid']; ?>"><?php echo $get_data['department']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div></br>


                                        <div class="row">
                                            <div class="col-md-1"></div>

                                            <div>
                                                <label>First Name: </label>
                                            </div>

                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="first_name" style=" text-transform: uppercase;" id="first_name" placeholder="First Name" value="<?php echo $firstname; ?>" required>
                                            </div>






                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-1"></div>


                                            <label>Middle Name: </label>

                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="middle_name" style=" text-transform: uppercase;" id="middle_name" placeholder="Middle Name (Ex: 'A')" value="<?php echo $middlename; ?>" required>
                                            </div>
                                        </div><br>


                                        <div class="row">
                                            <div class="col-md-1"></div>


                                            <label>Last Name: </label>

                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="last_name" style=" text-transform: uppercase;" id="last_name" placeholder="Last Name" value="<?php echo $lastname; ?>" required>
                                            </div>
                                        </div><br>


                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <label>Account Type: </label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;
                                            <div class="col-md-4">
                                                <select class="form-control select2" id="type" name="account_type" value="<?php echo $account; ?>">
                                                    <option selected="selected">Select Account Type</option>
                                                    <?php while ($get_data = $get_all_account_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <option value="<?php echo $get_data['objid']; ?>"><?php echo $get_data['account_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div><br>



                                        <div class=" box-footer" align="center">
                                            <button type="submit" <?php echo $btnSave; ?> name="insert_user" id="btnSubmit" class="btn btn-success">
                                                <i class="fa fa-check fa-fw"> </i> </button>

                                            <a href="list_users">
                                                <button type="button" name="cancel" class="btn btn-danger">
                                                    <i class="fa fa-close fa-fw"> </i> </button>
                                            </a>

                                            <!-- <a href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $entity_no; ?>">
                                                <button type="button" name="print" class="btn btn-primary">
                                                    <i class="nav-icon fa fa-print"> </i> </button>
                                            </a> -->


                                        </div><br>





                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <br><br>
        </div>

        <?php include('footer.php') ?>

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
            'autoHeight': true,
            initComplete: function() {
                this.api().columns([4]).every(function() {
                    var column = this;
                    var select = $('<select class="form-control select2"><option value="">show all</option></select>')
                        .appendTo('#combo')
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }

        });
        $('.select2').select2();





        function checkUsername() {
            var username = $('#username').val();
            if (username.length >= 3) {
                $("#status").html('<img src="loader.gif" /> Checking availability...');
                $.ajax({
                    type: 'POST',
                    data: {
                        username: username
                    },
                    url: 'check_username.php',
                    success: function(data) {
                        $("#status").html(data);

                    }
                });
            }
        };


        $(document).ready(function() {


            $('#username').change(function() {
                if ($('#entity_no').val() == '') {
                    $.ajax({
                        type: 'POST',
                        data: {},
                        url: 'generate_id.php',
                        success: function(data) {
                            //$('#entity_no').val(data);
                            document.getElementById("entity_no").value = data;
                            console.log(data);
                        }
                    });
                }
            });


        });


        // $("#insert_user").click(function(e) {
        //     e.preventDefault();
        //     var name = $("#name").val();
        //     var last_name = $("#last_name").val();
        //     var 
        //     var dataString = 'name=' + name + '&last_name=' + last_name;
        //     $.ajax({
        //         type: 'POST',
        //         data: dataString,
        //         url: 'insert_user.php',
        //         success: function(data) {
        //             alert(data);
        //         }
        //     });
        // });
    </script>
</body>

</html>