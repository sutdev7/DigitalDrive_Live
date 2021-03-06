<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
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
   <link rel="stylesheet" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<div class="browser-taskDiv">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="browser-top">
          <div class="browser-lft">
            <h2> Submit Proposal
          </div>
          
        </div>
        <div class="task_Left_Div task_Left_Div-new">
          <h3>Proposal Key</h3>

            <p class="mb-1">Required Key to submit this proposal  <b> 1</b></p>
            <p class="mb-1 mt-1">Available Key <b> {task_data}{user_connects}{/task_data} </b></p>
        </div>

		<div class="task_Left_Div task_Left_Div-new">
			<h3>Job Details </h3>
			<h5 class="mb-2 mt-4">{task_data}{task_title}{/task_data}</h5>
			<small> Posted on {task_data}{task_due_date}{/task_data} </small>
			<p>{task_data} {task_details} {/task_data}<!-- <a href="#"> More </a>--> </p>
			<h4> Skills</h4>
			<span>{task_data}{task_requirements} <a href="#">{skill_name}</a> {/task_requirements}{/task_data} </span>
                        <h2 class="Atta">Attachment</h2>
                        {task_data}{task_attachments}
                            <a href="<?php echo base_url(); ?>download_file/{file_name}"><img style="padding: 10px;" src="{file_ext_type}" alt=""></a>
                        {/task_attachments}{/task_data}			
			<!--
			<div class="task_info"> <span>  <h5> Date to be determined</h5>
				<em> Hourly</em></span>
				<span> <h5>Project length</h5><em>1 month</em></span> 
                <span> <h5>Level</h5> <em>Intermediate</em> </span> 
            </div>-->
		</div>
		<form action="<?= base_url().'freelancer/submit_proposal' ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="task_id" value="<?= $this->input->post('task_id') ?>">
        <input type="hidden" name="user_task_id" value="{task_data}{user_task_id}{/task_data}">
        <div class="task_Left_Div task_Left_Div-new position-relative">
          <h3>Terms</h3>
          <h5 class="mb-2 mt-4">What is the Bid You'd like to bid for this job ?</h5>
          <p>Project Budget <i class="fa fa-dollar ml-2"></i> {task_data}{task_total_budget}{/task_data} </p>
          <div class="row align-items-center">
          	<div class="col-sm-9">
          		<div class="frmList">
                <div>
                  <ul class="float-left">
                    <li class="row align-items-center">
                      <div class="col-lg-8 col-md-12 col-xs-12">
                        <p>Bidding Amount &nbsp;&nbsp;&nbsp;</p>
                      </div>
                      <div class="col-lg-4 col-md-12 col-xs-12">
                        <label>Amount / hr</label>
                        <div class="input-group amt"> <span class="input-group-addon"><i class="fa fa-dollar"></i></span>                          
                          <input class="form-control" name="terms_amount_max" id="terms_amount_max" type="text" placeholder="0">
                        </div>
                      </div>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                  <ul class="float-left">
                    <li class="row align-items-center">
                      <div class="col-lg-8 col-md-12 col-xs-12">
                        <p>Portal Charges&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                      </div>
                      <div class="col-lg-4 col-md-12 col-xs-12" >
                        <label></label>
                        <div class="input-group amt"> <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                          <input class="form-control" name="portal_charges" id="portal_charges" type="text" placeholder="0" disabled="">
                        </div>
                      </div>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                  <ul class="float-left">
                    <li class="row align-items-center">
                      <div class="col-lg-8 col-md-12 col-xs-12">
                        <p>3rd Party Charges</p>
                      </div>
                      <div class="col-lg-4 col-md-12 col-xs-12">
                        <label></label>
                        <div class="input-group amt"> <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                          <input class="form-control" name="3rd_party_charges" id="3rd_party_charges" type="text" placeholder="0" disabled="">
                        </div>
                      </div>
                    </li>
                  </ul>
                  <ul class="float-left">
                    <li class="row align-items-center">
                      <div class="col-lg-8 col-md-12 col-xs-12">
                        <p>Earn Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                      </div>
                      <div class="col-lg-4 col-md-12 col-xs-12">
                        <label></label>
                        <div class="input-group amt"> <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                          <input class="form-control" name="earn_amount" id="earn_amount" type="text" placeholder="0" disabled="">
                        </div>
                      </div>
                    </li>
                  </ul>
                  
                </div>
                
              </div>
            
          	</div>
          	<div class="col-sm-3">
          		<div class="card d-flex align-items-center justify-content-center p-3" >
        		<i class="fa fa-shield text-primary fa-5x mb-3"></i>
        		<p class="m-0 text-center" style="font-size: 15px">Your transaction is secured . For Support</p>
        		<h3 class="text-primary d-block m-0">1234567890</h3>
        	</div>
          	</div>
          </div>
          	
        </div>
        <div class="task_Left_Div task_Left_Div-new">
			<h3>Additional Details</h3>
			<div class="form-group my-4">
				<label>Cover Letter</label>
				<textarea rows="8" col="7" name="cover_letter" class="form-control" required></textarea>
			</div>
			<div class="form-group">
				<label>Attachments</label>
				
					
				<div  class="row">
						<div class="col-sm-3">
						<input type="file" name="fldTaskDocuments[]" data-show-remove="true" data-errors-position="outside"  class="dropify" multiple required />
						</div>
						<div class="col-sm-3">
						  <input type="file" name="fldTaskDocuments[]" data-show-remove="true" data-errors-position="outside"  class="dropify" multiple />
						</div>
						  <div class="col-sm-3">
						<input type="file" name="fldTaskDocuments[]" data-show-remove="true" data-errors-position="outside"  class="dropify" multiple />
						</div>
						<div class="col-sm-3">
						  <input type="file" name="fldTaskDocuments[]" data-show-remove="true" data-errors-position="outside"  class="dropify" multiple />
						</div>
				</div>
				
				
			<!--	<ul id="media-list" class="clearfix">
				  <li class="myupload w-auto"> <span><i class="fa fa-plus" aria-hidden="true"></i>
                  	<input type="file" name="fldTaskDocuments[]" click-type="type2" id="picupload" class="picupload" multiple />
                  	<input type="file" name="fldTaskDocuments[]"  class="dropify" multiple />
                  	
					</span> </li>
					
					<li class="myupload w-auto"> 
					<span><i class="fa fa-plus" aria-hidden="true"></i>
                        <input type="file" name="fldTaskDocuments[]"  class="dropify" multiple />
                  	</span> 
					</li>
					
					<li class="myupload w-auto"> 
					<span><i class="fa fa-plus" aria-hidden="true"></i>
                        <input type="file" name="fldTaskDocuments[]"  class="dropify" multiple />
                  	</span> 
					</li>
					
					<li class="myupload w-auto"> 
					<span><i class="fa fa-plus" aria-hidden="true"></i>
                        <input type="file" name="fldTaskDocuments[]"  class="dropify" multiple />
                  	</span> 
					</li>
					
					<li class="myupload w-auto"> 
					<span><i class="fa fa-plus" aria-hidden="true"></i>
                        <input type="file" name="fldTaskDocuments[]"  class="dropify" multiple />
                  	</span> 
					</li>
					
				</ul>  -->
			</div>
			<!--<p class="mt-4 mb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>-->
			<hr>
			<div class="form-group">
				<div class="row justify-content-end">
					<div class="col-sm-3">
						<input type="submit" name="submit" class="eyeBtn my-0" value="Submit Proposal" />
						<!-- <a href="#" class="eyeBtn my-0">Submit Proposal</a> -->
					</div>
					<div class="col-sm-3">
						<input type="button" name="" class="HireBtn my-0" value="Cancel"/>
						<!-- <a href="#" class="HireBtn my-0">Cancel</a> -->
					</div>
				</div>
			</div>
        </div>
		</form>
      </div>
    </div>
  </div>
