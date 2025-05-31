 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">Assigned Patients's</h4>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="page-title-box text-right">
                         <button class="btn btn-sm btn-primary mb-2" id="addExamBtn" style="display:none">Add
                             Exam</button>

                     </div>
                 </div>
             </div>
         </div>

         <div class="row">
             
             <div class="col-md-12">
                 <ul class="list-group" id="patientList">
                     <?php foreach ($patients as $p): ?>
                     <li class="list-group-item patient-item" data-id="<?= $p->id ?>">
                         <?= $p->first_name ?> <?= $p->last_name ?>
                     </li>
                     <?php endforeach; ?>
                 </ul>
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
                                     <tr>
                                         <th>Type</th>
                                         <th>Observations</th>
                                         <th>Results</th>
                                         <th>Date</th>
                                         <th>Actions</th>
                                     </tr>
                                 </thead>
                                 <tbody id="recordBody"></tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- end col -->
         </div>
         <!-- end row -->


         <div class="modal fade" id="examModal" tabindex="-1">
             <div class="modal-dialog">
                 <form id="examForm">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title">Examination</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                         </div>
                         <div class="modal-body">
                             <input type="hidden" name="id" id="exam_id">
                             <input type="hidden" name="patient_id" id="patient_id">
                             <div class="mb-2">
                                 <label>Exam Type</label>
                                 <input type="text" name="exam_type" class="form-control" required>
                             </div>
                             <div class="mb-2">
                                 <label>Observations</label>
                                 <textarea name="observations" class="form-control"></textarea>
                             </div>
                             <div class="mb-2">
                                 <label>Results</label>
                                 <textarea name="results" class="form-control"></textarea>
                             </div>
                             <div class="mb-2">
                                 <label>Exam Date</label>
                                 <input type="date" name="exam_date" class="form-control" required>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="submit" class="btn btn-success">Save</button>
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>



     </div>
     <!-- container-fluid -->

 </div>
 <!-- content -->



 <script>
let selectedPatientId = null;

$(document).ready(function() {
    $('.patient-item').click(function() {
        selectedPatientId = $(this).data('id');
        $('#recordTitle').text("Medical Records for Patient #" + selectedPatientId);
        $('#addExamBtn').show();
        loadRecords();
    });

    $('#searchForm').submit(function(e) {
        e.preventDefault();
        $.post('<?= base_url("Patients/search") ?>', $(this).serialize(), function(data) {
            $('#patientList').html($(data).find('#patientList').html());
        });
    });

    $('#addExamBtn').click(function() {
        $('#examForm')[0].reset();
        $('#exam_id').val('');
        $('#patient_id').val(selectedPatientId);
        $('#examModal').modal('show');
    });

    $('#examForm').submit(function(e) {
        e.preventDefault();
        const id = $('#exam_id').val();
        const url = id ? '<?= base_url("Patients/update_exam/") ?>' + id : '<?= base_url("Patients/save_exam") ?>';
        $.post(url, $(this).serialize(), function(res) {
            $('#examModal').modal('hide');
            loadRecords();
        }, 'json');
    });
});

function loadRecords() {
    $.get('<?= base_url("Patients/get_examinations/") ?>' + selectedPatientId, function(data) {
        let html = '';
        $.each(data, function(i, r) {
            html += `<tr>
                <td>${r.exam_type}</td>
                <td>${r.observations}</td>
                <td>${r.results}</td>
                <td>${r.exam_date}</td>
                <td>
                    <button class="btn btn-sm btn-info" onclick="editExam(${r.id})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteExam(${r.id})">Delete</button>
                </td>
            </tr>`;
        });
        $('#recordBody').html(html);
    }, 'json');
}

function editExam(id) {
    $.getJSON('<?= base_url("Patients/get_exam/") ?>' + id, function(r) {
        $('#exam_id').val(r.id);
        $('#patient_id').val(r.patient_id);
        $('[name="exam_type"]').val(r.exam_type);
        $('[name="observations"]').val(r.observations);
        $('[name="results"]').val(r.results);
        $('[name="exam_date"]').val(r.exam_date);
        $('#examModal').modal('show');
    });
}

function deleteExam(id) {
    if (confirm("Are you sure to delete this exam?")) {
        $.get('<?= base_url("Patients/delete_exam/") ?>' + id, function() {
            loadRecords();
        });
    }
}
</script>