<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="../assets/css/responsive.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    crossorigin="anonymous" />
<main id="main"> 
    <!--==========================
        ConterDiv Section
      ============================-->
    <section class="banner" style="background-image: url('../assets/img/banner-bg.jpg');">
      <div class="container">
        <div class="banner-content">
          <div class="left-col">
            <?php /*<div class="logo-container">
              <img src="../assets/img/logo.png" class="logo" alt="" />
            </div> */ ?>
            <div class="banner-text">
              <h2>{task_info}{task_title}{/task_info}</h2>
              <span>
                <p><i class="fas fa-map-marker-alt theme-color"></i>
                  {task_info}{task_country}{/task_info}</p>
                <p><i class="fas fa-calendar-alt theme-color"></i>
                  Posted {task_info}{task_doc}{/task_info}</p>
              </span>
            </div>
          </div>

          <div class="right-col">
            <div class="salary">
              <h4>Budget</h4>
              <h3>${task_info}{task_total_budget}{/task_info}</h3>
            </div>
          </div>
        </div>
      </div>

    </section>

    <?php
    $msg = $this->session->flashdata('msg');
    if (!empty($msg)) {
        ?>
        <section style="padding-top: 7%;">
            <div class="container">
            <?php echo $msg; ?>
            </div>
        </section>
        <?php
    }
    ?>

    <section class="job-name">
      <?php /*<div class="container">
        <div class="job-name-content">

          <h2>{task_info}{task_title}{/task_info}</h2>


          <div class="line-2">
            <span><i class="fas fa-map-marker-alt theme-color"></i> {task_info}{task_country}{/task_info}</span>
          </div>

          <div class="line-3">
            <span><i class="fas fa-calendar-alt theme-color"></i> Post Date: {task_info}{task_doc}{/task_info}</span>
          </div>


        </div>
      </div> */ ?>
    </section>

    <section class="outer-wrapper-job">
      <div class="container">
        <div class="row">
          <div class="left-col col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="job-detail-content">
              <h3>Job Detail</h3>

              <div class="row">
                <div class="more-detail col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <div class="more-detail-content">
                    <div>
                      <img src="../assets/img/money-hand.png" alt="" />
                    </div>
                    <div>
                      <h6>Budget
                      </h6>
                      <h6>${task_info}{task_total_budget}{/task_info}</h6>
                    </div>
                  </div>
                </div>

                <div class="more-detail col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <div class="more-detail-content">
                    <div>
                      <img src="../assets/img/folder.png" alt="" />
                    </div>
                    <div>
                      <h6>Project length
                      </h6>
                      <h6>{task_info}{tasktime_duration} {/task_info}</h6>
                    </div>
                  </div>
                </div>

                <?php /*<div class="more-detail col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <div class="more-detail-content">
                    <div>
                      <img src="../assets/img/bag.png" alt="" />
                    </div>
                    <div>
                      <h6>Hours to be determined</h6>
                      <h6>{task_info}{task_duration_type}{/task_info}</h6>
                    </div>
                  </div>
                </div> */ ?>

                <div class="more-detail col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <div class="more-detail-content">
                    <div>
                      <img src="../assets/img/avatar.png" alt="" />
                    </div>
                    <div>
                      <h6>Proposal
                      </h6>
                      <h6>{proposal_count}</h6>
                    </div>
                  </div>
                </div>

              </div>


              <div class="job-description">
                <h3>Job Description</h3>
                <p>{task_info}{task_details}{/task_info}</p>
              </div>

              <div class="required-skills">
                <h3>Keywords</h3>
                 <?php 
                $task_keywords = isset($task_info[0]['task_keywords']) ? explode(', ',$task_info[0]['task_keywords']) : array();
                if(!empty($task_keywords)) {
                  ?>
                  <span class="w-100">
                  <?php
                  foreach ($task_keywords as $keyword) {
                      ?>
                      <h5 class="bg-theme"><?php echo $keyword; ?></h5>
                      <?php                      
                  }
                  ?>
                  </span>
                  <?php
                }
                 ?>
              </div>

              <div class="required-skills">
                <h3>skills</h3>

                <span class="w-100">{task_info}{task_requirements}<h5 class="bg-theme">{skill_name}</h5> {/task_requirements}{/task_info}</span>
              </div>
              <br>
              <div class="what-will-do">
                <h3>Activity On this Job</h3>
                <?php /*<h5><i class="fas fa-long-arrow-alt-right"></i> Proposal <b>{proposal_count}</b> </h5>*/ ?>
                <h5><i class="fas fa-long-arrow-alt-right"></i> Hired <b>{task_info}{task_freelancer_hire}{/task_info}</b> </h5>
                <?php /*<h5><i class="fas fa-long-arrow-alt-right"></i> Offer Send <b>{offer_send}</b> </h5>*/ ?>
              </div>
            </div>
          </div>

          <div class="right-col col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">

            <div class="apply-job">
              <div class="btn">
                <?php
                    if ($hire_me == true) {
                        ?>
                        <a href="<?= base_url() . 'take-action' ?>/{mnotification_row_id}/<?php echo base64_encode('17'); ?>">Complete</a>
                        <?php
                    } else {
                        ?>
                        <!--form action="<?= base_url() . 'proposal' ?>" method="post">
                            <input type="hidden" value="{task_info}{user_task_id}{/task_info}" name="user_task_id">
                            <input type="hidden" value="{task_info}{task_id}{/task_info}" name="task_id">
                            <input type="submit" value="Submit Proposal" class="eyeBtn">
                        </form-->
                       <?php if(trim($proposal_info_is_already) == "yes" ){ ?>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#myModalview">VIEW PROPOSAL</a>
                        <?php }else{ ?>
                        <!-- myModal  -->
                          <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">SUBMIT PROPOSAL</a>
                        <?php } ?>
                        <?php
                    }
                ?>
                <!--a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">APPLY FOR THE JOB</a-->
              </div>
              <!-- <h5>Application end in 4d 5h 3m</h5> -->
              <h6>OR APPLY WITH</h6>
              <ul>
                    <li>
                        <?php /*<h3><a href="javascript:void(0)" class="{inappropriateclass}" id="txtflag" ><i class="fa fa-flag mr-2"></i>{inappropriatetext}</a></h3>*/ ?>
                        <p class="mb-1">Required connects to submit this proposal <b>1</b></p>
                        <p class="mb-1">Available Connects <b>{connection}</b>
                    </li>
                </ul>
            </div>

            <div class="btn send-msg-btn">
                <?php
                    if ($hire_me == true) {
                        ?>
                        <a href="<?= base_url() . 'problem-ticket' ?>">CANCEL</a>
                        <?php
                    } else {?>
                       {savetext}
                    <?php }?>
            </div>

            <div class="about-client-box">
              <h3>About the Client</h3>
              <span class="line"></span>
              <div class="client-text">
                <!--div class="text-line">
                  <div><i class="fas fa-map-marker-alt"></i>
                  </div>
                  <h4>Australia</h4>
                </div-->

                <div class="text-line">
                  <div><i class="fas fa-tv"></i>
                  </div>
                  <h4>{creator_data}{creator_post_count}{/creator_data} Jobs posted</h4>
                </div>

                <div class="text-line">
                  <div><i class="fas fa-clock"></i>
                  </div>
                  <h4>Member since {creator_data}{since}{/creator_data}</h4>
                </div>
              <?php  /*</div>

              <?php /*<h3>About the Client</h3>
              <div class="about-client-content"> */ ?>
                <?php /*<div class="text-line">
                  <div><i class="fas fa-address-card"></i>
                  </div>
                  <h4>Payment method verified</h4>
                </div> */ ?>

                <?php /*<div class="text-line">
                  <div><i class="fas fa-credit-card"></i>
                  </div>
                  <h4>Identity verified</h4>
                </div> */ ?>

                <div class="text-line">
                  <div><i class="fas fa-envelope <?php echo isset($creator_data[0]['status']) && $creator_data[0]['status'] == '1' ? 'text-success' : '';  ?>"></i>
                  </div>
                  <h4><?php echo isset($creator_data[0]['status']) && $creator_data[0]['status'] == '1' ? 'Email address verified' : 'Email address not verified';  ?></h4>
                </div>

                <div class="text-line">
                  <div><i class="fas fa-user-alt"></i>
                  </div>
                  <h4>Profile completed</h4>
                </div>

                <?php /*<div class="text-line">
                  <div><i class="fas fa-phone-alt <?php $creator_data[0]['is_mobile_verified'] = 1; echo isset($creator_data[0]['is_mobile_verified']) && $creator_data[0]['is_mobile_verified'] == '1' ? 'text-success' : '';  ?>"></i>
                  </div>
                  <h4>Phone number verified</h4>
                </div> */ ?>
              </div>
              <br>

              
              <h3>Job Link</h3>

              <div class="about-client-content">
                <div class="text-line">
                  
                  <h4><a href="<?= base_url() . 'job-details/' . $this->uri->segment(2) ?>">http://jobLink</a></h4>
                </div>

                <div class="text-line">
                  <h4 onclick="copyToClipboard('#copylink')">Copy link</h4>
                </div>

              </div>


            </div>

          </div>
        </div>
      </div>
    </section>
