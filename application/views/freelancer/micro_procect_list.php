<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
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
            <?php foreach($user_array as $vals){ ?>
            <div class="col-md-4 mb-3">
              <div class="card">
                   
                <div class="card-body">
                  <?php
                  if(empty($vals->profile_image)) {
            $user_profile_image1 = base_url('assets/img/no-image.png');
        }else{
            $user_profile_image1 = base_url('uploads/user/profile_image/'.$vals->profile_image);            
        }
        ?>
                  <div class="d-flex flex-column align-items-center text-center">
 <img class="card-img-top img-circle" src="<?=$user_profile_image1?>" style="width:100px;height:100px;border-radius: 73px;margin:0px 74px 10px 95px;
">
                    
                    <div class="mt-3">
                      <h4><?=$vals->name?></h4>
                    
                      <div>
                       
                        <p class="text-secondary mb-1"><?=$vals->address?></p>
                        <p class="text-secondary mb-1"><?=$vals->city?>, <?=$vals->state?>,<?=$vals->country_name?></p>
                        
                     
                   
                     
                      </div>
                     
                    </div>
                  

                  </div>

                </div>
              </div>
              
                     <!--  <h4 class="text-center">Bio</h4>
                      <strong>Bio</strong> -->
                    
            <!--          
                 <div>
                       
                        
                        <p class="text-secondary mb-1"><?=$vals->bio?></p>
                     
                   
                     
                      </div> -->
                
              
              <?php }?>
            </div>
           
            <div class="col-md-8">
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
                      <img class="card-img-top img-fluid" src="<?=$portfolio_img1?>" style="height: 200px;width: 200px;margin-left: -18%;">
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <div class="task_Left_Div" style="width: 500px;margin-top: -27px;">
                        <h3 class="" style="font-size: 24px;color:green;margin-left: -36px;"><?=$vals['title']?></h3>
                         
                         <span style="margin-left: -35px;"><?php  
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
                         
                        <div class="" style="font-size: 18px;color: #1324a0;margin-left: -8%;margin-top: 4%;">
                     <?=$vals['category']?>-><?=$vals['subcategory']?>
                    </div>
                     
                      </div>
                    </div>
                  </div>
                      
                    
                     


                    </div>
                   <!--   <div class="col-sm-3">
                      <h6 class="mb-0">Title </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <?=$vals['title']?>
                    </div> -->
                  </div>
                    
                  </div>
                 
                 <!--  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Title </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <?=$vals['title']?>
                    </div>
                  </div>
                  <hr> -->
                  <div class="row">
                   
                    <div class="col-sm-12 text-secondary">
                       <?php
                       
                        $limited_word = word_limiter($vals['description'],25);
                        echo $limited_word;
                       ?><a href="<?=base_url()?>micro-freelancer-details/<?=$vals['id']?>" style="text-decoration: none;color: blue" title="" class="view-more-pro"><b>Read more</b></a>
                    </div>
                  </div>
                 
                  <!-- <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Category</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <?=$vals['category']?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Subcategory</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <span class=""> <?=$vals['subcategory']?></span>
                    </div>
                  </div>
                  <hr> -->
                <!--   <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Link Micro</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <a href="<?=base_url()?>micro-freelancer-details/<?=$vals['id']?>" style="text-decoration: none;color: silver" title="" class="view-more-pro"><b>Details Webdevloper</b></a>
                    </div>
                  </div> -->
                   
                    <hr>
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

       
