<?php

include_once('../config.php');
$conn = connect();

$batchData = selectBatch($conn);

while ($row = mysqli_fetch_assoc($batchData)) {
    $batchList[] = $row;
}

$json['batchList'] = $batchList;
echo json_encode($json);
?>