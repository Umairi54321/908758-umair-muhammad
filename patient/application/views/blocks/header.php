 <!-- Header Start -->
 <header id="header">
        <div class="container-fluid">
            <div class="menu-bar">
                <!-- Logo -->
                <a href="<?=base_url()?>" class="logo">
                    <h1>HealthCare Consultant</h1>
                </a>

                <!-- Navbar -->
                <nav id="nav">
                    <div class="mobile-logo">
                        <h1>HealthCare Consultant</h1>
                    </div>
                    <ul>
                        <li>

                        </li>
                        <li>
                            <a href="<?=base_url()?>">Home </a>
                        </li>


                        <?php
        if($this->session->userdata('patient_id')){
          ?>
        <li class='dropdown'>
          <a href='#' >Patients <i class='fa fa-angle-down' aria-hidden='true'></i></a>
          <div class='dropdown-content'>
            <a href="<?=base_ur()?>dashboard">Dashboard</a>
            <a href='<?=base_ur()?>appointments'>Appointments</a>
            <a href='<?=base_ur()?>ward-assignment'>Ward Assignment</a>
               <a href='<?=base_ur()?>examination-results'>Examination Results</a>
               <a href='<?=base_url()?>logout'>Logout</a>
          </div>
        </li>

        <?php } ?>

                        <li>
                            <a href="<?=base_url()?>about-us">About Us</a>
                        </li>
                        <li>
                            <a href="<?=base_url()?>contact-us">Contact Us</a>
                        </li>

                        <li>
                            <a href="<?=base_url()?>faq">FAQ's</a>
                        </li>


                        <li class="login">
                            <a href="<?=base_url()?>login">Login / Signup</a>
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
       if ($this->session->userdata('patient_id')) {
        ?>
                
      <div class='dropdown_menu'>
        <img src='$profile_pic' alt=''>
        <button><i class='fa fa-angle-down' aria-hidden='true'></i></button>
        <div class='dropdown-body'>
        <p><img src='<?=base_url()?>"assets/images/default-user-image.png' alt=''></p>
        <a href="<?=base_ur()?>dashboard">Dashboard</a>
        <a href='<?=base_ur()?>appointments'>Appointments</a>
        <a href='<?=base_url()?>logout'>Logout</a>
   </div>
      </div>
      <?php
       }
       
       else {
        ?>
         <a href='<?=base_url()?>login'>
         <button>LOGIN / SIGNUP</button>
         </a>
         <?php
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