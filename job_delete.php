<?php 
session_start();
if (! isset($_SESSION['user_id'])) {
	header("location: login.php");
}


$connection = mysqli_connect("localhost", "root", "", "job_board");

$sql = 'SELECT * FROM user WHERE user_id = ' . $_SESSION['user_id'];

$result = mysqli_query($connection , $sql);
$user = mysqli_fetch_array($result, MYSQLI_ASSOC);

if(isset($_POST['delete'])){

		$job_id = $_POST['job_id'];
		$query = "DELETE FROM job WHERE user_id = " . $_SESSION['user_id'] ."  AND job_id = " . $job_id ;
		$result = mysqli_query($connection, $query);
		
	if(!$result){
		die("Query failed" . mysqli_error($connection));
	}
	else{
		header("location: dashboard.php");
		return;
	}

	$sql = "SELECT * FROM job WHERE user_id = " . $user['user_id'] . " AND job_id = " . $_GET['job_id'];
	$posts = mysqli_query($connection, $sql);
	if (! isset($_GET['job_id']) || mysqli_num_rows($posts) == 0) {
	// header('location: page_not_found.php');

	$post = mysqli_fetch_array($posts, MYSQLI_ASSOC);
}
}

?>

<div class="container">
  <div class="row justify-content-center">
	<div class="col-md-8">
         <div class="card">
            <div class="card-header justify-content-center"><h1> Deleting this a Job Post</h1></div>
                    <div class="card-body">
						<form class="form-horizontal" method="post" action="job_delete.php">
							<div class="row">
								<div class="col-md-12">

									<div class="row justify-content-center">
										<div class="col-md-4 ">
											<input type="hidden" 
							    			name="job_id"
							    			value="<?= $_GET['job_id'] ?>">

	                        				<button type="submit" class="btn btn-outline-danger btn-sm btn-inline login-button" name="delete">Yes</button>
	                        				<button type="submit" class="btn btn-outline-danger btn-sm btn-inline login-button" name="back" value="no">No</button>
	                        			</div>
									</div>
								</div>
							</div>
						</form>
					</div>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>