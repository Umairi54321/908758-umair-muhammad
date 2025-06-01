<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 bg-dark text-white vh-100 p-4">
            <h4 class="mb-4">Patient Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= base_url('dashboard') ?>">Dashboard</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= base_url('appointments') ?>">Appointments</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= base_url('examination-results') ?>">Examination Results</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= base_url('ward-assignment') ?>">Ward Assignment</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= base_url('logout') ?>">Logout</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <h2 class="mb-4">Your Appointments</h2>

            <div class="shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Upcoming Appointments</h5>
                </div>
                <div class="text-right my-2">
                    <button class="btn btn-success bg-success text-white" data-toggle="modal"
                        data-target="#appointmentModal">+ New Appointment</button>
                </div>

                <div class="card-body">
                    <?php if (empty($appointments)): ?>
                    <div class="alert alert-info" role="alert">
                        You have no upcoming appointments.
                    </div>
                    <?php else: ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1; ?>
                            <?php foreach ($appointments as $appointment): ?>
                            <tr>
                                <th scope="row"><?= $counter++ ?></th>
                                <td><?= $appointment->doctor_name ?></td>
                                <td><?= date('Y-m-d', strtotime($appointment->appointment_date)) ?></td>
                                <td><?= date('h:i A', strtotime($appointment->appointment_time)) ?></td>
                                <td>
                                    <?php if ($appointment->status == 'pending'): ?>
                                    <span class="badge badge-warning">Pending</span>
                                    <?php elseif ($appointment->status == 'completed'): ?>
                                    <span class="badge badge-success">Completed</span>
                                    <?php else: ?>
                                    <span class="badge badge-danger"><?=$appointment->status?></span>
                                    <?php endif; ?>
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
<!-- Appointment Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="appointmentForm" class="modal-content w-100">
            <div class="modal-header">
                <h5 class="modal-title">Book Appointment</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="form-group">
                    <label>Doctor</label>
                    <select name="doctor_id" class="form-control" id="doctorSelect" required></select>
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
                <button type="submit" class="btn btn-success bg-success text-white">Save</button>
                <button type="button" class="btn btn-secondary bg-danger text-white" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function loadDoctors() {
    $.getJSON('http://localhost:8084/appointment/get_doctors_api', function(res) {
        let options = '<option value="">Select</option>';
        res.forEach(d => {
            options += `<option value="${d.id}">${d.name}</option>`;
        });
        $('#doctorSelect').html(options);
    });
}

$('#appointmentModal').on('show.bs.modal', loadDoctors);

// Submit
$('#appointmentForm').submit(function(e) {
    e.preventDefault();
    const data = $(this).serializeArray();
    data.push({ name: 'patient_id', value: <?= $this->session->userdata('patient_id') ?> });

    $.post('http://localhost:8084/appointment/save', data, function(res) {
        alert(res.message);
        $('#appointmentModal').modal('hide');
        location.reload(); // Or fetch updated list via AJAX
    }, 'json');
});

// Cancel appointment
function cancelAppointment(id) {
    if (confirm("Cancel this appointment?")) {
        $.get('http://localhost:8084/appointment/delete/' + id, function(res) {
            alert(res.message);
            location.reload();
        }, 'json');
    }
}
</script>
