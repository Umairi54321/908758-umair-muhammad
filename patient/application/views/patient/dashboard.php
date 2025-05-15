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
            <h2 class="mb-4">Welcome, <?= $patient->first_name . ' ' . $patient->last_name ?> 👋</h2>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Your Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> <?= $patient->email ?></p>
                    <p><strong>Phone:</strong> <?= $patient->phone ?></p>
                    <p><strong>Gender:</strong> <?= $patient->gender ?></p>
                    <p><strong>Date of Birth:</strong> <?= $patient->dob ?></p>
                    <p><strong>Address:</strong> <?= $patient->address ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
