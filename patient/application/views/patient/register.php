<section>
    <div class="container-fluid">
        <div class="registration-container">

            <!-- Image Area -->
            <div class="registration-img">
                <img src="<?= base_url('assets/images/login-banner.png') ?>" alt="Registration Banner">
            </div>

            <!-- Form Area -->
            <div class="registration-form">
                <form method="POST" action="<?= base_url('register') ?>">
                    <h3>Register Here</h3>

                    <!-- Success Message -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>


                    <div class="inputField-container">
                        <input type="text" placeholder="First Name" name="first_name" value="<?= set_value('first_name') ?>" required>
                    </div>

                    <div class="inputField-container">
                        <input type="text" placeholder="Last Name" name="last_name" value="<?= set_value('last_name') ?>" required>
                    </div>

                    <div class="inputField-container">
                        <input type="email" placeholder="Email Address" name="email" value="<?= set_value('email') ?>" required>
                    </div>

                    <div class="inputField-container">
                        <input type="password" placeholder="Create Password" name="password" required>
                    </div>

                    <div class="inputField-container">
                        <input type="tel" placeholder="Mobile Number" name="phone" value="<?= set_value('phone') ?>">
                    </div>

                    <div class="inputField-container">
                        <input type="text" placeholder="Address" name="address" value="<?= set_value('address') ?>">
                    </div>

                    <div class="inputField-container">
                        <input type="date" name="dob" value="<?= set_value('dob') ?>" required>
                    </div>

                    <div class="inputField-container">
                        <label><strong>Gender:</strong></label><br>
                        <input type="radio" id="male" name="gender" value="Male" <?= set_radio('gender', 'Male', true) ?>>
                        <label for="male">Male</label>

                        <input type="radio" id="female" name="gender" value="Female" <?= set_radio('gender', 'Female') ?>>
                        <label for="female">Female</label>
                    </div>

                    <input type="submit" value="Signup" name="register">
                    <a class="login-link" href="<?= base_url('login') ?>">Already have an account?</a>
                </form>
            </div>
        </div>
    </div>
</section>
