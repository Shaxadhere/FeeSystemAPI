<?php 

include_once("../config.php");

$Username = $_REQUEST["Username"];
$Password = $_REQUEST["Password"];
$conn = connect();

$authUser = mysqli_fetch_assoc(getUser($Username, $Password, $conn));

$temp[] = $authUser;


if(isset($authUser)){
    $json['users'] = $temp;
    echo json_encode($json);

}
else{
    echo "false";
}
?>
