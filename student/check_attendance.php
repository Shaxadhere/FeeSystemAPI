<?php

include_once('../config.php');

$conn = connect();

$user_id = (int)$_REQUEST['PK_ID'];

if($user_id != 0){


$User = filterUser($user_id, $conn);
$Batch = mysqli_fetch_array(getBatch($user_id, $conn));
$Programme = mysqli_fetch_array(getProgramme($user_id, $conn));

$FullName = $User[1];
$BatchCode = $Batch[0];
$ProgrammeName = $Programme[0];
$StudentID = $User[3];
$currentProgramme = $User[9];
$CurrentSemesterPosition = $User[14];
$currentSemester = getCurrentSemester($currentProgramme, $CurrentSemesterPosition, $conn);
$fetchAttendedSessions = getAttendanceDetails($user_id, $conn);

$semesterName = $currentSemester[1];
$totalSession = (int)$currentSemester[2];
$attendedSessions = (int)$fetchAttendedSessions[0];
$remainingSessions = $totalSession - $attendedSessions;

$attendacePercentage = ($attendedSessions / 100) * $totalSession;

$attenddanceDetails = array(
    "FullName" => $FullName,
    "BatchCode" => $BatchCode,
    "StudentID" => $StudentID,
    "Programme" => $ProgrammeName,
    "SemesterName" => $semesterName,
    "TotalSession" => $totalSession,
    "AttendedSessions" => $attendedSessions,
    "RemainingSessions" => $remainingSessions
);

$temp[] = $attenddanceDetails;
$json_array['attendance'] = $temp;
    
echo json_encode($json_array);

}else{
    echo "false";
}
?>