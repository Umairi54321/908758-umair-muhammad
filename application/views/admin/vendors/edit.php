<!-- Start content -->
<div class="content">

    <div class="container-fluid">
        <div class="page-title-box">

            <div class="row align-items-center ">
                <div class="col-md-12">
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
                                            <form method='POST' enctype="multipart/form-data"
                                                action="<?=site_url();?>master/vendors/update">
                                                <?php

if($this->session->flashdata('vendor-update'))
{
echo '
<div class="alert alert-success mb-2">
'.$this->session->flashdata("vendor-update").'
</div>
';
}
?>


                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Company Name</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" name='full_name'
                                                            value="<?=$vendor['full_name']?>" placeholder='Company Name'
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Address</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" name='address'
                                                            value="<?=$vendor['address']?>"
                                                            placeholder='Company Address' required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">City</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id='team-role' type="text"
                                                            name='city' value="<?=$vendor['city']?>" placeholder='City'
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Country</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id='team-role' type="text"
                                                            name='country' value="<?=$vendor['country']?>"
                                                            placeholder='Country' required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Registration Number</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id='team-role' type="text"
                                                            name='registration_number'
                                                            value="<?=$vendor['registration_number']?>"
                                                            placeholder='Registration Number' required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Choose Logo</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id='team-role' type="file"
                                                            name='company_logo'>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Owner Name</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id='team-role'
                                                            value="<?=$vendor['owner_name']?>" type="text"
                                                            name='owner_name' placeholder='Owner Name' required>
                                                    </div>
                                                </div>

                                                <input type="hidden" name='vendor_id' value="<?=$vendor['id']?>">

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Owner Email</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id='team-role' type="email"
                                                            name='email' value="<?=$vendor['email']?>"
                                                            placeholder='Email Address' required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Owner Phone</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id='team-role' type="text"
                                                            name='phone' value="<?=$vendor['phone']?>"
                                                            placeholder='Phone Number' required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Vendor Website</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id='team-role'
                                                            value="<?=$vendor['vendor_website']?>" type="text"
                                                            name='vendor_website' placeholder='Vendor Website'>
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Currency</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-select form-control" id="currency"
                                                            name="currency">


                                                            <option
                                                                <?= ($vendor['currency'] == "SAR") ? "selected" : "" ?>
                                                                value="SAR">Saudi Riyal</option>
                                                            <option
                                                                <?= ($vendor['currency'] == "BHD") ? "selected" : "" ?>
                                                                value="BHD">Bahraini Dinar</option>
                                                            <option
                                                                <?= ($vendor['currency'] == "AED") ? "selected" : "" ?>
                                                                value="AED">UAE Dirham</option>

                                                        </select>


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Number of Allowed
                                                        Branches</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control"
                                                            value="<?=$vendor['allowed_branches']?>" min='1' max='5'
                                                            type="number" name='allowed_branches'
                                                            placeholder='Number of Allowed Branches' readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">VAT(%)</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="number" step="0.01"
                                                            name='gst_percentage' value="<?=$vendor['gst_percentage']?>"
                                                            placeholder='VAT Percentage' required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Language</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-select form-control" id="language"
                                                            name="language" required>
                                                            <option selected>Select Language</option>
                                                            <option <?= ($vendor['language'] == "English") ? "selected" : "" ?> value="English">English</option>
                                                            <option <?= ($vendor['language'] == "Arabic") ? "selected" : "" ?> value="Arabic">Arabic</option>
                                                            <option <?= ($vendor['language'] == "Bilingual") ? "selected" : "" ?> value="Bilingual">Bilingual</option>
                                                        </select>

                                                    </div>
                                                </div>




                                                <div class="col-sm-10">
                                                    <img style='width:100%;'
                                                        src="<?=base_url()?>assets/images/company-logo/<?=$vendor['company_logo']?>"
                                                        alt="">
                                                </div>










                                                <div class="form-group mb-0">
                                                    <div class='text-center'>
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">
                                                            Save
                                                        </button>
                                                        <button type="reset"
                                                            class="btn btn-secondary waves-effect m-l-5">
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

                    <!-- end page-title -->



                </div>
                <!-- content -->