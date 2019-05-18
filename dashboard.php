<?php 

	session_start();

	// Check if User is Logged In, If not login, redirect to login.php
	// $_SESSION['login_user'] is only set upon valid login
	if (! isset($_SESSION['user_id'])) {
		header("location: login.php");
	}

	// Get DB connection
	$connection = mysqli_connect("localhost", "root", "", "job_board");

	// Get user login
	$sql = 'SELECT * FROM user WHERE user_id = ' . $_SESSION['user_id'];
	$result = mysqli_query($connection , $sql);
	$user = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$posts = [];
	if ($user['user_role'] == 'Employer') {
		$sql = 'SELECT job.*, user.user_company AS company
			FROM job
			INNER JOIN user
			ON user.user_id = job.user_id
			WHERE user.user_id = ' . $user['user_id']; 
		$posts = mysqli_query($connection , $sql);
	} else {
		$sql = 'SELECT * FROM job'; 
		$posts = mysqli_query($connection , $sql);
	}
?>

<style>
	header {
		height: 100px;
		background-color: pink;
	}

	.dashboard {
		margin-top: 30px;
		margin-bottom: 150px;
	}

	.profile-card {
	}

	.profile-card_description {
		padding: 1.25rem;
		border-top: 1px solid rgba(0,0,0,.125);
	}

	.job-card {
		/*max-width: 600px;*/
	}

	.text-decoration-none {
		text-decoration: none;
	}

	footer {
		height: 300px;
		background-color: lightblue;
	}
</style>

<header></header>

<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card profile-card mb-4">
					<img class="card-img-top" src="https://www.drivereasy.com/wp-content/themes/drivereasy/images/user-experienced.jpg">
					<div class="card-body">
						<h5 class="card-title" style="margin-bottom: .25rem;">
							<?= $user['user_firstName'] . ' ' . $user['user_lastName'] ?>
						</h5>
						<p class="card-text font-weight-bold">
							<a class="text-muted text-decoration-none" href="#">
								<?= $user['user_company'] ?>
							</a>
						</p>
					</div>
					<div class="card-body profile-card_description">
						<div class="card-text">
							<strong>Email:</strong> <?= $user['user_email'] ?></div>
						<div class="card-text">
							<strong>Contact:</strong> <?= $user['user_contact'] ?></div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="mb-4">
					<h4 class="d-inline-block">
						<?= $user['user_role'] == 'Employer' ? 'My Job Posts' : 'Latest Job Posts' ?>
					</h4>
					<a class="float-right" href="job_create.php">+ Create Job Post</a>
				</div>

				<?php 
					// $posts = [
					// 	[
					// 		'title' => 'Web Developer',
					// 		'company' => 'KAL Academy',
					// 		'salary' => '20, 000 PHP',
					// 		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus culpa labore repellat, impedit atque! Possimus delectus ratione, sequi voluptates reiciendis vero, quidem autem optio eveniet aspernatur odio numquam tenetur iusto.',
					// 	],
					// 	[
					// 		'title' => 'UI/UX Engineer',
					// 		'company' => 'KAL Academy',
					// 		'salary' => '20, 000 PHP',
					// 		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus culpa labore repellat, impedit atque! Possimus delectus ratione, sequi voluptates reiciendis vero, quidem autem optio eveniet aspernatur odio numquam tenetur iusto.',
					// 	],
					// 	[
					// 		'title' => 'Instructor',
					// 		'company' => 'KAL Academy',
					// 		'salary' => '20, 000 PHP',
					// 		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus culpa labore repellat, impedit atque! Possimus delectus ratione, sequi voluptates reiciendis vero, quidem autem optio eveniet aspernatur odio numquam tenetur iusto.',
					// 	],
					// ];

					for ($i=0; $i < mysqli_num_rows($posts); $i++) { 
						$post = mysqli_fetch_array($posts, MYSQLI_ASSOC);
						?>
						<div class="card job-card mb-3">
							<div class="card-body">
								<div class="row">
									<div class="col-md-8">
										<h5 class="card-title mb-1">
											<a class="text-decoration-none text-dark" href="#">
												<?= $post['job_title'] ?>
											</a>
										</h5>
										<p class="card-text">
											<a class="text-muted text-decoration-none" href="#">
												<?= $post['company'] ?>
											</a>
										</p>
									</div>
									<div class="col-md-4">
										<h6 class="float-right">
											Salary:&emsp;
											<span class="text-muted font-italic"><?= $post['job_salary'] ?></span>
										</h6>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<h6>Description:</h6>
										<p>
											<?= $post['job_description'] ?>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<h6>Qualification:</h6>
										<p>
											<?= $post['job_qualification'] ?>
										</p>
									</div>
								</div>
							</div>
						</div>		
						<?php
					}

				?>
			</div>
		</div>
	</div>
</div>

<footer></footer>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>