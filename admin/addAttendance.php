<?php

include_once('../config.php');
    
$conn = connect();

$studentIDs = $_Request["studentIDs"];
$attendedSessions = $_Request["attendedSessions"];

for ($i=0; $i < sizeof($studentIDs); $i++) { 
    if($attendedSessions[$i] == null){
        $attendedSessions[$i] = 0;
    }
    markAttendance($attendedSessions[$i], $studentIDs[$i], $conn);
}

?>