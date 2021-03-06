<link rel="stylesheet" href="../assets/css/responsive.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
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
                {task_info}{task_country}{/task_info}, {task_info}{task_continent}{/task_info}</p>
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
  $popup_msg = $this->session->flashdata('popup_msg');
  if (!empty($msg) && empty($popup_msg)) {
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
    <?php /*
      <div class="container">
        <div class="job-name-content">

          <h2>{task_info}{task_title}{/task_info}</h2>


          <div class="line-2">
            <span><i class="fas fa-map-marker-alt"></i> {task_info}{task_country}{/task_info}, {task_info}{task_continent}{/task_info}</span>
          </div>

          <div class="line-3">
            <span><i class="fas fa-calendar-alt"></i> Post Date: {task_info}{task_doc}{/task_info}</span>
          </div>


        </div>
      </div>
      */ ?>
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

              <div class="more-detail col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="more-detail-content">
                  <div>
                    <img src="../assets/img/bag.png" alt="" />
                  </div>
                  <div>
                    <h6>Hours to be determined</h6>
                    <h6>{task_info}{task_duration_type}{/task_info}</h6>
                  </div>
                </div>
              </div>

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

            <!--div class="what-will-do">
                <h3>Keywords</h3>
                <h5><i class="fas fa-long-arrow-alt-right"></i> {task_info}{task_keywords}{/task_info}</h5>
              </div-->

            <div class="required-skills">
              <h3>Skills</h3>

              <span class="w-100">{task_info}{task_requirements}<h5 class="bg-theme">{skill_name}</h5> {/task_requirements}{/task_info}</span>
            </div>
            <br>
            <div class="what-will-do">
              <h3>Activity On this Job</h3>
              <h5><i class="fas fa-long-arrow-alt-right"></i> Proposal <b>{proposal_count}</b> </h5>
              <h5><i class="fas fa-long-arrow-alt-right"></i> Offer Send <b>{offer_send}</b> </h5>
            </div>
          </div>
        </div>

        <div class="right-col col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
              <?php 
              //echo base64_decode($notification_row_id);
              if(base64_decode($notification_row_id) != 0) { ?>
                <div class="apply-job">
                <div class="btn">

                <?php if ($task_is_completed_by_owner == 1 || $task_is_completed == 1) { ?>

                  <a href="Javascript:void(0)">PROJECT IS COMPLETED</a>

                <?php } else if (!empty($hire_id)) { ?>
                  <a href="<?= base_url() . 'take-action' ?>/{notification_row_id}/<?php echo base64_encode('17'); ?>">COMPLETE</a>
                  
                  <?php
                } else {
                  
                    if (base64_decode($notification_master_id) == 11) { ?>

                      <a href="<?= base_url() . 'take-action' ?>/{notification_row_id}/<?php echo base64_encode('14'); ?>">ACCEPT THE JOB</a>

               <?php } else if (base64_decode($notification_master_id) == 9) {

                      if($offer_accepted == "yes") { ?>

                        <a href="javascript:void(0)">OFFER ALREADY ACCEPTED</a>
                      
                      <?php } else { ?>
                        <a href="<?= base_url() . 'take-action' ?>/{notification_row_id}/<?php echo base64_encode('12'); ?>">ACCEPT OFFER </a>
                      <?php }

                    }
                  

                } ?>
                </div>
                </div>
              <?php 
              } 

              ?>
            
            <!-- <h5>Application end in 4d 5h 3m</h5> -->
            <!--h6>OR APPLY WITH</h6>
              <ul>
	                <li>
	                    <h3><a href="javascript:void(0)" class="{inappropriateclass}" id="txtflag" ><i class="fa fa-flag mr-2"></i>{inappropriatetext}</a></h3>
	                    <p class="mb-1">Required connects to submit this proposal <b>1</b></p>
	                    <p class="mb-1">Available Connects <b>{connection}</b>
	                </li>
	            </ul-->
          

          
            <?php 
            if (base64_decode($notification_row_id) != 0) { ?>
              <div class="btn send-msg-btn">
                <?php 
                 if ($task_is_completed_by_owner == 1) { 

                  } else if (!empty($hire_id)) { ?>
                      <a href="<?= base_url() . 'problem-ticket/{task_info}{task_id}{/task_info}' ?>">Cancel</a>
                  
                <?php
                  } else {

                  if (base64_decode($notification_master_id) == 11) { ?>
                    <a href="<?= base_url() . 'take-action' ?>/{notification_row_id}/<?php echo base64_encode('15'); ?>">Reject</a>
                <?php
                  } else if (base64_decode($notification_master_id) == 9) { ?>
                      <a href="<?= base_url() . 'take-action' ?>/{notification_row_id}/<?php echo base64_encode('13'); ?>">REJECT</a>
              
              <?php }
                  

            } ?>

              </div>
            <?php } ?>

          

          <div class="about-client-box">
            <h3>About the Client - {creator_data}{client_name} {/creator_data}</h3>
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

              <?php /*<div class="text-line">
                  <div><i class="fas fa-address-card"></i>
                  </div>
                  <h4>Payment method verified</h4>
                </div>

                <div class="text-line">
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
                  <div><i class="fas fa-phone-alt"></i>
                  </div>
                  <h4>Phone number verified</h4>
                </div> */ ?>

            </div>
            <br>

            <h3>Payment Details</h3>
            <br>
            <div class="">
              <ul>
                <li>
                  <table class="table table-striped">
                    <tr>
                      <th>Title</th>
                      <th>Budget</th>
                      <th>Payment Status</th>
                    </tr>
                    {milestoneInfo}
                    <tr>
                      <td>{milestone_title}</td>
                      <td>{milestone_agreed_budget}</td>
                      <td>
                        <?php 
                            $sss = "{payment_status}";
                            if($sss!==""){
                              echo $sss;
                            } else{
                              echo "Pending11";
                            }
                            
                        ?>
                      </td>
                    </tr>
                    {/milestoneInfo}
                  </table>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
if (!empty($popup_msg)) {
?>
  <!-- Modal -->
  <div id="success-msg" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-left">
          <h4 class="modal-title">Task Completed Successfully</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>          
        </div>
        <div class="modal-body">
            <div class="alert alert-success">
              <?php echo $popup_msg; ?>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>
<script>
  $(document).ready(function() {
    <?php
if (!empty($popup_msg)) {
  ?>
  $('#success-msg').modal('show');
  <?php
}
?>

    $('.saveBtn').on('click', function() {
      $.ajax({
        type: "POST",
        url: "<?= base_url() . '/save-job' ?>",
        data: {
          taskId: '<?= $this->uri->segment(2) ?>'
        },
        dataType: "text",
        success: function(resultData) {
          $('.HireBtn').removeClass('saveBtn');
          $('#txtShow').html('Saved Job').css("color", '#ccc');

        }
      });
    });
  });

  function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).attr('href')).select();
    document.execCommand("copy");
    alert('Linked Copied');
    $temp.remove();
  }
</script>
<script src="../assets/js/main.js"></script>