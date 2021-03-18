

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

<!-- Stripe JS library -->

<script src="https://js.stripe.com/v3/"></script>

  <!--==========================

      ConterDiv Section

    ============================-->

  <section id="postDiv">

    <div class="container">

      <div class="row">

        <div class="col-lg-12 col-md-12 col-xs-12">

          <div class="task_Left">

            <nav aria-label="breadcrumb">

              <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Home</a></li>

                <li class="breadcrumb-item"><a href="#">Offer Details</a></li>

                <li class="breadcrumb-item active" aria-current="page">Hire Freelancer</li>

              </ol>

            </nav>

            <div class="task_Left_Div task-Full">

              <h3>Deposit Fund for : {taskinfo}{task_name}{/taskinfo}</h3> 
              <br>
              <div class="bluediv">
                <label>Payable Ammount</label>
                <h2>${taskinfo}{task_total_budget}{/taskinfo}</h2>
              </div>
              <h3>Select Payment Method</h3>
              <!-- <label class="radio-inline">

                <input type="radio" name="optradio" checked>Debit or Credit Card

                </label>

                <label class="radio-inline">

                <input type="radio" name="optradio">PayPal

                </label>

              </label> -->

              <label class="btn btn-lg college_btn active">
                  <input class="checkinput " type="radio" name="catSelect_type" value="1" checked >
                  <span id="">Stripe</span>
              </label>
              <label class="btn btn-lg ">
                  <input class="checkinput" type="radio" name="catSelect_type" value="2">
                  <span id="paypalTab">PayPal <img src="https://www.f-cdn.com/assets/main/en/assets/payments/paypal_reference.svg" alt=""></span>
              </label>

              <label class="btn btn-lg ">
                  <input class="checkinput" type="radio" name="catSelect_type" value="3">
                  <span id="paypalTab">RazorPay <img src="https://cdn.razorpay.com/logo.svg" width="115px" alt=""></span>
              </label>

        <div id="cardTab">
            <!-- Display errors returned by createToken -->
			    <div id="paymentResponse"></div>
              <!-- Payment form -->
			      <form action="<?php echo base_url('stripe/pay/{taskinfo}{task_id}{/taskinfo}'); ?>" method="POST" id="paymentFrm" name="StripForm">
              <input class="checkinput" type="hidden" name="amount" value="{taskinfo}{task_total_budget}{/taskinfo}">
              <input class="checkinput" type="hidden" name="client_id" value="{taskinfo}{user_task_id}{/taskinfo}">             
              <input class="checkinput" type="hidden" name="task_id" value="{taskinfo}{task_id}{/taskinfo}">   
              <input type="hidden" name="freelancer_id" value="{taskinfo}{freelancer_id}{/taskinfo}" />          
              <input type="hidden" name="usertaskid_milestoneid" value="{taskinfo}{usertaskid_milestoneid}{/taskinfo}" />          

              <ul class="frmList">

              <li class=row></li>

                <li class="row">
                  <div class="col-lg-7 col-md-12 col-xs-12">
                    <label>Card Number
                      <div class="icon-container">
                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                      </div>
                    </label>
                    <!-- <input type="text" id="card_number" class="form-control cardInput" placeholder="Enter Card No"> -->
                    <div id="card_number" class="field"></div>
                  </div>
                  <div class="col-lg-5 col-md-12 col-xs-12"> <img src="img/card-img.jpg" alt="" class="cardImg"> </div>
                </li>

                <li class="row noBorder">
                  <div class="col-lg-4 col-md-12 col-xs-12">
                    <label>Expires on</label>

                    <!-- <div class="select-style">

                      <select>

                        <option>MM</option>

                      </select>

                    </div> -->

                    <!-- <input type="text" id="card_number" class="form-control" placeholder="Expires on"> -->

                    <div id="card_expiry" class="field"></div>

                  </div>

                  <div class="col-lg-4 col-md-12 col-xs-12">

                    <!-- <div class="select-style styleMargin">

                      <select>

                        <option>YY</option>

                      </select>

                    </div> -->

                  </div>

                  <div class="col-lg-4 col-md-12 col-xs-12">
                    <label>CVV</label>
                    <!-- <div class="input-group amt"> 
                      <input class="form-control" type="text" placeholder="Enter CVV">
                    </div> -->
                    <div id="card_cvc" class="field"></div>
                  </div>
                </li>

                <li class="noBorder">

                	<ul class="verifiedPaymentList">

                    	<li><label>Powered by</label><img src="img/strip-money-img.png" alt=""></li>

                        <li><img src="img/money-verified-img.png" alt=""></li>

                    </ul>

                </li>

                <li>

                	<div class="yNote">Note: Your fund will be deposit to the escrow</div>

                </li>

              </ul>
               <div class="fullDiv_bottom mrgnMinus paybutton_1">
              <button type="submit" id="payBtn" class="btn btn-primary" data-toggle="modal" data-target="#SentModal">Make Payment</button>
            </div>

            </form>

              </div>

            </div>

            <div class="fullDiv_bottom mrgnMinus paybutton_2">
               <form name="PayPalForm" id="PayableID" method="post" action="<?php echo base_url('paypal/pay'); ?>">
                <!-- <a href="<?php //echo base_url('paypal/pay/{taskinfo}{task_id}{/taskinfo}'); ?>" class="btn"> <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#SentModal">Make Payment</button></a> -->
                  <input type="hidden" name="payableamount" value="{taskinfo}{task_total_budget}{/taskinfo}" />
                  <input type="hidden" name="task_id" value="{taskinfo}{task_id}{/taskinfo}" />
                  <input type="hidden" name="freelancer_id" value="{taskinfo}{freelancer_id}{/taskinfo}" />
                  <input type="hidden" name="usertaskid_milestoneid" value="{taskinfo}{usertaskid_milestoneid}{/taskinfo}" />
                  <button type="submit" class="btn btn-primary" >Make Payment</button>
                </form>
            </div>

            <div class="fullDiv_bottom mrgnMinus paybutton_3">
              <button type="submit" data-user_task_id="{taskinfo}{user_task_id}{/taskinfo}" data-task_id="{taskinfo}{task_id}{/taskinfo}" data-amount="{taskinfo}{task_total_budget}{/taskinfo}" data-usertaskid_milestoneid="{taskinfo}{usertaskid_milestoneid}{/taskinfo}" data-freelancer_id="{taskinfo}{freelancer_id}{/taskinfo}" class="btn btn-primary razorpay_now">Make Payment</button>
            </div>



          </div>

        </div>

      </div>

    </div>

  </section>

