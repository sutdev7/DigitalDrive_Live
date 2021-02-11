<?php 
$query_solved=$this->db->query("SELECT * FROM user_grievance WHERE problem_status='solved'");
$solved=$query_solved->result();
/***** Unactive Freelancers ************/
$query_unactive_freelancers=$this->db->query("SELECT * FROM user_login WHERE profile_status='0' AND user_type='4'");
$unactiveFreelancer=$query_unactive_freelancers->result();
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/jquery.notify.css">
<style type="text/css">
  .card [class*="card-header-"] .card-icon, .card [class*="card-header-"] .card-text {
    border-radius: 3px;
    background-color: #999999;
    padding: 15px;
    margin-top: -20px;
    margin-right: 15px;
    float: left;
}
.card .card-header-warning .card-icon, .card .card-header-warning:not(.card-header-icon):not(.card-header-text), .card .card-header-warning .card-text {
    box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4);
}




.card .card-header-warning .card-icon, .card .card-header-warning .card-text, .card .card-header-warning:not(.card-header-icon):not(.card-header-text), .card.bg-warning, .card.card-rotate.bg-warning .front, .card.card-rotate.bg-warning .back {
    background: linear-gradient(60deg, #ffa726, #fb8c00);
    background-image: linear-gradient(60deg, rgb(255, 167, 38), rgb(251, 140, 0));
    background-position-x: initial;
    background-position-y: initial;
    background-size: initial;
    background-repeat-x: initial;
    background-repeat-y: initial;
    background-attachment: initial;
    background-origin: initial;
    background-clip: initial;
    background-color: initial;
}

.card-stats .card-header.card-header-icon, .card-stats .card-header.card-header-text {
    text-align: right;
}

.card [class*="card-header-"], .card[class*="bg-"] {
    color: #fff;
}
.card-stats .card-header.card-header-icon .card-title, .card-stats .card-header.card-header-text .card-title, .card-stats .card-header.card-header-icon .card-category, .card-stats .card-header.card-header-text .card-category {
    margin-left: 66%;
    height: 45px;
    font-size: 24px;
}

.card .card-body+.card-footer .stats, .card .card-footer .stats {
    color: #999999;
    font-size: 12px;
    line-height: 22px;
}

.card .card-footer .stats {
    color: #999999;
}
.card .card-footer .author, .card .card-footer .stats {
    display: inline-flex;
}
  .notify-item-wrapper{
    width:200px;
  }




.text-muted {
    color: #8898aa !important;
}
.text-uppercase {
    text-transform: uppercase !important;
}
.mb-0, .my-0 {
    margin-bottom: 0 !important;
}
.card-title {
    margin-bottom: 1.25rem;
    float:none;
}
h5, .h5 {
    font-size: .8125rem;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: inherit;
    font-weight: 600;
    line-height: 1.5;
    margin-bottom: .5rem;
    color: #32325d;
}
h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: .5rem;
}
*, *::before, *::after {
    box-sizing: border-box;
}