</div>
</div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
 
    <script>
            jQuery(document).ready(function(){
                // Basic
                jQuery('.dropify').dropify();

                $("#terms_amount_max").on('input', function(e) {

                  var gross_total = $(this).val();
                  if(isNaN(gross_total) || gross_total < 0) {
                    $("#portal_charges").val(0);
                    $("#3rd_party_charges").val(0);                    
                    $("#earn_amount").val(0);
                    return false;
                  }
                  var commision=0;
                  var percentage=0;
                  if(gross_total<100){
                    commision=(gross_total*3)/100;
                    percentage="3%";
                  } 
                  if(gross_total>=100 && gross_total<=500){
                    commision=(gross_total*5)/100;
                    percentage="5%";
                  }

                  if(gross_total>500 && gross_total<=1000){
                    commision=(gross_total*10)/100;
                    percentage="10%";
                  }

                  if(gross_total>1000 && gross_total<=3000){
                    commision=(gross_total*15)/100;
                    percentage="15%";
                  }

                  if(gross_total>3000){
                    commision=(gross_total*20)/100;
                    percentage="20%";
                  }
                  console.log(percentage);

                  var freelancer_amount = gross_total - commision;
                  var thired_party_commision = (gross_total*2)/100;
                  freelancer_amount = freelancer_amount - thired_party_commision;
                  $("#portal_charges_percentage").val(percentage);
                  $("#portal_charges").val(commision);
                  $("#3rd_party_charges").val(thired_party_commision);
                  $("#3rd_party_percentage").val('2%');
                  $("#earn_amount").val(freelancer_amount);
                });
            });
        </script>
 