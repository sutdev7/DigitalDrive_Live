<main id="main"> 
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!-- DataTables -->
  <link rel="stylesheet" href="https://www.drivedigitally.com/hwfinal/assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<main id="main"> 

  <!--==========================
      ConterDiv Section
    ============================-->
  <section id="profile_section">
    <div class="profile PublicProfile">
      <div class="container">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>public-profile">My Profile</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>ticket-history">Problem Ticket History</a> </li>
            <li class="breadcrumb-item active" aria-current="page">Compose Email</li>
          </ol>
        </nav>

      <?php 

          $msg = $this->session->flashdata('msg'); 
          if(!empty($msg)) {
        ?>
        <section style="padding-top: 0.5%;">
        <?php echo $msg; ?>
        </section>
        <?php
          }
        ?>
        <?php 

          $frmValidationMsg = validation_errors(); 
          if(!empty($frmValidationMsg)) {
        ?>
          <section style="padding-top:0.57%;">
            <?php echo '<div class="alert alert-danger text-center">' . $frmValidationMsg . '</div>'; ?>
          </section>
        <?php
          }
        ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-info card-outline">
            <div class="card-header">Compose Email</div>
            <div class="card-body">
              <div class="container-fluid">
                <div class="middle overViewPage">
                  <div class="container-fluid">
                      <!-- <h2 class="pageTitle"><strong>Compose</strong></h2> -->
                      <div class="row">
                        <div class="col-md-12">
                          <!-- <h4>Compose</h4> -->
                          <form class="form-horizontal" action="<?= base_url()?>ticket_send_email" method="POST" id="grievance_email_form">
                           <input type="hidden" name="grievance_id" id="grievance_id" value="<?= $grievance_id ?>" />
                            <div class="form-group">
                              <label for="email" class="col-sm-2 control-label">To:</label>
                              <div class="col-sm-10">
                                <input type="email" name="email_to" required="" class="form-control" id="email" placeholder="Email" value="<?= $this->config->item('admin_email') ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="carbonCopy" class="col-sm-2 control-label">CC:</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" id="carbonCopy" placeholder="Carbon copy addresses..." name="cc">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="blindCarbonCopy" class="col-sm-2 control-label">BCC:</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" id="blindCarbonCopy" placeholder="Blind carbon copy addresses..." name="bcc">
                              </div>
                            </div>
                            <!--<div class="form-group">
                              <label for="sentFrom" class="col-sm-2 control-label">Send from:</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" name="email_from" id="sentFrom" placeholder="Send from addresses..." required="">
                              </div>
                            </div>-->
                            <div class="form-group">
                              <label for="emailSubject" class="col-sm-2 control-label">Subject:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="emailSubject" placeholder="Subject of email..." name="email_subject" required="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="emailBody" class="col-sm-2 control-label">Email body:</label>
                              <div class="col-sm-10">
                                <textarea id="emailBody" name="email_body" class="form-control" rows="20" placeholder="Message..."></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" id="grievance_email_submit" class="btn btn-default">Send</button>
                              </div>
                            </div>
                          </form>
                        </div>

                      </div> <!--end .row -->

                    </div><!--end .container-fluid-->
                  </div><!--end .overViewPage-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div>
    </div>
  </section>
</main>
<script src="https://www.drivedigitally.com/hwfinal/assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="https://www.drivedigitally.com/hwfinal/assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script type="text/javascript">
  $(function () {
    $("#example1").DataTable();
  })
</script>