</main>

<!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <form action="<?= base_url().'freelancer/submit_proposal' ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="task_id" value="<?= $task_id ?>">
            <input type="hidden" name="user_task_id" value="<?= $user_task_id ?>">
            <div class="modal-content">
                <div class="header">
                    <h2>Apply a Job</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="body">
                    <div class="row cover">
                      <!-- added by amar -->
                      
                        <div class="col-md-12 col-lg-12 col-xl-12">

                          <!-- <h3>Terms</h3> -->
                          <div class="frmList">
                            <div class="radiodiv" style="padding-top:0;">
                              <?php  
                              if(isset($task_info[0]['milestone_type']) &&  $task_info[0]['milestone_type'] == "hourly" ){
                                  $hourly = "checked";
                                  $milestone = "";
                                  $displayH="";
                                  $DisplayM="display: none;";
                              } else  if(isset($task_info[0]['milestone_type']) &&  $task_info[0]['milestone_type'] == "milestone" ){
                                $hourly ="";
                                $milestone ="checked";
                                $displayH="display: none;";
                                $DisplayM = "display: block";
                              } else{
                                $hourly ="";
                                $milestone ="checked";
                                $displayH="display: none;";
                                $DisplayM="";
                              }

                               ?>
                              <ul>
                                <li>
                                  <label class="containerdiv newopen1">Amount / Hour
                                    <input type="radio" name="terms" value="pay_hourly_amount" <?php echo $hourly;?> >
                                    <span class="checkmark"></span> </label>
                                </li>
                                <!-- 
                                <li>
                                  <label class="containerdiv newopen2">Amount by Milestone
                                    <input type="radio" name="terms" value="pay_by_milestone">
                                    <span class="checkmark"></span> </label>
                                </li> -->

                                <li>
                                  <label class="containerdiv newopen3">Fixed Payment
                                    <input type="radio" name="terms" value="pay_whole_amount" <?php echo $milestone; ?>>
                                    <span class="checkmark"></span> </label>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                       

                        <div class="opendiv1 col-md-6 col-lg-6 col-xl-6" style="<?php echo $displayH;?>">
                            
                            <div class="portal-text" style="float: left;">
                                <h5>Amount / Hour</h5>
                                <input type="text" name="amount_per_hr" placeholder="$ 0" id="amount_per_hr">
                            </div>
                            <div class="portal-text" style="float: left; margin-left: 5px;">
                                <h5>No of hour</h5>
                                <input type="text" placeholder="$ 0"  id="no_of_hr" name="no_of_hr">
                            </div>
                            
                        </div>
                        

                        <div class="bidding-amt col-md-6 col-lg-6 col-xl-6">
                            <div class="portal-text" style="float: left;">
                                <h5>Bidding Amount</h5>
                                <input type="text" name="terms_amount_max" placeholder="$ 0" id="terms_amount_max" required>
                                <!-- <div class="opendiv1" style="display: inline;"><strong>/Hour</strong></div> -->
                            </div>
                            <div class="portal-text" style="float: left; margin-left: 5px;">
                                <h5>Portal Charges</h5>
                                <input type="text" placeholder="$ 0" disabled="" id="portal_charges" name="portal_charges">
                            </div>
                            
                        </div>

                        <div class="portal-charges col-md-6 col-lg-6 col-xl-6">
                            <div class="portal-text" style="float: left;">
                                <h5>3rd Party Charges</h5>
                                <input type="text" placeholder="$ 0" disabled="" name="3rd_party_charges" id="3rd_party_charges">
                            </div>
                            <div class="portal-text" style="float: left; margin-left: 5px;">
                                <h5>Earn Amount</h5>
                                <input type="text" placeholder="$ 0" name="earn_amount" disabled="" id="earn_amount">
                            </div>

                        </div>

                        <div class="proposal col-md-6 col-lg-6 col-xl-6">
                            <span>Required Key to submit this proposal 1</span>
                            <h4>Available Key {connection}</h4>
                        </div>

