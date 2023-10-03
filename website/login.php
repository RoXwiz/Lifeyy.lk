<?php
include_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="images/webicon.png">
    <link rel="stylesheet" href="css/loginstyle.css">
</head>

<body>
    <button class="backbtn"><a href="index.php">Go back to home</a></button>
    <center>
        <img src="images/loginHead.gif" alt="" style="width:100px;">
        <h1>Login</h1>
    </center>
    <div>
        <form method="POST" action="">
            <label for="Username">Username</label>
            <input type="text" id="username" name="username" placeholder="Your email.." required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Your password.." required>

            <input type="submit" name="submit" value="Login">
        </form>
    </div>
    </form>
    <center>
        <p>Are you new user? <a href="register.php">Register now</a></p>
    </center>
</body>

</html>
<?php
    if (isset($_POST["submit"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $logQuary = "SELECT * FROM users WHERE user_email = '$username'";
        $logResult = mysqli_query($db, $logQuary);

        if (mysqli_num_rows($logResult) == 1) {
            $row = mysqli_fetch_assoc($logResult);
            //check password
            if ($password == $row['user_password']) {
                session_start();
                $_SESSION["id"] = $row['user_id'];
                $_SESSION["firstName"] = $row['user_firstName'];
                $_SESSION["lastName"] = $row['user_lastName'];
                header("Location:home.php");
            } else {
                echo "<script>alert('Invalid password! Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Invalid username! Please try again.');</script>";
        }
    }
    //Closing DB connection
    mysqli_close($db);
?>


