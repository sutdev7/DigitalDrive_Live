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
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <!--==========================
      ConterDiv Section
    ============================-->
    <?php

#For Find How many micro Abhishek 
              $user_id = $this->session->userdata('user_id');
              $this->db->select('*');
              $this->db->from('microkey');
              $this->db->where('user_id',$user_id);
              $query = $this->db->get();
      
              $micro_values= $query->num_rows();

              $this->db->select('*');
              $this->db->from('skillcategory');
              $this->db->where('status','1');
              $this->db->where('parent_id','0');
              $this->db->group_by('category_name');
              $this->db->order_by('category_name','asc');
              $category_skills = $this->db->get()->result();
    
          
    ?>

  <section id="postDiv">
    <div class="postLink"> <a href="javascript:void(0);" class="act"><i class="fa num">1</i> Overview</a> <a href="javascript:void(0);"><i class="fa num">2</i> Pricing</a> <a href="javascript:void(0);"><i class="fa num">3</i> Description</a> </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="postDiv_Box">
            <form action="<?php echo base_url(); ?>post-microkey-Step-2" name="frmPostTaskFirst" method="post" enctype="multipart/form-data">
              <div class="step_Box">
                 <?php  if($micro_values>5){ $microMessage="<p class='microMessage' style='color:red'>Your mirco profile is allready  5</p>";
            echo $microMessage;}?>
                <h3>Description  </h3>
                <ul>
                  <li><span>
                <label><i class="fa fa-star" style="font-size:7px;color:#f00;" aria-hidden="true"></i> Micro key Title</label>
                          <input class="form-control" type="text" name="fldTaskTitle" value="{fldTaskTitle}" placeholder="Enter Here" required>
             </span>
                  
                   <span>
                    <label><i class="fa fa-star" style="font-size:7px;color:#f00;" aria-hidden="true"></i> Skill Required</label> <select class="js-example-tags" multiple="multiple" name="fldSkillRequired[]">
                      {skills}
                        <option value="{key}" {currentselection}>{value}</option>
                      {/skills}
                    </select>
                   
                    </span> </li>
                </ul>
               <ul>
                  <li>
                    <span>
                    <label>Category</label>
                  <div class="select-style">
                    <select   id="fldSelCat">
                      <?php foreach($category_skills as $row){?>
                      <option value="<?=$row->category_id?>"><?=$row->category_name?></option>
                    <?php }?>
                     
                    </select>
                  </div>
                </span>
                  </li>
                  <li>
                    <span>
                    <label>Sub Category</label>
                  <div class="select-style">
                    <select name="fldSelCatSub"  id="fldSelCatSub">
                     
                    </select>
                    <input id="myText" name="fldSelCat"  type="hidden" value="colors">
                  </div>
                </span>
                  </li>
                </ul>
        
        
              </div>
              <?php 
              
               
              
               if($micro_values<=5){
              ?>
              <div class="fullDiv_bottom">
                <button type="submit" name="btnSubmit" class="btn btn-primary" value="Save and Continue">Save and Continue</button>
                <!-- <button type="submit" class="btn btn-primary" id="save_continue_task">Save and Continue</button> -->
              </div>
            <?php }?>

            </form>
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
        $('#fldSelCat').change(function(){
  var opt = $(this).find('option:selected');
 
  $('#myText').val(opt.html());
});
      $('#fldSelCatSub').click(function(){
        var cat_val=$('#fldSelCat').val();
      
            $.ajax({
              url: "<?php echo base_url()?>admin/subctgeory_data/"+cat_val,
              success: function(result){
               
                $("#fldSelCatSub").html(result);
              }
            });
          //
          

         

      });

     function myFunction(e) {
    document.getElementById("myText").value = e.target.text
}
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

       