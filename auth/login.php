<?php 

include_once("../config.php");

$Username = $_REQUEST["Username"];
$Password = $_REQUEST["Password"];
$conn = connect();

$authUser = mysqli_fetch_assoc(getUser($Username, $Password, $conn));


    $temp[] = $authUser;


$json['users'] = $temp;
$jsonformat = json_encode($json);
echo($jsonformat);




// if(isset($authUser)){
//     showAlert("Authenticated");
//     echo json_encode($authUser);
//     $json['users'] = $temp;
//     $jsonformat = json_encode($json);
//     //echo $authUser;
// }
// else{
//     showAlert("Not Authenticated");
//     echo "Not Authenticated";
//     return false;
// }
?>