<div class="col-md-12 col-lg-12 col-xl-12" >
    
    <label class="containerdiv opendiv3" style="<?php echo $DisplayM;?>" >Go with Milestone
      <input type="checkbox" name="terms" class="newopen2" value="pay_by_milestone" <?php //echo $milestone; ?>>
      <span class="checkmark"></span> 
    </label>

    <div class="col-md-10 col-lg-10 col-xl-10 opendiv2">
        <a href="#" class="plus_btn" id="addRow"><i class="fa fa-plus"></i> Add More</a> <span class="optionalSpan"></span> 
    </div>
    <div class="opendiv2" style="<?php echo $DisplayM;?>">
        <table class="table table-bordered" id="addNewRow">
            <tbody>
                <tr>
                    <td>
                        <input type="text" id="title_1" name="milestone_title[]" class="form-control" placeholder="Title">
                    </td>
                    <td>
                      <span>
                        <i class="fa fa-dollar" style="float: left;margin: 10px"></i>
                        <input class="form-control milestone_amount" id="stoneAmt_1" type="number" name="milestone_agreed_budget[]" placeholder="00" style="width: 8rem;">
                      </span>
                    </td>
                    <td>
                      <button type="button" class="btn-primary removeRRow"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" name="rownum" id="rownum" value="1">
    </div>
