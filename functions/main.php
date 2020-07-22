<?php

//Adding Header With Dynamic Title//
function getHeader(string $pageName, string $headerPath)
{
    ob_start(); 
    include($headerPath);
    //include("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();
    $title = $pageName;
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . ' - JamesThrew$3', $buffer);

    echo $buffer;
}

//Calling Footer//
function getFooter(string $link){
    include($link);
}

//Redirecting//
function redirectWindow(string $url)
{
    echo "<script>window.location.href='$url';</script>";
}

//Showing Alert//
function showAlert(string $msg)
{
    echo "<script>alert('$msg');</script>";
}

//Insert Data//
function insertData(string $table,array $fields,array $values,$conn){
    //Managing Fields//
    $quote = '';
    $c = 0;
    foreach ($fields as $item) {
        $quote.="`$item`";
        $c++;
        if($c < count($fields))
        {
            $quote.=',';
        }
    }
    //Managing Values//
    $valQuote = '';
    $valc = 0;
    foreach ($values as $item) {
        $valQuote.="'$item'";
        $valc++;
        if($valc < count($fields))
        {
            $valQuote.=',';
        }
    }
    //Making Query//
    $query = "insert into `$table` (".$quote.") values (".$valQuote.")";
    mysqli_query($conn, $query);
}

//Fetching Data//
function fetchData(string $table, $conn){
    $query = "select * from `".$table."`";
    return mysqli_query($conn, $query);
}

//Getting Info//
function getInfo(string $table, string $PrimaryKey, $id, $conn){
    $query = "select * from `$table` where $PrimaryKey = $id";
    return mysqli_query($conn, $query);
}

//Deleting Data//
function deleteData(string $table, string $PrimaryKey, $id, $conn){
    $query = "DELETE FROM `$table` WHERE $PrimaryKey = $id";
    mysqli_query($conn, $query);
}

