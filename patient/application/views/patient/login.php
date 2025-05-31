<section>
    <div class="container-fluid">
        <div class="registration-container">

            <!-- Image Area -->
            <div class="registration-img">
                <img src="<?= base_url('assets/images/login-banner.png') ?>" alt="Login Banner">
            </div>

            <!-- Form Area -->
            <div class="registration-form">
                <form method="POST" action="<?= base_url('login') ?>">
                    <h3>Login</h3>

                      <!-- Success Message -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Flash Messages -->
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>


                    <div class="inputField-container">
                        <input type="email" placeholder="Email Address" name="email" value="<?= set_value('email') ?>" required>
                    </div>

                    <div class="inputField-container">
                        <input type="password" placeholder="Password" name="password" required>
                    </div>

                    <input type="submit" value="Login">
                    <a class="login-link" href="<?= base_url('register') ?>">Don't have an account? Register</a>
                </form>
            </div>

        </div>
    </div>
</section>
