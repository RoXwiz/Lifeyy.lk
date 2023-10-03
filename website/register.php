<?php
include_once 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="css/register.css" />
  
</head>
<body>
  <div class="wrapper">
  	<div class="registration_form">
  		<div class="title">
  			Registration Form
  		</div>

  		<form method="POST" action="">
  			<div class="form_wrap">
  				<div class="input_grp">
  					<div class="input_wrap">
  						<label for="fname">First Name</label>
  						<input type="text" id="fname" name="fname" required>
  					</div>
  					<div class="input_wrap">
  						<label for="lname">Last Name</label>
  						<input type="text" id="lname" name="lname" required>
  					</div>
  				</div>
  				<div class="input_wrap">
  					<label for="email">Email Address</label>
  					<input type="text" id="email" name="email" required>
  				</div>

  				<div class="input_wrap">
  					<label for="mobile">Mobile</label>
  					<input type="number" id="mobile" name="mobile" required>
  				</div>
  				<div class="input_wrap">
  					<label for="adress">Address</label>
  					<input type="text" id="address" name="address" required>
  				</div>
            <div class="input_wrap">
              <label for="Password">Password</label>
              <input type="password" id="password" name="password" required>
            </div>
          <div class="input_wrap">
  					<label>Gender</label>
  					<ul>
  						<li>
  							<label class="radio_wrap">
  								<input type="radio" name="gender" value="male" class="input_radio" checked>
  								<span>Male</span>
  							</label>
  						</li>
  						<li>
  							<label class="radio_wrap">
  								<input type="radio" name="gender" value="female" class="input_radio">
  								<span>Female</span>
  							</label>
  						</li>
  					</ul>
  				</div>
  				<div class="input_wrap">
  					<input type="submit" name="submit" value="Register Now" class="submit_btn">
  				</div>
  			</div>
  		</form>

  	</div>
  </div>
  <footer class="footer-distributed">

    <div class="footer-left">

      <h3>Lifey<span>Lk</span></h3>

      <p class="footer-links">
        <a href="home.html" class="link-1">Home</a>
        
        <a href="profile.html">Profile</a>
      
        <a href="claim.html">Claim</a>
      
        <a href="about.html">About</a>
        
        <a href="#">Faq</a>
        
        <a href="contactUs.html">Contact</a>
      </p>

      <p class="footer-company-name">LifeyLk © 2023</p>
    </div>

    <div class="footer-center">

      <div>
        <i class="fa fa-map-marker"></i>
        <p><span>No:10 Union Place, </span>  Colombo 3</p>
      </div>

      <div>
        <i class="fa fa-phone"></i>
        <p>0111292336</p>
      </div>

      <div>
        <i class="fa fa-envelope"></i>
        <p><a href="mailto:Lifeyinsurance@gmail.com">Lifeyinsurance@gmail.com</a></p>
      </div>

    </div>

    <div class="footer-right">

      <p class="footer-company-about">
        <span>About the company</span>
        Our primary goal is to offer peace of mind and stability, allowing our clients to focus on what matters most - their family's well-being and future.
      </p>

      <div class="footer-icons">

        <a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
        <a href="https://twitter.com"><i class="fa fa-twitter"></i></a>
        <a href="https://www.linkedin.com"><i class="fa fa-linkedin"></i></a>
        <a href="https://github.com"><i class="fa fa-github"></i></a>

      </div>

    </div>

  </footer>
</body>
</html>

<?php
  if (isset($_POST["submit"])) {
      $firstName = $_POST['fname'];
      $lastName = $_POST['lname'];
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];
      $address = $_POST['address'];
      $password = $_POST['password'];
      $gender = $_POST['gender'];

      $Quary = "INSERT INTO users (user_firstName, user_lastName, user_email, user_mobile, user_address, user_password, user_gender) VALUES ('$firstName', '$lastName', '$email','$mobile','$address','$password','$gender')";
      
      if(mysqli_query($db,$Quary)){
        echo "<script>
          alert('Registered successfully!, Will redirect to login page shortly');
          window.location.href='login.php';
          </script>";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  }
  //Closing DB connection
  mysqli_close($db);
?>