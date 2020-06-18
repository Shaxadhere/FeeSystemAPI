<?php 

include_once("../config.php");

$Username = $_REQUEST["Username"];
$Password = $_REQUEST["Password"];
$conn = connect();

$authUser = mysqli_fetch_array(getAdmin($Username, $Password, $conn));

if(isset($authUser)){
    showAlert("Authenticated");
    return $authUser;
}
else{
    showAlert("Not Authenticated");
    return false;
}
?>
