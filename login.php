<?php

$connection = mysqli_connect("localhost", "root", "", "job_board");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
	$user_password = mysqli_real_escape_string($connection, $_POST['user_password']);

	$sql = "SELECT user_id FROM user WHERE user_email = '$user_email' AND user_password = '$user_password'";
	$result = mysqli_query($connection , $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$active = $row ['active'];

	$count = mysqli_num_rows($result);

	if($count == 1){
		session_register('user_email');
		$_SESSION['login_user'] = $user_email;

		header("location: dashboard.php");
	}
	else{ $error = "You're Email or Password is invalid"; 
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.3.4.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.x1min.js"></script>
<script src="sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Login</h1></div>
                        <div class="card-body">
                        	<form class="form-horizontal" 
                                method="post" 
                                action="login.php">
                                <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Your Email</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                                <input type="email" 
                                                value="<?= isset($_POST['user_email'])? $_POST['user_email'] : '' ?>"
                                                class="form-control" 
                                                name="user_email" 
                                                id="user_email" 
                                                placeholder="Enter your Email" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Password</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                <input type="password"
                                                  value="<?= 
                                                    isset($_POST['user_password']) 
                                                    ? $_POST['user_password'] 
                                                    : '' ?>"
                                                  class="form-control"
                                                  name="user_password"
                                                  id="password"
                                                  placeholder="Enter your Password" 
                                                  required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="submit" value="submit">Login</button>
                                    </div>
</body>
</html>