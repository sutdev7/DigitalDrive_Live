<style>

.demo

{

	padding: 120px 0;

}

.heading-title

{

	margin-bottom: 50px;

    text-align: center;

}

.pricingTable {

    border: 1px solid #46b4e7;

    border-top-width: 5px;

    box-shadow: 0 0 10px rgba(0, 0, 0, 0.14);

    margin: 0 -5px;

    text-align: center;

    transition: all 0.4s ease-in-out 0s;

}



.pricingTable:hover{

    border: 2px solid #46b4e7;

    border-top-width: 5px;

    margin-top: -30px;

}



.pricingTable .pricingTable-header{

    padding: 10px 10px;

    background-color: #c58af1;

}



.pricingTable .heading{

    display: block;

    color: #000;

    font-weight: 900;

    text-transform: uppercase;

    font-size:21px;

}



.pricingTable .pricing-plans {

    padding:  11px 25px;

    border-bottom: 1px solid #d0d0d0;

    color: #000;

    font-weight: 900;

    background-color: #8165efd4;

}



.pricingTable .price-value{

    color: #474747;

    display: block;

    font-size: 25px;

    font-weight: 800;

    line-height: 35px;

    padding: 0 10px;

}



.pricingTable .price-value span{

    font-size: 50px;

}



.pricingTable .subtitle{

    color: #82919f;

    display: block;

    font-size: 15px;

    margin-top: 15px;

    font-weight: 100;

}



.pricingTable .pricingContent ul{

    padding: 0;

    list-style: none;

    margin-bottom: 0;

}



.pricingTable .pricingContent ul li{

    padding: 20px 0;

}



.pricingTable .pricingContent ul li:nth-child(odd) {

    background-color: #fff;

}



.pricingTable .pricingContent ul li:last-child{

    border-bottom: 1px solid #dbdbdb;

}



.pricingTable .pricingTable-sign-up{

    padding: 25px 0;

}



.pricingTable .btn-block{

    width: 50%;

    margin: 0 auto;

    background: #46b4e7;

    border:1px solid transparent;

    padding: 10px 5px;

    color:#fff;

    text-transform: capitalize;

    border-radius: 5px;

    transition:0.3s ease;

}



.pricingTable .btn-block:after{

    content: "\f090";

    font-family: 'FontAwesome';

    padding-left: 10px;

    font-size: 15px;

}



.pricingTable:hover .btn-block{

    background:#fff;

    color: #46b4e7;

    border:1px solid #46b4e7;

}



@media screen and (max-width:990px){

    .pricingTable{

        margin-bottom: 30px;

    }

}



@media screen and (max-width:767px){

    .pricingTable{

       margin: 0 0 30px 0;

    }

}@charset "utf-8";



/* CSS Document */

</style>



