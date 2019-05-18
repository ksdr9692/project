<?php
$connection = mysqli_connect("localhost", "root", "", "job_board");
$user_email = mysqli_query($connection, "SELECT user_email FROM user");
echo $user_email;
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>