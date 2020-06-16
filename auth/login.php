<?php 

include_once("../config.php");

$Username = $_REQUEST["Username"];
$Password = $_REQUEST["Password"];
$conn = connect();

$authUser = getUser($Username, $Password, $conn);

if($authUser != null){
    return $authUser;
}
?>