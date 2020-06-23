<?php

include_once('../config.php');
$conn = connect();

return selectProgramme($conn);

?>