<?php
// Session Start
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Health Care Consultant</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<!-- Head end -->
<!-- Body Start -->

<body>
    <!-- Header Start -->
    <header id="header">
        <div class="container-fluid">
            <div class="menu-bar">
                <!-- Logo -->
                <a href="/" class="logo">
                    <!-- <img src="assets\images\logo.png" width="221px"> -->
                    <h1>HealthCare Consultant</h1>
                </a>

                <!-- Navbar -->
                <nav id="nav">
                    <div class="mobile-logo">
                        <!-- <img src="assets\images\logo.png" width="160px"> -->
                        <h1>HealthCare Consultant</h1>
                    </div>
                    <ul>
                        <li>

                        </li>
                        <li>
                            <a href="index.php">Home </a>
                        </li>


                        <?php
        if(isset($_SESSION["patient-username"])){
          echo "
        <li class='dropdown'>
          <a href='#' >Patients <i class='fa fa-angle-down' aria-hidden='true'></i></a>
          <div class='dropdown-content'>
            <a href='patient-dashboard.php'>Dashboard</a>
               <a href='patient-profile.php'>Profile Settings</a>
               <a href='patient-appointment.php'>Appointments</a>
               <a href='change-password.php'>Change Password</a>
               <a href='logout.php'>Logout</a>
          </div>
        </li>";
        } ?>

                        <li>
                            <a href="about-us.php">About Us</a>
                        </li>
                        <li>
                            <a href="contact-us.php">Contact Us</a>
                        </li>

                        <li>
                            <a href="faq.php">FAQ's</a>
                        </li>


                        <li class="login">
                            <a href="login.php">Login / Signup</a>
                        </li>


                    </ul>
                </nav>
                <div class="contactInfo-container">
                    <div class="contactInfo">
                        <i class="fa fa-hospital-o" aria-hidden="true"></i>
                        <div class="info">
                            <p>Contact</p>
                            <p>07463735273</p>
                        </div>
                    </div>
                    <?php 
      
      if(isset($_SESSION["doctor-username"])){
        $profile_pic= "assets/images/default-user-image.png";
        $name=$_SESSION["doctor-username"];
        
        echo "
      <div class='dropdown_menu'>
        <img src='$profile_pic' alt=''>
        <button><i class='fa fa-angle-down' aria-hidden='true'></i></button>
        <div class='dropdown-body'>
        <p><img src='$profile_pic' alt=''> $name</p>
        <a href='doctor-dashboard.php'>Dashboard</a>
        <a href='doctor-change-password.php'>Change Password</a>
        <a href='doctor-logout.php'>Logout</a>
   </div>
      </div>";
       } 
       elseif (isset($_SESSION["patient-username"])) {
        $profile_pic= "assets/images/default-user-image.png";
        $name=$_SESSION["patient-username"];
        
        echo "
      <div class='dropdown_menu'>
        <img src='$profile_pic' alt=''>
        <button><i class='fa fa-angle-down' aria-hidden='true'></i></button>
        <div class='dropdown-body'>
        <p><img src='$profile_pic' alt=''> $name</p>
        <a href='patient-dashboard.php'>Dashboard</a>
        <a href='patient-profile.php'>Profile Setting</a>
        <a href='logout.php'>Logout</a>
   </div>
      </div>";
       }
       
       else {
         echo " <a href='login.php'>
         <button>LOGIN / SIGNUP</button>
         </a>";
       }
   ?>

                </div>
                <span class="burgerMenu">
                    <i class="fa fa-bars"></i>
                </span>
            </div>
        </div>

    </header>


    <script type="text/javascript">
    $('.burgerMenu').click(function() {
        $('body').toggleClass("show-menu");
    });
    </script>