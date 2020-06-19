<?php

include_once('../config.php');

$user_id = $_REQUEST['PK_ID'];
$conn = connect();

//Getting days of months required to calculate fee//
$getFirstDay = new \DateTime('first day of this month');
$firstDay = $getFirstDay->format('Y-m-d');
$today = date("Y-m-d");
$dueDate =  date("Y-m-10");
$seventhDay = date("Y-m-7");

//Getting user's fee details///
$feeDetails = getFeeDetails($user_id, $conn);
$paidFee = $feeDetails[1];
$totalFee = $feeDetails[2];
$remainingFee = intval($totalFee) - intval($paidFee);
$advanceFee = $feeDetails[4];
$tuitionFee = $feeDetails[5];
$joiningDate = $feeDetails[3];

$isFeePaid = true;
$sendNotif = false;

//Getting the month in which fee was started to charge//
$feeStart = date("Y-m-d", strtotime("+1 month", $joiningDate));

//Calculating months from joining date till today//
$months = calcMonths($joiningDate, $today);

//Calculating Fee that is required to be paid till today//
$feeCalc = $months * $tuitionFee + $advanceFee;

//Checking if the right amount of fee is paid//
if($feeCalc == $paidFee){
    $feeInfo = array($paidFee, $totalFee, $remainingFee, $joiningDate, $isFeePaid, $sendNotif);
    return $feeInfo;
}

//Checking if right amount of fee is not paid//
if($feeCalc > $paidFee){
    $isFeePaid = false;

    //Returning data with notification//
    if($today > $seventhDay && $today <= $dueDate){
        $sendNotif = true;
        $feeInfo = array($paidFee, $totalFee, $remainingFee, $joiningDate, $isFeePaid, $sendNotif);
        return $feeInfo;
    }

    //Returning data without notification//
    if($today == $firstDay || $today >= $firstDay && $today <= $seventhDay){
        $sendNotif = false;
        $feeInfo = array($paidFee, $totalFee, $remainingFee, $joiningDate, $isFeePaid, $sendNotif);
        return $feeInfo;
    }
}

return false;

?>