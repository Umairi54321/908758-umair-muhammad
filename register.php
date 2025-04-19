<?php
// header included
include "header.php";
?>
<!-- Register Form -->
<section>
    <div class="container-fluid">
        <div class="registration-container">
            <!-- Image Area -->
            <div class="registration-img">
                <img src="assets\images\login-banner.png" alt="">
            </div>
            <!-- Form Area -->
            <div class="registration-form">
                <form method="POST">
                    <h3>
                        Register Here
                    </h3>
                    <div class="inputField-container">
                        <input type="text" placeholder="First Name" name="fname" required>
                    </div>
                    <div class="inputField-container">
                        <input type="text" placeholder="Last Name" name="lname" required>
                    </div>
                    <div class="inputField-container">
                        <input type="email" placeholder="Email Address" name="email" required>
                    </div>
                    <div class="inputField-container">
                        <input type="tel" placeholder="Mobile Number" name="mobile" required>
                    </div>
                    <div class="inputField-container">
                        <input type="text" placeholder="Your Country" name="country" required>
                    </div>
                    <div class="inputField-container">
                        <input type="password" placeholder="Create Password" name="password" required>
                    </div>
                    <label><strong>Gender:</strong></label>
                      <input type="radio" id="male" name="gender" value="Male" checked>
                      <label for="male">Male</label>
                      <input type="radio" id="female" name="gender" value="Female">
                      <label for="female">Female</label>

                    <input type="submit" value="Signup" name="register">
                    <a class="login-link" href="login.php">Already have an account?</a>
                </form>

            </div>
        </div>

    </div>
</section>
<!-- Registration Form End -->
<?php
// Footer Included
include "footer.php";
    ?>
