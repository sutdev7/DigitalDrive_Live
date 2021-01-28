<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main id="main"> 
  
  <?php 
  $msg = $this->session->flashdata('msg'); 
  if(!empty($msg)) {
  ?>
  <section style="padding-top: 7%;">
    <?php echo $msg; ?>
  </section>
  <?php
  }
  ?>

  <!--==========================
      ConterDiv Section
    ============================-->
  <form name="frmCloseContract" id="frmCloseContract" action="<?php echo base_url(); ?>hire/submit_close_contract" method="post">
  <input type="hidden" name="fldContractID" value="{contract_id}" /> 
  <input type="hidden" name="fldOfferID" value="{offer_id}" />
  <input type="hidden" name="fldTaskID" value="{task_id}" />
  <input type="hidden" name="fldFreelancerID" value="{freelancer_id}" />     
  <div class="full" style="background:#f6f8fa; padding:50px 0; width:100%; float:left;">
    <div class="container">
      <div class="total-boddiv">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Close Contract</li>
          </ol>
        </nav>
        <div class="back-white back-white-two">
          <div class="bod-sec">
            <h2> Frelancer </h2>
            {freelancer_details}
            <div class="img2-ses"> <span> <img class="media-object img-circle" src="{user_image}" alt="{freelancer_name}" style="width: 89px;height: 88px;border-radius: 43px;"> </span>
              <div class="caption">
                <h3> {freelancer_name} </h3>
                <p> {freelancer_city}, {freelancer_state}, {freelancer_country} </p>
                <small> {freelancer_total_positive_coins} Coins </small>
                <small> {freelancer_total_negative_coins} Coins </small>
              </div>
            </div>
            {/freelancer_details}
          </div>
          <div class="bod-sec">
            <h2> Contract Title </h2>
            <big> {task_name} </big> </div>
          <div class="radiodiv">
            <ul>
              <li>
                <label class="containerdiv">Mark as incomplete
                  <input type="radio"   name="action" value="incomplete" id="markasincomplete" data-toggle="modal" data-target="#myModal" required >
                  <span class="checkmark"></span> </label>
              </li>
              <li>
                <label class="containerdiv">Mark as complete
                  <input type="radio" name="action" id="markascomplete" value="complete" >
                  <span class="checkmark"></span> </label>
              </li>
			  
            </ul>
			 </div>
			 <div id="coinsdiv" class="radiodiv">
                
                <span>Coins</span>
                  
                <ul>
                  <li>
                          <label class="containerdiv"> <small> -2 Coin </small> Bad Work
                            <input type="radio"   name="coin" value="0" required >
                            <span class="checkmark"></span> </label>
                    
                    <label class="containerdiv"> <small> -1 Coins </small> Bad Work
                            <input type="radio"   name="coin" value="-1" >
                            <span class="checkmark"></span> </label>
                        </li>
                  
                    <li>
                          <label class="containerdiv"> <small> +1 Coin </small> Good Work
                            <input type="radio"   name="coin" value="1" >
                            <span class="checkmark"></span> </label>
                    
                    <label class="containerdiv"> <small> +2 Coins </small> Good Work
                            <input type="radio"   name="coin" value="2" >
                            <span class="checkmark"></span> </label>
                        </li>
                </ul>
			
			
            <textarea rows="" cols="" name="fldContractReview" placeholder="Leave a review" required></textarea>
            <button type="submit" class="sub_btn">Submit</button> </div>
        </div>
      </div>
    </div>
  </div>
  </form>

<!-- Start by amardeep -->
  <!-- Button to Open the Modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open modal
  </button> -->

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Problem Ticket</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <!-- Modal body.. -->
          <!-- <div class="container"> -->
            <!-- <div class="row"> -->
              <!-- <div class="col-lg-12"> -->
                <!-- <div class="postDiv_Box"> -->
                  <form action="<?= base_url().'hire/save_problem_ticket' ?>" method="post">
                    <div class="step_Box step_box2">
                      <!-- <h3>Problem Ticket</h3> -->
                      <ul>
                        <li class="w-100"> 
                          <span>
                              <label>Issue Type</label>
                              <div class="select-style">
                                  <select name="problem_id" required>
                                  {grievance}
                                      <option value="{fid}">{problem_type}</option>
                                  {/grievance} 
                                  </select>
                              </div>
                          </span> 
                        </li>
                      </ul>
                      <ul>
                        <li class="w-100">
                          <span>
                              <label>Other Issue Type (optional)</label>
                              <input type="text" name="grievance_subject" class="form-control" />
                          </span>
                        </li>
                      </ul>
                      <ul>
                        <li class="w-100">
                          <span>
                              <label>Describe your problem</label>
                              <textarea name="grievance_content" class="form-control" rows="7" cols="" placeholder="Enter Description" required></textarea>
                        </span>
                        </li>
                      </ul>
                    </div>

                <!-- </div> -->
              <!-- </div> -->
            <!-- </div> -->
          <!-- </div> -->
        </div>
        <!--End Modal body -->
        
        <!-- Modal footer -->
        <div class="modal-footer">
                  <!-- <div class="fullDiv_bottom"> -->
                      <input type="submit" class="btn btn-primary" value="Raise Ticket" />
                    <!-- </div> -->
                  </form>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
<!-- End by amardeep -->

</main>

<script>
$(document).ready(function(){
  $("#markasincomplete").on('click',function(){
    // alert();
    $("#coinsdiv").hide();
  });
  $("#markascomplete").on('click',function(){
    // alert();
    $("#coinsdiv").show();
  });
});
</script>