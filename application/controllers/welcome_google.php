<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/css/intlTelInput.css"/>
<style>
.skill span.selection {
    width: 100%;
}
.skill span.select2-search.select2-search--inline {
    float: none;
}
.skill span.select2-selection.select2-selection--multiple:last-child {
    margin-left: 0px;
    float: left;
    width: 100%;
    border-radius: 4px;
    height: 50px;
    color: #293134;
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 25px;
    border: 1px solid #ccc;
}
.skill .select2-container--default .select2-selection--multiple .select2-selection__choice {
    display: inline-flex;
}
.skill span .select2-selection_choice_display {
    width: auto;
}
.skill span .select2-selection__choice__display {
    width: auto;
}


</style>
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
  <section id="signInDiv">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="singUpDiv">

          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?=$Welcome;?>
  
  <!--==========================
      ConterDiv Section
    ============================-->
  <section id="signInDiv">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="singUpDiv">

          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- <script src="http://localshost/hirenwork/assets/js/flag.js"></script>  -->
