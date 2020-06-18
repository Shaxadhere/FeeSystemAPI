<?php
include_once("../config.php");
$token = $_REQUEST['token'];
$user_id = $_REQUEST['user'];
$conn = connect();
$ResetToken = getToken($user_id, $conn);
if($token != $ResetToken[0]){
    redirectWindow("http://$_SERVER[HTTP_HOST]/feesystemapi/http_errors/404.php");
}


?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
.form-gap {
    padding-top: 70px;
}
</style>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Set New Password</h2>
                  <p>Do not reuse the old password, use a combination of caps, smalls, numbers and symbols as a password</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" action='../auth/savepassword.php' autocomplete="off" class="form" method="post">
                    <input type="hidden" class="hide" name="antiforgerytoken" id="antiforgerytoken" value="<?= $token ?>">
                    <input type="hidden" class="hide" name="id" id="id" value="<?= $user_id ?>">
                    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                          <input id="password" name="password" placeholder="New Password" class="form-control"  type="password">
                          <input id="confirm" name="confirm" placeholder="Confirm Password" class="form-control"  type="password">
                        </div>
                        <span id='message' style="float: left;"></span>
                        <br>
                      </div>
                      <div class="form-group">
                        <input name="reset" class="btn btn-lg btn-primary btn-block" value="Save Password" type="submit">
                      </div> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>

<script>
    $('#password, #confirm').on('keyup', function () {
        if ($('#password').val() == $('#confirm').val()) {
            $('#message').html('Passwords match').css('color', 'green');
        } else 
        $('#message').html('Passwords does not match').css('color', 'red');
    });
</script>