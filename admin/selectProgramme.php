<?php

include_once('../config.php');
$conn = connect();

$programmeData = selectProgramme($conn);
while ($row = mysqli_fetch_assoc($programmeData)) {
    $programmeList[] = $row;
}


$json['programmeList'] = $programmeList;
echo json_encode($json);

?>