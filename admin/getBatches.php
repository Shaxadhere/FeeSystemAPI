<?php

include_once('../config.php');

$start_row = $_REQUEST['start_row'];
if($page_num == null){
    $page_num = 0;
}
$end_row = $page_num + 15;

$conn = connect();
return getBatches($start_row, $end_row, $conn);

?>