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
            <h2 class="mb-4">Your Examination Results</h2>

            <div class="shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Examination Results</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($results)): ?>
                        <div class="alert alert-info" role="alert">
                            You have no examination results yet.
                        </div>
                    <?php else: ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Examination Type</th>
                                    <th scope="col">Observation</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Examination Date</th>
                                    <th scope="col">Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = 1;?>
                                <?php foreach ($results as $result): ?>
                                    <tr>
                                        <th scope="row"><?= $counter++ ?></th>
                                        <td><?= $result->exam_type ?></td>
                                        <td><?= $result->observations ?></td>
                                        <td><?= $result->doctor_name ?></td>
                                        <td><?= date('Y-m-d', strtotime($result->exam_date)) ?></td>
                                        <td>
                                            <?=$result->results?>
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
