<?php

$state = "addnew";
$button = "add";
include('config/db_config.php');

// session_start();
//variable declaration
$alert_msg = '';
// include('insert_user.php');
//sign in button
if (isset($_POST['signin'])) {
  //to check if data are passed
  // echo "<pre>";
  //     print_r($_POST);
  // echo "</pre>";

  $username = $_POST['username'];
  $password = $_POST['password'];

  $check_username_sql = "SELECT * FROM tbl_users where username = :uname and status =:status";

  $username_data = $con->prepare($check_username_sql);
  $username_data->execute([
    ':uname' => $username,
    ':status' => 'ACTIVE',
  ]);
  if ($username_data->rowCount() > 0) {
    while ($result = $username_data->fetch(PDO::FETCH_ASSOC)) {

      //from database already hash
      $hash_password = $result['password'];

      //hash the $u_pass and compared to $hashed_password
      if (password_verify($password, $hash_password)) {
        session_start();
        $_SESSION['id'] = $result['id'];
        $_SESSION['user_type'] = $result['account_type'];
        // if ($result['account_type'] == 1) {

        header('location: admin'); //location is folder
        // }
        // else {
        //   header('location: user');
        // }
      } else {
        //echo "Password does not match!";
        $alert_msg .= ' 
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-warning"></i>
                    Password did not match!
                    </div>     
                    
                ';
      }
    }
  } else {
    $alert_msg .= ' 
              <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="icon fa fa-warning"></i>
              Username does not exist!
              </div>     
          ';
  }
}



?>




<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SENIOR CITIZEN SYSTEM | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="../dist/css/ionicons.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  jvectormap -->
  <!-- <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <style>

  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">

      <!-- <img src="dist/img/final_logo.png" width="350px"> -->


      <!-- <img src="{{ qr_code_data_uri(message, { writer: 'svg', size: 150 }) }}" /> -->



      <!-- <h1 id="vamos"><b>VAMOS</b></h1>
      <h6><b>VIRUS ASSESSMENT <br>AND MONITORING SYSTEM</b></h6> -->
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">SENIOR CITIZEN SYSTEM</p>

      <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="Ashake form-group has-feedback">
          <?php echo $alert_msg; ?>
        </div>

        <div class="form-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="username" placeholder="Username">
          </div>
        </div>

        <div class="form-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
        </div>

        <br>

        <div class="row" align="center">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- <a href="#addnew" data-toggle="modal" style="color:white;" data-backdrop="static" class="btn btn-primary pull-left">Sign Up</a> -->
            <input type="submit" class="btn btn-success pull-right" name="signin" value="Sign In">
          </div>
        </div>

      </form>
    </div><!-- /.login-box-body -->
    <!-- <div class="login-logo">
      <a href="http://34.92.117.58/sccdrrmo/downloads/app-release.apk"><img src="dist/img/downloadbuttonandroid.png" width="200px"></a>
    </div> -->

  </div><!-- /.login-box -->
</body>



<!-- jQuery 3 -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery/jquery.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>


<script>
  function loadImage() {
    var input = document.getElementById("fileToUpload");
    var fReader = new FileReader();
    fReader.readAsDataURL(input.files[0]);
    fReader.onloadend = function(event) {
      var img = document.getElementById("profilepic");
      img.src = event.target.result;
    }
  }
  $(document).ready(function() {

    $('#username').keyup(function() {
      var username = $('#username').val();

      $.ajax({
        type: "POST",
        url: "check_username.php",
        data: {
          uname: username
        },
        success: function(response) {
          var result = jQuery.parseJSON(response);
          if (result.data1 != '') {
            // $('#username').toggle("tooltip");
            // $('#username').attr("title","This username is already taken.");
            $('#checkusername').html('This username is already taken.');
            $('#save').prop('disabled', true);
            // console.log(result.data1);
          } else {
            if (username != '') {
              $('#checkusername').html('This username is available.');
              $('#save').prop('disabled', false);
            }
          }
        },
        error: function(xhr, b, c) {
          console.log("xhr=" + xhr.responseText + " b=" + b.responseText + " c=" + c.responseText);
        }
      })
      if (username == '') {
        $('#checkusername').html('');
        $('#save').prop('disabled', true);
      }

    })

    $('#email').keyup(function() {
      var mail = $('#email').val();

      $.ajax({
        type: "POST",
        url: "check_username.php",
        data: {
          email: mail
        },
        success: function(response) {
          var result = jQuery.parseJSON(response);
          if (result.data2 != '') {
            $('#checkemail').html('This email is already taken.');
            $('#save').prop('disabled', true);
            // console.log(result.data1);
          } else {
            if (mail != '') {
              $('#checkemail').html('This email is available.');
              $('#save').prop('disabled', false);
            }
          }
        },
        error: function(xhr, b, c) {
          console.log("xhr=" + xhr.responseText + " b=" + b.responseText + " c=" + c.responseText);
        }
      })
      if (mail == '') {
        $('#checkemail').html('');
        $('#save').prop('disabled', false);
      }


    })


  });
</script>
</body>

</html>