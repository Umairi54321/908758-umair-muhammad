<?php
// header included
include "header.php";
?>
<!-- Login Form Start -->
<section>
    <div class="container-fluid">
        <div class="login-container">
            <!-- Image Area -->
            <div class="login-img">
                <img src="assets\images\login-banner.png" alt="">
            </div>
            <!-- Form Area -->
             <div class="login-form">
                 <form method="POST">
                     <h3>
                         Login HealthCare Consultant
                     </h3>
                     <div class="inputField-container">
                       <input type="email" placeholder="Email Address" name="email" required>
                   </div>
                   <div class="inputField-container">
                       <input type="password" placeholder="Password" name="password" required>
                   </div>
                   <a class="forget-password" href="doctor-login.php">Are you Doctor?</a>
                   <input type="submit" name="login" value="Login">
                   <p>
                       <span>Don’t have an account?</span><a href="register.php">Register</a>
                    </p>
                 </form>

             </div>
        </div>

    </div>
</section>
<!-- Login Form End -->

<?php
// Footer included
include "footer.php";
    ?>