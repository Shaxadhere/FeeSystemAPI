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

include_once('config.php');

if(!isset($_POST["submit"])){
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    echo $password;
    echo "<br>";
    echo $hashed_password;
    echo "<br>";

    if(password_verify($password, $hashed_password) == $password){
        echo "password is correct";
    }
}

?>