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
                                            <h4 class="page-title">Menu Item Edit</h4>

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
                                                action="<?=site_url();?>master/vendors/update-menu">



                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Branch Type</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name='branch_slug'  id='branch' required>

                                                           
                                                            <option
                                                                <?=($item['branch_slug'] == "mall")?"selected":""?>
                                                                value="mall">Mall
                                                                </option>

                                                                <option
                                                                <?=($item['branch_slug'] == "non-mall")?"selected":""?>
                                                                value="non-mall">Non Mall
                                                                </option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Menu Category</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name='category_id' id='category' required>

                                                            <?php
                                        foreach($categories as $category){
                                            if($this->session->userdata('language') == "English"){
                                            ?>
                                                            <option
                                                                <?=($item['category_id'] == $category->id)?"selected":""?>
                                                                value="<?=$category->id?>"><?=$category->category_name?>
                                                            </option>
                                                            <?php
                                        }
                                        elseif($this->session->userdata('language') == "Arabic"){
                                            ?>
                                                            <option
                                                                <?=($item['category_id'] == $category->id)?"selected":""?>
                                                                value="<?=$category->id?>">
                                                                <?=$category->category_name_arabic?>
                                                            </option>
                                                            <?php
                                        }
                                        else{
                                            ?>
                                                            <option
                                                                <?=($item['category_id'] == $category->id)?"selected":""?>
                                                                value="<?=$category->id?>">
                                                                <?=$category->category_name."(".$category->category_name_arabic.")"?>
                                                            </option>
                                                            <?php
                                        }
                                    }
                                        ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <input type="hidden" name='id' value="<?=$item['id']?>">





                                                <?php if ($language == 'Arabic' || $language == 'Bilingual') {
                            ?>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Item Name(Arabic)</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" name='item_name_arabic'
                                                            placeholder='Item Name in Arabic'
                                                            value="<?=$item['item_name_arabic']?>"
                                                            <?= ($language == 'Arabic') ? 'required' : '' ?>>
                                                    </div>
                                                </div>
                                                <?php
                            }
                            if ($language == 'English' || $language == 'Bilingual') {
                            ?>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Item
                                                        Name(English)</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" name='item_name'
                                                            value="<?=$item['item_name']?>"
                                                            placeholder='Item Name in English'
                                                            <?= ($language == 'English') ? 'required' : '' ?>>
                                                    </div>
                                                </div>
                                                <?php
                            }
                            ?>


                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Item Image</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id='team-role' type="file"
                                                            name='item_image'>
                                                    </div>
                                                </div>



                                                <?php if ($language == 'Arabic' || $language == 'Bilingual') { ?>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Description
                                                        (Arabic)</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name='item_description_arabic'
                                                            placeholder='Description in Arabic'
                                                            <?= ($language == 'Arabic') ? 'required' : '' ?>><?=$item['item_description_arabic']?></textarea>
                                                    </div>
                                                </div>
                                                <?php } ?>

                                                <?php if ($language == 'English' || $language == 'Bilingual') { ?>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Description
                                                        (English)</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name='item_description'
                                                            placeholder='Description in English'
                                                            <?= ($language == 'English') ? 'required' : '' ?>><?=$item['item_description']?></textarea>
                                                    </div>
                                                </div>
                                                <?php } ?>

                                                <?php

$showArabic = ($language == 'Arabic' || $language == 'Bilingual');
$showEnglish = ($language == 'English' || $language == 'Bilingual');
$item_type = $item['item_type']; // Assuming $item['item_type'] holds the current item type
$isVariable = ($item_type == 'variable');

