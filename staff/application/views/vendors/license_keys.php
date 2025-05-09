 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">License Key's Record</h4>

                     </div>
                 </div>




             </div>
         </div>
         <!-- end page-title -->

         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <div class="table-responsive">

                             <?php if(count($list) > 0) { ?>

                             <form id="updateForm">
                                 <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo $vendor_id; ?>">
                                 <div class="form-group">
                                     <label for="allowed_branches">Allowed Number of Branches:</label>
                                     <input type="number" id="allowed_branches" name="allowed_branches"
                                         class="form-control" value="<?php echo count($list); ?>">
                                 </div>
                                 <div class="form-group mb-0">
                                     <div class='text-left'>
                                         <button id='update-key'  class="btn btn-primary waves-effect waves-light">
                                             Update
                                         </button>
                                        
                                     </div>
                                 </div>

                                 <!-- Display existing license keys -->
                                 <h3>Existing License Keys</h3>
                                 <table class="table table-bordered table-striped dt-responsive nowrap">
                                     <thead>
                                         <tr>
                                             <th>License Key</th>
                                         </tr>
                                     </thead>
                                     <tbody id="license_keys_list">
                                         <?php foreach ($list as $key): ?>
                                         <tr>
                                             <td><?php echo $key->license_key; ?></td>
                                         </tr>
                                         <?php endforeach; ?>
                                     </tbody>
                                 </table>
                             </form>

                         </div>
                         <?php
                    }else{
                    ?>
                         <div class="alert alert-danger wow fadeInUp" role="alert"> No Data Found! </div>
                         <?php
                    }
                    ?>
                     </div>
                 </div>
             </div>
             <!-- end col -->
         </div>
         <!-- end row -->

         <!-- Modal for deleting license keys -->
         <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
             aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="deleteModalLabel">Select License Keys to Delete</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form id="deleteForm">
                             <!-- License keys checkboxes will be injected here -->
                         </form>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="button" class="btn btn-danger" id="deleteKeysBtn">Delete Selected</button>
                     </div>
                 </div>
             </div>
         </div>



     </div>
     <!-- container-fluid -->

 </div>
 <!-- content -->





 <script>
$(document).ready(function() {
    // Handle allowed branches change
    $('#update-key').on('click', function(e) {
        e.preventDefault();
        const allowedBranches = $("#allowed_branches").val();
        const currentKeys = $('#license_keys_list tr').length;

        if (allowedBranches > currentKeys) {
            // Add new license keys
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('admin/Vendors/add_license_keys'); ?>',
                data: {
                    vendor_id: $('#vendor_id').val(),
                    count: allowedBranches - currentKeys
                },
                success: function(response) {
                    Swal.fire('Success', 'License keys added successfully.', 'success');
                }
            });
        } else if (allowedBranches < currentKeys) {
            // Show modal for deletion
            $('#deleteModal').modal('show');
            const excessCount = currentKeys - allowedBranches;

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('admin/Vendors/get_license_keys'); ?>',
                data: {
                    vendor_id: $('#vendor_id').val()
                },
                success: function(response) {
                    let keys = JSON.parse(response);
                    $('#deleteForm').empty();
                    keys.forEach(key => {
                        $('#deleteForm').append(`
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keys_to_delete[]" value="${key.license_key}">
                                        <label class="form-check-label">${key.license_key}</label>
                                    </div>
                                `);
                    });
                }
            });

            $('#deleteKeysBtn').off('click').on('click', function() {
                const selectedKeys = $('input[name="keys_to_delete[]"]:checked');
                if (selectedKeys.length > excessCount) {
                    Swal.fire('Error', `You can only delete up to ${excessCount} keys.`,
                        'error');
                    return;
                }

                const keysToDelete = selectedKeys.map((i, el) => $(el).val()).get();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('admin/Vendors/delete_license_keys'); ?>',
                    data: {
                        keys_to_delete: keysToDelete
                    },
                    success: function(response) {
                        Swal.fire('Success', 'License keys removed successfully.',
                            'success').then(() => {
                            window.location.reload();
                        });
                    }
                });
            });
        }
    });
});
 </script>