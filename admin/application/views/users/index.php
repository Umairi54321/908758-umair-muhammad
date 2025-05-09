 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">User's</h4>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="page-title-box text-right">
                         <button class="btn btn-success" id="addUserBtn">Add User</button>

                     </div>
                 </div>
             </div>
         </div>


         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <div class="table-responsive">



                             <table id="userTable"
                                 class="table table-bordered table-striped dt-responsive nowrap"
                                 style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                 <thead>
                                     <th>Name</th>
                                     <th>Email</th>
                                     <th>Phone</th>
                                     <th>Role</th>
                                     <th>Actions</th>

                                 </thead>

                                 <tbody>

                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- end col -->
         </div>
         <!-- end row -->


         <!-- Add/Edit Modal -->
         <div class="modal fade" id="userModal" tabindex="-1">
             <div class="modal-dialog">
                 <form id="userForm" class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">User Form</h5>
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                         <input type="hidden" name="user_id">
                         <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control"
                                 required></div>
                         <div class="form-group"><label>Email</label><input type="email" name="email"
                                 class="form-control" required></div>
                         <div class="form-group"><label>Phone</label><input type="text" name="phone"
                                 class="form-control"></div>
                         <div class="form-group">
                             <label>Role</label>
                             <select name="role" class="form-control" required>
                                 <option value="doctor">Doctor</option>
                                 <option value="nurse">Nurse</option>
                                 <option value="staff">Staff</option>
                                 <option value="admin">Admin Staff</option>
                             </select>
                         </div>
                         <div class="form-group"><label>Password</label><input type="password" name="password"
                                 class="form-control"></div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-success">Save</button>
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                     </div>
                 </form>
             </div>
         </div>



     </div>
     <!-- container-fluid -->

 </div>
 <!-- content -->



 <script>
function loadUsers() {
    $.getJSON("<?= base_url('users/get_users_api') ?>", function(users) {
        let rows = '';
        users.forEach(u => {
            rows += `<tr>
                <td>${u.name}</td><td>${u.email}</td><td>${u.phone}</td><td>${u.role}</td>
                <td>
                    <button class="btn btn-sm btn-primary editBtn" data-id="${u.id}">Edit</button>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="${u.id}">Delete</button>
                </td>
            </tr>`;
        });
        $('#userTable tbody').html(rows);
    });
}

$('#addUserBtn').click(function() {
    $('#userForm')[0].reset();
    $('input[name=user_id]').val('');
    $('#userModal').modal('show');
});

$(document).on('click', '.editBtn', function() {
    const id = $(this).data('id');
    $.getJSON("<?= base_url('users/get_users_api') ?>", function(users) {
        const u = users.find(user => user.id == id);
        if (u) {
            $('input[name=user_id]').val(u.id);
            $('input[name=name]').val(u.name);
            $('input[name=email]').val(u.email);
            $('input[name=phone]').val(u.phone);
            $('select[name=role]').val(u.role);
            $('input[name=password]').val('');
            $('#userModal').modal('show');
        }
    });
});

$('#userForm').submit(function(e) {
    e.preventDefault();
    const id = $('input[name=user_id]').val();
    const url = id ? "<?= base_url('users/update_user_api/') ?>" + id : "<?= base_url('users/add_user_api') ?>";
    $.post(url, $(this).serialize(), function(res) {
        Swal.fire(res.status ? 'Success' : 'Error', res.message, res.status ? 'success' : 'error');
        if (res.status) {
            $('#userModal').modal('hide');
            loadUsers();
        }
    }, 'json');
});

$(document).on('click', '.deleteBtn', function() {
    const id = $(this).data('id');
    Swal.fire({
        title: 'Delete user?',
        showCancelButton: true,
        confirmButtonText: 'Delete'
    }).then(res => {
        if (res.isConfirmed) {
            $.get("<?= base_url('users/delete_user_api/') ?>" + id, function(res) {
                Swal.fire(res.status ? 'Deleted!' : 'Error', res.message, res.status ? 'success' : 'error');
                if (res.status) loadUsers();
            }, 'json');
        }
    });
});

$(document).ready(loadUsers);
</script>