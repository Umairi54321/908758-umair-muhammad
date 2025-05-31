 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">Examination's</h4>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="page-title-box text-right">
                         <button class="btn btn-primary" data-toggle="modal" data-target="#examModal">+ New
                             Examination</button>

                     </div>
                 </div>
             </div>
         </div>


         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <div class="table-responsive">



                             <table id="examTable" class="table table-bordered table-striped dt-responsive nowrap"
                                 style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                 <thead>
                                     <tr>
                                         <th>Patient</th>
                                         <th>Doctor</th>
                                         <th>Type</th>
                                         <th>Date</th>
                                         <th>Actions</th>
                                     </tr>
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
         <div class="modal fade" id="examModal" tabindex="-1">
             <div class="modal-dialog">
                 <form id="examForm" class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">Examination</h5>
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                         <input type="hidden" name="id">
                         <div class="form-group">
                             <label>Patient</label>
                             <select name="patient_id" class="form-control" id="examPatientSelect"></select>
                         </div>
                         <div class="form-group">
                             <label>Doctor</label>
                             <select name="doctor_id" class="form-control" id="examDoctorSelect"></select>
                         </div>
                         <div class="form-group">
                             <label>Exam Type</label>
                             <input type="text" name="exam_type" class="form-control" required>
                         </div>
                         <div class="form-group">
                             <label>Date</label>
                             <input type="date" name="exam_date" class="form-control" required>
                         </div>
                         <div class="form-group">
                             <label>Observations</label>
                             <textarea name="observations" class="form-control"></textarea>
                         </div>
                         <div class="form-group">
                             <label>Results</label>
                             <textarea name="results" class="form-control"></textarea>
                         </div>
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
function loadExamFormDropdowns() {
    $.getJSON('patients/get_patients_api', function(res) {
        let options = '<option value="">Select</option>';
        res.forEach(p => options += `<option value="${p.id}">${p.first_name}</option>`);
        $('#examPatientSelect').html(options);
    });

    $.getJSON('users/get_doctors_api', function(res) {
        let options = '<option value="">Select</option>';
        res.forEach(d => options += `<option value="${d.id}">${d.name}</option>`);
        $('#examDoctorSelect').html(options);
    });
}

$('#examModal').on('show.bs.modal', loadExamFormDropdowns);

$('#examForm').submit(function(e) {
    e.preventDefault();
    $.post('examinations/save', $(this).serialize(), function(res) {
        alert(res.message);
        $('#examModal').modal('hide');
        fetchExaminations();
    }, 'json');
});

function fetchExaminations() {
    $.getJSON('examinations/fetch_all', function(res) {
        let rows = '';
        res.data.forEach(e => {
            rows += `<tr>
        <td>${e.first_name}</td>
        <td>${e.doctor_name}</td>
        <td>${e.exam_type}</td>
        <td>${e.exam_date}</td>
        <td><button class="btn btn-sm btn-danger" onclick="deleteExam(${e.id})">Delete</button></td>
      </tr>`;
        });
        $('#examTable tbody').html(rows);
    });
}

function deleteExam(id) {
    if (confirm("Delete this examination record?")) {
        $.get('examinations/delete/' + id, function(res) {
            alert(res.message);
            fetchExaminations();
        }, 'json');
    }
}

$(document).ready(fetchExaminations);
 </script>