</div>


                      <!-- end by amar -->
                        <div class="col-md-10 col-lg-10 col-xl-10">
                            <div class="cover-letter">
                                <h4>Cover letter</h4>
                                <!-- <div id="the-count">
                                    <span id="current">0</span>
                                    <span id="maximum">/ 700</span>
                                </div> -->
                            </div>
                            <textarea name="cover_letter" id="the-textarea" required placeholder="Type here" autofocus></textarea>
                        </div>

                        <!-- <div class="proposal text-center col-md-4 col-lg-4 col-xl-4">
                            <p>Required Key to submit this proposal 1</p>
                            <h4>Available Key {connection}</h4>
                        </div> -->
                    </div>

                    <div class="row charges">
                        <div class="drop-files col-md-5 col-lg-5 col-xl-5">

                            <div class="file-upload">
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*,.pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" name="fldTaskDocuments[]" />
                                    <div class="drag-text">
                                        <img src="../assets/img/modal-upload.jpg" data-default-path="../assets/img/modal-upload.jpg" alt="" />
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                        <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="bidding-amt col-md-4 col-lg-4 col-xl-4">
                            <div class="portal-text">
                                <h5>Bidding Amount</h5>
                                <input type="text" name="terms_amount_max" placeholder="$ 0" id="terms_amount_max" required>
                                <span>Amount / hr</span>
                            </div>
                            <div class="portal-text">
                                <h5>Portal Charges</h5>
                                <input type="text" placeholder="$ 0" disabled="" id="portal_charges" name="portal_charges">
                            </div>
                        </div>

                        <div class="portal-charges col-md-3 col-lg-3 col-xl-3">
                            <div class="portal-text">
                                <h5>3rd Party Charges</h5>
                                <input type="text" placeholder="$ 0" disabled="" name="3rd_party_charges" id="3rd_party_charges">
                            </div>
                            <div class="portal-text">
                                <h5>Earn Amount</h5>
                                <input type="text" placeholder="$ 0" name="earn_amount" disabled="" id="earn_amount">
                            </div>

                        </div> -->
                    </div>
                </div>

                <div class="line">

                </div>

                <footer class="footer">
                    <div class="cta">
                        <button class="btn submit" type="submit">Submit</button>
                        <button class="btn cancel" data-dismiss="modal">Cancel</button>
                    </div>
                </footer>
            </div>
        </form>
            <!-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div> -->
        </div>

    </div>

<!-- Modal end -->


<!-- view proposal Modal -->
<div id="myModalview" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <form action="<?= base_url().'freelancer/submit_proposal' ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="task_id" value="<?= $task_id ?>" id="task_id">
            <input type="hidden" name="user_task_id" value="<?= $user_task_id ?>" id="user_task_id">
            <div class="modal-content">
                <div class="header">
                    <h2>View Proposal</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

