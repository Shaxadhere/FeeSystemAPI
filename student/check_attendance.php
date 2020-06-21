<?php

include_once('../config.php');

$conn = connect();

$user_id = $_REQUEST['PK_ID'];
$User = filterUser($user_id, $conn);

$currentProgramme = $User[9];
$CurrentSemesterPosition = $User[14];
$currentSemester = getCurrentSemester($currentProgramme, $CurrentSemesterPosition, $conn);
$fetchAttendedSessions = getAttendanceDetails($user_id, $conn);

$semesterName = $currentSemester[1];
$totalSession = (int)$currentSemester[2];
$attendedSessions = (int)$fetchAttendedSessions[0];
$remainingSessions = $totalSession - $attendedSessions;

$attendacePercentage = ($attendedSessions / 100) * $totalSession;

$attenddanceDetails = array($semesterName, $totalSession, $attendedSessions, $remainingSessions);
return $attenddanceDetails;
?>