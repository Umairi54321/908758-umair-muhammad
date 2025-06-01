 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">Patient's</h4>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="page-title-box text-right">
                         <button class="btn btn-success" id="addPatientBtn">Add Patient</button>

                     </div>
                 </div>
             </div>
         </div>


         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <div class="table-responsive">



                             <table id="patientTable" class="table table-bordered table-striped dt-responsive nowrap"
                                 style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                 <thead>
                                     <th>Name</th>
                                     <th>Email</th>
                                     <th>Phone</th>
                                     <th>DOB</th>
                                     <th>Address</th>
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
         <div class="modal fade" id="patientModal" tabindex="-1">
             <div class="modal-dialog">
                 <form id="patientForm" class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">Patient Form</h5>
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                         <input type="hidden" name="id">
                         <div class="form-group"><label>First Name</label><input type="text" name="first_name"
                                 class="form-control" required></div>
                         <div class="form-group"><label>Last Name</label><input type="text" name="last_name"
                                 class="form-control" required></div>
                         <div class="form-group"><label>Email</label><input type="email" name="email"
                                 class="form-control" required></div>
                         <div class="form-group"><label>Phone</label><input type="text" name="phone"
                                 class="form-control" required></div>
                         <div class="form-group"><label>DOB</label><input type="date" name="dob" required class="form-control">
                         </div>
                         <div class="form-group">
                             <label>Gender</label>
                             <select name="gender" class="form-control" required>
                                 <option value="male">Male</option>
                                 <option value="female">Female</option>
                                 <option value="other">Other</option>
                             </select>
                         </div>
                         <div class="form-group"><label>Address</label><textarea name="address" required
                                 class="form-control"></textarea></div>

                         <div class="form-group"><label>Password</label><input type="password" name="password"
                                 class="form-control" required></div>

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
function loadPatients() {
    $.getJSON("<?= base_url('patients/get_patients_api') ?>", function(data) {
        let rows = '';
        data.forEach(p => {
            rows += `<tr>
                <td>${p.first_name}${p.last_name}</td><td>${p.email}</td><td>${p.phone}</td><td>${p.dob}</td><td>${p.address}</td>
                <td>
                    <button class="btn btn-sm btn-primary editBtn" data-id="${p.id}">Edit</button>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="${p.id}">Delete</button>
                </td>
            </tr>`;
        });
        $('#patientTable tbody').html(rows);
    });
}

$('#addPatientBtn').click(function() {
    $('#patientForm')[0].reset();
    $('input[name=id]').val('');
    $('#patientModal').modal('show');
});

$(document).on('click', '.editBtn', function() {
    const id = $(this).data('id');
    $.getJSON("<?= base_url('patients/get_patients_api') ?>", function(data) {
        const p = data.find(item => item.id == id);
        if (p) {
            Object.keys(p).forEach(key => $(`[name=${key}]`).val(p[key]));
            $('#patientModal').modal('show');
        }
    });
});

$('#patientForm').submit(function(e) {
    e.preventDefault();
    const id = $('input[name=id]').val();
    const url = id ? "<?= base_url('patients/update_patient_api/') ?>" + id :
        "<?= base_url('patients/add_patient_api') ?>";
    $.post(url, $(this).serialize(), function(res) {
        Swal.fire(res.status ? 'Success' : 'Error', res.message, res.status ? 'success' : 'error');
        if (res.status) {
            $('#patientModal').modal('hide');
            loadPatients();
        }
    }, 'json');
});

$(document).on('click', '.deleteBtn', function() {
    const id = $(this).data('id');
    Swal.fire({
        title: 'Delete this patient?',
        showCancelButton: true,
        confirmButtonText: 'Delete'
    }).then(res => {
        if (res.isConfirmed) {
            $.get("<?= base_url('patients/delete_patient_api/') ?>" + id, function(res) {
                Swal.fire(res.status ? 'Deleted!' : 'Error', res.message, res.status ?
                    'success' : 'error');
                if (res.status) loadPatients();
            }, 'json');
        }
    });
});

// You can expand this to open a modal for transfer if needed
$(document).on('click', '.transferBtn', function() {
    const id = $(this).data('id');
    const newWardId = prompt("Enter new Ward ID:");
    if (newWardId) {
        $.post("<?= base_url('patients/transfer_patient_api/') ?>" + id, {
            ward_id: newWardId
        }, function(res) {
            Swal.fire(res.status ? 'Transferred' : 'Error', res.message, res.status ? 'success' :
                'error');
            if (res.status) loadPatients();
        }, 'json');
    }
});

$(document).ready(loadPatients);
 </script>