<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Hospital Management System | Login</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="<?=base_url();?>assets/admin/images/favicon.ico">
    <link href="<?=base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>assets/admin/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>assets/admin/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>assets/admin/css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="accountbg"></div>


    <div class="wrapper-page">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5">
                    <div class="card card-pages shadow-none mt-4">
                        <div class="card-body">
                            <div class="text-center mt-0 mb-3">
                                <a href="" class="logo logo-admin">
                                    <img src="<?=base_url();?>assets/admin/images/logo-light.png" class="mt-3" alt=""
                                        height="26"></a>
                                <p class="text-muted w-75 mx-auto mb-4 mt-4">Enter your email address and password to
                                    access dashboard panel.</p>
                            </div>
                            

                            <form id="adminLoginForm" class="form-horizontal mt-4" method="POST">

                                <div class="form-group">
                                    <div class="col-12">
                                        <label for="username">Email Address</label>
                                        <input class="form-control" name='email' type="text" required="" id="email"
                                            placeholder="Email Address">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <label for="password">Password</label>
                                        <input class="form-control" name='password' type="password" required=""
                                            id="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group text-center mt-3">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block waves-effect waves-light"
                                            type="submit">Log In</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
    </div>

    <!-- jQuery  -->
    <script src="<?=base_url();?>assets/admin/js/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url();?>assets/admin/js/metismenu.min.js"></script>
    <script src="<?=base_url();?>assets/admin/js/jquery.slimscroll.js"></script>
    <script src="<?=base_url();?>assets/admin/js/waves.min.js"></script>
    <!-- App js -->
    <script src="<?=base_url();?>assets/admin/js/app.js"></script>

    <script>
    $('#adminLoginForm').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Logging in...',
            text: 'Please wait while we verify your credentials.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });

        $.ajax({
            url: '<?= base_url("admin/login/do_login") ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful!',
                        text: 'Redirecting to dashboard...',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        localStorage.setItem('admin_data', JSON.stringify(response.data));
                        window.location.href = '<?= base_url("admin/dashboard") ?>';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: response.message,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.',
                });
            }
        });
    });
    </script>


</body>

</html>