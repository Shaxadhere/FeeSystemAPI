<?php

include_once('../config.php');

$conn = connect();

$batches = getBatches($conn);


while ($row = mysqli_fetch_assoc($batches)) {
    $batchList[] = $row;
}

$temp[] = $batchList;
$json['batchList'] = $temp;
echo json_encode($json);

?>