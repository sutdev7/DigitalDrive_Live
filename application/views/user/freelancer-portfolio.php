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
            <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
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
                 <!--  <ul>
                    <li><a href="<?php echo base_url(); ?>user-bio"><img src="<?php  echo base_url('assets/img/BioIcon-1A.png'); ?>" alt=""><?=$user_type?> Bio</a></li>

                    <?php if($this->session->userdata('user_type') == 4) {?>
                      <li class="active"><a href="<?php echo base_url(); ?>portfolio"><img src="<?php  echo base_url('assets/img/GenderIcon-1A.png'); ?>" alt=""> Portfolio</a></li>
                    <?php } ?>

                    <li ><a href="<?php echo base_url(); ?>gender"><img src="<?php  echo base_url('assets/img/GenderIcon-1A.png'); ?>" alt=""> Gender</a></li>
                    <li><a href="<?php echo base_url(); ?>payment"><img src="<?php  echo base_url('assets/img/PaymentIcon-1A.png'); ?>" alt=""> Payment</a></li>
                    <li><a href="<?php //echo base_url(); ?>settings"><img src="<?php  //echo base_url('assets/img/SettingIcon-1A.png'); ?>" alt=""> Settings</a></li>
                <li><a href="<?php //echo base_url(); ?>reviews"><img src="<?php  //echo base_url('assets/img/ReviewIcon-1A.png'); ?>" alt=""> Reviews</a></li>
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
             <div class="row"> 
              <div class="col-md-12">
                <div class="pro_info">
                  <div>
                    <h4 style="float: left;">Portfolio</h4>
                    <a class="addMore" data-toggle="modal" href="#EditArea" style="float: right;">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>


            <div class="row">

              <?php if(!empty($portfolioData)){
                 $i=0;
                foreach($portfolioData as $portfolio){ ?>
                  <div class="col-md-4 pmargintop">
                    <div class="ptotalblock">
                      <?php if($portfolio->portfolio_image == '') {?>
                        <img src="<?php echo base_url(); ?>/uploads/user/portfolio_image/no_image.png" style="width: 100%;height: 220px;">
                      <?php }else{ ?>
                        <img src="<?php echo base_url(); ?>/uploads/user/portfolio_image/<?php echo $portfolio->portfolio_image; ?>" style="width: 100%;height: 220px;"> 
                      <?php } ?>


                       <!-- <div  class="pdesc"><?php echo $portfolio->portfolio_desc; ?></div> -->
                      <!-- <div class="hblock">
                        <div class="ptitle">
                          <?php echo $portfolio->portfolio_url; ?>
                         
                        </div>
                        <div class="ptitle2">
                          <?php echo $portfolio->portfolio_desc; ?>
                        </div>
                        
                      </div>
                     
                       
                     <div  data-id="<?php echo $portfolio->id; ?>" class="dataId">
                        <a class="addMore" data-toggle="modal" href="#AddArea" style="float: right;background-color: black;border-radius: 50px">
                          <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                      </div>
                      -->
                        <?php $single_data = $this->db->get_where('user_portfolio_list',array('id' =>$portfolio->id))->row(); ?>
 
                        <input class="form-control" id="userId_<?php echo $i ?>" type="hidden" value='<?= $single_data->id;?>' />
                        <input class="form-control" id="userImgname_<?php echo $i ?>" type="hidden" value="<?= $single_data->portfolio_name;?>" />
                        <input class="form-control" id="userImgdesc_<?php echo $i ?>" type="hidden" value="<?= $single_data->portfolio_desc;?>" /> 
                        <input class="form-control" id="userImgUrl_<?php echo $i ?>" type="hidden" value="<?= $single_data->portfolio_url;?>" /> 
                        <input class="form-control" id="userImgval_<?php echo $i ?>" type="hidden" value="<?=base_url()?>/uploads/user/portfolio_image/<?= $single_data->portfolio_image;?>" />
                        <button onclick="addMore('<?php echo $i ?>')">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>   
                        <?php
                          $i++;
                        ?>

                    </div>
                  </div>
                <?php }} ?>
                  <!-- Shifted Model Popup Down-->
                  <div class="modal editingModal" id="AddArea">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content"> 
                            <form name="frmSaveUserInfo" class="userInfo" method="post" action="<?php echo base_url(); ?>user/updateePortfolioData" enctype="multipart/form-data">
                              <!-- Modal Header -->
                              <div class="modal-header"> Portfolio Update 
                                <button type="button" class="close" id="BtnCloseModel" data-dismiss="modal">&times;</button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                               
                                <div class="form-group">
                                     <input class="form-control editId" name="editId" type="hidden" value="" />
                                  <input class="form-control fldName" id="fldName" name="fldName" type="text" value="" placeholder="project name" required />
                                  <input class="form-control " id="id" name="id" type="hidden" value="" placeholder="project name" required />
                                </div>
                                <div class="form-group">
                                  <input class="form-control fldUrl" id="fldUrl" name="fldUrl" type="text" value="" placeholder="project url" required />
                                </div>
                                <div class="form-group">
                                  <textarea class="fldDesc" id="fldDesc" name="fldDesc" placeholder="project description" style="height: 100px" required>
                                  
                                  </textarea>
                                </div>

                                   <span class="imsurls" style="width: 100%;height: 100px"></span>
                                    <span class="imsurl" id="blah_update"></span>
                                <div class="custom-file">
                                  <input class="custom-file-input file-upload update_images" id="customFile"  name="projectImage" type="file" accept="image/*">

                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <input name="btnSubmit" type="submit" value="Update">
                              </div>
                            </div>
                            </form>
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

  <!--Edit Area Popup-->
  <div class="modal editingModal" id="EditArea">
    <div class="modal-dialog modal-sm">
      <div class="modal-content"> 
        <form name="frmSaveUserInfo" class="userInfo" method="post" action="<?php echo base_url(); ?>user/savePortfolioData" enctype="multipart/form-data">
          <!-- Modal Header -->
          <div class="modal-header"> Portfolio
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <input class="form-control editId" name="editId" type="hidden" value="" />
            <div class="form-group">
              <input class="form-control fldName" name="fldName" type="text" value="" placeholder="project name" required />
            </div>
            <div class="form-group">
              <input class="form-control fldUrl" name="fldUrl" type="text" value="" placeholder="project url" required />
            </div>
            <div class="form-group">
              <textarea class="fldDesc" name="fldDesc" placeholder="project description" required></textarea>
            </div>

             <span class="imsurl" id="blah"></span>

            <div class="custom-file">
              <input class="custom-file-input file-upload img_add" id="customFile" name="projectImage" type="file" accept="image/*">

              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
           

          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <input name="btnSubmit" type="submit" value="Save">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Edit Area Popup--> 

  <script>
