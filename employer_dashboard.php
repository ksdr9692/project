<?php
session_start();
session_destroy();
$connection = mysqli_connect('localhost', 'root', '', 'job');

$query = "SELECT * FROM users";
	$result = mysqli_query($connection,$query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Employer</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script type="text/javascript" src="jquery.3.4.1.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>



</body>
</html>


