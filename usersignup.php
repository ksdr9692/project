<?php 
session_start();
session_destroy();
$connection = mysqli_connect("localhost", "root", "", "job_board");


if(isset($_POST["submit"])){

  $user_role = $_POST["user_role"];
  $user_company = $_POST["user_company"];
  $user_loc = $_POST["user_loc"];
  $user_lastName = $_POST["user_lastName"];
  $user_firstName = $_POST["user_firstName"];
  $user_email = $_POST["user_email"];
  $user_gender = $_POST["user_gender"];
  $user_contact = $_POST["user_contact"];
  $user_password = password_hash($_POST["user_password"], PASSWORD_BCRYPT);
  $user_confirm = $_POST["user_confirm"];

	// $query = "SELECT user_email FROM applicant WHERE user_email = '$user_email'";
	// if(mysqli_num_rows($query) > 0){
	// 	$row = mysqli_fetch_assoc($query);
	// 	if($user_email==$row['user_email'] && !empty($user_email)){
	// 		echo"<script>document.getElementId('user_email') = This Email is used.</script>";
	// 	}}

	if(password_verify($user_confirm, $user_password)){

	$query = "INSERT INTO user (user_role, user_company, user_loc, user_lastName, user_firstName, user_email, user_gender, user_contact, user_password) VALUES  ('$user_role', '$user_company',  '$user_loc', '$user_lastName', '$user_firstName', '$user_email', '$user_gender', '$user_contact', '$user_password')";

			
			
			$result = mysqli_query($connection , $query);

			if(!$result){
				die("Query failed" . mysqli_error());
      echo '<div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h1 class="display-4">You have succesfully registered</h1>
              </div>
            </div>';
			}
}
else{
	echo"<script>alert('Please match your passwords');</script>";
}

// function employer(){
// $user_role = $_POST["user_role"];
//   if($user_role == "Employer"){
//                                       echo"
//                                       <div class='form-group'>
//                                         <label for='emp_company' class='cols-sm-2 control-label'>Your Company</label>
//                                         <div class='cols-sm-10'>
//                                             <div class='input-group'>
//                                                 <span class='input-group-addon'><i class='fa fa-envelope fa' aria-hidden='true'></i></span>
//                                                 <input type='text' class='form-control' name='emp_company' id='emp_company' placeholder='Enter your Company name' required/>
//                                             </div>
//                                         </div>
//                                     </div>";
//                                     };

}






?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
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
                            <div class="card-header"><h1>Register</h1></div>
                            <div class="card-body">

                                <form class="form-orizontal" 
                                method="post" 
                                action="usersignup.php">
                                    <div class="form-group">

                                        <label for="user_role" 
                                        class="cols-md-4 control-label">Apply as an:</label>

                                        <select class="form-control form-control-lg" 
                                        name="user_role">
                                        <?php
                                          $userRoles = ['Applicant', 'Employer'];
                                          foreach ($userRoles as $role) {

                                            if (isset($_POST['user_role']) 
                                              && $role == $_POST['user_role']) {
                                                
                                                echo '<option selected>' . $role . '</option>';
                                            
                                            } else {
                                              
                                              echo '<option>' . $role . '</option>';
                                            
                                            }
                                          }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_company" class="cols-sm-2 control-label">Company</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                <input type="text"
                                                  value="<?= 
                                                    isset($_POST['user_company']) 
                                                    ? $_POST['user_company'] 
                                                    : '' ?>"
                                                  class="form-control"
                                                  name="user_company"
                                                  id="password"
                                                  placeholder="Put N/A if none" 
                                                  required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_loc" class="cols-md-2 control-label">Region you're located at:</label>
                                            <select name="user_loc"class="form-control form-control-sm">
                                              <?php
                                              $userLoc = ['ARMM (Autonomous Region in Muslim Mindanao)','CAR (Cordillera Administrative Region)','NCR (National Capital Region)','Region 1 (Ilocos Region)','Region 2 (Cagayan Valley)','Region 3 (Central Luzon)','Region 4A (CALABARZON)','Region 4B (MIMAROPA)','Region 5 (Bicol Region)','Region 6 (Western Visayas)','Region 7 (Central Visayas)','Region 8 (Eastern Visayas)','Region 9 (Zamboanga Peninsula)','Region 10 (Northern Mindanao)','Region 11 (Davao Region)','Region 12 (SOCCSKSARGEN)','Region 13 (Caraga Region)'];
                                              
                                              foreach ($userLoc as $loc) {
                                                if (isset($_POST['user_loc']) && $loc == $_POST['user_loc']){
                                                  echo '<option selected>' .$loc. '</option>';
                                                } else {
                                                  echo '<option>' .$loc. '</option>';
                                                }
                                              }

                                              ?>
                                              
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" 
                                        class="cols-sm-2 control-label">Your Name</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                <input type="text" 
                                                value="<?= isset($_POST['user_lastName'])
                                                ? $_POST['user_lastName']
                                                : '' ?>"
                                                class="form-control" 
                                                name="user_lastName" 
                                                id="app_lastName" 
                                                placeholder="Last Name" required/>
                                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                <input type="text" 
                                                value ="<?= isset($_POST['user_firstName']) ? $_POST['user_lastName']
                                                : '' ?>"
                                                class="form-control" 
                                                name="user_firstName" 
                                                id="app-firstName" 
                                                placeholder="First Name." required/>
                                            </div>
                                        </div>
                                    </div>
                                    
									                  <div class="form-group">
                                        <label for="user_gender" class="cols-sm-2 control-label" required>Gender</label>
                                            <select name="user_gender" id="user_gender" class="form-control form-control-sm">
									  		                       <?php
                                                $userGender = ['Male', 'Female'];

                                                foreach($userGender as $gender) {
                                                  if (isset($_POST['user_gender']) && $gender == $_POST['user_gender']){

                                                      echo '<option selected>' .$gender. '</option>';
                                                    } 
                                                  else {
                                                    echo '<option>' .$gender. '</option>';
                                                  }
                                                }
                                                ?>
                                            </select>
									  			          </div>
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
                                        <label for="contact" class="cols-sm-2 control-label">Contact Number</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                                <input type="Number" 
                                                value="<?= isset($_POST['user_contact']) ? $_POST['user_contact'] : '' ?>"
                                                class="form-control" 
                                                name="user_contact" 
                                                id="user_contact" 
                                                placeholder="Enter your Contact Number" required>
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
                                    <div class="form-group">
                                        <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                <input type="password" 
                                                value="<?= isset($_POST['user_confirm']) ? $_POST['user_confirm'] :'' ?>" 
                                                class="form-control" 
                                                name="user_confirm" 
                                                id="user_confirm" 
                                                placeholder="Confirm your Password" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="submit" value="submit">Register</button>
                                    </div>
                                    
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
</div>

<script type="text/javascript">


</script>

</body>
</html>
