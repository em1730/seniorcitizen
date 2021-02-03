<?php

include ('db-config.php');
// session_start();
// $user_id = $_SESSION['id'];

    //  echo "<pre>";
    //  print_r($_GET);
    //  echo "</pre>";

//fetch user from database
$get_covid_sql = "SELECT * FROM tbl_covid";
$covid_data = $con->prepare($get_covid_sql);
$covid_data->execute();
while ($result = $covid_data->fetch(PDO::FETCH_ASSOC)) {

    $pum= $result['pum'];
    $pui= $result['pui'];
    $positive = $result['positive'];
    $death = $result['death'];
    $recovery = $result['recovery'];
    $asof   =  $result['date'];
}

//     $userInfo = [
//         'userInfo' => array(
//                 'UserID' => $userID
//         )
//   ];

    $covid = array(
        'CovidInfo' => array (
             array(
                 'pum'              => $pum,
                 'pui'              => $pui,
                 'positive'         => $positive,
                 'death'            => $death,
                 'recovery'         => $recovery,
                 'asof'             => $asof

                   )
                            )
            );
            
    echo json_encode($covid);

?>



