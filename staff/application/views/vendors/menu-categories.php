 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">Menu Categories's Record</h4>

                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="page-title-box text-right">
                         <a class='btn btn-primary' href="<?=site_url()?>master/vendors/add-menu-category?id=<?=$this->input->get('id')?>&vendor_id=<?=$this->input->get('vendor_id')?>">Add Menu Category</a>

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
                                         <th>Category Name</th>
                                         <th>Action</th>
                                     </tr>

                                 </thead>

                                 <tbody>
                                     <?php foreach ($list as $category) { ?>
                                     <tr>
                                         <td><?=$category->id?></td>
                                         <td><?=$category->category_name?></td>
                                         
                                         <td>
                                             <div class="btn-group">
                                                 <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                                     data-toggle="dropdown" aria-haspopup="true"
                                                     aria-expanded="false">Action</button>
                                                 <div class="dropdown-menu">

                                                     <a class="dropdown-item"
                                                         href="<?= site_url() ?>master/vendors/edit-menu-category?id=<?= $category->id?>">Edit Menu Categories</a>
                                                     



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