<?php

include_once('../config.php');

$errors = array();

if(isset($_POST['reset'])){
    $user_id = $_POST['id'];
    $token = $_POST['antiforgerytoken'];
    $newPassword = $_POST['password'];
    // if(!validatePassword($password)){
    //     array_push($errors, "Password must be a combination of caps, smalls and numbers");
    // }
    $conn = connect();
    $ResetToken = getToken($user_id, $conn);
    // if($errors == null){
        if($token == $ResetToken[0]){
            editData("tbl_User", array("Password", $newPassword, "ResetToken", ""), "PK_ID", $user_id, $conn);
            redirectWindow('../resetpassword/success.php');
        }
        else{
            redirectWindow('../resetpassword/failed.php');
        }
    // }
    // else{
    //     return false;
    // }

}
?>