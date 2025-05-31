 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">Appointment's</h4>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="page-title-box text-right">
                         <button class="btn btn-primary" data-toggle="modal" data-target="#appointmentModal">+ New
                             Appointment</button>

                     </div>
                 </div>
             </div>
         </div>


         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <div class="table-responsive">



                             <table id="appointmentTable"
                                 class="table table-bordered table-striped dt-responsive nowrap"
                                 style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                 <thead>
                                     <tr>
                                         <th>Patient</th>
                                         <th>Doctor</th>
                                         <th>Date</th>
                                         <th>Time</th>
                                         <th>Status</th>
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
         <div class="modal fade" id="appointmentModal" tabindex="-1">
             <div class="modal-dialog">
                 <form id="appointmentForm" class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">Appointment</h5>
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                         <input type="hidden" name="id">
                         <div class="form-group">
                             <label>Patient</label>
                             <select name="patient_id" class="form-control" id="patientSelect"></select>
                         </div>
                         <div class="form-group">
                             <label>Doctor</label>
                             <select name="doctor_id" class="form-control" id="doctorSelect"></select>
                         </div>
                         <div class="form-group">
                             <label>Date</label>
                             <input type="date" name="appointment_date" class="form-control" required>
                         </div>
                         <div class="form-group">
                             <label>Time</label>
                             <input type="time" name="appointment_time" class="form-control" required>
                         </div>
                         <div class="form-group">
                             <label>Notes</label>
                             <textarea name="notes" class="form-control"></textarea>
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
const APPOINTMENT_API_URL = "http://localhost:8084/appointment";

function loadPatientsAndDoctors() {
  $.getJSON('patients/get_patients_api', function(res) {
    let options = '<option value="">Select</option>';
    res.forEach(p => options += `<option value="${p.id}">${p.first_name} ${p.last_name}</option>`);
    $('#patientSelect').html(options);
  });

  $.getJSON('users/get_doctors_api', function(res) {
    let options = '<option value="">Select</option>';
    res.forEach(d => options += `<option value="${d.id}">${d.name}</option>`);
    $('#doctorSelect').html(options);
  });
}

$('#appointmentModal').on('show.bs.modal', loadPatientsAndDoctors);

$('#appointmentForm').submit(function(e) {
  e.preventDefault();
  $.post(`${APPOINTMENT_API_URL}/save`, $(this).serialize(), function(res) {
    alert(res.message);
    $('#appointmentModal').modal('hide');
    fetchAppointments();
  }, 'json');
});

function fetchAppointments() {
  $.getJSON(`${APPOINTMENT_API_URL}/fetch_all`, function(res) {
    let rows = '';
    res.data.forEach(a => {
      rows += `<tr>
        <td>${a.patient_name}</td>
        <td>${a.doctor_name}</td>
        <td>${a.appointment_date}</td>
        <td>${a.appointment_time}</td>
        <td>${a.status}</td>
        <td><button class="btn btn-sm btn-danger" onclick="cancelAppointment(${a.id})">Cancel</button></td>
      </tr>`;
    });
    $('#appointmentTable tbody').html(rows);
  });
}

function cancelAppointment(id) {
  if (confirm("Cancel this appointment?")) {
    $.get(`${APPOINTMENT_API_URL}/delete/${id}`, function(res) {
      alert(res.message);
      fetchAppointments();
    }, 'json');
  }
}

$(document).ready(fetchAppointments);
</script>

