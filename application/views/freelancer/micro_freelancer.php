<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$msg = $this->session->flashdata('msg'); 
if(!empty($msg)) {
  ?>
  <section style="padding-top: 10%;">
	<?php echo $msg; ?>
  </section>
  <?php
}
 
$frmValidationMsg = validation_errors(); 
if(!empty($frmValidationMsg)) {
  ?>
  <section style="padding-top: 7%;">
    <?php echo '<div class="alert alert-danger text-center">' . $frmValidationMsg . '</div>'; ?>
  </section>
  <?php
}
 ?>
  
<section id="postDiv">
    <div class="container">
    <div class="p-3">
      <h3 class="mt-3 mb-0">Popular Freelancer<span><a href="#" class="small btn btn-sm btn-primary float-right">Show More</a></span></h3>

            <div class="row">
              {dataArr}
        <div class="col-sm-4">
<div class="mt-5">
<div class="card gigs">
  <img class="card-img-top img-circle" src="{user_image}" style="width:100px;height:100px;border-radius: 73px;margin: 7px 0px 0px 108px;
">
  <?php //echo '<pre>'; print_r($data); ?>
  <div class="card-body position-relative">
<!--    <p class="small text-muted m-0 last-login"><span class="float-left"><i class="fa fa-calendar mr-1"></i>2.2.10</span><span class="float-right"><i class="fa fa-clock-o ml-3 mr-1"></i>10.08 P.M</span></p>-->
    <div class="gig-prof">
     <!--  <img src="{user_image}" class="user-img" style="width:60px;height:50px;"> -->
      <p class="text-center" style="font-size: 19px;color:black;"><b>{user_name}</b> </p>
      <p class="my-2 text-center">{microkey_title}</p>
      <div style="display: inline-flex;">
       <div class="text-center" style="background: #0080008f;flex: 1;width: 81px;border-radius: 5px;"><a href="<?=base_url()?>reviews/{user_id}" title="" class="follow"  style="color: white;">{reviews_frelincer}Review</a></div>
        <div class="text-center" style="background: red;width: 81px; margin-left: 33px;border-radius: 5px;"><a href="<?=base_url()?>messages/{user_id}" title="" class="message-us"style="color: white;"><i class="fa fa-envelope"></i></a></div>
       <div class="text-center" style="background: skyblue;width: 81px; margin-left: 30px;border-radius: 5px;"> <a href="<?=base_url()?>direct-hire-freelancer/{user_id}" title="" class="hire-us" style="color: white;">Hire</a></div>
      </div>
      <!-- <p class="my-2">{user_name} <span class="d-block small"><i class="fa fa-map-marker"></i> {user_city}, {user_state}, {user_country}</span></p>
      <p class="my-2 small"><span class="text-primary"><b>{user_projects}</b></span> Projects Done</p> -->
      
    </div>
 <!-- <h5 class="card-title text-center"><a href="micro-freelancer-details/{microkey_id}">{microkey_title}</a></h5>  -->
    
  </div>
  <div class="card-footer text-muted d-flex justify-content-between flex-wrap">
    <div>
    <!-- <span class="text-primary"><img src="img/coinn.png" width="18" class="mr-2" />5 ( 20 )</span> -->
    <span class="coin-tag"> {user_coins} Coins</span>
  </div>
  <div class="pull-right" style="margin-top: 6px;">
  
    <span class="text-primary"><a href="<?=base_url()?>freelancer/details_project/{user_id}" title="" class="view-more-pro">No of profile : {total_project_count}</a></span>
  </div>
  
  <!--  <div class="w-100 text-center mt-3"><a href="<?=base_url()?>freelancer/details_project/{microkey_id}" style="text-decoration: none;color: silver" title="" class="view-more-pro"><b>View Profile </b></a></div> -->
  <div class="w-100 text-center mt-3"><a href="<?=base_url()?>public-profile/{user_id}" title="" class="view-more-pro"><b>View Profile </b></a></div>
  <!-- <div class="w-100 text-center mt-3"><a href="<?=base_url()?>freelancer/details_project/{user_id}" title="" class="view-more-pro"><b>View Profile </b></a></div> -->
   <!--  <div class="w-100 border-top mt-3">
      <p class="text-center text-muted small mt-2 mb-0" style="font-size: 12px">{last_login}</p>
    </div> -->
    
  </div>
</div>
</div>
        </div>
        {/dataArr}
        
        
        
      </div>
    </div>
</div>
  </section>