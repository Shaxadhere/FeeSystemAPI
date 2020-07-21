<?php 

include_once('../config.php');

$conn = connect();
$batch = $_REQUEST['batchID'];

$batchStudents = getBactchStudents($batch, $conn);

while ($row = mysqli_fetch_assoc($batchStudents)) {
    $batchStudentsList[] = $row;
}

$temp[] = $batchStudentsList;
$json['batchStudentsList'] = $temp;
echo json_encode($json);

?>