// Add the following code if you want the name of the file appear on select
// $(".custom-file-input").on("change", function() {
//   var fileName = $(this).val().split("\\").pop();
//   $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
// });
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').html('<img  src='+e.target.result+' with="150px" height="150px">');

     
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}
$(".img_add").change(function() {
  readURL(this);
});




function updateImages(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah_update').html('<img  src='+e.target.result+' with="150px" height="50px">');

     
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}
$(".update_images").change(function() {
  updateImages(this);
});
function addMore(id){
 $("#AddArea").show(); 
  var userId=$("#userId_"+id).val();
  var userImgname=$("#userImgname_"+id).val();
  var userImgdesc=$("#userImgdesc_"+id).val();
  var userImgUrl=$("#userImgUrl_"+id).val();
   var userImgVal=$("#userImgval_"+id).val();
  $("#id").val(userId);
  $("#fldName").val(userImgname);
  $("#fldDesc").val(userImgdesc);
  $("#fldUrl").val(userImgUrl);
  $('.imsurls').html('<img  src='+userImgVal+' with="150px" height="50px">');  
}

$(document).on('click','#BtnCloseModel',function(){
  $("#AddArea").hide();
});





$(document).ready(function() { 

  $(document).on('click','.peditlogo',function(){

   $("#EditArea").find('form').trigger('reset');

   var pk = $(this).data('id');
   var base_url = window.location.origin+'/hwfinal';

   $.ajax({

    url: "<?= base_url()?>portfolio/getPortfolioList",
    type: "POST",
    data: { pk: pk },
    dataType: 'json',
    success: function (result) {

      $('.editId').val(result.result.id);
      $('.fldName').val(result.result.portfolio_name);
      $('.fldUrl').val(result.result.portfolio_url);
      $('.fldDesc').val(result.result.portfolio_desc);

      $('.imsurl').html('<img id="theImg" src='+base_url+'/uploads/user/portfolio_image/'+result.result.portfolio_image+'>');

      $("#EditArea").modal('show');
        //$('#customSwitch'+pk).val(data);
      }


    });



 });

});
</script>