.text-white {
    color: #fff !important;
}
[class*='shadow'] {
    transition: all .15s ease;
}
.bg-gradient-red {
    background: linear-gradient(
87deg
, #f5365c 0, #f56036 100%) !important;
}
.icon-shape {
    display: inline-flex;
    padding: 12px;
    text-align: center;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
}
.icon {
    width: 3rem;
    height: 3rem;
}
.text-white {
    color: #fff !important;
}
.text-white {
    color: #fff !important;
}
.shadow {
    box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15) !important;
}
.rounded-circle, .avatar.rounded-circle img {
    border-radius: 50% !important;
}
*, *::before, *::after {
    box-sizing: border-box;
}
user agent stylesheet
div {
    display: block;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    border: 1px solid rgba(0, 0, 0, .05);
    border-radius: .375rem;
    background-color: #fff;
    background-clip: border-box;
}
:root {
   
    --gray-dark: #32325d;
    --light: #ced4da;
    --lighter: #e9ecef;
    --primary: #5e72e4;
    --secondary: #f7fafc;
    --success: #2dce89;
    --info: #11cdef;
    --warning: #fb6340;
    --danger: #f5365c;
    --light: #adb5bd;
    --dark: #212529;
    --default: #172b4d;
    --white: #fff;
    --neutral: #fff;
    --darker: black;
    --breakpoint-xs: 0;
    --breakpoint-sm: 576px;
    --breakpoint-md: 768px;
    --breakpoint-lg: 992px;
    --breakpoint-xl: 1200px;
    --font-family-sans-serif: Open Sans, sans-serif;
    /* --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace; */
}
html {
    font-family: sans-serif;
    line-height: 1.15;
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
*, *::before, *::after {
    box-sizing: border-box;
}
*, *::before, *::after {
    box-sizing: border-box;
}

.col {
    max-width: 100%;
    flex-basis: 0;
    flex-grow: 1;
}

.card {
    margin-bottom: 30px;
    border: 0;
    box-shadow: 0 0 2rem 0 rgb(136 152 170 / 15%);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    border: 1px solid rgba(0, 0, 0, .05);
    border-radius: .375rem;
    background-color: #fff;
    background-clip: border-box;
}
*, *::before, *::after {
    box-sizing: border-box;
}
user agent stylesheet
div {
    display: block;
}

:root {
 
    --gray-dark: #32325d;
    --light: #ced4da;
    --lighter: #e9ecef;
    --primary: #5e72e4;
    --secondary: #f7fafc;
    --success: #2dce89;
    --info: #11cdef;
    --warning: #fb6340;
    --danger: #f5365c;
    --light: #adb5bd;
    --dark: #212529;
    --default: #172b4d;
    --white: #fff;
    --neutral: #fff;
    --darker: black;
    --breakpoint-xs: 0;
    --breakpoint-sm: 576px;
    --breakpoint-md: 768px;
    --breakpoint-lg: 992px;
    --breakpoint-xl: 1200px;
    --font-family-sans-serif: Open Sans, sans-serif;
    /* --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace; */
}
html {
    font-family: sans-serif;
    line-height: 1.15;
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
*, *::before, *::after {
    box-sizing: border-box;
}
*, *::before, *::after {
    box-sizing: border-box;
}


.col-xl-10, .col-xl-11, .col-xl-12, .col-xl, .col-xl-auto {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}
*, *::before, *::after {
    box-sizing: border-box;
}
.text-sm{
background: orange;;
    width: 251px;
    margin-left: -18px;
    height: 34px;
 
    margin-bottom: -19px;
    border-radius: 5px;
    color:white;
}
.text-sm a{
  color:white;
}
.fa-arrow-up{
  margin: 7px 2px 11px 13px;
}

.bg-gradient-orange {
    background: linear-gradient(
87deg
, #fb6340 0, #fbb140 100%) !important;
}
.bg-gradient-warning{
   background: linear-gradient( 
87deg
 , #fb6340 0, #1e5040 100%)!important;
}
</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/nucleo.css" type="text/css">

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">

                      <h5 class="card-title text-uppercase text-muted mb-0"style="height: 35px;">Clients</h5>
                     <h3 class="h2 font-weight-bold mb-0"><?php echo isset($client_count) ? $client_count : "0"; ?>
                    
                  </h3>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                       <i class="fas fa-user-tie text-center" style="color: white;font-size: 20px;border-radius: 3px;"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3  text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> </span>
                    <span class="text-nowrap"><a href="<?php echo base_url().'admin/client-list' ?>" class="small-box-footer">More info</a></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0" style="height: 35px;">Freelancers</h5>
                       <h3 class="h2 font-weight-bold mb-0" ><?php echo isset($freelancer_count) ? $freelancer_count : "0"; ?></h3>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ion ion-stats-bars" ></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3  text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> </span>
                    <span class="text-nowrap"><a href="<?php echo base_url().'admin/freelancer-list' ?>" class="small-box-footer">More info <!-- <i class="fas fa-arrow-circle-right"></i> --></a></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0" style="height: 35px;">Naluacers</h5>
                      
                      <h3 class="h2 font-weight-bold mb-0" ><?php echo isset($naluacer_count) ? $naluacer_count : "0"; ?></h3>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ion ion-stats-bars" ></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3  text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap"><a href="<?php echo base_url().'admin/freelancer-list' ?>"  class="small-box-footer">More info</a></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0" style="height: 35px;">Problem Unsolved Tickets</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo isset($problem_ticket_count) ? $problem_ticket_count : "0"; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ion ion-pie-graph" ></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3  text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap"><a href="<?php echo base_url().'admin/problem-ticket/unsolved' ?>" class="small-box-footer" >More info</a></span>
                  </p>
                </div>
              </div>
            </div>

             <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0" style="height: 35px;">Inactive Freelancers</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo count($unactiveFreelancer); ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3  text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap"><a href="<?php echo base_url().'admin/problem-ticket/unsolved' ?>" class="small-box-footer" >More info</a></span>
                  </p>
                </div>
              </div>
            </div>
        <!-- <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="fas fa-user-tie"></i>
                  </div>
                  <p class="card-category" style="color: #fd9b15;">Clients</p>
                  <h3 class="card-title" style="color: #fd9b15;margin-left: 223px;"><?php echo isset($client_count) ? $client_count : "0"; ?>
                    <small style="color: #fd9b15;">Now</small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="fas fa-user-tie text-center" style="background: #fd9b15;color: white;font-size: 20px;border-radius: 3px;width: 23px;height: 23px;"></i>
                    <a href="<?php echo base_url().'admin/client-list' ?>" style="background: silver;color: white;margin-left: 8px;" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon" style=" background: red;">
                    <i class="ion ion-stats-bars" ></i>
                  </div>
                  <p class="card-category" style=" color: red;margin-left: 91px;">Freelancers</p>
                  <h3 class="card-title" style=" color: red;margin-left: 177px;"><?php echo isset($freelancer_count) ? $freelancer_count : "0"; ?>
                    <small style="color: red;">Now</small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="ion ion-stats-bars text-center" style="background: red;color: white;font-size: 20px;border-radius: 3px;width: 23px;height: 23px;"></i><a href="<?php echo base_url().'admin/freelancer-list' ?>" style="background: silver;color: white;margin-left: 8px;" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon" style=" background: green;">
                    <i class="ion ion-stats-bars" ></i>
                  </div>
                  <p class="card-category" style=" color: green;margin-left: 0px;">Naluacers</p>
                  <h3 class="card-title" style=" color: green;margin-left: 65%;"><?php echo isset($naluacer_count) ? $naluacer_count : "0"; ?><small style="color:green">Now</small></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="ion ion-stats-bars text-center" style="background: green;color: white;font-size: 20px;border-radius: 3px;width: 23px;height: 23px;" ></i> <a href="<?php echo base_url().'admin/freelancer-list' ?>" style="background: silver;color: white;margin-left: 8px;" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
       
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon" style=" background: blue;">
                    <i class="ion ion-pie-graph" ></i>
                  </div>
                  <p class="card-category" style=" color: blue;margin-left: 0px;">Problem Unsolved Tickets</p>
                  <h3 class="card-title" style=" color: blue;margin-left: 106px;"><?php echo isset($problem_ticket_count) ? $problem_ticket_count : "0"; ?>
                    <small>Now</small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="fas fa-user-tie text-center" style="background: blue;color: white;font-size: 20px;border-radius: 3px;width: 23px;height: 23px;"></i>
                    <a href="<?php echo base_url().'admin/problem-ticket/unsolved' ?>" class="small-box-footer" style="background: silver;color: white;margin-left: 8px;">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon" style="background-color: #400006">
                   <i class="fas fa-users"></i>
                  </div>
                  <p class="card-category" style=" color: #400006;margin-left: 0px;">Inactive Freelancers</p>
                  <h3 class="card-title" style=" color: #400006;margin-left: 102px;"><?php echo count($unactiveFreelancer); ?>
                     <small>Now</small>
                    
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="fas fa-users text-center" style="background: #400006;color: white;font-size: 20px;border-radius: 3px;width: 23px;height: 23px;"></i><a href="<?php echo base_url().'admin/problem-ticket/unsolved' ?>" class="small-box-footer" style="background: silver;color: white;margin-left: 8px;">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div> -->
          <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo isset($client_count) ? $client_count : "0"; ?></h3>

                <p>Clients</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <a href="<?php echo base_url().'admin/client-list' ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6">
            <!-- small box -->
            <!-- <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo isset($freelancer_count) ? $freelancer_count : "0"; ?></h3>
                <p>Freelancers</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url().'admin/freelancer-list' ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          
          <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
           <!--  <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo isset($naluacer_count) ? $naluacer_count : "0"; ?></h3>
                <p>Naluacers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url().'admin/naluacer-list' ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> --> 
          <!-- ./col -->
         <!--  <div class="col-lg-3 col-6">
            small box -->
            <!-- <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo count($solved); ?></h3>
                <p>Problem Solved Tickets</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo base_url().'admin/problem-ticket/solved' ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
      
       <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
           <!--  <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo isset($problem_ticket_count) ? $problem_ticket_count : "0"; ?></h3>
                <p>Problem Unsolved Tickets</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo base_url().'admin/problem-ticket/unsolved' ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
      
      <div class="col-lg-3 col-6"> -->
            <!-- small box -->
           <!--  <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo count($unactiveFreelancer); ?></h3>
                <p>Inactive Freelancers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url().'admin/freelancer-list/inactive' ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
        </div>
        <div class="row"></div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

   <div class="notify" data-notify-type="notice">
     <a href="<?php echo base_url()?>admin/freelancer-list" style="color: white;">Freelancer (<b><?php echo count_inactive_freelance(); ?></b>)</a>
   </div>
<div class="notify" data-notify-type="notice">
  <a href="<?php echo base_url()?>admin/client-list" style="color: white;">Client (<b><?php echo count_inactive_client(); ?></b>)</a>
</div>
<div class="notify" data-notify-type="notice">
  <a href="<?= base_url()?>admin/naluacer-lists/client" style="color: white;" >Room (<b><?php echo count_inactive_room(); ?></b>)</a>
</div>
<div class="notify" data-notify-type="notice">
  <a href="<?= base_url() ?>" style="color: white;">Ticket (<b><?php echo count_unsolved_ticket(); ?></b>)</a>
</div>
    
  <script src="<?php echo base_url()?>assets/jquery.notify.js"></script>
    <script type="text/javascript"><!--
      google_ad_client = "ca-pub-2783044520727903";
      /* jQuery_demo */
      google_ad_slot = "2780937993";
      google_ad_width = 728;
      google_ad_height = 90;
//-->
</script>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    setInterval(function(){
  load_last_notification();
 }, 1000);

 function load_last_notification()
 {
    var data_Freelancer = '<a href="<?php echo base_url()?>admin/freelancer-list" style="color: white;">Freelancer (<b><?php echo count_inactive_freelance(); ?></b>)</a>';
    var data_Client = '<a href="<?php echo base_url()?>admin/client-list" style="color: white;">Client (<b><?php echo count_inactive_client(); ?></b>)</a>';
    var data_Room = '<a href="<?= base_url()?>admin/naluacer-lists/client" style="color: white;" >Room (<b><?php echo count_inactive_room(); ?></b>)</a>';
    var data_Ticket = '<a href="<?= base_url() ?>" style="color: white;">Ticket (<b><?php echo count_unsolved_ticket(); ?></b>)</a>';
    $('#notification_content_Freelancer').html(data_Freelancer);
    $('#notification_content_Client').html(data_Client);
    $('#notification_content_Room').html(data_Room);
    $('#notification_content_Ticket').html(data_Ticket);

 }



$(document).ready(function(){
  $("button").click(function(){
    $("#alert_popover").css({"display": "none"});
  });
});

  </script>

  <script>
$.notifySetup({sound: '<?php base_url()?>assets/audio/notify.wav'});
$('.notify').notify();
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

$(function() {
    function loadCount() {
        count.load(
            "<?php echo $vars['url']; ?>mod/notifications/ajax/livenum.php"
        );
    }

    // Load on page load (call the function loadCount):
    loadCount()

    // Set the refresh interval and call the function loadCount every 60 seconds):
    var refreshId = setInterval(loadCount, 60000);
    $.ajaxSetup({ cache: false });
});
</script>