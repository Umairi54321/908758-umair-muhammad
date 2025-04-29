 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">Emergency Patient Intake</h4>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="page-title-box text-right">
                         <button class="btn btn-primary" data-toggle="modal" data-target="#emergencyModal">+ Register
                             Emergency</button>

                     </div>
                 </div>
             </div>
         </div>


         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <div class="table-responsive">



                             <table id="emergencyTable" class="table table-bordered table-striped dt-responsive nowrap"
                                 style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                 <thead>
                                     <tr>
                                         <th>Name</th>
                                         <th>Phone</th>
                                         <th>Triage</th>
                                         <th>Assigned Doctor</th>
                                         <th>Date</th>
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
         <div class="modal fade" id="emergencyModal" tabindex="-1">
             <div class="modal-dialog">
                 <form id="emergencyForm" class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">Emergency Intake</h5>
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                         <div class="form-group"><label>First Name</label><input type="text" name="first_name"
                                 class="form-control" required></div>
                         <div class="form-group"><label>Last Name</label><input type="text" name="last_name"
                                 class="form-control"></div>
                         <div class="form-group"><label>Phone</label><input type="text" name="phone"
                                 class="form-control"></div>
                         <div class="form-group">
                             <label>Triage Priority</label>
                             <select name="triage_priority" class="form-control">
                                 <option value="">Select</option>
                                 <option value="low">Low</option>
                                 <option value="medium">Medium</option>
                                 <option value="high">High</option>
                                 <option value="critical">Critical</option>
                             </select>
                         </div>
                         <div class="form-group">
                             <label>Assign Doctor</label>
                             <select name="assigned_doctor_id" class="form-control" id="emergencyDoctorSelect"></select>
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
    function loadDoctors() {
  $.getJSON("doctor/list", function(res) {
    let options = '<option value="">Select Doctor</option>';
    res.data.forEach(doc => options += `<option value="${doc.id}">${doc.name}</option>`);
    $('#emergencyDoctorSelect').html(options);
  });
}

$('#emergencyModal').on('show.bs.modal', loadDoctors);

$('#emergencyForm').submit(function(e) {
  e.preventDefault();
  $.post("emergency/save", $(this).serialize(), function(res) {
    alert(res.message);
    $('#emergencyModal').modal('hide');
    fetchEmergencyPatients();
  }, 'json');
});

function fetchEmergencyPatients() {
  $.getJSON("emergency/fetch_all", function(res) {
    let rows = '';
    res.data.forEach(p => {
      rows += `<tr>
        <td>${p.first_name} ${p.last_name}</td>
        <td>${p.phone}</td>
        <td>${p.triage_priority}</td>
        <td>${p.assigned_doctor_id ?? '-'}</td>
        <td>${p.created_at}</td>
      </tr>`;
    });
    $('#emergencyTable tbody').html(rows);
  });
}

$(document).ready(fetchEmergencyPatients);

</script>