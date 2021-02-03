<?php

session_start();

$now = new DateTime();

$entity_no = $date_register = $user_name = $firstname = $middlename = $lastname = $birthdate = $age = $gender = $barangay = $street = $city = $province = $mobile_no = $telephone_no = $email = '';

$btnSave = $btnEdit = "";
$btnNew = 'hidden';
$btn_enabled = 'enabled';


if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('insert_individual.php');
include('verify_admin.php');

$get_all_brgy_sql = "SELECT * FROM barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();

$province = 'NEGROS OCCIDENTAL ';
$city = 'SAN CARLOS CITY';


$title = 'VAMOS | Add Individual';


?>


<!DOCTYPE html>
<html>

<head>
    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="../plugins/pixelarity/pixelarity.css">
    <!-- <link rel="stylesheet" href="../plugins/pixelarity/jquerysctipttop.css"> -->
    <!-- <link rel="stylesheet" href="../plugins/toastr/toastr.min.css"> -->

    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
    <!-- <link rel="stylesheet" href="../plugins/datatables/jquery.dataTables.css"> -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <script src="https://kit.fontawesome.com/629c6e6cbc.js" crossorigin="anonymous"></script>

    <style>
        #webcam {
            width: 350px;
            height: 350px;
            border: 1px solid black;
        }

        #photo {
            display: block;
            position: relative;
            margin-top: 40px;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">
            <div class="content-header"></div>

            <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div>

            <section class="content">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h4>Individual Form</h4>
                    </div>


                    <div class="card-body">

                        <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">

                            <div class="box-body">
                                <div class="row">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="m-1 pb-1"> </div>
                                    <div class="card col-md-6">

                                        <div class=" card-header">
                                            <h6><strong>GENERAL INFORMATION</strong></h6>
                                        </div>

                                        <div class="box-body">
                                            <br>

                                            <div class="row">

                                                <div class="col-md-1"></div>
                                                <div class="col-lg-4">
                                                    <label>Date Registered: </label>
                                                    <div class="input-group date" data-provide="datepicker">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $now->format('Y-m-d'); ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label>Entity ID : </label>
                                                    <input readonly type="text" class="form-control" name="entity_no" id="entity_no" placeholder="Entity ID" value="<?php echo $entity_no; ?>" required>
                                                </div>


                                            </div></br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>First Name:</label> -->
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="User Name" onblur="checkUsername()" value="<?php echo $user_name; ?>" required>
                                                    <div id="status"></div>
                                                </div>
                                            </div></br>



                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>First Name:</label> -->
                                                    <input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>" required>
                                                </div>
                                            </div></br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Middle Name:</label> -->
                                                    <input type="text" class="form-control" name="middlename" placeholder="Middle Name" value="<?php echo $middlename; ?>" required>
                                                </div>
                                            </div></br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label> Last Name:</label> -->
                                                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>" required>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-4">
                                                    <label>Birthdate: </label>

                                                    <input type="date" value="" id="date" name="birthdate" onblur="getAge();" class="form-control pull-right " placeholder="dd/mm/yyyy" />
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Age:</label>
                                                    <input type="number" id="age" name="age" class="form-control" placeholder="Age" value="<?php echo $age ?>">

                                                </div>

                                                <div class="col-md-4">
                                                    <label>Gender:</label>
                                                    <select class=" form-control select2" id="gender" name="gender" value="<?php echo $gender; ?>" required>
                                                        <option selected="selected">Select Gender</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Male">Male</option>
                                                    </select>
                                                </div>
                                            </div><br>

                                            <!-- <div class="row">

                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    Put birthdate:
                                                    Your age:

                                                </div>

                                            </div><br> -->

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="street" placeholder="Street / Lot # / Block #" value="<?php echo $street; ?>" required>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Barangay: </label> -->
                                                    <select class="form-control select2" id="barangay" style="width: 100%;" name="barangay" value="<?php echo $barangay; ?>" required>
                                                        <option selected="selected">Select Barangay</option>
                                                        <?php while ($get_brgy = $get_all_brgy_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?php echo $get_brgy['brgy']; ?>"><?php echo $get_brgy['brgy']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="city" placeholder="City" value=" <?php echo $city; ?>" required>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="province" placeholder="Province" value=" <?php echo $province; ?>" required>
                                                </div>
                                            </div><br>


                                        </div>


                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <div class="card col-md-5">
                                        <div class="card-header">
                                            <h6><strong> ID PHOTO </strong></h6>
                                        </div>

                                        <div class="box-body">
                                            <br>
                                            <div class="row col-12">

                                                <!-- <div class="col-12" style="vertical-align: middle; height: 280px; width:300px;border: 1px solid black ;" id="my_camera" align="center" onClick="setup()">
                                                <img src="" id = "photo" style="margin:auto;height: 200px; width:280;"onClick="setup()">
                                                        Click me to Open Camera
                                                
                                                  
                                                </div> -->
                                                <div style="margin:auto">

                                                    <video id="webcam" autoplay playsinline width="450 " height="450" align="center" hidden class="photo  img-thumbnail"></video>
                                                    <canvas id="canvas" class="d-none" hidden width="450" height="450" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>
                                                    <audio id="snapSound" src="audio/snap.wav" preload="auto"></audio>

                                                    <img src="../flutter/images/user.jpg" id="photo" style="height: 320px; width:320px; margin:auto;" class="photo img-thumbnail">


                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- <form method="POST" action="storeImage.php"> -->
                                            <div style="margin:auto">
                                                <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                    <span class="align-baseline">
                                                        <input type="hidden" name="image" class="image-tag">
                                                        <!-- <input type="button" class="btn btn-primary" value="&#9654" onClick="setup()">  -->
                                                        <button type="button" id="opencamera" class="btn btn-warning " value="CAPTURE"><i class="fa fa-camera"></i></button>
                                                        <button type="button" id="capture" class="btn btn-primary toastsDefaultSuccess" value="CAPTURE" onClick="take_snapshot()"><i class="fa fa-check"></i></button>

                                                        <style>
                                                            input[type="file"] {
                                                                display: none;
                                                            }

                                                            .custom-file-upload {
                                                                border: 1px solid #ccc;
                                                                border-radius: 5px;
                                                                display: inline-block;
                                                                padding: 7px 12px;
                                                                cursor: pointer;
                                                            }
                                                        </style>
                                                        <label for="fileToUpload" class="custom-file-upload">
                                                            <i class="fa fa-cloud-upload"></i> Import Image
                                                        </label>
                                                        <input type="file" id="fileToUpload" name="myFile" class="btn btn-danger custom-file-upload ">

                                                    </span>
                                                </div>
                                            </div><br>
                                            <!-- </form> -->

                                        </div>

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <label>CONTACT DETAILS </label>

                                            </div>
                                        </div><br>

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <!-- <label>Street: </label> -->
                                                <input type="number" class="form-control" name="mobile_no" placeholder="Mobile Number" value="<?php echo $mobile_no; ?>">
                                            </div>
                                        </div></br>

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <!-- <label>Street: </label> -->
                                                <input type="number" class="form-control" name="telephone_no" placeholder="Telephone Number" value="<?php echo $telephone_no; ?>">
                                            </div>
                                        </div><br>

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <!-- <label>Street: </label> -->
                                                <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo $email; ?>">
                                            </div>
                                        </div><br>


                                        <div class="box-footer" align="center">


                                            <button type="submit" <?php echo $btnSave; ?> name="insert_individual" id="btnSubmit" class="btn btn-success">
                                                <i class="fa fa-check fa-fw"> </i> </button>

                                            <a href="list_individual.php">
                                                <button type="button" name="cancel" class="btn btn-danger">
                                                    <i class="fa fa-close fa-fw"> </i> </button>
                                            </a>

                                            <a href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $entity_no; ?>">
                                                <button type="button" name="print" class="btn btn-primary">
                                                    <i class="nav-icon fa fa-print"> </i> </button>
                                            </a>


                                        </div><br>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>


        <?php include('footer.php') ?>

    </div>



    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- CK Editor -->
    <script src="../plugins/ckeditor/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <!-- <script src="../plugins/fastclick/fastclick.js"></script> -->
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="../dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- DataTables -->
    <!-- <script src="../plugins/datatables/jquery.dataTables.js"></script> -->
    <script src="../plugins/pixelarity/pixelarity-face.js"></script>
    <!-- <script src="../plugins/pixelarity/pixelarity-faceless.js"></script>
    <script src="../plugins/pixelarity/script-faceless.js"></script> -->
    <!-- <script src="../plugins/pixelarity/jquery.3.4.1.min.js"></script> -->
    <!-- <script src="../plugins/datatables/dataTables.bootstrap4.js"></script> -->
    <!-- Toastr -->
    <!-- <script src="../plugins/toastr/toastr.min.js"></script> -->
    <!-- Select2 -->
    <!-- <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script> -->
    <script src="../plugins/cameracapture/webcam-easy.min.js"></script>
    <!-- <script src="../plugins/webcamjs/webcam.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->
    <!-- textarea wysihtml style -->
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
    <!-- <script src="jpeg_camera/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     -->

    <!-- <script src="jpeg_camera/dist/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script> -->

    <script src="../plugins/select2/select2.full.min.js"></script>





    <script language="JavaScript">
        function getAge() {
            var dob = document.getElementById('date').value;
            dob = new Date(dob);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            document.getElementById('age').value = age;
        };

        const webcamElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('canvas');
        const snapSoundElement = document.getElementById('snapSound');
        const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);

        function take_snapshot() {
            // // take snapshot and get image data

            let picture = webcam.snap();
            document.querySelector('#photo').src = picture;
            $(".image-tag").val(picture);
            $("#canvas").attr("hidden", true);
            webcam.stop();
            $("#canvas").hide();
            $("#webcam").hide();
            $("#photo").show();

        }


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
        }



        $(document).ready(function() {
            $('.select2').select2();
            // $('#entity_no').val(sessionStorage.getItem("entity_number"));

            //execute the image cropper when the image is imported
            $("#fileToUpload").change(function(e) {

                var img = e.target.files[0];

                if (!pixelarity.open(img, false, function(res) {

                        $("#photo").attr("src", res);
                        $(".image-tag").attr("value", res);
                    }, "jpg", 0.7)) {

                    alert("Whoops! That is not an image!");
                }

                $("#photo").show();
                $("#canvas").hide();
                $("#webcam").hide();

            });
            //open the webcam
            $("#opencamera").click(function() {
                $("#canvas").show();
                $("#webcam").show();
                $('#canvas').removeAttr('hidden');
                $('#webcam').removeAttr('hidden');
                $("#photo").hide();
                webcam.start()
                    .then(result => {
                        console.log("webcam started");
                    })
                    .catch(err => {
                        console.log(err);
                    })
            });

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
    </script>
</body>

</html>