<div class="body">
  <div class="row cover">
    <div class="to-close">
      <h2>Proposal Details</h2>
      <p>
        <i class="fa fa-dollar theme-color"></i> 
        Bidding Amount: 
        $<?php echo isset($proposal_info[0]["terms_amount_max"]) ? $proposal_info[0]["terms_amount_max"] : ""; ?>
      </p>
      
      <p>
        <i class="fa fa-calendar theme-color"></i> 
        Posting Date: 
        <?php echo isset($proposal_info[0]["doc"]) ? $proposal_info[0]["doc"] : ""; ?>
      </p>
      
      <p>
        <i class="fa fa-credit-card theme-color"></i> 
        Payment Type: 
        <?php echo isset($proposal_info[0]["milestone_type"]) ? ucwords($proposal_info[0]["milestone_type"]) : ""; ?>
      </p>
      
      <?php if(isset($proposal_info[0]["milestone_type"]) && ($proposal_info[0]["milestone_type"] == "hourly")){ ?>
          <p><i class="fa fa-clock-o theme-color"></i> 
            Total no. of hour:   
            <?php echo isset($proposal_info[0]["no_of_hr"]) ? $proposal_info[0]["no_of_hr"] : "";  ?>
            &nbsp Amount / hour: 
            <?php echo isset($proposal_info[0]["amount_per_hr"]) ? '$'.$proposal_info[0]["amount_per_hr"] : "";  ?>
          </p>
      <?php } ?>
      <hr/>
      
      <h2 class="Atta">Download Attachment</h2>
      <?php if("" != $proposal_info[0]["attachments"]){ ?>
        <a href="<?php echo base_url(); ?>download_attachment_proposal/<?php echo isset($proposal_info[0]["attachments"]) ? $proposal_info[0]["attachments"] : "";  ?>"><img style="padding: 10px; width: 84px; height: 84px;" src="<?php echo get_file_ext($proposal_info[0]["attachments"]) ?>" alt=""></a>
        <br/>
        <a href="<?php echo base_url(); ?>download_attachment_proposal/<?php echo isset($proposal_info[0]["attachments"]) ? $proposal_info[0]["attachments"] : "";  ?>" class="" download><i class="fa fa-download"></i> Download</a>
      <?php }else{ ?>
        <p>No Attachment</p>
      <?php } ?>
      <br/> 

      <!--<p>{p_attachments}</p> -->
        <!-- <form id="frm_attachment" action="<?php /*echo base_url() */?>download_attachment/{p_attachments}" method="post" style="width:100%;">
        <p id="download_attachment_{p_attachments}" style="cursor: pointer;"><i class="fa fa-download"></i> Download Attachment </p>
        </form>-->
      <hr/>
      <h2>Cover Letter</h2>
      <div class="anyClass black_color proposal-remark"><?php echo isset($proposal_info[0]["cover_letter"]) ? $proposal_info[0]["cover_letter"] : "";  ?></div>
      <hr/>

    </div>
    
    <div class="mbl-table-nine">
      <div class="mbldiv-scroll">
        <h2>Budget details</h2>
        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Title</th>
              <th>Budget</th>
              <!-- <th>Provided By</th> -->
              <!-- <th>Action</th> -->
            </tr>
          </thead>
          <tbody id="dataList">
            <!-- Display posts list -->
            <?php if(!empty($proposal_info)){ foreach($proposal_info as $row){ ?>
              <tr>
                <td> <?php  echo date('Y-m-d',strtotime($row["milestone_doc"])); ?></td>
                <td><?php  echo $row["milestone_title"]; ?></td>
                <td>$<?php echo $row["milestone_agreed_budget"]; ?></td>
              </tr>
            <?php } }else{ ?>
              <tr>
                <td  colspan="5"><p>Records not found...</p></td>
              </tr>
            <?php } ?>
            <!-- Render pagination links -->
            <tr>
              <td  colspan="5"></td>
            </tr>
          </tbody>
        </table>
                                    
      </div>
    </div>
  </div>
</div>

<div class="line"></div>
<footer class="footer">
  <div class="cta">
    <button class="btn cancel" data-dismiss="modal">Cancel</button>
  </div>
</footer>
</div>
</form>
</div>
</div>
<!-- view proposal Modal end -->
  
<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