<div class="demo">

        <div class="container">

            <div class="heading-title">

                <h1>Try a Premium Membership</h1>

                <h4>Choose Your Plan</h4>

            </div>

          <form id="" name="frmSignUpAsMembership" action="<?php echo base_url(); ?>sign-up-as" method="post">
            <div class="row">

                 <div class="btn-group btn-group-toggle" data-toggle="buttons">



                <div class="col-md-3 col-md-4">

                    <div class="pricingTable">

                        <div class="pricingTable-header">

                            <span id="logo" class="">

                            <a href="<?php echo base_url(); ?>" class="scrollto"> <img src="<?php  echo base_url('assets/img/logo.png'); ?>" alt=""> </a> 

                            </span>

                            <span class="heading">

                               Free

                            </span>

                        </div>

                        <div class="pricing-plans">

                            <span class="price-value"><i class="fa fa-usd"></i><span>00</span></span>

                            <span class="subtitle">Lorem ipsum dolor</span>

                        </div>

                        <div class="pricingContent">

                            <ul>

                                <li><b>15</b> Bids Per Month</li>

                                <li><b>30</b>Skills</li>

                                <li><b>Unlimited</b> Project Bookmarks</li>

                                <li><b></b> Unlock Rewards</li>

                                <li><b></b> Preferred Freelancer Eligible*</li>

                            </ul>

                        </div><!-- /  CONTENT BOX-->

                        <div class="pricingTable-sign-up"><!-- BUTTON BOX-->

                            <!-- <a href="<?php echo base_url(); ?>" class="btn btn-block btn-default">buy now</a> -->

                        <label class="btn btn-outline-primary active">

                        <input type="radio" name="membership" value="1" id="option1" autocomplete="off" checked> Choose

                        </label>

                        </div><!-- BUTTON BOX-->

                    </div>

                </div>



                <div class="col-md-3 col-md-4">

                    <div class="pricingTable">

                        <div class="pricingTable-header">

                            <span id="logo" class="">

                            <a href="<?php echo base_url(); ?>" class="scrollto"> <img src="<?php  echo base_url('assets/images/subscription/silver.png'); ?>" height="55px" alt="silver"> </a> 

                            </span>

                            <span class="heading">

                                Silver

                            </span>

                        </div>

                        <div class="pricing-plans">

                            <span class="price-value"><i class="fa fa-usd"></i><span>10</span></span>

                            <span class="subtitle">Lorem ipsum dolor</span>

                        </div>

                        <div class="pricingContent">

                            <ul>

                                <li><b>25</b> Bids Per Month</li>

                                <li><b>50</b>Skills</li>

                                <li><b>Unlimited</b> Project Bookmarks</li>

                                <li><b></b> Unlock Rewards</li>

                                <li><b></b> Preferred Freelancer Eligible*</li>

                            </ul>

                        </div><!-- /  CONTENT BOX-->



                        <div class="pricingTable-sign-up"><!-- BUTTON BOX-->

                            <!-- <a href="<?php echo base_url(); ?>subscription/payment/2" class="btn btn-block btn-default">buy now</a> -->

                        <label class="btn btn-outline-primary">

                        <input type="radio" name="membership" value="2" id="option2" autocomplete="off"> Choose

                        </label>



                        </div><!-- BUTTON BOX-->

                    </div>

                </div>



                <div class="col-md-3 col-md-4">

                    <div class="pricingTable">

                        <div class="pricingTable-header">

                            <span id="logo" class="">

                            <a href="<?php echo base_url(); ?>" class="scrollto"> <img src="<?php  echo base_url('assets/images/subscription/gold.png'); ?>" height="55px" alt="gold"> </a> 

                            </span>

                            <span class="heading">

                               Gold

                            </span>

                        </div>

                        <div class="pricing-plans">

                            <span class="price-value"><i class="fa fa-usd"></i><span>20</span></span>

                            <span class="subtitle">Lorem ipsum dolor</span>

                        </div>

                        <div class="pricingContent">

                            <ul>

                                <li><b>50</b> Bids Per Month</li>

                                <li><b>100</b>Skills</li>

                                <li><b>Unlimited</b> Project Bookmarks</li>

                                <li><b></b> Unlock Rewards</li>

                                <li><b></b> Preferred Freelancer Eligible*</li>

                            </ul>

                        </div><!-- /  CONTENT BOX-->



                        <div class="pricingTable-sign-up"><!-- BUTTON BOX-->

                            <!-- <a href="<?php echo base_url(); ?>subscription/payment/3" class="btn btn-block btn-default">buy now</a> -->

                        <label class="btn btn-outline-primary">

                        <input type="radio" name="membership" value="3" id="option3" autocomplete="off"> Choose

                        </label>

                        </div><!-- BUTTON BOX-->

                    </div>

                </div>



                <div class="col-md-3 col-md-4">

                    <div class="pricingTable">

                        <div class="pricingTable-header">

                            <span id="logo" class="">

                            <a href="<?php echo base_url(); ?>" class="scrollto"> <img src="<?php  echo base_url('assets/images/subscription/platinum.png'); ?>" height="55px" alt="platinum"> </a> 

                            </span>

                            <span class="heading">

                                Platinum

                            </span>

                        </div>

                        <div class="pricing-plans">

                            <span class="price-value"><i class="fa fa-usd"></i><span>30</span></span>

                            <span class="subtitle">Lorem ipsum dolor</span>

                        </div>

                        <div class="pricingContent">

                            <ul>

                                <li><b>Unlimited</b> Bids Per Month</li>

                                <li><b>Unlimited</b>Skills</li>

                                <li><b>Unlimited</b> Project Bookmarks</li>

                                <li><b></b> Unlock Rewards</li>

                                <li><b></b> Preferred Freelancer Eligible*</li>

                            </ul>

                        </div><!-- /  CONTENT BOX-->



                        <div class="pricingTable-sign-up"><!-- BUTTON BOX-->

                            <!-- <a href="<?php echo base_url(); ?>subscription/payment/4" class="btn btn-block btn-default">buy now</a> -->

                        <label class="btn btn-outline-primary">

                        <input type="radio" name="membership" value="4" id="option4" autocomplete="off"> Choose

                        </label>

                        </div><!-- BUTTON BOX-->

                    </div>

                </div>

                </div>

            </div>

            
        <br>
        <button type="submit" id="btnSubmit" class="ProceedBtn">Proceed <i class="fa  fa-long-arrow-right "></i></button>

        </form>



        </div>

    </div>