//Editing Data//
function editData(string $table, array $data, string $PrimaryKey, $id, $conn){
    //Managing Data
    $ini = '';
    $c = 0;
    $mm = count($data);
    foreach($data as $item){
        $c++;
        if($mm % 2 == 0){
            $ini .= "`$item`=";
        }
        if($mm % 2 != 0){
            $ini .= "'$item'";
        }
        if($mm % 2 != 0 && $c < count($data))
        {
            $ini.=',';
        }
        if($c == count($data)){
            $ini .= '';
        }
        $mm--;
    }
    $query = "UPDATE `$table` SET $ini WHERE $PrimaryKey = $id";
    mysqli_query($conn, $query);
}
//Get User Data//
function getUser(string $username, string $password, $conn){
    $res = mysqli_query($conn, "select * from tbl_user where Username = $username and Password = $password");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//Get User Data//
function getAdmin(string $username, string $password, $conn){
    $res = mysqli_query($conn, "select * from tbl_admin where Username = $username and Password = $password");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//Get User Email//
function getContact(string $username, $conn){
    $res = mysqli_query($conn, "select `PK_ID`, `Email`, `FullName` from tbl_user where Username = $username");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return mysqli_fetch_array($res);
}

//Filter User//
function filterUser($id, $conn){
    $res = mysqli_query($conn, "select * from tbl_user where PK_ID = $id");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return mysqli_fetch_array($res);
}

//Get All Semesters//
function getCurrentSemester($programmeID, $position, $conn){
    $res = mysqli_query($conn, "SELECT * from tbl_semester where tbl_semester.FK_ProgrammeSemester = $programmeID and tbl_semester.Position = $position");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return mysqli_fetch_array($res);
}

//Get Attendance Details//
function getAttendanceDetails($FK_User, $conn){
    $res = mysqli_query($conn, "SELECT tbl_attendance.AttendedSessions from tbl_attendance where tbl_attendance.FK_User = $FK_User");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return mysqli_fetch_array($res);
}

//Get Reset Token//
function getToken($id, $conn){
    $res = mysqli_query($conn, "select `ResetToken` from tbl_user where PK_ID = $id");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return mysqli_fetch_array($res);
}

//Get User Email//
function getBatches($conn){
    $res = mysqli_query($conn, "SELECT `PK_ID`, `BatchID` FROM `tbl_batch` ORDER BY tbl_batch.PK_ID");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//Clean Text//
function clean_text($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);
	return $string;
}

//Generate Radnom String
function random_strings ($length_of_string) 
{
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
	return substr(str_shuffle($str_result),0, $length_of_string); 
} 

function getFeeDetails($id, $conn){
    $res = mysqli_query($conn, "SELECT tbl_user.PK_ID, tbl_user.PaidFee, tbl_programme.TotalFee, tbl_user.JoinigData, tbl_programme.Advance, tbl_programme.Tuition, tbl_user.CourseStatus, tbl_user.IsAdvancePaid FROM tbl_user INNER JOIN tbl_programme ON tbl_user.FK_Programme = tbl_programme.PK_ID where tbl_user.PK_ID = $id");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return mysqli_fetch_array($res);
}

//GET Batch Students//
function getBactchStudents($batchID, $conn){
    $res = mysqli_query($conn, "select * from tbl_user where FK_Batch = $batchID");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//Mark Attendance//
function markAttendance($attendedSessions, $user_id, $conn){
    $res = mysqli_query($conn, "update tbl_attendance set tbl_attendance.AttendedSessions = tbl_attendance.AttendedSessions + $attendedSessions where FK_User = $user_id");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//Select Batch//
function selectBatch($conn){
    $res = mysqli_query($conn, "SELECT `PK_ID`, `BatchID` FROM `tbl_batch` ORDER BY tbl_batch.PK_ID DESC");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//Select Programme//
function selectProgramme($conn){
    $res = mysqli_query($conn, "SELECT `PK_ID`, `ProgrammeName` FROM `tbl_programme` ORDER BY tbl_programme.PK_ID DESC");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//GetUserBatch//
function getBatch($user_id, $conn){
    $res = mysqli_query($conn, "SELECT `BatchID` FROM `tbl_batch` INNER join tbl_user on tbl_batch.PK_ID = tbl_user.FK_Batch where  tbl_user.PK_ID = $user_id");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//GetUserBatch//
function getProgramme($user_id, $conn){
    $res = mysqli_query($conn, "SELECT `ProgrammeName` FROM `tbl_programme` INNER join tbl_user on tbl_programme.PK_ID = tbl_user.FK_Programme where  tbl_user.PK_ID = $user_id");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//Check if same value already exists//
function check_existance($table, $column_name, $value, $conn){
    $res = mysqli_query($conn, "select count($column_name) from $table where $column_name = $value");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    $num = mysqli_fetch_array($res);
    if($num[0] == 0){
        return true;
    }
    else{
        return false;
    }
}

//Get Programme ID//
function getProgrammeIdByName($name, $conn){
    $res = mysqli_query($conn, "SELECT `PK_ID` FROM `tbl_programme` WHERE tbl_programme.ProgrammeName = '$name'");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//Get Batch ID//
function getBatchIdByName($name, $conn){
    $res = mysqli_query($conn, "SELECT `PK_ID` FROM `tbl_batch` WHERE tbl_batch.BatchID = '$name'");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//Add Student//
function addStudent($fullName, $username, $studentId, $isAdvancePaid, $paidFee, $password, $FK_Programme, $FK_Batch, $email, $joiningDate, $currentSemester, $conn){
    echo $fullName.$username;
    exit;
    $res = mysqli_query(
        $conn,
        "INSERT INTO `tbl_user`(`FullName`, `Username`, `StudentID`, `IsAdvancePaid`, `PaidFee`, `Password`, `FK_Programme`, `FK_Batch`, `Email`, `JoinigData`, `CurrentSemester`) VALUES ('1111123fullName', '1111123username', '$studentId', '$isAdvancePaid', '$paidFee', '$password', '1', '1', '$email', '$joiningDate', '$currentSemester')");
        
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
}

//Initialise Attendance//
function getLastRow($conn){
    $res = mysqli_query($conn, "SELECT PK_ID FROM tbl_user ORDER BY PK_ID DESC LIMIT 1");
    if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    return $res;
    
}

//Get next days//
function getNextDays($number_of_days){
    $days   = [];
    $period = new DatePeriod(
    new DateTime(), // Start date of the period
    new DateInterval('P1D'), // Define the intervals as Periods of 1 Day
    $number_of_days // Apply the interval 6 times on top of the starting date
    );

    foreach ($period as $day)
    {
        $days[] = $day->format('Y-m-d H:i:s');
    }
    return $days;
}

//Calculate months between two dates//
function calcMonths($start_date, $end_date){
    $ts1 = strtotime($start_date);
    $ts2 = strtotime($end_date);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    return $diff;
}

/*Ensure that we have at least three out of four password criteria met. 
This would far more complicated to achieve using standard regular expressions
charecter one is not working*/
function validatePassword(string $password) {
    $count = 0;
 
    if( 8 <= strlen($password) && strlen($password) <= 32  )
    {
       if(preg_match("/^.*\\d.*$/", $password))
          $count ++;
       if(preg_match("/^.*[a-z].*$/", $password))
          $count ++;
       if(preg_match("/^.*[*.!@#$%^&(){}[]:;<>,.?~_-=|].*$/", $password))
          $count ++;
       if(preg_match("/^.*[A-Z].*$/", $password))
          $count ++;
    }

    if($count >= 3){
        return true;
    }
    else{
        return false;
    }
}

//Validate a username//
function validateUsername(string $username){
    if(!empty($username)){
        if(preg_match("/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $username)){
            return true;
        }
    }
}

//Validate plain Text//
function validatePlainText(string $plainText){
    if(!empty($plainText)){
        if(preg_match("/^[a-zA-Z ]*$/", $plainText)){
            return true;
        }
    }
}

//Validate alphanumeric//
function validateAlphanumeric(string $alphanumeric){
    if(!empty($alphanumeric)){
        if(preg_match("/^[A-Za-z0-9]*$/", $alphanumeric)){
            return true;
        }
    }
}
?>