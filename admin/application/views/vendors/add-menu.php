<!-- Start content -->
<div class="content">

    <div class="container-fluid">
        <div class="page-title-box">

            <div class="row align-items-center ">
                <div class="col-md-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Menu Item Add</h4>

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
                            action="<?=site_url();?>master/vendors/save-menu">
                            <?php

if($this->session->flashdata('menu-item-add'))
{
echo '
<div class="alert alert-success mb-2">
'.$this->session->flashdata("menu-item-add").'
</div>
';
}
?>

                            <?php

if($this->session->flashdata('menu-item-error'))
{
echo '
<div class="alert alert-danger mb-2">
'.$this->session->flashdata("menu-item-error").'
</div>
';
}
?>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Branch Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name='branch_slug' id='branch' required>
                                        <option selected>Please Choose Branch Type</option>
                                        <option value="mall">Mall</option>
                                        <option value="non-mall">Non Mall</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name='vendor_id' value="<?=$this->input->get('id')?>">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Menu Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name='category_id' id='category' required>
                                        <option selected>Please Choose Menu Category</option>
                                        <?php
                                        foreach($categories as $category){
                                            ?>
                                        <option value="<?=$category->id?>"><?=$category->category_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Item Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name='item_name' placeholder='Item Name'
                                        required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Item Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id='team-role' type="file" name='item_image' required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name='item_description' placeholder='Description'
                                        required></textarea>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Item Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name='item_type' id='item_type' required>
                                        <option selected value='single'>Single</option>
                                        <option value='variable'>Variable</option>
                                    </select>
                                </div>
                            </div>

                            <?php
    $language = $this->session->userdata('language');
    if($language == "English"){
?>

                            <div class="variant-section variant-english d-none">
                                <div class="form-group">
                                    <label>Variants (English)</label>
                                    <div id="variant-container-english">
                                        <div class="variant-group mb-3">
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        name="variant_size_english[]" placeholder="Size">
                                                </div>
                                                <div class="col">
                                                    <input type="number" step="0.01" class="form-control"
                                                        name="variant_price_english[]" placeholder="Price">
                                                </div>
                                                <div class="col">
                                                    <input type="number" step="0.01" class="form-control"
                                                        name="variant_calory_english[]" placeholder="Calories">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-success add-variant"
                                                        data-language="english">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
    } elseif($language == "Arabic"){
?>

                            <div class="variant-section variant-arabic d-none">
                                <div class="form-group">
                                    <label>Variants (Arabic)</label>
                                    <div id="variant-container-arabic">
                                        <div class="variant-group mb-3">
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="variant_size_arabic[]"
                                                        placeholder="Size">
                                                </div>
                                                <div class="col">
                                                    <input type="number" step="0.01" class="form-control"
                                                        name="variant_price_arabic[]" placeholder="Price">
                                                </div>
                                                <div class="col">
                                                    <input type="number" step="0.01" class="form-control"
                                                        name="variant_calory_arabic[]" placeholder="Calories">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-success add-variant"
                                                        data-language="arabic">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
    } else { // Both English and Arabic
?>

                            <div class="variant-section variant-english d-none">
                                <div class="form-group">
                                    <label>Variants (English)</label>
                                    <div id="variant-container-english">
                                        <div class="variant-group mb-3">
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        name="variant_size_english[]" placeholder="Size">
                                                </div>
                                                <div class="col">
                                                    <input type="number" step="0.01" class="form-control"
                                                        name="variant_price_english[]" placeholder="Price">
                                                </div>
                                                <div class="col">
                                                    <input type="number" step="0.01" class="form-control"
                                                        name="variant_calory_english[]" placeholder="Calories">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-success add-variant"
                                                        data-language="english">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="variant-section variant-arabic d-none">
                                <div class="form-group">
                                    <label>Variants (Arabic)</label>
                                    <div id="variant-container-arabic">
                                        <div class="variant-group mb-3">
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="variant_size_arabic[]"
                                                        placeholder="Size">
                                                </div>
                                                <div class="col">
                                                    <input type="number" step="0.01" class="form-control"
                                                        name="variant_price_arabic[]" placeholder="Price">
                                                </div>
                                                <div class="col">
                                                    <input type="number" step="0.01" class="form-control"
                                                        name="variant_calory_arabic[]" placeholder="Calories">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-success add-variant"
                                                        data-language="arabic">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
    }
?>


                            <div class="form-group row single-item">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input class="form-control" step="0.01" id='team-role' type="number" name='price'
                                        placeholder='Price' required>
                                </div>
                            </div>

                            <?php
$language = $this->session->userdata('language');
if($language == "English" || $language == "Bilingual") {
?>
                            <div id="addon-section-english">
                                <label>Addons (English)</label>
                                <div class="addon-group mb-3">
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" name="addon_for_english[]" class="form-control"
                                                placeholder="Addon For">
                                        </div>
                                        <div class="col">
                                            <input type="number" step="0.01" name="addon_price_english[]"
                                                class="form-control" placeholder="Price (leave empty if free)">
                                        </div>
                                        <div class="col">
                                            <input type="number" step="0.01" class="form-control"
                                                name="addon_calory_english[]" placeholder="Calories">
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-success add-addon"
                                                data-language="english">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
}
if($language == "Arabic" || $language == "Bilingual") {
?>
                            <div id="addon-section-arabic">
                                <label>Addons (Arabic)</label>
                                <div class="addon-group mb-3">
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" name="addon_for_arabic[]" class="form-control"
                                                placeholder="Addon For">
                                        </div>
                                        <div class="col">
                                            <input type="number" step="0.01" name="addon_price_arabic[]"
                                                class="form-control" placeholder="Price (leave empty if free)">
                                        </div>
                                        <div class="col">
                                            <input type="number" step="0.01" class="form-control"
                                                name="addon_calory_arabic[]" placeholder="Calories">
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-success add-addon"
                                                data-language="arabic">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
}
?>



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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
$(document).ready(function() {
    $('#item_type').change(function() {
        if ($(this).val() === 'single') {
            $('.single-item').show();
            $('.single-item input').prop('required', true);
            $('.variant-section').hide();
            $('.variant-section input').prop('required', false);
            $('.variant-section input').prop('disabled', true);
        } else {
            $('.single-item').hide();
            $('.single-item input').prop('required', false);
            $('.variant-section').show();
            $('.variant-section').removeClass("d-none");
            $('.variant-section input').prop('required', true);
            $('.variant-section input').prop('disabled', false);
        }
    }).change();

    $(document).on('click', '.add-variant', function() {
        var language = $(this).data('language');
        var variantContainer = $('#variant-container-' + language);

        if (variantContainer.find('.variant-group').length < 5) {
            var newVariant = variantContainer.find('.variant-group:first').clone();
            newVariant.find('input').val('');
            newVariant.find('.add-variant').removeClass('btn-success add-variant').addClass(
                'btn-danger remove-variant').text('-');
            variantContainer.append(newVariant);
        }
    });

    $(document).on('click', '.remove-variant', function() {
        $(this).closest('.variant-group').remove();
    });
});
</script>


<script>
$(document).ready(function() {
    $(document).on('click', '.add-addon', function() {
        var language = $(this).data('language');
        var addonGroup = `<div class="addon-group mb-3">
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" name="addon_for_${language}[]" class="form-control" placeholder="Addon For">
                                </div>
                                <div class="col">
                                    <input type="number" step="0.01" name="addon_price_${language}[]" class="form-control" placeholder="Price (leave empty if free)">
                                </div>
                                <div class="col">
                                    <input type="number" step="0.01" class="form-control" name="addon_calory_${language}[]" placeholder="Calories">
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-danger remove-addon">-</button>
                                </div>
                            </div>
                          </div>`;
        $('#addon-section-' + language).append(addonGroup);
    });

    $(document).on('click', '.remove-addon', function() {
        $(this).closest('.addon-group').remove();
    });
});
</script>

<script>
$(document).ready(function() {
    $('#branch').change(function() {
        var selectedDataId = $("#branch").val();
        var vendor_id = `<?=$this->input->get('id')?>`;
        if (selectedDataId) {
            $.ajax({
                url: '<?php echo site_url('Admin/Vendors/getMenuCategoriesByBranchId'); ?>', // URL of the controller method
                type: 'POST',
                data: {branch_id: selectedDataId, vendor_id: vendor_id},
                dataType: 'json',
                success: function(response) {
                    //let data = JSON.parse(response);
                    var $branchCodeDropdown = $('#category');
                    $branchCodeDropdown.empty(); // Clear previous options
                    $branchCodeDropdown.append('<option value="">Select Category</option>'); // Add default option
                    $branchCodeDropdown.append(response.options);
                    
                },
                error: function() {
                    alert('Error fetching branch codes.');
                }
            });
        } else {
            $('#branch-code').empty().append('<option value="">Select Branch Code</option>');
        }
    });
});
</script>