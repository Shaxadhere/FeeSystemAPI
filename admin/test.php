<!DOCTYPE html>
<html>
<body>

<h2>Validate Password</h2>

<form action="" method="post">
  <input type="text" id="password" name="password" placeholder="type your password"><br>
  <input type="submit" names="submit" value="Submit">
</form> 

</body>
</html>

<?php 

include_once('../config.php');

if(!isset($_POST["submit"])){
    if(validatePassword($_POST['password'])){
        showAlert("Validated");
    }
    else{
        showAlert("Not Validated");
    }
}

?>