</main>



<script>

    $(document).ready(function() {

      // $("#cardTab").hide();

        $(".paybutton_2").hide();

        $(".paybutton_3").hide();



        $(".checkinput").on('click', function(){

             //alert($(this).val());

            var paymentType = $(this).val();

            if(paymentType == 1){

                $(".paybutton_1").show();

                $(".paybutton_2").hide();

                $(".paybutton_3").hide();

                $("#cardTab").show();

            }else if(paymentType == 2){

              $(".paybutton_1").hide();

                $(".paybutton_2").show();

                $(".paybutton_3").hide();

                $("#cardTab").hide();

            }else{

              $(".paybutton_1").hide();

                $(".paybutton_2").hide();

                $(".paybutton_3").show();

              $("#cardTab").hide();

            }

            

        });



    });



</script>

<!-- Stripe integration script -->

<script>

// Create an instance of the Stripe object

// Set your publishable API key

var stripe = Stripe('<?php echo $this->config->item('stripe_publishable_key'); ?>');
// Create an instance of elements
var elements = stripe.elements();
var style = {
    base: {
		fontWeight: 400,
		fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
		fontSize: '16px',
		lineHeight: '1.4',
		color: '#555',
		backgroundColor: '#fff',
		'::placeholder': {
			color: '#888',
		},
	},
	invalid: {
	  color: '#eb1c26',
	}

};
var cardElement = elements.create('cardNumber', {
	style: style
});

cardElement.mount('#card_number');
var exp = elements.create('cardExpiry', {
  'style': style
});
exp.mount('#card_expiry');
var cvc = elements.create('cardCvc', {
  'style': style
});
cvc.mount('#card_cvc');
// Validate input of the card elements
var resultContainer = document.getElementById('paymentResponse');
cardElement.addEventListener('change', function(event) {
	if (event.error) {
		resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
	} else {
		resultContainer.innerHTML = '';
	}

});
// Get payment form element
var form = document.getElementById('paymentFrm');
// Create a token when the form is submitted.
form.addEventListener('submit', function(e) {
	e.preventDefault();
	createToken();
});



// Create single-use token to charge the user

function createToken() {

	stripe.createToken(cardElement).then(function(result) {
		if (result.error) {
			// Inform the user if there was an error
			resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
		} else {
			// Send the token to your server
			stripeTokenHandler(result.token);
		}

	});

}



// Callback to handle the response from stripe

function stripeTokenHandler(token) {
	// Insert the token ID into the form so it gets submitted to the server
	var hiddenInput = document.createElement('input');
	hiddenInput.setAttribute('type', 'hidden');
	hiddenInput.setAttribute('name', 'stripeToken');
	hiddenInput.setAttribute('value', token.id);
	form.appendChild(hiddenInput);
	// Submit the form
	form.submit();
}

</script>

<!-- Stripe integration script End -->

<!-- Razor pay integration in js-->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

var SITEURL = "<?php echo base_url() ?>";

$('body').on('click', '.razorpay_now', function(e){

var totalAmount = $(this).attr("data-amount");
var task_id =  $(this).attr("data-task_id");
var client_id= $(this).attr("data-user_task_id");
var usertaskid_milestoneid= $(this).attr("data-usertaskid_milestoneid");
var freelancer_id= $(this).attr("data-freelancer_id");

var options = {

  "key": "rzp_test_6zWahD2t7IjCvW",// amardeep test account // "rzp_test_zchN665lTTrnce",  // digital drive test account
  "amount": (totalAmount * 100), // 2000 paise = INR 20
  "name": "Digitally Drive",
  "description": "Payment",
  "image": "<?php  echo base_url('assets/img/logo.png'); ?>",
  "handler": function (response){
      $.ajax({
        url: SITEURL + 'Razorpay/razorPaySuccess',
        method: 'post',
        // dataType: 'json',
        data: {razorpay_payment_id: response.razorpay_payment_id,payment_type:"Razor", totalAmount:totalAmount,task_id:task_id,client_id:client_id, usertaskid_milestoneid: usertaskid_milestoneid,freelancer_id:freelancer_id},
        success: function (msg) {
          var msgobj = JSON.parse(msg);
          window.location.href = SITEURL + 'razorpay/RazorThankYou/' + msgobj.id;
        },
        beforeSend:function(){
        },
        error:function(){
          console.log('error in payment insertion');
        }
    });
  },
  "theme": { "color": "#528FF0" }
};

var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){

        // alert(response.error.code);

        // alert(response.error.description);

        // alert(response.error.source);

        // alert(response.error.step);

        // alert(response.error.reason);

        // alert(response.error.metadata.order_id);

        // alert(response.error.metadata.payment_id);

        // window.location.href = SITEURL + 'razorpay/cancel';

});

rzp1.open();
e.preventDefault();

});

</script>