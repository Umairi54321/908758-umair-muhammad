<!-- Start content -->
<div class="content">

<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-12">
                <div class="page-title-box">
                    <h4 class="page-title">Dashboard</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Welcome to Hospital Management Dashboard</li>
                    </ol>
                </div>
            </div>

            
        </div>
    </div>
    <!-- end page-title -->

    <!-- start top-Contant -->
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center p-1">
                        <div class="col-lg-6">
                            <h5 class="font-16">Total Patient</h5>
                            <h4 class="text-info pt-1 mb-0"><?=$total_patients?></h4>
                        </div>
                        <div class="col-lg-6">
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center p-1">
                        <div class="col-lg-6">
                            <h5 class="font-16">Today Patients</h5>
                            <h4 class="text-warning pt-1 mb-0"><?=$today_patients?></h4>
                        </div>
                        <div class="col-lg-6">
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center p-1">
                        <div class="col-lg-6">
                            <h5 class="font-16">Total Wards</h5>
                            <h4 class="text-primary pt-1 mb-0"><?=$total_wards?></h4>
                        </div>
                        <div class="col-lg-6">
                            <div id="chart3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
    <!-- end top-Contant -->


    

   

</div>
<!-- container-fluid -->

</div>
<!-- content -->












