<?php
// header included
include "header.php";

?>
<!-- Contact Form Start -->
<section>
    <div class="container-fluid">
        <div class="login-container">
            <!-- Image Area -->
            <div class='d-flex w-50'>
                <div class="mr-3 border border-muted bg-white" style="position:relative; width:30%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <div class='p-3'
                        style='background:#09e5ab;left:0; right:0; margin:0 auto;position:absolute; top:-20px; border-radius:50%; display:inline-block; width:40px; height:40px; text-align:center;'>
                        <i class='fa fa-phone fs-2 text-white'></i>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center">Phone</h4>
                        <p class='text-center'>07463735273</p>

                    </div>
                </div>
                <div class="mr-3 border border-muted bg-white" style="position:relative; width:30%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <div class='bg-primary p-3'
                        style='left:0; right:0; margin:0 auto;position:absolute; top:-20px; border-radius:50%; display:inline-block; width:40px; height:40px; text-align:center;'>
                        <i class='fa fa-envelope-open-o'></i>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center">Email</h4>
                        <p class='text-center'>health-constultant@gmail.com</p>

                    </div>
                </div>
                <div class="mr-3 border border-muted bg-white" style="position:relative; width:30%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <div class=' p-3'
                        style='background:#09e5ab;left:0; right:0; margin:0 auto; position:absolute; top:-20px; border-radius:50%; display:inline-block; width:40px; height:40px; text-align:center;'>
                        <i class='fa fa-map-marker text-white'></i>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center">Location</h4>
                        <p class='text-center'>356 mayo avenue 
                             Bd8 7HP, Bradford, West     Yorkshire</p>

                    </div>
                </div>
            </div>
            <!-- Form area -->
            <div class="login-form">
                <form method="POST">
                    <h3>
                        Contact us Here
                    </h3>
                    <?php
                    //  Showing Success Msg
					if(isset($success_message) && $success_message !== ""){
					?>
                    <div class="alert alert-success wow fadeInUp" role="alert"> <?=$success_message?> </div>
                    <?php
					}
					?>
                    <?php
                        // Showing Error Msg
					if(isset($error_message) && $error_message !==""){
					?>
                    <div class="alert alert-danger wow fadeInUp" role="alert"> <?=$error_message?> </div>
                    <?php
					}
					?>

                    <div class="inputField-container">
                        <input type="text" placeholder="Your Name" name="name" required>
                    </div>
                    <div class="inputField-container">
                        <input type="email" placeholder="Email Address" name="email" required>
                    </div>
                    <div class="inputField-container">
                        <input type="text" placeholder="Subject" name="subject" required>
                    </div>
                    <div class="inputField-container">
                        <textarea name="message" id="" cols="30" rows="5" placeholder='Message' required></textarea>
                    </div>
                    <input type="submit" name="sent" value="Sent">
                </form>

            </div>
        </div>

    </div>
</section>
<iframe style='width:100%;' src="https://www.google.com/maps/d/embed?mid=1aUkfzl1JMiWs_ZEIwtWMHhEXR8A&hl=en_US&ehbc=2E312F" height="480"></iframe>
<!-- Contact Form End -->
<?php
// Footer Included
include "footer.php";
    ?>