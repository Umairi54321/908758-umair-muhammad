 <!-- Start content -->
 <div class="content">

     <div class="container-fluid">
         <div class="page-title-box">

             <div class="row align-items-center ">
                 <div class="col-md-8">
                     <div class="page-title-box">
                         <h4 class="page-title">Menu's Record</h4>

                     </div>
                 </div>

                 <div class="col-md-4">
                     <div class="page-title-box text-right">
                         <a class='btn btn-primary' href="<?=site_url()?>master/vendors/add-menu?id=<?=$this->input->get('vendor_id')?>">Add Menu Item</a>

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
                                         <th>Item Name</th>
                                         <th>Item Image</th>
                                         <th>Item Type</th>
                                         <th>Menu Category</th>
                                         <th>Branch Type</th>
                                         <th>Description</th>
                                         <th>Variant</th>
                                         <th>Price</th>
                                         <th>Addons</th>
                                         <th>Action</th>
                                     </tr>

                                 </thead>

                                 <tbody>
                                 <?php $i=1; foreach ($list as $item) { 
                                       $language = "";
                                       $varaints = "";
                                        $addons = "";
                                        $item_name = "";
                                        $cat_name = "";
                                        $item_desc = "";
                                        if($language == "English"){
                                            $addons =  json_decode($item->addons);
                                            $varaints =  json_decode($item->variants);
                                            $item_name = $item->item_name;
                                            $item_desc = $item->item_description;
                                            $cat_name = $item->category_name;
                                        }
                                        elseif($language == "Arabic"){
                                            $addons =  json_decode($item->addons_arabic);
                                            $varaints =  json_decode($item->variants_arabic);
                                            $item_name = $item->item_name_arabic;
                                            $item_desc = $item->item_description_arabic;
                                            $cat_name = $item->category_name_arabic;
                                        }
                                        else{
                                            $addons =  json_decode($item->addons);
                                            $varaints =  json_decode($item->variants);
                                            $addons_arabic =  json_decode($item->addons_arabic);
                                            $varaints_arabic =  json_decode($item->variants_arabic);
                                            $item_name = $item->item_name."(".$item->item_name_arabic.")";
                                            $item_desc = $item->item_description." (".$item->item_description_arabic.")";
                                            $cat_name = $item->category_name."(".$item->category_name_arabic.")";
                                        }
                                        ?>
                                     <tr>
                                         <td><?=$i?></td>
                                         <td><?=$item_name?></td>
                                         <td><img style='width:80px; height:80px; border-radius:50%;'
                                                 src="<?=base_url()?>assets/images/menu-item/<?=$item->item_image?>"
                                                 alt="<?=$item->item_image?>"></td>
                                         <td><?= ucfirst($item->item_type)?></td>
                                         <td><?=$cat_name?></td>
                                         <td><?=$item->branch_type?></td>
                                         <td><?=$item_desc?></td>
                                         <td>
                                              <?php
                                              if($varaints && count($varaints) > 0){
                                                ?>
                                                <ul>
                                                <?php
                                                foreach($varaints as $variant){
                                                    ?>
                                                    
                                                        <li><?=$variant->size."-".$variant->price?></li>
                                                    
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

                                         <td><?=!empty($item->price)?$item->price:"Null"?></td>

                                         <td>
                                              <?php
                                              if($addons && count($addons) > 0){
                                                ?>
                                                <ul>
                                                <?php
                                                foreach($addons as $addon){
                                                    ?>
                                                    
                                                        <li><?=$addon->addon_for?> - <?=($addon->price == null)?"Free":$addon->price?></li>
                                                    
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
                                         
                                         
                                         <td>
                                             <div class="btn-group">
                                                 <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                                     data-toggle="dropdown" aria-haspopup="true"
                                                     aria-expanded="false">Action</button>
                                                 <div class="dropdown-menu">

                                                     <a class="dropdown-item"
                                                         href="<?= site_url() ?>master/vendors/edit-menu?id=<?=$item->itemId?>&vendor_id=<?=$this->input->get('vendor_id')?>">Edit</a>



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