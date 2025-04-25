 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">Branches's Record</h4>

                     </div>
                 </div>
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
                                         <th>Branch Type</th>
                                         <th>Vendor Name</th>
                                         <th>Action</th>
                                     </tr>

                                 </thead>

                                 <tbody>
                                     <?php foreach ($list as $branch) { ?>
                                     <tr>
                                         <td><?=$branch->id?></td>
                                         <td><?=$branch->branch_type?></td>
                                         <td><?=$branch->full_name?></td>

                                         <td>
                                             <div class="btn-group">
                                                 <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                                     data-toggle="dropdown" aria-haspopup="true"
                                                     aria-expanded="false">Action</button>
                                                 <div class="dropdown-menu">

                                                     <a class="dropdown-item"
                                                         href="<?= site_url() ?>master/vendors/menu-categories?id=<?=$branch->id?>&vendor_id=<?=$this->input->get('id')?>">Menu
                                                         Categories</a>
                                                     <a class="dropdown-item"
                                                         href="<?= site_url() ?>master/vendors/menu?branch=<?= $branch->branch_slug?>&vendor_id=<?=$this->input->get('id')?>">Menu</a>



                                                 </div>
                                             </div>
                                         </td>
                                     </tr>
                                     <?php
                            }
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