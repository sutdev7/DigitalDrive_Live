<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<main id="main">

    
    <section id="postDiv">
        <div class="container">
            <div class="p-3">
                <h3 class="mt-3 mb-0">Popular Freelancer</h3>
               
                    
                    <div class="row" >
                        <?php 
                        foreach ($userData as $key => $value) {
                            # code...
                        
                        ?>
                      
                        <div class="col-sm-4">
                            <div class="mt-5">
                                <div class="card gigs">
                                    <img class="card-img-top img-circle" src="<?=base_url('uploads/user/profile_image/'.$value->profile_image);?>"  style="width:100px;height:100px;border-radius: 73px;margin: 7px 0px 0px 108px;
" />

                                    <div class="card-body position-relative">

                                        <div class="gig-prof">
                                           <!--  <img src="<?php echo base_url(); ?>assets/img/img-profile.jpg" class="user-img" /> -->
                                            <p class="text-center" style="font-size: 19px;color:black;"><b><?=$value->name?></b> </p>
                                           <!--  <p class="my-2">Don Bros <span class="d-block small"><i
                                                        class="fa fa-map-marker"></i> Sydney, NSW, Australia</span>
                                            </p> -->
                                             <p class="my-2 text-center"><i
                                                        class="fa fa-map-marker"></i><?=$value->cname?></span></p>
                                            <p class="my-2 text-center" style="height: 66px"><?= substr($value->bio, 0, 60); ?>
                                            </p>
                                            <!-- <p class="my-2 small"><span class="text-primary"><b>50</b></span>
                                                Projects
                                                Done</p> -->

                                             <div style="display: inline-flex;">
                                                   <div class="text-center" style="background: #0080008f;flex: 1;width: 81px;border-radius: 5px;"><a href="<?=base_url()?>reviews" title="" class="follow"  style="color: white;">
                                                       <?php 
                                                        $revie_count = $this->Tasks->reviewsCount($value->user_id);
                                                        echo $revie_count;
                                                        ?>
                                                   Review</a></div>
                                                    <div class="text-center" style="background: red;width: 81px; margin-left: 33px;border-radius: 5px;"><a href="<?=base_url()?>messages/N4IND81M4L" title="" class="message-us"style="color: white;"><i class="fa fa-envelope"></i></a></div>
                                                   <div class="text-center" style="background: skyblue;width: 81px; margin-left: 30px;border-radius: 5px;"> <a href="<?=base_url()?>hired" title="" class="hire-us" style="color: white;">Hire</a></div>
                                              </div>

                                        </div>
                                        <h5 class="card-title text-center"><a href="micro-key-details.html"></a></h5>
                                                <!-- <div>

                                                    <span class="micro-key">Micro-key</span>
                                                </div> -->
  

                                    </div>
                                    <div class="card-footer text-muted d-flex justify-content-between flex-wrap">
                                        <div>

                                            <span class="coin-tag"><?=$value->total_positive_coins?> Coins</span>
                                        </div>
                                        <p class="my-2 small"><span class="text-primary"><b>
                                            <?php $task_com=$this->Tasks->reviewsCountTask($value->user_id);
                                            echo $task_com;
                                            ?>
                                       </b></span>
                                                Projects
                                                Done</p>
                                                <p class="text-center text-muted small mt-2 mb-0"
                                                style="font-size: 12px">
                                                Last Login: <?=$value->last_login?></p>
                                        
                                        <div class="w-100 text-center mt-3"><a href="<?=base_url()?>freelancer/details_project/<?=$value->user_id?>" title="" class="view-more-pro"><b>View Profile </b></a></div>
                                        <!-- <div class="w-100 border-top mt-3">
                                            <p class="text-center text-muted small mt-2 mb-0"
                                                style="font-size: 12px">
                                                Last Login 9.08.20, 10.30 P.M</p>
                                        </div> -->

                                    </div>
                                </div>
                            </div>

                        </div>

                        <?php }?>

                        <div class="pag">
                            <?=$links?>
                          </div>
                        

                    </div>
                  
          
               
                
            </div>

        </div>
    </section>
</main>


<!-- script for auto complete multiselect --> 
<script src="<?php  echo base_url('assets/js/fastselect.standalone.js'); ?>"></script> 
<script>
  $('.multipleSelect').fastselect();
</script> 

<script> 
  $(document).ready(function() { 
    $( "#fldSearchCriteria" ).keyup(function() {
      $.ajax({
        method: "POST",
        url: "<?php echo base_url(); ?>Task/ajax_list_tasks",
        data: { searchCriteria: $(this).val() }
      })
      .done(function( msg ) {
        $("#searchResult").html(msg);
      });
    });
  }); 
</script>     