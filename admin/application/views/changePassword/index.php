  <!-- Start content -->
  <div class="content">

      <div class="container-fluid">
          <div class="page-title-box">

              <div class="row align-items-center ">
                  <div class="col-md-12">
                      <div class="page-title-box">
                          <h4 class="page-title">Change Password</h4>

                      </div>
                  </div>
              </div>
          </div>
          <!-- end page-title -->

          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-body">
                          <form method='POST' action="<?=site_url();?>master/password/update"
                              enctype="multipart/form-data">
                              <?php

if($this->session->flashdata('change-password-error'))
{
echo '
<div class="alert alert-danger mb-2">
'.$this->session->flashdata("change-password-error").'
</div>
';
}
?>
                              <?php

if($this->session->flashdata('change-password-success'))
{
echo '
<div class="alert alert-success mb-2">
'.$this->session->flashdata("change-password-success").'
</div>
';
}
?>

                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Password</label>
                                  <div class="col-sm-10">
                                      <input class="form-control" type="password" name='password' placeholder='Password'
                                          required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Confirm Password</label>
                                  <div class="col-sm-10">
                                      <input class="form-control" type="password" name='confirm_password'
                                          placeholder='Confirm Password' required>
                                  </div>
                              </div>










                              <div class="form-group mb-0">
                                  <div class='text-center'>
                                      <button type="submit" name='add' class="btn btn-primary waves-effect waves-light">
                                          Save
                                      </button>
                                      <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                          Reset
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <!-- end col -->
          </div>
          <!-- end row -->

      </div>
      <!-- container-fluid -->

  </div>
  <!-- content -->