<script> 
$(document).ready(function() {
    // Basic
    $('.dropify').dropify();
    $("#terms_amount_max").on('change input', function(e) {
        //console.log("In");
        // $(".newopen2").prop('checked', true);
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
        //console.log(percentage);

        var freelancer_amount = gross_total - commision;
        var thired_party_commision = (gross_total*2)/100;
        freelancer_amount = freelancer_amount - thired_party_commision;
        
        $("#portal_charges_percentage").val(percentage);
        $("#portal_charges").val(commision);
        $("#3rd_party_charges").val(thired_party_commision);
        $("#3rd_party_percentage").val('2%');
        $("#earn_amount").val(freelancer_amount);
    });

    $("#savejob").click(function(){
        $userTaskId = $("#user_task_id").val();
        //console.log($taskid);
        if($userTaskId !=""){
            $.ajax({
                url: '<?php echo base_url();?>save-job',
                method:'post',
                data:{"userTaskId":$userTaskId},
                dataType: 'json',
                success: function (res) {
                  if(res['status']=='200'){
                    location.reload();  
                  }
                }
            });
        }
    });

    $("#savedJob").click(function(){
      window.open('<?php echo base_url();?>my-jobs', '_blank');
    })
});
	
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).attr('href')).select();
    document.execCommand("copy");
    alert('Linked Copied');
    $temp.remove();
}

var currentamount = 0;
var wholeamount = 0;
    
function CalculateMS(){
    var sumtotal=0;
    wholeamount = $("#terms_amount_max").val();
    var lastval = $(".milestone_amount").last().val();
    if(isNaN(lastval) || lastval ==''){
      lastval = 0;
    }
    $(".milestone_amount").each(function(){
      sumtotal = sumtotal + Number($(this).val());
    });
    
    $restamount = wholeamount-sumtotal;
    $balance = parseInt($restamount) + parseInt(lastval);
    // alert($balance);
    $(".milestone_amount").last().val($balance);
}

$(".newopen2").click(function(){
    //alert($(this).is(":checked"));
    if($(this).is(":checked")){
      $(".opendiv2").show();
      wholeamount = $("#terms_amount_max").val();
      $(".milestone_amount").first().val(wholeamount);
    }else{
      $(".opendiv2").hide();
    }
    
    $(".opendiv1").hide();
});

$('#addRow').click(function(){
    wholeamount = $("#terms_amount_max").val();
    var sumtotal = 0;
    if(wholeamount <= 0){
        alert("please Enter the bidding amount");
    }else{
        $(".milestone_amount").each(function(){
            sumtotal = sumtotal + Number($(this).val());
        });
          
        if(sumtotal >= wholeamount ){
            alert("please reduce milestone amount to add different milestone");
        } else{
            var index = $('#rownum').val();    
            index = parseInt(index) + 1;
              
            $('#addNewRow').find("tbody").append('<tr><td><input type="text" id="title_'+index+'" name="milestone_title[]" class="form-control" placeholder="Title"></td><td><span><i class="fa fa-dollar" style="float: left;margin: 10px"></i><input class="form-control milestone_amount" id="stoneAmt_'+index+'" type="number" name="milestone_agreed_budget[]" style="width:8rem;"></span></td><td><button type="button" class="btn-primary removeRRow"><i class="fa fa-remove"></i></button></td></tr>');
            
            $('#rownum').val(index);            
            CalculateMS();
        }
    }
});

$(document).on('click', '.removeRRow',function(){
    var index = $('#rownum').val();  
      
    if(index == 1){
        alert('You cannot remove');
    } else{
        index = parseInt(index) - 1;
        $(this).closest('tr').remove();
        $('#rownum').val(index);  
    }
    CalculateMS();
});

 

$(".newopen1").click(function(){
    $(".opendiv1").show();
    $(".opendiv2").hide();
    $(".opendiv3").hide();

    $("#terms_amount_max").val("");
    $("#portal_charges").val("");
    $("#3rd_party_charges").val("");
    $("#earn_amount").val("");
});
      
$(".newopen3").click(function(){
    $(".opendiv2").hide();
    $(".opendiv1").hide();
    $(".opendiv3").show();
    $("#no_of_hr").val("");
    $("#amount_per_hr").val("");
    $("#terms_amount_max").val("");
    $("#portal_charges").val("");
    $("#3rd_party_charges").val("");
    $("#earn_amount").val("");
    $(".newopen2").prop('checked', false);
});

$("#amount_per_hr").on('input', function(){
    hourlyamount();
});

$("#no_of_hr").on('input', function(){
    hourlyamount();
});

function hourlyamount(){
    var noofhr = $("#no_of_hr").val();
    var amountperhr = $("#amount_per_hr").val();
    if(noofhr != "" && amountperhr != ""){
        var termsamountmax = (noofhr * amountperhr);
        $("#terms_amount_max").val(termsamountmax);
        $("#terms_amount_max").trigger("change");
    }
}

$(function (){
    $('body').on('focus',".milestone_end_date", function(){
        $(this).datepicker();
    });
});
</script>	
<script src="../assets/js/job_page.js"></script>