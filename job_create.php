<?php 
session_start();
session_destroy();
$connection = mysqli_connect("localhost", "root", "", "job");

if(isset($_POST["submit"])){
	$job_title = $_POST['job_title'];
	$job_salary = $_POST['job_salary'];
	$job_description = $_POST['job_description'];
	$job_qualification = $_POST['job_qualification'];


$query = "INSERT INTO job (job_title, job_salary, job_description, job_qualification) VALUES  ('$job_title', '$job_salary', '$job_description', '$job_qualification')";

			
			
			$result = mysqli_query($connection , $query);

			if(!$result){
				die("Query failed" . mysqli_error());
			}

			// echo "You have successfully posted a job! ";
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
						<form class="form-orizontal" method="post" action="job_create.php">
							<div class="form-group">
                                <label for="job_title" class="cols-sm-2 control-label">Job title</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                        	<input type="text" class="form-control" name="job_title" id="job_title" placeholder="Enter the job title of your post" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="job_salary" class="cols-sm-2 control-label">Salary range:</label>
                                    <select name="job_salary"class="form-control form-control-sm" required>
	                                    <option>< 10,000.00</option>
	                                    <option>10,000.00 - 20,000.00</option>
	                                    <option>20,000.00 - 30,000.00</option>
	                                    <option>30,000.00 - 40,000.00</option>
	                                    <option>40,000.00 <</option>                                              
                                    </select>
                            </div>
                            <div class="form-group">
							    <label for="job_description">Job Description</label>
							    	<textarea name="job_description" class="form-control" id="job_description" rows="3" placeholder="Describe the job you're offering" required></textarea>
							  	</div>
							<div class="form-group">
							    <label for="job_qualification">Job Qualification</label>
							    	<textarea name="job_qualification" class="form-control" id="job_qualification" rows="3" placeholder="What are the qualifications for this job?" required=""></textarea>
							  	</div>




                        <div class="form-group ">
                        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="submit" value="submit">Post Job</button>
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