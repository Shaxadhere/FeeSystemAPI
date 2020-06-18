<?php

include_once('../config.php');

if(isset($_POST['reset'])){
    $user_id = $_POST['id'];
    $token = $_POST['antiforgerytoken'];
    $newPassword = $_POST['password'];
    $conn = connect();
    $ResetToken = getToken($user_id, $conn);
    if($token == $ResetToken[0]){
        editData("tbl_User", array("Password", $newPassword, "ResetToken", ""), "PK_ID", $user_id, $conn);
        return true;
    }
    else{
        return false;
    }

}
?>