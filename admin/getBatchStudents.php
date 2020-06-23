<?php 

include_once('../config.php');

$conn = connect();
$batch = $_REQUEST['batchID'];

$batchStudents = getBactchStudents($batch, $conn);

return $batchStudents;

?>