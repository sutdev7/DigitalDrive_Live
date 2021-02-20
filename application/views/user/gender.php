<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


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
            <li class="breadcrumb-item"><a href="#">My Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gender</li>
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
          
          ($this->session->userdata('user_type') == 3)? $user_type = 'Client' : $user_type = 'Freelancer';
        //echo "<pre>";print_r($user_info);die
         //echo CI_VERSION;die;
          ?>
        <div class="row">
          <div class="col-lg-3"> </div>
          <div class="col-lg-9">
            <div class="profile_topLink <?php echo  ($this->session->userdata('user_type') == 4) ? 'freelancer' : 'client'; ?>">
              <ol class="progtrckr" data-progtrckr-steps="5">
              <?php 
              foreach($user_login_data as $val){ 
              if(!empty($val->bio)){
              ?>
              <li class="progtrckr-done"> <a href="<?php echo base_url(); ?>user-bio"><img src="<?php  echo base_url('assets/img/BioIcon-1A.png'); ?>" alt=""> <?=$user_type?> Bio</a></li>
            <?php }else{?>
              <li class="progtrckr-todo"> <a href="<?php echo base_url(); ?>user-bio"><img src="<?php  echo base_url('assets/img/BioIcon-1A.png'); ?>" alt=""> <?=$user_type?> Bio</a></li>
            <?php }}if($this->session->userdata('user_type') == 4) {if(!empty($portfolioData)){ ?>
              <li class="progtrckr-done">
                <a href="<?php echo base_url(); ?>portfolio"><img src="<?php  echo base_url('assets/img/GenderIcon-1A.png'); ?>" alt=""> Portfolio</a>
              </li>
              <?php }else{?>
                <li class="progtrckr-todo"><?php if($this->session->userdata('user_type') == 4) { 
                  foreach($user_login_data as $val){ 
                  if(!empty($val->bio)){
                  ?>
                <a href="<?php echo base_url(); ?>portfolio"><img src="<?php  echo base_url('assets/img/GenderIcon-1A.png'); ?>" alt=""> Portfolio</a>
                <?php }else{?>
                   <img src="<?php  echo base_url('assets/img/GenderIcon-1A.png'); ?>" alt=""> Portfolio
                  <?php
                } }}?></li>
              <?php }}?>
                <?php foreach($user_login_data as $val){ 
              if(!empty($val->gender)){
              ?>
               <li class="progtrckr-done"><a href="<?php echo base_url(); ?>gender"><img src="<?php  echo base_url('assets/img/GenderIcon-1A.png'); ?>" alt=""> Gender</a></li>
            <?php }else{   ?>
              <li class="progtrckr-todo"><?php if(!empty($portfolioData)){?><a href="<?php echo base_url(); ?>gender"><img src="<?php  echo base_url('assets/img/GenderIcon-1A.png'); ?>" alt=""> Gender</a>
            <?php }
            else{ ?>
              <img src="<?php  echo base_url('assets/img/GenderIcon-1A.png'); ?>" alt=""> Gender
              <?php }
            }}?>
             </li>
              <?php if(!empty($bankData)){?>
              <li class="progtrckr-done"><a href="<?php echo base_url(); ?>payment"><img src="<?php  echo base_url('assets/img/PaymentIcon-1A.png'); ?>" alt=""> Payment</a></li>
              <?php }else{?>
                <li class="progtrckr-todo"><?php foreach($user_login_data as $val){ 
              if(!empty($val->gender)){?><a href="<?php echo base_url(); ?>payment"><img src="<?php  echo base_url('assets/img/PaymentIcon-1A.png'); ?>" alt=""> Payment</a><?php }else{?>
                <img src="<?php  echo base_url('assets/img/PaymentIcon-1A.png'); ?>" alt=""> Payment
              <?php }}?>
              </li>
              <?php }?>
              
              
            </ol>
            <!--   <ul>
                <li><a href="<?php echo base_url(); ?>user-bio"><img src="<?php  echo base_url('assets/img/BioIcon-1A.png'); ?>" alt=""><?=$user_type?> Bio</a></li>

                <?php if($this->session->userdata('user_type') == 4) {?>
                      <li class=""><a href="<?php echo base_url(); ?>portfolio"><img src="<?php  echo base_url('assets/img/GenderIcon-1A.png'); ?>" alt=""> Portfolio</a></li>
                <?php } ?>

                <li class="active"><a href="<?php echo base_url(); ?>gender"><img src="<?php  echo base_url('assets/img/GenderIcon-1A.png'); ?>" alt=""> Gender</a></li>
                <li><a href="<?php echo base_url(); ?>payment"><img src="<?php  echo base_url('assets/img/PaymentIcon-1A.png'); ?>" alt=""> Payment</a></li>
                <li><a href="<?php echo base_url(); ?>settings"><img src="<?php  echo base_url('assets/img/SettingIcon-1A.png'); ?>" alt=""> Settings</a></li>
                <li><a href="<?php echo base_url(); ?>reviews"><img src="<?php  echo base_url('assets/img/ReviewIcon-1A.png'); ?>" alt=""> Reviews</a></li> 
              </ul> --> 
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="profile">
      <div class="container">
        <div class="row">
          <div class="col-lg-3" style="margin-top: -5rem;">
            <div class="pro_img"> <span class="pro_imgBox"><img src="{user_info}{user_image}{/user_info}" alt="Profile Image" /> <a href="#" class="uplod"></a> </span>
              <h2><?php echo $this->session->userdata('user_name'); ?></h2>
              <p>{user_info} {city} {/user_info}, {user_info} {state} {/user_info}, {user_info} {country} {/user_info}</p>
              <a href="<?php echo base_url(); ?>public-profile" class="pro_imgBtn">View Public Profile</a> <a href="<?php echo base_url(); ?>logout" class="pro_logout" ><img src="<?php  echo base_url('assets/img/logout.png'); ?>" alt=""></a> </div>
          </div>
          <div class="col-lg-9" style="margin-top: -5rem;">
            <div class="pro_info">
              <h4>Gender</h4>
              <form id="frmGender" name="frmGender" action="<?php echo base_url(); ?>gender" method="post">
                <div class="GenderPnl">
                  {user_info}
                    {gender}  
                  <a class="SelectGender" href="javascript:void(0);">
                    <input type="radio" id="{element_id}" name="fldUserGender" value="{key}" {checked} />
                    <label for="{element_id}" class="btn"><img src="{icon}" alt=""><br>{value}</label>
                  </a> 
                    {/gender}
                  {/user_info}                 
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script> 
  $(document).ready(function() { 
    $("input[name=fldUserGender]").click(function() { 
      $('#frmGender').submit();
    }); 
  }); 
</script>