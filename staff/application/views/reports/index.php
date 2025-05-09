 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">Report's</h4>
                     </div>
                 </div>
             </div>
         </div>
         <!-- end page-title -->

         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <form method='POST' action="<?=site_url();?>admin/Reports/index">
                             <div class="form-group row">
                                 <label class="col-sm-2 col-form-label">Vendor</label>
                                 <div class="col-sm-10">
                                     <select class="custom-select" name='vendor'>
                                         <option selected value=''>Select Vendor Name</option>
                                         <?php
                                         foreach($vendors as $vendor){
                                         ?>
                                         <option value="<?=$vendor->vendor_slug?>"><?=$vendor->full_name?></option>
                                         <?php
                                         }
                                         ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label class="col-sm-2 col-form-label">Branch Type</label>
                                 <div class="col-sm-10">
                                     <select class="custom-select" name='branch_type'>
                                         <option selected value=''>Select Branch Type</option>
                                         <option value="mall">Mall</option>
                                         <option value="non-mall">Non Mall</option>
                                     </select>
                                 </div>
                             </div>
                             <!-- <div class="form-group row start-date">
                                 <label class="col-sm-2 col-form-label">Start Date</label>
                                 <div class="col-sm-10">
                                     <input class="form-control" name='start-date' type="date" id='start-date'>
                                 </div>
                             </div>
                             <div class="form-group row end-date">
                                 <label class="col-sm-2 col-form-label">End Date</label>
                                 <div class="col-sm-10">
                                     <input class="form-control" name='end-date' type="date" id='end-date'>
                                 </div>
                             </div> -->
                             <div>
                                 <button type='submit' name='filter' class='btn btn-primary'> Apply</button>
                             </div>
                         </form>

                     </div>
                 </div>
             </div>
             <!-- end col -->
         </div>
         <!-- end row -->

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
                                         <th>Order Id</th>
                                         <th>Vendor</th>
                                         <th>Branch Name</th>
                                         <th>Branch Type</th>
                                         <th>Branch Code</th>
                                         <th>Items</th>
                                         <th>Total Amount</th>
                                         <th>Created At</th>

                                     </tr>

                                 </thead>

                                 <tbody>
                                     <?php foreach ($list as $item) { 
                                        $formatted_date = date("d F Y h:i A", strtotime($item->created_at));
                                        $items = json_decode($item->items);
                                        ?>
                                     <tr>
                                         <td><?=$item->order_id?></td>
                                         <td><?=ucwords($item->vendor)?></td>
                                         <td><?=$item->branch_name?></td>
                                         <td><?= ucwords(str_replace('-', ' ', $item->branch_type))?></td>
                                         <td><?=$item->branch_code?></td>

                                         <td>
                                             <?php
                                              if(count($items) > 0){
                                                ?>
                                             <ul>
                                                 <?php
                                                foreach($items as $product){
                                                    ?>

                                                 <li>
                                                     <?=$product->item_quantity . " X " . $product->item_name?>
                                                     <?=($product->size) ? ", " . $product->size : ""?>
                                                     <?php if (!empty($product->addon) && is_array($product->addon)): ?>
                                                     with <?=implode(", ", $product->addon)?>
                                                     <?php endif; ?>
                                                 </li>


                                                 <?php
                                                }
                                                ?>
                                             </ul>
                                             <?php
                                              }
                                              else{
                                                ?>
                                             Null
                                             <?php
                                              }
                                              ?>
                                         </td>



                                         <td><?="Rs. ".$item->total_amount?></td>
                                         <td><?=$formatted_date?></td>


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