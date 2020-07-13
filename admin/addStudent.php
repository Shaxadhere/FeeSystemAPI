<?php

include_once('../config.php');

$conn = connect();

//Initialising Variables//
$errors = array();
$fullName = '';
$username = '';
$studentId = '';
$isAdvancePaid = null;
$courseStatus = null;
$contactNumber = '';
$paidFee = null;
$password = '';
$fk_Programme = null;
$fk_Batch = null;
$Email = '';
$JoiningDate = null;
$currentSemester = 1;

//Requesting Values//
$fullName = clean_text($_REQUEST['fullName']);
$username  = clean_text($_REQUEST['username']);
$studentId = clean_text($_REQUEST['studentId']);
$isAdvancePaid = $_REQUEST['isAdvancePaid'];
$courseStatus = $_REQUEST['courseStatus'];
$contactNumber = clean_text($_REQUEST['contactNumber']);
$paidFee = $_REQUEST['paidFee'];
$password = clean_text($_REQUEST['password']);
$fk_Programme = $_REQUEST['FK_Programme'];
$fk_Batch = $_REQUEST['FK_Batch'];
$currentSemester = 1;
$joiningDate = $_REQUEST['joiningDate'];

//Validating Values//
if(empty($fullName)){
    array_push($errors, "Full name is required");
}
else if(validatePlainText($fullName))
{
    array_push($errors, "Only letters and white space is allowed");
}

if(empty($username)){
    array_push($errors, "Username is required");
}
else if(!check_existance("tbl_User", "Username", $username, $conn)){
    array_push($errors, "Username already exists");
}
else if(validateUsername($username))
{
    array_push($errors, "Invalid username provided");
}


if(empty($studentId)){
    array_push($errors, "StudentId is required");
}
else if(!check_existance("tbl_User", "Username", $studentId, $conn)){
    array_push($errors, "Student with this ID already exists");
}
else if(validateAlphanumeric($studentId))
{
    array_push($errors, "Invalid Student ID provided");
}

if(empty($password)){
    array_push($errors, "Password is required");
}
else if(validatePassword($password)){
    array_push($errors, "Password must be a combination of caps, smalls and numbers");
}

if($fk_Programme == null){
    array_push($errors, "Please select a programme");
}

if($fk_Batch == null){
    array_push($errors, "Please select a batch");
}

if(empty($Email)){
    array_push($errors, "Email is required");
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    array_push($errors, "Invalid Emaill provided");
}

if($joiningDate == null){
    $joiningDate = date("Y-m-d");
}

if($errors == null){
    $data = addStudent($fullName, $username, $studentId, $isAdvancePaid, $courseStatus, $contactNumber, $paidFee, $password, $FK_Programme, $FK_Batch, $email, $joiningDate, $currentSemester, $conn);    
    insertData("tbl_Attendance", array("PK_ID"), array($data[0]), $conn);
    echo "true";
}
else{
    echo json_encode($errors);
}
?>