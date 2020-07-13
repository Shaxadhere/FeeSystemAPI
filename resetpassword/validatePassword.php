<?php

include_once('../config.php');

$password = $_REQUEST['password'];

if(validatePassword($password)){
    return true;
}
else{
    return "Password must be a combination of caps, smalls and numbers";
}



?>