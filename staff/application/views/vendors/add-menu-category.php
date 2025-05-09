<!-- Start content -->
<div class="content">

    <div class="container-fluid">
        <div class="page-title-box">

            <div class="row align-items-center ">
                <div class="col-md-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Menu Category Add</h4>

                    </div>
                </div>
            </div>
        </div>
        <!-- end page-title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method='POST' enctype="multipart/form-data" action="<?=site_url();?>master/vendors/save-menu-category">
                            
                            <input type="hidden" name='vendor_id' value="<?=$this->input->get('vendor_id')?>">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Branch Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name='branch_slug' required>
                                        <option value="" disabled selected>Please Choose Branch Type</option>
                                            <option value="mall">Mall</option>
                                            <option value="non-mall">Non Mall</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Menu Category Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name='category_name'
                                        placeholder='Category Name' required>
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