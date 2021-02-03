<?php

include('../config/db_config.php');

session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}


//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $db_fullname = $result['fullname'];
}




?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VAMOS | Ways of Scanning QR Code </title>
    <?php include('heading.php'); ?>


    <style>
        #information {
            font-size: 20px;
            padding-left: 35px;

        }

        #hand-login {
            padding-top: 80px;
            width: 400px;
            height: 800px;
        }

        #app_label {
            font-size: 25px;
            text-decoration: underline;
        }

        #number {
            width: 50px;
            height: 50px;
        }

        #icon {
            width: 30px;
            height: 30px;
        }


        #fbpage:hover {

            background-color: lightgreen;
        }


        #text-english {
            font-size: 25px;
            font-weight: normal !important;
            line-height: 1;

        }

        #list-office {
            font-size: 20px;
            padding-left: 110px;
            color: green;
        }

        .logo {
            width: 70px;
            height: 80px;

        }

        .label-logo {
            padding-left: 150px;
            font-size: 13px;
        }

        #label-QR {
            padding-left: 190px;
            font-size: 25px;
        }

        #content {
            padding-left: 80px;

        }
    </style>

</head>



<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">
            <div class="content-header"></div>

            <!-- ENTITIES -->
            <section class="content">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4>WAYS OF SCANNING QR CODE</h4>

                    </div>
                    <div class="card-body">
                        <div class="box-body">
                            <div class="card">
                                <br>

                                <div class="row">

                                    <div class="col-md-7">


                                        <label id="label-QR">
                                            <b>SCAN QR CODE</b>
                                        </label> <br>

                                        <p id="information">
                                            <img src="../dist/img/one.png" id="number">
                                            &nbsp; &nbsp;
                                            Palihug i-click ang <i>SCAN QR CODE</i> button.

                                        </p><br>
                                        <p id="information">
                                            <img src="../dist/img/two.png" id="number">
                                            &nbsp; &nbsp;
                                            Pwede na ka start ug scan kung ready na ang back camera sa
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            imong cellphone. Para sa saktong pag scan sa <i>QR Code</i>,
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            siguraduhang nakasulod kini sa <i>"square marker"</i>. Palihug sa
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            striktong pag sunod
                                            sa <i>"social distancing"</i> samtang ga scan.

                                        </p><br>

                                        <p id="information">
                                            <img src="../dist/img/three.png" id="number">
                                            &nbsp; &nbsp;

                                            May mensahe ka nga makita kung nagmalampuson ang pag
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            scan sa <i>QR Code</i>. Palihug i check ang <i>CONTACT HISTORY</i>
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            para sa dugang impormasyon. Tanang na scan nga <i>QR Code</i> kay
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            siguradong mapadala sa among <i>"data server"</i> kung may internet.

                                        </p><br>
                                        <br>
                                        <label id="label-QR">
                                            <b>SCAN ME</b>
                                        </label> <br>

                                        <p id="information">
                                            <img src="../dist/img/one.png" id="number">
                                            &nbsp; &nbsp;
                                            Palihug i-click ang <i>SCAN ME</i> button.

                                        </p><br>

                                        <p id="information">
                                            <img src="../dist/img/two.png" id="number">
                                            &nbsp; &nbsp;
                                            Ang imuhang <i>"VIRTUAL ID"</i> nga nakalakip sa imung <i>QR Code</i>
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            hulagway og detalye ang ma display sa screen. Ang naka assign
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            nga personnel
                                            o staff sa usa ka <i>"Juridical o Transportation"</i> ang mu
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            scan sa imuhang <i>"VIRTUAL ID"</i>.


                                        </p><br>

                                        <p id="information">
                                            <img src="../dist/img/three.png" id="number">
                                            &nbsp; &nbsp;
                                            Palihug sa pag confirm kung ang imung <i>QR Code</i> kay
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            nagmalampusong nai scan sa assigned personnel o staff bag-o
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            musulod sa usa ka building o musakay pampublikong
                                            <br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;
                                            transportasyon.



                                        </p><br>






                                    </div>

                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                                    <div class="col-md-4">
                                        <img src="../dist/img/SCANNING.png" alt="" id="hand-login">

                                        <br>
                                        <p>
                                            &nbsp;&nbsp;&nbsp;
                                            Please like our facebook page for more updates: <br>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="https://www.facebook.com/lgusccno.itcso" id="fbpage" target="_blank">
                                                <label>https://facebook.com/lgusccno.itcso</label>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <br><br>


                            </div>
                        </div>
                    </div>

                </div>

            </section>



            <br>
        </div>

        <?php include('footer.php'); ?>

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





</body>

</html>