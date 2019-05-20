<?php 
session_start();
if (! isset($_SESSION['user_id'])) {
	header("location: login.php");
}

$connection = mysqli_connect("localhost", "root", "", "job_board");

// Get user login
$sql = 'SELECT * FROM user WHERE user_id = ' . $_SESSION['user_id'];
$result = mysqli_query($connection , $sql);
$user = mysqli_fetch_array($result, MYSQLI_ASSOC);

if(isset($_POST["submit"])){
	$job_title = $_POST['job_title'];
	$job_salary = $_POST['job_salary'];
	$job_description = $_POST['job_description'];
	$job_qualification = $_POST['job_qualification'];



$query = "INSERT INTO job (job_title, job_salary, job_description, job_qualification, user_id) VALUES  ('$job_title', '$job_salary', '$job_description', '$job_qualification', '" . $_SESSION['user_id'] . "')";

			
			
			$result = mysqli_query($connection , $query);

			if(!$result){
				die("Query failed" . mysqli_error($connection));
			}

			echo "<script>alert(You have successfully posted a job!)</script>";
			header("location: dashboard.php");
			return;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Post a Job</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
<div class="row justify-content-center">
	<div class="col-md-8">
         <div class="card">
                <div class="card-header"><h1>Post a Job</h1></div>
                    <div class="card-body">
						<form class="form-horizontal" method="post" action="job_create.php">
							<div class="row">
								<div class="col-md-12">
                                	<label for="job_title" class="control-label">Job title</label>
                                    <input type="text" class="form-control" name="job_title" id="job_title" placeholder="Enter the job title of your post" required>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-md-12">
                                	<label for="job_salary" class="control-label">Salary range:</label>
                                    <select name="job_salary"class="form-control " required>
	                                    <option>< 10,000.00</option>
	                                    <option>10,000.00 - 20,000.00</option>
	                                    <option>20,000.00 - 30,000.00</option>
	                                    <option>30,000.00 - 40,000.00</option>
	                                    <option>40,000.00 <</option>
	                                </select>
	                            </div>    
                            </div>
                            <div class="row">
                            	<div class="col-md-12">
							    	<label for="job_description">Job Description</label>
							    	<textarea name="job_description" class="form-control" id="job_description" rows="3" placeholder="Describe the job you're offering" required></textarea>
							  	</div>
							</div>  	
							<div class="row">
								<div class="col-md-12">
							    	<label for="job_qualification">Job Qualification</label>
							    	<textarea name="job_qualification" class="form-control" id="job_qualification" rows="3" placeholder="What are the qualifications for this job?" required=""></textarea>
							  	</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-12">
                        			<button type="submit" class="btn btn-primary btn-block login-button" name="submit" value="submit">Post Job</button>
                        		</div>
                        	</div>
						</form>
					</div>
				</div>
		</div>
	</div>
</div>
</div>


</body>
</html>