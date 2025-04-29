<!-- Start content -->
<div class="content">

    <div class="container-fluid">
        <div class="page-title-box">

            <div class="row align-items-center ">
                <div class="col-md-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Vendor Add</h4>

                    </div>
                </div>
            </div>
        </div>
        <!-- end page-title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method='POST' enctype="multipart/form-data" action="<?=site_url();?>master/vendors/save">
                            <?php

if($this->session->flashdata('vendor-add'))
{
echo '
<div class="alert alert-success mb-2">
'.$this->session->flashdata("vendor-add").'
</div>
';
}
?>

                            <?php

if($this->session->flashdata('vendor-error'))
{
echo '
<div class="alert alert-danger mb-2">
'.$this->session->flashdata("vendor-error").'
</div>
';
}
?>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Company Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name='full_name' placeholder='Company Name'
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name='address' placeholder='Company Address'
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id='team-role' type="text" name='city'
                                        placeholder='City' required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Country</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id='team-role' type="text" name='country'
                                        placeholder='Country' required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Registration Number</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id='team-role' type="text" name='registration_number'
                                        placeholder='Registration Number' required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Choose Logo</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id='team-role' type="file" name='company_logo' required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Owner Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id='team-role' type="text" name='owner_name'
                                        placeholder='Owner Name' required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Owner Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id='team-role' type="email" name='email'
                                        placeholder='Email Address' required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Owner Phone</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id='team-role' type="text" name='phone'
                                        placeholder='Phone Number' required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id='team-role' type="password" name='password'
                                        placeholder='Password' required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Vendor Website</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id='team-role' type="text" name='vendor_website'
                                        placeholder='Vendor Website'>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Currency</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-control" id="currency" name="currency" required>
                                        <option selected>Select Currency</option>
                                        <option value="SAR">Saudi Riyal</option>
                                        <option value="BHD">Bahraini Dinar</option>
                                        <option value="AED">UAE Dirham</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Number of Allowed Branches</label>
                                <div class="col-sm-10">
                                    <input class="form-control" min='1' max='5' type="number" name='allowed_branches'
                                        placeholder='Number of Allowed Branches' required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">VAT(%)</label>
                                <div class="col-sm-10">
                                    <input class="form-control" step="0.01" type="number" name='gst_percentage'
                                        placeholder='VAT Percentage' required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Language</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-control" id="language" name="language" required>
                                        <option selected>Select Language</option>
                                        <option value="English">English</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Bilingual">Bilingual</option>
                                    </select>

                                </div>
                            </div>





                            <div class="form-group mb-0">
                                <div class='text-center'>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
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