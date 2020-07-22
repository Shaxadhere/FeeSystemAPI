<?php

include_once('../config.php');

$conn = connect();

//Initialising Variables//
$errors = array();

$isAdvancePaid = null;
$courseStatus = null;

$paidFee = null;

$fk_Programme = null;
$fk_Batch = null;

$JoiningDate = null;
$currentSemester = 1;


//Requesting Values//
$fullName = clean_text($_REQUEST['fullName']);
$username  = clean_text($_REQUEST['username']);
$studentId = clean_text($_REQUEST['studentId']);

$isAdvancePaid = $_REQUEST['isAdvancePaid'];
$paidFee = $_REQUEST['paidFee'];
$password = clean_text($_REQUEST['password']);
$Programme = mysqli_fetch_array(getProgrammeIdByName($_REQUEST['FK_Programme'], $conn));
$fk_Programme = $Programme[0];
$Batch = mysqli_fetch_array(getBatchIdByName($_REQUEST['FK_Batch'], $conn));
$fk_Batch = $Batch[0];
$email = $_REQUEST["email"];
$currentSemester = 1;
$joiningDate = $_REQUEST['joiningDate'];


$res = mysqli_query(
    $conn,
    "INSERT INTO `tbl_user`(`FullName`, `Username`, `StudentID`, `IsAdvancePaid`, `PaidFee`, `Password`, `FK_Programme`, `FK_Batch`, `Email`, `JoinigData`, `CurrentSemester`) VALUES ('$fullName', '$username', '$studentId', '$isAdvancePaid', '$paidFee', '$password', '1', '1', '$email', '$joiningDate', '$currentSemester')");
    
if (!$res) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
echo "pass";
exit();
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
else if(!check_existance("tbl_user", "Username", $username, $conn)){
    array_push($errors, "Username already exists");
}
else if(validateUsername($username))
{
    array_push($errors, "Invalid username provided");
}


if(empty($studentId)){
    array_push($errors, "StudentId is required");
}
else if(!check_existance("tbl_user", "Username", $studentId, $conn)){
    array_push($errors, "Student with this ID already exists");
}
else if(validatePlainText($studentId))
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

if(empty($email)){
    array_push($errors, "Email is required");
}

if($joiningDate == null){
    $joiningDate = date("Y-m-d");
}

if($errors == null){
    // $data = addStudent(
    //     'shehryar123123',
    //     'haider12312',
    //     $studentId,
    //     $isAdvancePaid,
    //     $paidFee,
    //     $password,
    //     $FK_Programme,
    //     $FK_Batch,
    //     $email,
    //     $joiningDate,
    //     $currentSemester,
    //     $conn
    // );
    // $lastStudent = getLastRow($conn);
    // showAlert($lastStudent[0]);
    // insertData("tbl_attendance", array("PK_ID"), array($lastStudent[0]), $conn);
    // echo "true";

}
else{
    $temp[] = $errors;
    $json['errors'] = $temp;
    echo json_encode($json);
}
?>