// Check if variants exist; if not, create an empty variant
$variants_arabic = !empty($item['variants_arabic']) ? json_decode($item['variants_arabic']) : [(object)['size' => '', 'price' => '', 'calories' => '']];
$variants_english = !empty($item['variants']) ? json_decode($item['variants']) : [(object)['size' => '', 'price' => '', 'calories' => '']];
?>

                                                <div class="form-group row">
                                                    <label class='col-sm-2 col-form-label' for="item_type">Item
                                                        Type</label>
                                                    <div class="col-sm-10">
                                                        <select id="item_type" name="item_type" class="form-control">
                                                            <option value="single"
                                                                <?= ($item_type == 'single') ? 'selected' : '' ?>>Single
                                                            </option>
                                                            <option value="variable"
                                                                <?= ($item_type == 'variable') ? 'selected' : '' ?>>
                                                                Variable
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="variant-section"
                                                    style="display: <?= $isVariable ? 'block' : 'none' ?>;">
                                                    <!-- Arabic Variants Section -->
                                                    <?php if ($showArabic) { ?>
                                                    <div class="form-group">
                                                        <label>Variants (Arabic)</label>
                                                        <div id="variant-container-arabic">
                                                            <?php
            $i = 0;
            foreach ($variants_arabic as $variant) {
                ?>
                                                            <div class="variant-group mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <input type="text" class="form-control"
                                                                            value='<?= $variant->size ?>'
                                                                            name="variant_size_arabic[]"
                                                                            placeholder="Size">
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="number" step="0.01"
                                                                            class="form-control"
                                                                            value='<?= $variant->price ?>'
                                                                            name="variant_price_arabic[]"
                                                                            placeholder="Price">
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="number" step="0.01"
                                                                            class="form-control"
                                                                            value='<?= $variant->calories ?>'
                                                                            name="variant_calory_arabic[]"
                                                                            placeholder="Calories">
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <button type="button"
                                                                            class="btn btn-<?= $i == 0 ? 'success add-variant' : 'danger remove-variant' ?>"
                                                                            data-language="arabic"><?= $i == 0 ? '+' : '-' ?></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                $i++;
            }
            ?>
                                                        </div>
                                                    </div>
                                                    <?php } ?>

                                                    <!-- English Variants Section -->
                                                    <?php if ($showEnglish) { ?>
                                                    <div class="form-group">
                                                        <label>Variants (English)</label>
                                                        <div id="variant-container-english">
                                                            <?php
            $i = 0;
            foreach ($variants_english as $variant) {
                ?>
                                                            <div class="variant-group mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <input type="text" class="form-control"
                                                                            value='<?= $variant->size ?>'
                                                                            name="variant_size_english[]"
                                                                            placeholder="Size">
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="number" step="0.01"
                                                                            class="form-control"
                                                                            value='<?= $variant->price ?>'
                                                                            name="variant_price_english[]"
                                                                            placeholder="Price">
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="number" step="0.01"
                                                                            class="form-control"
                                                                            value='<?= $variant->calories ?>'
                                                                            name="variant_calory_english[]"
                                                                            placeholder="Calories">
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <button type="button"
                                                                            class="btn btn-<?= $i == 0 ? 'success add-variant' : 'danger remove-variant' ?>"
                                                                            data-language="english"><?= $i == 0 ? '+' : '-' ?></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                $i++;
            }
            ?>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>








                                                <?php
                                                 if($item['item_type'] == "single") {
?>
                                                <div class="form-group row single-item">
                                                    <label class="col-sm-2 col-form-label">Price</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" value='<?= $item['price'] ?>'
                                                            type="number" name='price' placeholder='Price' required>
                                                    </div>
                                                </div>
                                                <?php
}
?>





                                                <?php

$showArabic = ($language == 'Arabic' || $language == 'Bilingual');
$showEnglish = ($language == 'English' || $language == 'Bilingual');

// Check if addons exist; if not, create an empty addon
$addons_arabic = !empty($item['addons_arabic']) ? json_decode($item['addons_arabic']) : [(object)['addon_for' => '', 'price' => '', 'calories' => '']];
$addons_english = !empty($item['addons']) ? json_decode($item['addons']) : [(object)['addon_for' => '', 'price' => '', 'calories' => '']];
?>

                                                <div id="addon-section">
                                                    <!-- Arabic Addons Section -->
                                                    <?php if ($showArabic) { ?>
                                                    <div class="form-group">
                                                        <label>Addons (Arabic)</label>
                                                        <div id="addon-container-arabic">
                                                            <?php
            $i = 0;
            foreach ($addons_arabic as $addon) {
                ?>
                                                            <div class="addon-group mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <input type="text" class="form-control"
                                                                            value='<?= $addon->addon_for ?>'
                                                                            name="addon_for_arabic[]"
                                                                            placeholder="Addon For">
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="number" step="0.01"
                                                                            class="form-control"
                                                                            value='<?= $addon->price ?>'
                                                                            name="addon_price_arabic[]"
                                                                            placeholder="Price (leave empty if free)">
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="number" step="0.01"
                                                                            class="form-control"
                                                                            value='<?= $addon->calories ?>'
                                                                            name="addon_calory_arabic[]"
                                                                            placeholder="Calories">
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <button type="button"
                                                                            class="btn btn-<?= $i == 0 ? 'success add-addon' : 'danger remove-addon' ?>"
                                                                            data-language="arabic"><?= $i == 0 ? '+' : '-' ?></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                $i++;
            }
            ?>
                                                        </div>
                                                    </div>
                                                    <?php } ?>

                                                    <!-- English Addons Section -->
                                                    <?php if ($showEnglish) { ?>
                                                    <div class="form-group">
                                                        <label>Addons (English)</label>
                                                        <div id="addon-container-english">
                                                            <?php
            $i = 0;
            foreach ($addons_english as $addon) {
                ?>
                                                            <div class="addon-group mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <input type="text" class="form-control"
                                                                            value='<?= $addon->addon_for ?>'
                                                                            name="addon_for_english[]"
                                                                            placeholder="Addon For">
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="number" step="0.01"
                                                                            class="form-control"
                                                                            value='<?= $addon->price ?>'
                                                                            name="addon_price_english[]"
                                                                            placeholder="Price (leave empty if free)">
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="number" step="0.01"
                                                                            class="form-control"
                                                                            value='<?= $addon->calories ?>'
                                                                            name="addon_calory_english[]"
                                                                            placeholder="Calories">
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <button type="button"
                                                                            class="btn btn-<?= $i == 0 ? 'success add-addon' : 'danger remove-addon' ?>"
                                                                            data-language="english"><?= $i == 0 ? '+' : '-' ?></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                $i++;
            }
            ?>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>


                                                <div class="col-sm-10">
                                                    <img class='img-fluid' style='width:100%;'
                                                        src="<?=base_url()?>assets/images/menu-item/<?=$item['item_image']?>"
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

                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

                <script>
                $(document).ready(function() {
                    // Toggle variants section based on item_type
                    $('#item_type').change(function() {
                        var itemType = $(this).val();
                        if (itemType === 'variable') {
                            $('.variant-section').show();
                            $(".single-item").hide();

                            // Show/Hide based on language
                            var language = '<?= $language ?>';
                            if (language === 'Arabic') {
                                $('#variant-container-arabic').show();
                                $('#variant-container-english').hide();
                            } else if (language === 'English') {
                                $('#variant-container-english').show();
                                $('#variant-container-arabic').hide();
                            } else if (language === 'Bilingual') {
                                $('#variant-container-arabic').show();
                                $('#variant-container-english').show();
                            }
                        } else {
                            $('.variant-section').hide();
                            $(".single-item").show();
                        }
                    }).trigger('change'); // Trigger the change event to apply on page load

                    // Add variant
                    $(document).on('click', '.add-variant', function() {
                        var language = $(this).data('language');
                        var variantContainer = $('#variant-container-' + language);

                        if (variantContainer.find('.variant-group').length < 5) {
                            var newVariant = variantContainer.find('.variant-group:first').clone();
                            newVariant.find('input').val(''); // Clear the cloned inputs
                            newVariant.find('.add-variant').removeClass('btn-success add-variant')
                                .addClass('btn-danger remove-variant').text('-');
                            variantContainer.append(newVariant);
                        }
                    });

                    // Remove variant
                    $(document).on('click', '.remove-variant', function() {
                        $(this).closest('.variant-group').remove();
                    });
                });
                </script>








                <script>
                $(document).ready(function() {
                    // Add addon
                    $(document).on('click', '.add-addon', function() {
                        var language = $(this).data('language');
                        var addonGroup = `
        <div class="addon-group mb-3">
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
                        $('#addon-container-' + language).append(addonGroup);
                    });

                    // Remove addon
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