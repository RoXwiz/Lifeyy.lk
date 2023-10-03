<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location:login.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/homestyle.css">
    <title>Home</title>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</head>
<body>
     <div class="main">
         <nav>
             <img src="img/logo.png" alt="logo" class="logo">
             <ul>
                 <li><a href="Home.html">HOME</a></li>
                 <li><a href="aboutUs.html">ABOUT</a></li>
                 <li><a href="contactUs.html">CONTACT US</a></li>
                 <li><a href="FAQ page.html">FAQ</a></li>
                 <li><a href="logout.php">LOGOUT</a></li>
             </ul>
         </nav>
         <div class="content">
             <h1 class="anim">Plan Your Future</h1>
             <p class="anim">When it comes to taking creativity and innovation beyond borders, we are naturals at it. <br> We strive to enhance the quality of life of all Sri Lankan's.</p>
             <div class="links anim">
                <button><span></span><a href="profile.php">Profile</a></button>
                <button><span></span><a href="dashboard.php">Dashboard</a></button>
             </div>
         </div>
     </div>
     <footer>
        <div class="row">
            <div class="col">
                <img src="img/logo.png" class="footer_logo">
                <p class="footer_about">Our primary goal is to offer peace of mind and stability, allowing our clients to focus on what matters most - their family's well-being and future.


                </p>
            </div>
            <div class="col">
                <h3>Office <div class="bottom_line"><span></span></div></h3>
                <p>No:10 </p>
                <p>Union Place,</p>
                <p>Colombo, Sri Lanka</p>
                <p class="footer_email">Lifeyinsurance@gmail.com</p>
                <h4>+94 111292336</h4>
            </div>
            <div class="col">
                <h3>Links <div class="bottom_line"><span></span></div></h3>
                <ul>
                    <li><a href="aboutUs.html">ABOUT</a></li>
                    <li><a href="FAQ page.html">FAQ</a></li>
                    <li><a href="contactUs.html">CONTACT US</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>For New Offers<div class="bottom_line"><span></span></div></h3>
                <form>
                    <ion-icon class="icon" name="mail"></ion-icon>
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit"><ion-icon class="icon_right" name="arrow-round-forward"></ion-icon></button>
                </form>
                <div class="social_icons">
                    <ion-icon class="social_icon" name="logo-facebook"></ion-icon>
                    <ion-icon class="social_icon" name="logo-whatsapp"></ion-icon>
                    <ion-icon class="social_icon" name="logo-twitter"></ion-icon>
                    <ion-icon class="social_icon" name="logo-instagram"></ion-icon>
                </div>
            </div>
        </div>
        <hr>
        <p class="copyright">Lifey Lk Ⓒ 2023 - All Rights Reserved</p>
     </footer> 
</body>   
</html>