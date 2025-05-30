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
                                         <th>Ward Name</th>
                                         <th>Total Beds</th>
                                         <th>Occupied Beds</th>
                                         <th>Available Beds</th>
                                         <th>Actions</th>
                                     </tr>
                                 </thead>

                                 <tbody>
                                     <?php foreach ($wards as $ward): ?>
                                     <tr>
                                         <td><?= $ward['name'] ?></td>
                                         <td><?= $ward['total_beds'] ?></td>
                                         <td><?= $ward['occupied_beds'] ?></td>
                                         <td><?= ($ward['total_beds'] - $ward['occupied_beds']) ?></td>
                                         <td>
                                             <button class="btn btn-sm btn-primary assignBtn"
                                                 data-id="<?= $ward['id'] ?>">Assign Bed</button>
                                             <button class="btn btn-sm btn-info viewPatientsBtn"
                                                 data-id="<?= $ward['id'] ?>">View Patients</button>
                                         </td>
                                     </tr>
                                     <?php endforeach; ?>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- end col -->
         </div>
         <!-- end row -->


         <div class="modal fade" id="assignModal" tabindex="-1">
             <div class="modal-dialog">
                 <form id="assignForm" class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">Assign Bed</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                     </div>
                     <div class="modal-body">
                         <input type="hidden" name="ward_id" id="assignWardId">
                         <div class="mb-3">
                             <label>Patient ID</label>
                             <input type="number" name="patient_id" class="form-control" required>
                         </div>
                         <div class="mb-3">
                             <label>Available Beds</label>
                             <select name="bed_number" id="bedSelect" class="form-control" required></select>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-success">Assign</button>
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                     </div>
                 </form>
             </div>
         </div>

         <!-- Patients Modal -->
         <div class="modal fade" id="patientsModal" tabindex="-1">
             <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">Patients in Ward</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                     </div>
                     <div class="modal-body">
                         <table class="table table-bordered">
                             <thead>
                                 <tr>
                                     <th>Patient Name</th>
                                     <th>Email</th>
                                     <th>Bed Number</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody id="patientsTableBody"></tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>




     </div>
     <!-- container-fluid -->

 </div>
 <!-- content -->



<script>
    $(document).ready(function () {
        const WARD_API = "http://localhost:8085/ward";
        let assignModal = new bootstrap.Modal(document.getElementById('assignModal'));
        let patientsModal = new bootstrap.Modal(document.getElementById('patientsModal'));

        $('.assignBtn').click(function () {
            const wardId = $(this).data('id');
            $('#assignWardId').val(wardId);
            $('#bedSelect').empty();

            $.getJSON(`${WARD_API}/get_available_beds/${wardId}`, function (res) {
                const beds = res.data || [];
                if (beds.length === 0) {
                    $('#bedSelect').append('<option disabled>No beds available</option>');
                } else {
                    beds.forEach(function (bed) {
                        $('#bedSelect').append('<option value="' + bed + '">' + bed + '</option>');
                    });
                }
                assignModal.show();
            });
        });

        $('#assignForm').submit(function (e) {
            e.preventDefault();
            $.post(`${WARD_API}/assign_patient`, $(this).serialize(), function (res) {
                if (res.status === 'success') {
                    alert('Bed assigned successfully');
                    location.reload();
                } else {
                    alert(res.message || 'Failed to assign bed');
                }
            }, 'json');
        });

        $('.viewPatientsBtn').click(function () {
            const wardId = $(this).data('id');
            $('#patientsTableBody').empty();

            $.getJSON(`${WARD_API}/get_patients_by_ward/${wardId}`, function (res) {
                const patients = res.data || [];
                if (patients.length === 0) {
                    $('#patientsTableBody').append('<tr><td colspan="4">No patients in this ward.</td></tr>');
                } else {
                    patients.forEach(function (p) {
                        $('#patientsTableBody').append(`
                            <tr>
                                <td>${p.patient_name}</td>
                                <td>${p.email}</td>
                                <td>${p.bed_number}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm dischargeBtn" data-id="${p.assignment_id}">Discharge</button>
                                </td>
                            </tr>
                        `);
                    });
                    patientsModal.show();
                }
            });
        });

        $(document).on('click', '.dischargeBtn', function () {
            const id = $(this).data('id');
            if (confirm('Discharge this patient?')) {
                $.post(`${WARD_API}/discharge_patient`, { assignment_id: id }, function () {
                    alert('Patient discharged');
                    location.reload();
                });
            }
        });
    });
</script>
