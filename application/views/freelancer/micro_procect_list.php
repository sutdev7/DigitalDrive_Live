<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

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

  <?php 
  $frmValidationMsg = validation_errors(); 
  if(!empty($frmValidationMsg)) {
  ?>
  <section style="padding-top: 7%;">
    <?php echo '<div class="alert alert-danger text-center">' . $frmValidationMsg . '</div>'; ?>
  </section>
  <?php
  }
  ?>
<style type="text/css">
  .select2{
    width: 100% !important;
    margin-bottom: -90px !important;
  }
  .select2-selection{
    margin-bottom: 0px !important;
    border: 1px solid #d3dde6 !important;
  }
  .select2-dropdown--below{
    margin-top: -109px !important;
  }
  .select2-selection__choice{
    width: auto !important;
    border-radius: 20px !important;
    background-color: #eff2f4 !important;
    border:0px !important;
  }
  .select2-selection__choice__remove{
    border:0px !important;
  }
  .select2-selection__choice__remove span{
   margin-bottom: 0px !important;
  }
  .select2-selection__choice__display
  {
    margin-bottom: 0px !important;
    float: none !important;
    font-size: 14px;
    color: #7c8994;
  }

  body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <!--==========================
      ConterDiv Section
    ============================-->
 

  <section id="postDiv">
   
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="postDiv_Box">
            <div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
         
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="http://localhost/drive_Live_new/uploads/user/profile_image/1610805616_thump.png" alt="Admin" class="rounded-circle" width="150" style="border-radius: none!important;
}

;">
                    <div class="mt-3">
                      <h4>John Doe</h4>
                      <h6 class="pull-left">About:</h6><br>
                      <div>
                      <p class="text-secondary mb-1">Full Stack Developer</p>
                      <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"><img class="card-img-top img-circle" src="http://localhost/drive_Live_new/uploads/user/profile_image/1598451752_PMPQMWGW76.jpg" style="width:50px;height:50px;border-radius: 73px;
"></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      Web Devloper
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">About </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      Helllo Jha 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Duration</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      3 Month
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Coin</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <span class="coin-tag"> 0 Coins</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Link Micro</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <a href="#" style="text-decoration: none;color: silver" title="" class="view-more-pro"><b>Details Webdevloper</b></a>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
        </div>
    </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- script for auto complete multiselect --> 
<script src="<?php  echo base_url('assets/js/fastselect.standalone.js'); ?>"></script> 
<script>
  $('.multipleSelect').fastselect();
</script> 


 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

    <script>
      $('.subctgeory').click(function(){
        var cat_val=$('.category_data').val();
        $.ajax({
          //url: "<?php echo base_url()?>admin/subctgeory_data/"+cat_val,
          url: "<?php echo base_url()?>admin/cat_id_data/"+cat_val,
          type: "POST",
          data: {
          cat_val: cat_val
          },
          cache: false,
          success: function(result){
            $.ajax({
              url: "<?php echo base_url()?>admin/subctgeory_data/"+result,
              success: function(result){
               
                $(".subctgeory").html(result);
              }
            })
          //
          

          }
          });

      });
            jQuery(document).ready(function(){
                // Basic
               jQuery('.dropify').dropify({
					messages: {
						'default': 'Drag and drop a file here or click.Hover over on file after upload to remove this file.',
						'replace': 'Drag and drop or click to replace',
						'remove':  'Remove',
						'error':   'Ooops, something wrong happended.'
					}
				});

           
            });
			
			//$("#save_continue_task").click(function(event) {
              /* Act on the event */
            //  $('#post_task_step2_form').submit();
            //});

            $(".js-example-tags").select2({
              tags: true
            });
        </script>   

       