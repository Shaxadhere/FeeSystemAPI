<?php

include_once('../config.php');

$user_id = $_REQUEST['PK_ID'];
$conn = connect();

//Getting user's information//
$User = filterUser($user_id, $conn);
$currentProgramme = $User[9];
$CurrentSemesterPosition = $User[14];
$Batch = mysqli_fetch_array(getBatch($user_id, $conn));
$Programme = mysqli_fetch_array(getProgramme($user_id, $conn));
$currentSemester = getCurrentSemester($currentProgramme, $CurrentSemesterPosition, $conn);

//Getting days of months required to calculate fee//
$getFirstDay = new \DateTime('first day of this month');
$firstDay = $getFirstDay->format('Y-m-d');
$today = date("Y-m-d");
$dueDate =  date("Y-m-10");
$seventhDay = date("Y-m-7");

//Getting user's fee details///
$feeDetails = getFeeDetails($user_id, $conn);
$isAdvancePaid = $feeDetails[7];
$advanceFee = $feeDetails[4];
$tuitionFee = $feeDetails[5];
$joiningDate = $feeDetails[3];


//Final Values//
$FullName = $User[1];
$BatchCode = $Batch[0];
$StudentID = $User[3];
$ProgrammeName = $Programme[0];
$semesterName = $currentSemester[1];
$courseStatus = $feeDetails[6];
$remainingFee = intval($totalFee) - intval($paidFee);
$paidFee = $feeDetails[1];
$totalFee = $feeDetails[2];
$unpaidFee = 0;
$isFeePaid = true;
$sendNotif = false;

if(!$isAdvancePaid){
    if($paidFee >= $advanceFee){
        $isAdvancePaid = true;
        $courseStatus = true;
        editData("tbl_User", array("IsAdvancePaid", $isAdvancePaid, "CourseStatus", $courseStatus), "PK_ID", $user_id, $conn);
    }
    else{
        $courseStatus = false;
        $isAdvancePaid = false;
        editData("tbl_User", array("IsAdvancePaid", $isAdvancePaid, "CourseStatus", $courseStatus), "PK_ID", $user_id, $conn);
    } 
}

//Getting the month in which fee was started to charge//
$feeStart = date("Y-m-d", strtotime("+1 month", $joiningDate));

//Calculating months from joining date till today//
$months = calcMonths($joiningDate, $today);

//Calculating Fee that is required to be paid till today//
$feeCalc = $months * $tuitionFee + $advanceFee;

//Checking if the right amount of fee is paid//
if($feeCalc == $paidFee){
    $feeInfo = array(
        "FullName" => $FullName,
        "BatchCode" => $BatchCode,
        "StudentID" => $StudentID,
        "Programme" => $ProgrammeName,
        "SemesterName" => $semesterName,
        "CourseStatus" => $courseStatus,
        "RemainingFee" => $remainingFee,
        "TotalFee" => $totalFee,
        "PaidFee" => $paidFee,
        "UnpaidFee" => $unpaidFee,
        "IsFeePaid" => $isFeePaid,
        "SendNotif" => $sendNotif
    );
    $temp[] = $feeInfo;
    $json_array['fee'] = $temp;
    echo json_encode($json_array);
}

//Checking if right amount of fee is not paid//
else if($feeCalc > $paidFee){
    $isFeePaid = false;
    $unpaidFee = $feeCalc - $paidFee;

    //Returning data with notification//
    if($today > $seventhDay && $today <= $dueDate){
        $sendNotif = true;
        $feeInfo = array(
            "FullName" => $FullName,
            "BatchCode" => $BatchCode,
            "StudentID" => $StudentID,
            "Programme" => $ProgrammeName,
            "SemesterName" => $semesterName,
            "CourseStatus" => $courseStatus,
            "RemainingFee" => $remainingFee,
            "TotalFee" => $totalFee,
            "PaidFee" => $paidFee,
            "UnpaidFee" => $unpaidFee,
            "IsFeePaid" => $isFeePaid,
            "SendNotif" => $sendNotif
        );

        $temp[] = $feeInfo;
        $json_array['fee'] = $temp;
        echo json_encode($json_array);
    }

    //Returning data without notification//
    else if($today == $firstDay || $today >= $firstDay && $today <= $seventhDay){
        $sendNotif = false;
        $feeInfo = array(
            "FullName" => $FullName,
            "BatchCode" => $BatchCode,
            "StudentID" => $StudentID,
            "Programme" => $ProgrammeName,
            "SemesterName" => $semesterName,
            "CourseStatus" => $courseStatus,
            "RemainingFee" => $remainingFee,
            "TotalFee" => $totalFee,
            "PaidFee" => $paidFee,
            "UnpaidFee" => $unpaidFee,
            "IsFeePaid" => $isFeePaid,
            "SendNotif" => $sendNotif
        );
        $temp[] = $feeInfo;
        $json_array['fee'] = $temp;
        echo json_encode($json_array);
    }
}else{
    echo "false";
}
?>