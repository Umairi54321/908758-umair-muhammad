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
            <h2 class="mb-4">Your Ward Assignment</h2>

            <div class="shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Ward Assignment Details</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($ward_assignment)): ?>
                        <div class="alert alert-info" role="alert">
                            You have no ward assignment details.
                        </div>
                    <?php else: ?>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Ward Name</th>
                                    <td><?= $ward_assignment->ward_name ?></td>
                                </tr>
                                <tr>
                                    <th>Assigned Date</th>
                                    <td><?= date('Y-m-d', strtotime($ward_assignment->assigned_at)) ?></td>
                                </tr>
                                <tr>
                                    <th>Bed Number</th>
                                    <td><?= $ward_assignment->bed_number ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
