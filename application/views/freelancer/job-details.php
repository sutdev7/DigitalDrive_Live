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
                        <a href="javascript:void(0)" id="txtShow" >{savetext}</a>
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
                          <ul>
                            <li>
                              <label class="containerdiv newopen1">Amount / Hr
                                <input type="radio" name="terms" value="pay_hourly_amount" checked="checked">
                                <span class="checkmark"></span> </label>
                            </li>

                            <li>
                              <label class="containerdiv newopen2">Amount by Milestone
                                <input type="radio" name="terms" value="pay_by_milestone">
                                <span class="checkmark"></span> </label>
                            </li>

                            <li>
                              <label class="containerdiv newopen3">Fixed Payment
                                <input type="radio" name="terms" value="pay_whole_amount">
                                <span class="checkmark"></span> </label>
                            </li>
                          </ul>
                        </div>

                        </div>
                        </div>

                      <div class="bidding-amt col-md-4 col-lg-4 col-xl-4">
                          
                            <div class="portal-text">
                                <h5>Bidding Amount</h5>
                                <input type="text" name="terms_amount_max" placeholder="$ 0" id="terms_amount_max" required>
                                <div class="opendiv1">
                                  <span>Amount / hr</span>
                                </div>

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

                        </div>

                        <div class="proposal text-center col-md-4 col-lg-4 col-xl-4">
                            <p>Required Key to submit this proposal 1</p>
                            <h4>Available Key {connection}</h4>
                        </div>

                      <div class="col-md-12 col-lg-12 col-xl-12">

                          <div class="opendiv2" style="display:none;">
                                  <ul>
                                    <li class="row after-add-more">
                                    <div class="col-lg-4 col-md-12 col-xs-12">
                                      <label>Title</label>
                                      <input type="text" name="milestone_title[]" class="form-control" placeholder="Title">
                                    </div>
                                    <!-- <div class="col-lg-4 col-md-12 col-xs-12">
                                      <label>Hire Date</label>
                                      <div id="datepicker" class="input-group date milestone_end_date" data-date-format="mm-dd-yyyy">
                                      <input class="form-control" type="text" name="milestone_end_date[]" value="" />
                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span> </div>
                                    </div> -->
                                    <div class="col-lg-4 col-md-12 col-xs-12">
                                      <label>Amount</label>
                                      <div class="input-group amt"> <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                      <input class="form-control milestone_amount" id="" type="text" name="milestone_agreed_budget[]" value="" placeholder="00">
                                      </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-xs-12">
                                      <div> 
                                        <a href="#" class="cancelBtn"><i class="fa fa-times" aria-hidden="true"></i></a>
                                      </div>
                                    </div>
                                    </li>
                                  
                                                    
                                          
                                    <li class="row" style="padding:40px 0; border:none;"> 
                                      <a href="#" class="plus_btn" id="addMore"><i class="fa fa-plus"></i> Add Another</a> <span class="optionalSpan"></span> 
                                    </li>
                                  </ul>
                          </div>
                      </div>
                      <!-- end by amar -->
                        <div class="col-md-8 col-lg-8 col-xl-8">
                            <div class="cover-letter">
                                <h4>Cover letter</h4>
                                <div id="the-count">
                                    <span id="current">0</span>
                                    <span id="maximum">/ 700</span>
                                </div>
                            </div>
                            <textarea name="cover_letter" id="the-textarea" required maxlength="700" placeholder="Type here" autofocus></textarea>
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
            <input type="hidden" name="task_id" value="<?= $task_id ?>">
            <input type="hidden" name="user_task_id" value="<?= $user_task_id ?>">
            <div class="modal-content">
                <div class="header">
                    <h2>View Proposal</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="body">
                      <div class="row cover">

                      <div class="to-close">
                                      <h2>Proposal Details</h2>
                                      <p><i class="fa fa-dollar theme-color"></i> Bidding Amount: $<?php echo isset($proposal_info[0]["terms_amount_max"]) ? $proposal_info[0]["terms_amount_max"] : "";  ?></p>
                                      <p><i class="fa fa-calendar theme-color"></i> Posting Date: <?php echo isset($proposal_info[0]["doc"]) ? $proposal_info[0]["doc"] : "";  ?></p>
                                      <p><i class="fa fa-credit-card theme-color"></i> Payment Type: <?php echo isset($proposal_info[0]["milestone_type"]) ? ucwords($proposal_info[0]["milestone_type"]) : "";  ?></p>
                                      
                                      <hr/>
                                      <h2 class="Atta">Download Attachment</h2>
                                      
                                      <a href="<?php echo base_url(); ?>download_attachment_proposal/<?php echo isset($proposal_info[0]["attachments"]) ? $proposal_info[0]["attachments"] : "";  ?>"><img style="padding: 10px; width: 84px; height: 84px;" src="{file_ext_type}" alt=""></a>
                                      <br/>
                                      <a href="<?php echo base_url(); ?>download_attachment_proposal/<?php echo isset($proposal_info[0]["attachments"]) ? $proposal_info[0]["attachments"] : "";  ?>" class="" download><i class="fa fa-download"></i> Download</a>
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
                                  
                                  <td><?php echo $row["milestone_agreed_budget"]; ?></td>
                                  <!-- <td><?php //echo $row["provided_email"]; ?></td> -->
                                  <!-- <td> -->
                                  <!-- <a data-toggle="tooltip" data-placement="top" title="withdraw">
                                  <i class="fa fa-money" style="font-size:24px;"></i></a>  -->
                                      <!-- <a data-toggle="tooltip" data-placement="top" title="Details" href="<?php //echo base_url() ;?>hired-job-details/<?php echo $row['user_task_id'] ;?>"> -->
                                        <!-- <i class="fa fa-eye" style="font-size:24px;" aria-hidden="true"></i> -->
                                        <!-- </a> -->
                                <!-- </td> -->
                                  
                                </tr>
                                <!-- <tr>
                                  <td><img src="img/cal-img.png" alt=""> 10/12/2019 </td>
                                  <td>UI Design</td>
                                  
                                  <td>$50</td>
                                </tr> -->
                                  <?php } }else{ ?>
                                  <tr><td  colspan="5"><p>Records not found...</p></td></tr>
                                <?php } ?>
                                    <!-- Render pagination links -->
                                  <tr>
                                  <td  colspan="5">
                                    <?php // echo ($this->ajax_pagination->create_links() !== "") ? $this->ajax_pagination->create_links():""; ?>
                                    
                                  </td>
                                  </tr>
                                
                              </tbody>
                            </table>
                            
                          </div>
                          
                        </div>

                      </div>
                </div>

                <div class="line">

                </div>

                <footer class="footer">
                    <div class="cta">
                        <!-- <button class="btn submit" type="submit">Submit</button> -->
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

