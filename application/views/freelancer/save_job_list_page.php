<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$msg = $this->session->flashdata('msg'); 
$frmValidationMsg = validation_errors(); 
?>
<div class="browser-taskDiv pt-4">
    <div class="container">
        <?php 
        if(!empty($msg)) { ?> <section> <?php echo $msg; ?> </section> <?php }
        if(!empty($frmValidationMsg)) { ?> <section> <?php echo $frmValidationMsg; ?> </section> <?php } ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="browser-top">
                    <div class="browser-lft">
                        <h2> My Saved Jobs List </h2>
                    </div>
                    
                </div>
                {jobs}
                <div class="task_Left_Div task_Left_Div-new">
                    <div class="key-list-main">
                        <div class="key-l-left">
                            <a href="<?= base_url().'job-details/{user_task_id}' ?>">
                                <h3>{task_name}</h3>
                            </a>
                            <small>
                                <span class="mr-3">Posted on {task_doc}</span>
                                <span><i style="color:#b93f3f;" class="fa fa-map-marker mr-2"></i>{task_origin_country}</span>
                            </small>
                        </div>
                        <div class="key-l-right">
                            <div class="view-box-two-box-rht">
                            {send_sent_proposal_link}
                                    <!-- <a href="<?= base_url().'job-details/{user_task_id}' ?>" class="view-btn">Send Proposal</a> -->
                            </div>
                        </div>
                    </div>


                    <p> {task_details}
                        <!-- <a href="#"> More </a> -->
                    </p>
                    <h4> Skills</h4>

                    <span> {task_requirements}<a href="#">{skill_name}</a> {/task_requirements}</span>
                    <div class="task_info"> <span>
                            <h5>Budget</h5>
                            <em>{task_total_budget}</em>
                        </span> <span>
                            <h5>Offers</h5>
                            <em>{offer_count} Offer(s)</em>
                        </span> <span>
                    </div>
                </div>
                {/jobs}

                <div class="pag">{links}</div>
                <!--
        <div class="pag">
          <ul class="pagination" style="margin-top:20px;">
            <li class="previous"><a href="#">Previous</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <li class="next"><a href="#">Next</a></li>
          </ul>
        </div>-->


            </div>
        </div>
    </div>
</div>
