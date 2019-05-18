<?php 
session_start();
if (! isset($_SESSION['user_id'])) {
	header("location: login.php");
}

$connection = mysqli_connect("localhost", "root", "", "job_board");


?>