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

            <?php $frmValidationMsg = validation_errors(); 
            if(!empty($frmValidationMsg)) { ?>
            <section style="padding-top: 7%;">
              <?php echo '<div class="alert alert-danger text-center">' . $frmValidationMsg . '</div>'; ?>
            </section>
            <?php } ?>

            <h3>New to <span>Hire-n-Work</span>? Sign up below</h3>
            <form action="<?php echo base_url(); ?>confirm-sign-up" name="frmSignUp" id="frmSignUp"  enctype="multipart/form-data" method="post">
              <!-- http://demoupdates.com/updates/nlaucer/html/confirmation.html -->
              <input type="hidden" name="fldUserType" value="{sign_up_as}" />
              <input type="hidden" name="subscription_plan" value="{subscription_plan}" />
              <div class="form-group">
                <label>Enter your name <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="fldName" name="fldName" placeholder="Enter Name" value=""  required>
              </div>
              <div class="form-group">
                <label>Enter username <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="username" name="username" data-placement="top"  placeholder="Enter Username" value="" required>
              </div>
              <div class="form-group">
                <label>Select Country <span style="color:red">*</span></label>
                <select id="fldCountry" name="fldCountry" value="" required>
                  <option value="">Select Country</option>
                  {countries} <option value="{key}">{value}</option> {/countries}                 
                </select>
              </div>


              <?php if($sign_up_as == 'freelancer' || $sign_up_as == 'nlancer'){ ?>              
                    <div class="form-group skill">
                      <label>Select skills</label>
                      <select id="fldSkills" name="fldSkills[]" required="" multiple="" class="js-example-placeholder-multiple form-control" oninvalid="this.setCustomValidity('Enter upto 2 skills Here')" oninput="this.setCustomValidity('')">
                        {skills} 
                       <!--  <option value="{area_of_interest_id}">{name}</option> -->
                         <option value="{name}">{name}</option>
                        {/skills}
                      </select>
                    </div>
              <?php } ?>


              <div class="form-group">
                <span>
                  <label>Email Address<span style="color:red">*</span></label> 
                  <input type="email" class="form-control" id="fldEmail" name="fldEmail" placeholder="Email Address" value="" required>
                </span> 
                
              </div> 

              <div class="form-group">
                <span>
                  <label>Enter Password <span style="color:red">*</span></label> 
                  <input type="password" class="form-control" id="fldPassword" name="fldPassword" placeholder="Enter Password" value="" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$"  required>

                  <b class="text-danger">Password should be, Capital, small, number & special character combination with min 8 digit and max12.</b>
                </span> 
              </div>         
               <div class="form-group"> 
                <span>
                  <label>Choose country code then number (Ex:+00 000000000) <span style="color:red">*</span></label>
                  <div class="form-group"> 
                      <input id="phone" type="tel" name="phone_no" placeholder="Mobile No" class="form-control" placeholder="Mobile No" value="" minlength="10" maxlength="13"  required>  
                  </div>

                  <!-- old code -->
                  <!-- <input  type="text" pattern="\d*" minlength="10" maxlength="10"  class="form-control" id="phone_no" name="phone_no" placeholder="Mobile No" value="" required> -->
                </span> 
                <span>


                  <label>Upload your profile picture <span style="color:red">*</span></label> 

                <div class="form_upload">
                  <div class="file-upload-wrapper" data-text="Upload profile picture">
                    <input name="userImage" type="file" class="file-upload-field"  value="" id="cv_upload" required="">
                  </div>
                </div>



                <!-- old input -->
                <!-- <input type="file" name="userImage" size="20"  required /> -->
                </span> 
              </div>
        
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="fldTnC" value="yes" required>  
                  I agree to the <a href="<?php echo base_url(); ?>terms-and-condition" target="_blank">Terms & Conditions</a>, <a href="<?php echo base_url(); ?>privacy-policy" target="_blank">Privacy Policy</a>
                  

                </label>
              </div>
              <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary" >Sign up</button>
            </form>
            <!-- <div class="withdiv"> 
            <h4>Or Sign in with</h4>
            </div> -->
            
            <div class="alink2" style="margin-top: 1rem;"> 
              <!--<a href="#" class="facebookLink"><i class="fa fa-facebook"></i> Facebook</a>--> 
               <a href="<?=base_url()?>googlelogin/login/<?=$sign_up_as?>" class="googleLink"><i class="fa fa-google-plus"></i> Google +</a> 
              <!-- <a href="#" class="linkedinLink"><i class="fa fa-linkedin"></i> Linkedin</a>  -->
            </div>
            <h2>Already have an account <a href="<?php echo base_url(); ?>sign-in">Sign in</a></h2>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- <script src="http://localshost/hirenwork/assets/js/flag.js"></script>  -->
<script src="<?php  echo base_url('assets/js/flag.js'); ?>"></script> 


