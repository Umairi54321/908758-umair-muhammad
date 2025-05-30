 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">Ward's</h4>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="page-title-box text-right">
                         <button class="btn btn-primary" data-toggle="modal" data-target="#wardModal">+ Add
                             Ward</button>

                     </div>
                 </div>
             </div>
         </div>


         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <div class="table-responsive">



                             <table id="wardTable" class="table table-bordered table-striped dt-responsive nowrap"
                                 style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                 <thead>
                                     <tr>
                                         <th>Name</th>
                                         <th>Total Beds</th>
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


         <div class="row mt-5">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <h5>Assign Patient to Ward</h5>
                         <form id="assignForm">
                             <div class="form-row">
                                 <div class="form-group col-md-4">
                                     <label>Patient</label>
                                     <select name="patient_id" class="form-control" id="patientSelect"></select>
                                 </div>
                                 <div class="form-group col-md-4">
                                     <label>Ward</label>
                                     <select name="ward_id" class="form-control" id="wardSelect"></select>
                                 </div>
                                 <div class="form-group col-md-4">
                                     <label>Bed Number</label>
                                     <input type="number" name="bed_number" class="form-control">
                                 </div>
                             </div>
                             <button type="submit" class="btn btn-success">Assign</button>
                         </form>
                     </div>
                 </div>
             </div>
             <!-- end col -->
         </div>

         <div class="row mt-5">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <h5>Current Assignments</h5>
                         <table class="table table-bordered" id="assignmentTable">
                             <thead>
                                 <tr>
                                     <th>Patient</th>
                                     <th>Ward</th>
                                     <th>Bed</th>
                                     <th>Assigned At</th>
                                 </tr>
                             </thead>
                             <tbody></tbody>
                         </table>
                     </div>
                 </div>
             </div>
             <!-- end col -->
         </div>


         <!-- Add/Edit Modal -->
         <div class="modal fade" id="wardModal" tabindex="-1">
             <div class="modal-dialog">
                 <form class="modal-content" id="wardForm">
                     <div class="modal-header">
                         <h5 class="modal-title">Add/Edit Ward</h5>
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                         <input type="hidden" name="id">
                         <div class="form-group">
                             <label>Ward Name</label>
                             <input type="text" name="name" class="form-control" required>
                         </div>
                         <div class="form-group">
                             <label>Total Beds</label>
                             <input type="number" name="total_beds" class="form-control" required>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button class="btn btn-success" type="submit">Save</button>
                         <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                     </div>
                 </form>
             </div>
         </div>




     </div>
     <!-- container-fluid -->

 </div>
 <!-- content -->



 <script>
const WARD_API = "http://localhost:8085/ward";

function fetchWards() {
    $.getJSON(`${WARD_API}/fetch_all`, function(res) {
        let rows = '';
        let wardOptions = '<option value="">Select</option>';
        res.data.forEach(w => {
            rows += `<tr><td>${w.name}</td><td>${w.total_beds}</td>
                <td><button class="btn btn-sm btn-danger" onclick="deleteWard(${w.id})">Delete</button></td></tr>`;
            wardOptions += `<option value="${w.id}">${w.name}</option>`;
        });
        $('#wardTable tbody').html(rows);
        $('#wardSelect').html(wardOptions);
    });
}

function fetchPatients() {
    $.getJSON('wards/get_patients', function(res) {
        let options = '<option value="">Select</option>';
        res.data.forEach(p => {
            options += `<option value="${p.id}">${p.first_name} ${p.last_name}</option>`;
        });
        $('#patientSelect').html(options);
    });
}

function fetchAssignments() {
    $.getJSON(`${WARD_API}/get_ward_assignments`, function(res) {
        let rows = '';
        res.data.forEach(a => {
            rows += `<tr><td>${a.first_name} ${a.last_name}</td>
                <td>${a.ward_name}</td><td>${a.bed_number}</td><td>${a.assigned_at}</td></tr>`;
        });
        $('#assignmentTable tbody').html(rows);
    });
}

$('#wardForm').submit(function(e) {
    e.preventDefault();
    $.post(`${WARD_API}/save`, $(this).serialize(), function(res) {
        alert(res.message);
        $('#wardModal').modal('hide');
        fetchWards();
    }, 'json');
});

$('#assignForm').submit(function(e) {
    e.preventDefault();
    $.post(`${WARD_API}/assign_patient`, $(this).serialize(), function(res) {
        alert(res.message);
        if (res.status) fetchAssignments();
    }, 'json');
});

function deleteWard(id) {
    if (confirm("Delete this ward?")) {
        $.get(`${WARD_API}/delete/` + id, function(res) {
            alert(res.message);
            fetchWards();
        }, 'json');
    }
}

$(document).ready(function() {
    fetchWards();
    fetchPatients();
    fetchAssignments();
});
 </script>