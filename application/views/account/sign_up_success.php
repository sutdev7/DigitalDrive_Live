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
                <h2>You are successfully registered with us.</h2>
                <p><b>Your account verification link sent on your registered email id</b></p>
                <p><b>Your Email:</b> <?php echo $userEmail;?></p>
              

              <a href="<?php echo base_url(); ?>" class="btn btn-primary">Home</a>
            </div>
         </div>
     </div>
  </div>
</div>