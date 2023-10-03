<?php
	include_once 'connect.php';
	session_start();
	if(!isset($_SESSION['id'])){
		header("location:login.php");
		die();
	}
	//Retreive userID from session
	$userID = $_SESSION['id'];
	//Retreiving information related to the user
	$Quary= "SELECT * FROM users u INNER JOIN plans p ON u.plan_id = p.plan_id WHERE u.user_id = '$userID'";
	$result = mysqli_query($db, $Quary);
	//Retreiving all plan information
	$planQuary= "SELECT * FROM plans";
	$planResult = mysqli_query($db, $planQuary);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Account Settings UI Design</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/profilestyle.css">
</head>
<body>
	<section class="py-5 my-5">
		<div class="container">
			<h1 class="mb-5">Profile</h1>
			<div class="bg-white shadow rounded-lg d-block d-sm-flex">
				<div class="profile-tab-nav border-right">

					<?php
					if(mysqli_num_rows($result) > 0){
						$row = mysqli_fetch_assoc($result);
					?>
					<div class="p-4">
						<div class="img-circle text-center mb-3">
							<img src="img/user2.jpg" alt="Image" class="shadow">
						</div>
						<h4 class="text-center"><?php echo $row["user_firstName"]. " " . $row["user_lastName"];?></h4>
					</div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-home text-center mr-1"></i> 
							Account
						</a>
						<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Password
						</a>
						<a class="nav-link" id="dashboard-tab" data-toggle="pill" href="#dashboard" role="tab" aria-controls="application" aria-selected="false">
							<i class="fa fa-tv text-center mr-1"></i> 
							Dashboard
						</a>
						
					</div>
				</div>
				<form method="POST" action="">
					<div class="tab-content p-4 p-md-4" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
							<h3 class="mb-4">Account</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" class="form-control" id="fname" name="fname" maxlength="20" value="<?php echo $row["user_firstName"]; ?>" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" class="form-control" id="lname" name="lname" maxlength="20" value="<?php echo $row["user_lastName"]; ?>" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input type="text" class="form-control" id="email" name="email" maxlength="30" value="<?php echo $row["user_email"]; ?>" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Phone number</label>
										<input type="number" class="form-control" id="mobile" name="mobile" maxlength="10" value="<?php echo $row["user_mobile"]; ?>" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Address</label>
										<input type="text" class="form-control" id="address" name="address" maxlength="50" value="<?php echo $row["user_address"]; ?>" required>
									</div>
								</div>
								
								
							</div>
							<div>
								<button class="btn btn-primary" type="submit" name="InfoSubmit">Update</button>
							</div>
						</div>
					</form>	
					<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
						<h3 class="mb-4">Password Settings</h3>
						<form method="POST">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Old password</label>
										<input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>New password</label>
										<input type="password" class="form-control" id="newPassword" name="newPassword" onkeyup ='check_pass();' required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Confirm new password</label>
										<input type="password" class="form-control" id="reconfirmPassword" name="reconfirmPassword" onkeyup ='check_pass();' required>
									</div>
								</div>
							</div>
							<div>
								<button class="btn btn-primary" type="submit" name="PasswordSubmit" id="PasswordSubmit" disabled>Update</button>
								<button class="btn btn-light" type="reset">Cancel</button>
							</div>
						</form>	
					</div>
					<div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
						<h3 class="mb-4">Dashboard</h3>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group"> </div>
							</div>
						</div>
						<form method="POST">
							<div>
								<div class="form-group">
									<label for="plan">Current plan</label>

									<select class="form-control" name="plan" id="plan">
									<?php
										if(mysqli_num_rows($planResult) > 0){
											while($planRow = mysqli_fetch_assoc($planResult)) {
									?>
										<option value="<?php echo $planRow['plan_id'] ?>" <?php if( $row['plan_id'] == $planRow['plan_id'] ): ?> selected="selected"<?php endif; ?>><?php echo $planRow['plan_name']. " (Yearly Rs." .$planRow['plan_amount']. ")" ?></option>
									<?php
											}
										}
										else{
											echo "<script>
											alert('Currently no plans available to purchase');
											</script>";
										}
									?>	
									</select>
								</div>
								<button class="btn btn-primary" type="submit" name="planSubmit" id="planSubmit">Update Plan</button>
							</div>
						</form>	
					</div>
				</div>
				<?php
					}
					else{
						echo "<script>alert('Hmmm we could not find your account, Contact customer support or register as a new customer!');
						window.location.href='login.php';
						</script>";
					}
				?>
			</div>
		</div>
	</section>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>	

	<script>
		function check_pass() {
			if (document.getElementById('newPassword').value == document.getElementById('reconfirmPassword').value) {
				document.getElementById('PasswordSubmit').disabled = false;
			} else {
				document.getElementById('PasswordSubmit').disabled = true;
			}
		}
	</Script>
</body>
</html>

<?php
    //Retreive userId from session
	$userID = $_SESSION['id'];
	
	if (isset($_POST['InfoSubmit'])) {
      $firstName = $_POST['fname'];
      $lastName = $_POST['lname'];
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];
      $address = $_POST['address'];

	  $Quary = "UPDATE users SET user_firstName = '$firstName', user_lastName = '$lastName', user_email = '$email', user_mobile = '$mobile', user_address = '$address' WHERE user_id = '$userID'";
      
      if(mysqli_query($db,$Quary)){
        echo "<script>
        alert('Information updated successfully!');
        </script>";
		echo "<meta http-equiv='refresh' content='0'>";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
    elseif (isset($_POST['PasswordSubmit'])) {
        $oldPassword = $_POST['oldPassword'];
		$newPassword = $_POST['newPassword'];

		$updateQuary = "UPDATE users set user_password = '$newPassword' WHERE user_id = '$userID'";
		$getUserPwQuery = "SELECT user_password FROM users WHERE user_id = '$userID'";

		$getUserPwResult = mysqli_query($db,$getUserPwQuery);

		if (mysqli_num_rows($getUserPwResult) == 1) {
            $row = mysqli_fetch_assoc($getUserPwResult);
            //check password
            if ($oldPassword == $row['user_password']) {
                if(mysqli_query($db,$updateQuary)){
					echo "<script>
					alert('Password updated successfully!');
					</script>";
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
            } else {
                echo "<script>alert('Current password is invalid! Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Hmmm we could not find your account, Contact customer support or register as a new customer!');</script>";
        }
    }
	elseif ( isset($_POST['planSubmit'])) {
		$selectedPlan = $_POST['plan'];
		$planUpdateQuery = "UPDATE users set plan_id = '$selectedPlan' WHERE user_id = '$userID'";

		if(mysqli_query($db,$planUpdateQuery)){
			echo "<script>
			alert('Plan updated successfully!');
			</script>";
		  } else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		  }
	}

	//Closing DB connection
	mysqli_close($db);
?>