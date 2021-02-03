<?php

include('../config/db_config.php');

//get all draft from announcement





$incident_report  = '';
$registration_list = '';
$get_individual_entity = '';
$mobile_alert = '';
$post_announce = ' ';
$post_announce_last = ' ';
$settings = ' ';
$announce = ' ';
$numberofdraft = ' ';
$post_last = ' ';
$breal = ' ';


$infection = '';
$contacts = '';
$covid_case = ' ';
$covid_positive = ' ';
$covid_contact = ' ';
$add_contact_case = ' ';



// $get_all_draft_sql = "SELECT * FROM tbl_announcement WHERE status = 'draft'";
// $get_all_draft_data = $con->prepare($get_all_draft_sql);
// $get_all_draft_data->execute();
// $numberofdraft = $get_all_draft_data->rowCount();



//sidebar buttons
// if ($_SESSION['user_type'] == 1) {
//   $registration_list =
//     '
//         <li class="nav-item">
//           <a href="list_users" class="nav-link sidebar-link">
//             &nbsp; 

//             <i class="nav-icon fa fa-users icons"></i>
//             <p> &nbsp; User Credentials</p>
//           </a>
//         </li>';
// }

//   $incident_report =
//     ' <li class="nav-item">
//         <a href="list_incident" class="nav-link sidebar-link">
//           &nbsp; 
//           <i class="fas fa-car-crash " id="icons"></i>
//           <p> &nbsp;
//             Incident Report
//           </p>
//         </a>
//         </li>';


//   $infection =
//     '
//   <li class="nav-item">
//   <a href="https://forms.gle/hPFdN8XDr9VpSYYt7" class="nav-link sidebar-link">
//     &nbsp;
//     <i class="nav-icon fas fa-file-alt"></i>

//     <p> &nbsp; Sources of Infection</p>
//   </a>
// </li>';

//   $contacts =
//     '
//       <li class="nav-item">
//       <a href="https://forms.gle/7uxgB4rvGU6ZMDdx6" class="nav-link sidebar-link">
//         &nbsp;
//         <i class="nav-icon fas fa-file-alt"></i>

//         <p> &nbsp; Close Contacts</p>
//       </a>
//     </li>';

//   $covid_case = '     <label id="label1" style="font-size:18px; ">
//     &nbsp;
//     <i class="nav-icon fas fa-briefcase-medical icons "></i>
//     &nbsp;
//     COVID-19 CASES
//   </label>';








//   // individual form  
//   $view_history = '
//     <a class="btn btn-success btn-sm" id="view_history" href="view_individual_history.php?&entity_no=' . $get_individual_entity . '">
//     <i class="fa fa-suitcase"></i>
//   </a>';



//   $covid_contact = '    <li class="nav-item">
//             <a href="list_contact" class="nav-link sidebar-link">
//               &nbsp;
//               <i class="nav-icon fas fa-people-arrows icons"></i>
//               <p> &nbsp; Close Contacts </p>
//             </a>
//           </li>';


//           $add_contact_case = '    <li class="nav-item">
//           <a href="add_contact_case" class="nav-link sidebar-link">
//             &nbsp;
//             <i class="nav-icon fas fa-people-arrows icons"></i>
//             <p> &nbsp; Close Contact Form </p>
//           </a>
//         </li>';

//   $settings = '  <label id="label1" style="font-size:18px; ">
//                         &nbsp;
//                         <i class="nav-icon fa fa-cogs icons"></i>
//                         &nbsp;
//                         SETTINGS
//                     </label>';


//   $mobile_alert =  '    <li class="nav-item ">

//                                 <a href="#addnew" data-toggle="modal" data-target="#push_notify" class="nav-link sidebar-link">
//                                 &nbsp; 
//                                 <i class="fa fa-bell-o nav-icon icons" ></i>
//                                 <p>&nbsp; Mobile Alert</p>
//                                 </a>

//                             </li>';


//   $covid_positive = ' <li class="nav-item">
// <a href="list_positive_cases" class="nav-link sidebar-link">
//   &nbsp;
//   <i class="nav-icon fas fa-user-plus icons"></i>
//   <p> &nbsp; COVID Positive </p>
// </a>
// </li> ';







//   $post_announce = '
//                             <li class="nav-item">
//                               <a href="view_all_posts" class="nav-link sidebar-link">
//                                 &nbsp; 
//                                 <i class="nav-icon fa fa-bullhorn icons"></i>
                  
//                                 <span class="badge badge-danger navbar-badge">  ';

//   $post_last = '</span> 
                                
//                 <p>&nbsp; Post Announcement </p>
//                 </a>
//                 </li>';





//   if ($numberofdraft > 0) {
//     $post_announce_last = $post_announce . " " . $numberofdraft . " " . $post_last;
//   }




//   $break = '<br><br><br><br>';
// }






// if ($_SESSION['user_type'] == 3) {

//   $infection =
//     '
//   <li class="nav-item">
//   <a href="https://forms.gle/hPFdN8XDr9VpSYYt7" class="nav-link sidebar-link">
//     &nbsp;
//     <i class="nav-icon fas fa-file-alt"></i>

//     <p> &nbsp; Sources of Infection</p>
//   </a>
// </li>';

//   $contacts =
//     '
//       <li class="nav-item">
//       <a href="https://forms.gle/7uxgB4rvGU6ZMDdx6" class="nav-link sidebar-link">
//         &nbsp;
//         <i class="nav-icon fas fa-file-alt"></i>  

//         <p> &nbsp; Close Contacts</p>
//       </a>
//     </li>';


    
//     $view_history = '
//     <a class="btn btn-success btn-sm" id="view_history" href="view_individual_history.php?&entity_no=' . $get_individual_entity . '">
//     <i class="fa fa-suitcase"></i>
//   </a>';

// }

//     if ($_SESSION['user_type'] == 4) {

//       $infection =
//         '
//       <li class="nav-item">
//       <a href="https://forms.gle/hPFdN8XDr9VpSYYt7" class="nav-link sidebar-link">
//         &nbsp;
//         <i class="nav-icon fas fa-file-alt"></i>
    
//         <p> &nbsp; Sources of Infection</p>
//       </a>
//     </li>';
    
//       $contacts =
//         '
//           <li class="nav-item">
//           <a href="https://forms.gle/7uxgB4rvGU6ZMDdx6" class="nav-link sidebar-link">
//             &nbsp;
//             <i class="nav-icon fas fa-file-alt"></i>  
    
//             <p> &nbsp; Close Contacts</p>
//           </a>
//         </li>';


//         $view_history = '
//         <a class="btn btn-success btn-sm" id="view_history" href="view_individual_history.php?&entity_no=' . $get_individual_entity . '">
//         <i class="fa fa-suitcase"></i>
//       </a>';
    

              
//     $covid_case = '     <label id="label1" style="font-size:18px; ">
//    &nbsp;
//     <i class="nav-icon fas fa-briefcase-medical icons "></i>
//     &nbsp;
//     COVID-19 CASES
//   </label>';

//   $covid_positive = ' <li class="nav-item">
//   <a href="list_positive_cases" class="nav-link sidebar-link">
//     &nbsp;
//     <i class="nav-icon fas fa-user-plus icons"></i>
//     <p> &nbsp; COVID Positive </p>
//   </a>
//   </li> ';

//   $covid_contact = '    <li class="nav-item">
//                 <a href="list_contact" class="nav-link sidebar-link">
//                   &nbsp;
//                   <i class="nav-icon fas fa-people-arrows icons"></i>
//                   <p> &nbsp; Close Contacts </p>
//                 </a>
//               </li>';

