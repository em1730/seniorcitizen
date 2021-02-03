<!-- navbar and sidebar -->
<style>
  label {

    font-size: 16px;
    color: green;

  }

  .fas,
  .icons,
  #icons {
    color: black;
  }




  p {
    color: green;
  }

  .sidebar-link:hover,
  #lightgreen:hover {

    background-color: lightgreen;
  }


  /* .top-link{

  } */
  .top-link:hover {
    background-color: green;
    color: black;
  }

  #label1::after {
    content: '';
    display: block;
    position: absolute;

    background-color: black;
    width: 200px;
    height: 1px;


    /* bottom: -3px; */
  }

  #label2::after {
    content: '';
    display: block;
    position: absolute;

    background-color: black;
    width: 200px;
    height: 1px;


    /* bottom: -3px; */
  }
</style>
<?php
include_once('session.php');
include('../config/db_config.php');
// include('send_notification.php');
// include('user_controls.php');
// include('session.php');


// include ('../config/db_config.php');
// session_start();
// $user_id = $_SESSION['id'];

// if (!isset($_SESSION['id'])) {
//     header('location:../index.php');
// } else {

// }
$user_id = $_SESSION['id'];

$db_fullname = '';
$photo = '';

// //fetch user from database
// $get_user_sql = " SELECT CONCAT(firstname,' ',LEFT(middlename, 1),'. ',lastname) as fullname FROM tbl_users where id = :id";
// $user_data = $con->prepare($get_user_sql);
// $user_data->execute([':id' => $user_id]);
// while ($result4 = $user_data->fetch(PDO::FETCH_ASSOC)) {
//   $db_fullname = $result4['fullname'];
//   // $photo = $result4['photo'];
// }

//get all draft from announcement
// $get_all_draft_sql = "SELECT * FROM tbl_announcement WHERE status = 'draft'";
// $get_all_draft_data = $con->prepare($get_all_draft_sql);
// $get_all_draft_data->execute();
// $numberofdraft = $get_all_draft_data->rowCount();

// //get all new report from report pum/pui
// $get_all_newreport_sql = "SELECT * FROM tbl_reportpum WHERE remarks = 'NEW REPORT'";
// $get_all_newreport_data = $con->prepare($get_all_newreport_sql);
// $get_all_newreport_data->execute();
// $numberofnewreport = $get_all_newreport_data->rowCount();

?>

<nav class="main-header navbar navbar-expand greenBG navbar-light border-bottom">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">SENIOR CITIZEN SYSTEM</a>
    </li>


    <li class="nav-item">
      <a href="index" class="nav-link ">HOME PAGE</a>
    </li>


    <li class="nav-item">
      <a href="announcement" class="nav-link ">
        <!-- <i class="nav-icon fa fa-exclamation-circle"></i> -->
        <!-- <label href="announcement"> -->
        ANNOUNCEMENTS
        <!-- </label> -->
      </a>
    </li>


  </ul>

  <ul class="navbar-nav ml-auto">
    <!-- <li class="nav-item">
      <a href="#" class="nav-link">Contact Us</a>
    </li> -->


    <!-- <li class="nav-item">
      <a href="#" class="nav-link">About Us</a>
    </li>

    <li class="nav-item">
      <a href="#" class="nav-link">Profile</a>
    </li> -->




  </ul>



</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <div class="greenBG">

    <!-- <a href="index" class="brand-link">  
      <img src="../dist/img/scdrrmo_logo.png" class="img-circle elevation-2" width="40px">   
    </a> -->

    <!-- Sidebar -->

    <!-- Sidebar user panel (optional) -->
    <div class="sidebar">
      &nbsp; &nbsp; &nbsp; &nbsp;
      <!-- <img src="../dist/img/final_logo_white.png" width="150px" height="80px"> -->
      <label style="color:white" class="d-block">
      <label> SENIOR CITIZEN </label>

      
        &nbsp; &nbsp; &nbsp; &nbsp;
        <?php echo $db_fullname ?> </label>


    </div>

  </div>
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->




        <div>
          <label id="label1" style="font-size:18px; ">
            &nbsp;
            <i class="nav-icon fa fa-address-book icons "></i>
            &nbsp;
            TRANSACTIONS
          </label>


          <li class="nav-item">
            <a href="list_dailypayment" class="nav-link sidebar-link">
              &nbsp;
              <i class="nav-icon fa fa-user icons"></i>
              <p> &nbsp; DAILY PAYMENT</p>
            </a>
          </li>
</div>
    
     
<br>

        <div>
          <label id="label1" style="font-size:18px; ">
            &nbsp;
            <i class="nav-icon fa fa-folder icons "></i>
            &nbsp;
            REPORTS
          </label>


          <li class="nav-item">
            <a href="list_payments" class="nav-link sidebar-link">
              &nbsp;
              <i class="nav-icon fa fa-user icons"></i>
              <p> &nbsp; DAILY PAYMENT REPORT</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="list_userlogs" class="nav-link sidebar-link">
              &nbsp;
              <i class="nav-icon fa fa-user icons"></i>
              <p> &nbsp; User Logs</p>
            </a>
          </li>






            </ul>
          </li>
          <div>


          
          <div>
     
        <br>

        

      





      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->

  <?php include('push_notification.php'); ?>

</aside>