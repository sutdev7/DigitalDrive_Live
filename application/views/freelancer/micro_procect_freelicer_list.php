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
    margin-left: -50px;
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
header{
  display: inline-flex;

}
.post_micro{
  margin-left: 788px;
  margin-top: 8px;
}
.main_div{
  margin-top: -18px;
}

.heading_title{
  margin-left:12px;
}
   
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
            <li class="breadcrumb-item active" aria-current="page">My Micro profile</li>
          </ol>
        </nav>
   
      <div class="row">
        <p class="pull-right" style="width: 99%; text-align: right;margin-top:0px; "> <a class="btn btn-info" href="<?= base_url().'post-microkey-step-1' ?>" class="<?php echo ($this->uri->segment(1) == '/post-microkey-step-1') ? "active" : '' ?> ">Post Micro Key</a></p>
        
        <div class="col-lg-12 main_div">
          <div class="postDiv_Box">
            
              
    <div class="main-body">
    
          <!-- Breadcrumb -->
         
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
          
           
            <div class="col-md-12">
               <?php foreach($microkey_array as $vals){?>
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      
                      
                      <?php 

                      if(empty($vals['portfolio_img1'])) {
            $portfolio_img1 = base_url('assets/img/no-image.png');
        }else{
            $portfolio_img1 = base_url('uploads/user/microkey_files/'.$vals['image']);          
        }
                      ?>
                      <div class="row">
                    <div class="col-sm-3">
                      <img class="card-img-top img-fluid" src="<?=$portfolio_img1?>"style="width:100px;height:100px;border-radius: 73px;margin:0px 74px 10px 95px;
">
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <div class="task_Left_Div" style="width: 850px;margin-top: -32px;">
                        <h3 class="" style="font-size: 24px;color:green;margin-left: -36px; margin-top: -10px;"><?=$vals['title']?></h3>
                         
                         <span style="margin-left: -27px;"><?php  
                         $skills=$vals['skills'];
                         $b = str_replace( ',', '', $skills );


                        $c = strlen($skills); 
                        for($i=0;$i<$c;$i++){
                          $val= $skills[$i];
                          if($val!=','){
                           
                            $skils_name=$this->db->get_where('area_of_interest',array('area_of_interest_id'=>$val))->row();?> <a href="#"><?=$skils_name->name;?></a> <?php  
                          }
                        }
                        ?>  </span>
                         
                        <div class="" style="font-size: 18px;color: #1324a0;margin-left: -3%;margin-top: 4%;">
                     <?=$vals['category']?>-><?=$vals['subcategory']?>
                    </div>
                      <div class="" style="margin-left: -4%;margin-top: 4%;">
                     <?=$vals['description']?>
                     <a href="<?=base_url()?>micro-freelancer-details/<?=$vals['id']?>" style="text-decoration: none;color: blue" title="" class="view-more-pro"><b>View more</b></a>
                    </div>
                      </div>
                    </div>
                  </div>
                      
                    
                     


                    </div>
                 
                  </div>
                    
                  </div>
                 
                </div>
              
              <?php }?>
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

       