<!-- view proposal Modal end -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script> 
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        $("#terms_amount_max").on('input', function(e) {
            console.log("In");
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

        // $("#addMore").on("click",function(e){ 
        //   alert('hii');
        // e.preventDefault();
        //     var html = $(".after-add-more").first().clone();
        // var total_element = $(".after-add-more").length;
        // var total_element = total_element +1;
        //     $(".after-add-more").last().after(html);
        // $("#noofmilestone").html(total_element);
        // });

        // $("body").on("click",".cancelBtn",function(e){ 
        // e.preventDefault();
        // var total_element = $(".after-add-more").length;
        // if(total_element >= 2){
        //   $(this).parents(".after-add-more").remove();
        // }
            
        // });
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
        
        $("#addMore").on("click",function(e){ 
          // alert('hii');
        e.preventDefault();
            var html = $(".after-add-more").first().clone();
        var total_element = $(".after-add-more").length;
        var total_element = total_element +1;
        

        var firstval = $(".milestone_amount").first().val();
        var lastval = $(".milestone_amount").last().val();

        // alert("firstval" + firstval);
        // alert("lastval" + lastval);


        wholeamount = $("#terms_amount_max").val();
        if(wholeamount <= 0){
          alert("please select the bidding amount");
        }else{

        var sumtotal = 0;

        // alert(wholeamount);
        $(".milestone_amount").each(function(){
          sumtotal = sumtotal + Number($(this).val());
          // alert("currentval" + $(this).val());;
        });
        // alert("sumtotal" + sumtotal);
        if( sumtotal >= wholeamount ){
          alert("please reduce milestone amount to add different milestone")
        }else{
         $(".milestone_amount").first().val(wholeamount- sumtotal );

          $(".after-add-more").last().after(html);
          $("#noofmilestone").html(total_element);
      }
    }
            
        });

        $(".cancelBtn").on("click",function(e){ 
        e.preventDefault();
        var total_element = $(".after-add-more").length;
        alert(total_element);

        if(total_element >= 2){
          $(this).parents(".after-add-more").remove();
        }
            
        });

        $(".opendiv1").show();
        $(".opendiv2").hide();
        $(".newopen1").click(function(){
          $(".opendiv1").show();
          $(".opendiv2").hide();
        });
        
        $(".newopen2").click(function(){
          $(".opendiv2").show();
          $(".opendiv1").hide();
        });

        
        $(".newopen3").click(function(){
          $(".opendiv2").hide();
          $(".opendiv1").hide();
          $(".opendiv3").show();

        });


        $(function (){
          $('body').on('focus',".milestone_end_date", function(){
            $(this).datepicker();
          });
        });
</script>	
<script src="../assets/js/job_page.js"></script>