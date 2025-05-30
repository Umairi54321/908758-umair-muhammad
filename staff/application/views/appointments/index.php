 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">My Schedule's</h4>
                     </div>
                 </div>
                
             </div>
         </div>


         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <ul class="nav nav-tabs" id="appointmentTabs" role="tablist">
                             <li class="nav-item">
                                 <a class="nav-link active" id="upcoming-tab" data-toggle="tab" href="#upcoming"
                                     role="tab">Upcoming Appointments</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" id="past-tab" data-toggle="tab" href="#past" role="tab">Past
                                     Appointments</a>
                             </li>
                         </ul>

                         <div class="tab-content mt-3">
                             <!-- Upcoming -->
                             <div class="tab-pane fade show active" id="upcoming" role="tabpanel">
                                 <?php if (empty($upcoming)): ?>
                                 <p>No upcoming appointments.</p>
                                 <?php else: ?>
                                 <table class="table table-bordered">
                                     <thead>
                                         <tr>
                                             <th>Patient</th>
                                             <th>Date</th>
                                             <th>Status</th>
                                             <th>Actions</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php foreach ($upcoming as $apt): ?>
                                         <tr>
                                             <td>Patient #<?= $apt['patient_id'] ?></td>
                                             <td><?= date('Y-m-d H:i', strtotime($apt['appointment_date'])) ?></td>
                                             <td><?= ucfirst($apt['status']) ?></td>
                                             <td>
                                                 <?php if ($apt['status'] == 'pending'): ?>
                                                 <button class="btn btn-success btn-sm accept-btn"
                                                     data-id="<?= $apt['id'] ?>">Accept</button>
                                                 <button class="btn btn-danger btn-sm reject-btn"
                                                     data-id="<?= $apt['id'] ?>">Reject</button>
                                                 <?php elseif ($apt['status'] == 'accepted'): ?>
                                                 <button class="btn btn-primary btn-sm notes-btn"
                                                     data-id="<?= $apt['id'] ?>">Add Notes</button>
                                                 <?php endif; ?>
                                             </td>
                                         </tr>
                                         <?php endforeach; ?>
                                     </tbody>
                                 </table>
                                 <?php endif; ?>
                             </div>

                             <!-- Past -->
                             <div class="tab-pane fade" id="past" role="tabpanel">
                                 <?php if (empty($past)): ?>
                                 <p>No past appointments.</p>
                                 <?php else: ?>
                                 <table class="table table-bordered">
                                     <thead>
                                         <tr>
                                             <th>Patient</th>
                                             <th>Date</th>
                                             <th>Status</th>
                                             <th>Notes</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php foreach ($past as $apt): ?>
                                         <tr>
                                             <td>Patient #<?= $apt['patient_id'] ?></td>
                                             <td><?= date('Y-m-d H:i', strtotime($apt['appointment_date'])) ?></td>
                                             <td><?= ucfirst($apt['status']) ?></td>
                                             <td><?= $apt['cnotes'] ? htmlspecialchars($apt['notes']) : '-' ?>
                                             </td>
                                         </tr>
                                         <?php endforeach; ?>
                                     </tbody>
                                 </table>
                                 <?php endif; ?>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- end col -->
         </div>
         <!-- end row -->


         <!-- Add/Edit Modal -->
         <div class="modal fade" id="notesModal" tabindex="-1" role="dialog">
             <div class="modal-dialog" role="document">
                 <form id="notesForm">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title">Add Consultation Notes</h5>
                             <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                         </div>
                         <div class="modal-body">
                             <input type="hidden" id="appointment_id" name="id">
                             <div class="form-group">
                                 <label for="notes">Notes</label>
                                 <textarea class="form-control" name="notes" id="notes" rows="4" required></textarea>
                             </div>
                             <div class="form-group">
                                 <label for="patient_name">Patient</label>
                                 <input type="text" id="patient_name" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="submit" class="btn btn-success">Save Notes</button>
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
const APPOINTMENT_API = 'http://localhost:8084/appointment/';

$(function() {
    // Accept appointment
    $('.accept-btn').click(function() {
        var id = $(this).data('id');
        updateStatus(id, 'accepted');
    });

    // Reject appointment
    $('.reject-btn').click(function() {
        var id = $(this).data('id');
        updateStatus(id, 'rejected');
    });

    // Show Add Notes Modal
    $('.notes-btn').click(function() {
        var id = $(this).data('id');
        $.getJSON(APPOINTMENT_API + 'get/' + id, function(data) {
            $('#appointment_id').val(data.appointment.id);
            $('#notes').val(data.appointment.notes || '');
            $('#patient_name').val(data.patient.name || 'Patient #' + data.appointment.patient_id);
            $('#notesModal').modal('show');
        });
    });

    // Submit Notes
    $('#notesForm').submit(function(e) {
        e.preventDefault();
        $.post(APPOINTMENT_API + 'add_notes', $(this).serialize(), function(res) {
            $('#notesModal').modal('hide');
            location.reload();
        });
    });

    // Update status handler
    function updateStatus(id, status) {
        $.post(APPOINTMENT_API + 'update_status', { id: id, status: status }, function(res) {
            location.reload();
        });
    }
});
</script>
