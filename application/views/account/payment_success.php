<style>
.payment {
  border: 5px solid #46b4e7;
  height: 280px;
  border-radius: 24px;
  background: #fff;
  margin-top: 65px;
  margin-bottom: 95px;
  height: 78%;
}

.payment_header {
  background: rgb(15 134 19);
  padding: 20px;
  border-radius: 18px 18px 0px 0px;
}

.check {
  margin: 0px auto;
  width: 50px;
  height: 50px;
  border-radius: 100%;
  background: #fff;
  text-align: center;
}

.check i {
  vertical-align: middle;
  line-height: 50px;
  font-size: 30px;
}

.content {
  text-align: center;
}

.content h1 {
  font-size: 40px;
  padding-top: 0px;
}

.content a {
  width: 200px;
  height: 35px;
  color: #fff;
  border-radius: 30px;
  padding: 5px 10px;
  background: #46b4e7;
  transition: all ease-in-out 0.3s;
}

.content a:hover {
  text-decoration: none;
  background: #000;
}

.payment_header_hr {
  border: 3px solid #46b4e7;
  border-radius: 0px;
}


</style>
<?php  //print_r($result); echo '{result}{email}{/result}' ?>
<div class="container">
   <div class="row">
      <div class="col-md-8 mx-auto mt-5">
         <div class="payment">
          <div class="payment_header">
            <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
          </div>
            <hr class="payment_header_hr">
            <div class="content">
               <!-- Verification email sent to inbox -->

        <?php if($this->session->userdata('user_id') =="") { ?>
            <h2>You are successfully registered with us.</h2>
            <p><b>Your account verification link sent on your registered email id</b></p>
        <?php } ?>

               <h2>Payment is successfully Done !!</h2>
               <p></p>

               <?php if(isset($result[0]->name)){ ?>
                <p><b>Your Upgraded Plan:</b> {result}{name}{/result}</p>
              <?php } ?>

              <p><b>Transaction ID:</b> {result}{txn_id}{/result}</p>
              <p><b>Paid Amount:</b> {result}{amount}{/result} {result}{currency_code}{/result}</p>
              <p><b>Payment Status:</b> {result}{payment_status}{/result}</p>
              <p><b>Payment Type:</b> {result}{payment_type}{/result}</p>
            <?php if($this->session->userdata('user_id') =="") { ?>
              <a href="<?php echo base_url(); ?>sign-in">Sign in & Complete Profile</a>
          	<?php } else{?>
          		<a href="<?php echo base_url(); ?>dashboard">Go to Dashboard</a>
          	<?php  } ?>


            </div>
         </div>
     </div>
  </div>
</div>