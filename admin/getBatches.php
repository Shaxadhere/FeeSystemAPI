<?php

include_once('../config.php');

$conn = connect();
return getBatches(15, $conn);

?>