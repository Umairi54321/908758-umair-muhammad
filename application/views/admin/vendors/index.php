 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">Vendor's Record</h4>

                     </div>
                 </div>
                 <?php
                                         if($this->session->userdata('role') == "admin"){
                                         ?>
                 <div class="col-md-4">
                     <div class="page-title-box text-right">
                         <a class='btn btn-primary' href="<?=site_url()?>master/vendors/add">Add Vendor</a>

                     </div>
                 </div>
                 <?php
                                         }
                                         ?>



             </div>
         </div>
         <!-- end page-title -->

         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <div class="table-responsive">

                             <?php if(count($list) > 0) { ?>


                             <table id="datatable-buttons"
                                 class="table table-bordered table-striped dt-responsive nowrap"
                                 style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                 <thead>
                                     <tr>
                                         <th>Id</th>
                                         <?php
                                         if($this->session->userdata('role') == "admin"){
                                         ?>
                                         <th>Action</th>
                                         <?php
                                         }
                                         ?>
                                         <th>Company Name</th>
                                         <th>Comapny Logo</th>
                                         <th>Address</th>
                                         <th>Registration Number</th>
                                         <th>Status</th>
                                         
                                         <th>Owner Name</th>
                                         <th>Owner Email</th>
                                         <th>Owner Phone</th>
                                         <th>GST(%)</th>
                                         <th>Currency</th>
                                         <th>Language</th>
                                         
                                     </tr>

                                 </thead>

                                 <tbody>
                                     <?php $i=1; foreach ($list as $vendor) { ?>
                                     <tr>
                                         <td><?=$i?></td>
                                         <?php
                                         if($this->session->userdata('role') == "admin"){
                                         ?>
                                         <td>
                                             <div class="btn-group">
                                                 <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                                     data-toggle="dropdown" aria-haspopup="true"
                                                     aria-expanded="false">Action</button>
                                                 <div class="dropdown-menu">

                                                     <a class="dropdown-item"
                                                         href="<?= site_url() ?>master/vendors/edit?id=<?= $vendor->id ?>">Edit</a>
                                                     <?php
                                                     if($vendor->status == 1){
                                                        ?>
                                                     <a class="dropdown-item"
                                                         href="<?= site_url() ?>master/vendors/change-status?id=<?= $vendor->id?>&status=0">Deactivate</a>
                                                     <?php
                                                     }
                                                     else{
                                                        ?>
                                                     <a class="dropdown-item"
                                                         href="<?= site_url() ?>master/vendors/change-status?id=<?= $vendor->id?>&status=1">Activate</a>
                                                     <?php
                                                     }
                                                     ?>
                                                     <a class="dropdown-item"
                                                         href="<?= site_url() ?>master/vendors/branches?id=<?= $vendor->id?>">Branches</a>

                                                         <a class="dropdown-item"
                                                         href="<?= site_url() ?>master/vendors/license-keys?id=<?= $vendor->id?>">License Keys</a>



                                                 </div>
                                             </div>
                                         </td>
                                         <?php
                                         }
                                         ?>
                                         <td><?=$vendor->full_name?></td>
                                         <td><img style='width:80px; height:80px; border-radius:50%;'
                                                 src="<?=base_url()?>assets/images/company-logo/<?=$vendor->company_logo?>"
                                                 alt="<?=$vendor->compnay_logo?>"></td>
                                         <td><?=$vendor->address." ,".$vendor->city." ,".$vendor->country?></td>
                                         <td><?=$vendor->registration_number?></td>
                                         <td>
                                             <?php
                                         if($vendor->status == 1){
                                            ?>
                                         <span class='badge badge-success'>Active</span>
                                             <?php
                                         }
                                         else{
                                            ?>
                                             <span class='badge badge-danger'>Deactive</span>
                                             <?php
                                         }
                                         ?>
                                         </td>

                                        

                                         <td><?=$vendor->owner_name?></td>
                                         <td><?=$vendor->email?></td>
                                         <td><?=$vendor->phone?></td>
                                         <td><?=$vendor->gst_percentage. "%"?></td>
                                         <td><?=$vendor->currency?></td>
                                         <td><?=$vendor->language?></td>
                                        
                                     </tr>
                                     <?php
                            $i++;}
                            ?>
                                 </tbody>
                             </table>
                         </div>
                         <?php
                    }else{
                    ?>
                         <div class="alert alert-danger wow fadeInUp" role="alert"> No Data Found! </div>
                         <?php
                    }
                    ?>
                     </div>
                 </div>
             </div>
             <!-- end col -->
         </div>
         <!-- end row -->



     </div>
     <!-- container-fluid -->

 </div>
 <!-- content -->