<script type="text/javascript" language="javascript">
  $(".js-example-placeholder-multiple").select2({
    placeholder: "Select maximum 2 Skills",
    maximumSelectionLength: 2,
    tags: true
  });
    $(document).ready(function() { 
        $('[data-toggle="tooltip"]').tooltip();   
    });


      jQuery(document).ready(function($) {
        jQuery(".form_upload").on("change", ".file-upload-field", function(){ 
          jQuery(this).parent(".file-upload-wrapper").attr("data-text",jQuery(this).val().replace(/.*(\/|\\)/, '') );
        });
      });

      $('#phone').submit(function(e) {
            e.preventDefault();
            if(!$('#mobile').val().match('[0-9]{10,13}'))  {
                alert("Please put min 10 digit max 12 digit mobile number 1");
                return;
            }  

        });
      $("#submit").click(function(){
var fldName = $("#fldName").val();

if(empty(fldName)){
  alert("Jga");
   document.getElementById("fldName").focus();
}


      });

//  $(document).ready(function() {  
//             $("#fldName").focusout(function() {  
//                 if($(this).val()=='') {  
//                     $(this).css('border', 'solid 2px red');  
//                 } 
//                 else { 
                      
//                     // If it is not blank. 
//                     $(this).css('border', 'solid 2px green');     
//                 }     
//             }) .trigger("focusout"); 

//             $("#username").focusout(function() {  
//                 if($(this).val()=='') {  
//                     $(this).css('border', 'solid 2px red');  
//                 } 
//                 else { 
                      
//                     // If it is not blank. 
//                     $(this).css('border', 'solid 2px green');     
//                 }     
//             }) .trigger("focusout");
//             $("#fldCountry").focusout(function() {  
//                 if($(this).val()=='') {  
//                     $(this).css('border', 'solid 2px red');  
//                 } 
//                 else { 
                      
//                     // If it is not blank. 
//                     $(this).css('border', 'solid 2px green');     
//                 }     
//             }) .trigger("focusout");   

//             $("#fldEmail").focusout(function() {  
//                 if($(this).val()=='') {  
//                     $(this).css('border', 'solid 2px red');  
//                 } 
//                 else { 
                      
//                     // If it is not blank. 
//                     $(this).css('border', 'solid 2px green');     
//                 }     
//             }) .trigger("focusout"); 
//             $("#fldPassword").focusout(function() {  
//                 if($(this).val()=='') {  
//                     $(this).css('border', 'solid 2px red');  
//                 } 
//                 else { 
                      
//                     // If it is not blank. 
//                     $(this).css('border', 'solid 2px green');     
//                 }     
//             }) .trigger("focusout");  
//             $("#phone").focusout(function() {  
//                 if($(this).val()=='') {  
//                     $(this).css('border', 'solid 2px red');  
//                 } 
//                 else { 
                      
//                     // If it is not blank. 
//                     $(this).css('border', 'solid 2px green');     
//                 }     
//             }) .trigger("focusout");   
//             $(".file-upload-field").focusout(function() {  

//                 if($(this)[0].files.length==0) {  
//                     $('.file-upload-wrapper').css('border', 'solid 2px red');  
//                 } 
//                 else { 
                      
//                     // If it is not blank. 
//                     $('.file-upload-wrapper').css('border', 'solid 2px green');     
//                 }     
//             }) .trigger("focusout");  
//              }); 
         
//          $('#fldCountry').change(function () {
//     var countryCode = $(this).val();
//     var countryFlag = $(this).text();

//     if (countryCode) {
//         $('#phone').val("+"+countryCode);
       
//     }
//     if (countryFlag) {
        
//         $('.iti-flag').val("+"+countryCode);
//     }
// });

$(document).ready(function() {  
            $("#fldName").focusout(function() {  
                if($(this).val()!='') {  
                     $(this).css('border', 'solid 2px green'); 
                } 
                   
            }) .trigger("focusout"); 

            $("#username").focusout(function() {  
               if($(this).val()!='') {  
                     $(this).css('border', 'solid 2px green'); 
                }      
            }) .trigger("focusout");
            $("#fldCountry").focusout(function() {  
                if($(this).val()!='') {  
                     $(this).css('border', 'solid 2px green'); 
                }    
            }) .trigger("focusout");   

            $("#fldEmail").focusout(function() {  
               if($(this).val()!='') {  
                     $(this).css('border', 'solid 2px green'); 
                }      
            }) .trigger("focusout"); 
            $("#fldPassword").focusout(function() {  
               if($(this).val()!='') {  
                     $(this).css('border', 'solid 2px green'); 
                }     
            }) .trigger("focusout");  
            $("#phone").focusout(function() {  
                if($(this).val()!='') {  
                     $(this).css('border', 'solid 2px green'); 
                }      
            }) .trigger("focusout");   
            $(".file-upload-field").focusout(function() {  

                if($(this)[0].files.length!==0) {  
                   $('.file-upload-wrapper').css('border', 'solid 2px green');  
                } 
                   
            }) .trigger("focusout");  
             }); 
         
         $('#fldCountry').change(function () {
    var countryCode = $(this).val();
    var countryFlag = $(this).text();

    if (countryCode) {
        $('#phone').val("+"+countryCode);
       
    }
    if (countryFlag) {
        
        $('.iti-flag').val("+"+countryCode);
    }
});
   </script>



