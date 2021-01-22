<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main id="main"> 
    <?php
    $msg = $this->session->flashdata('msg');
    if (!empty($msg)) {
        ?>
        <section style="padding-top: 7%;">
            <?php echo $msg; ?>
        </section>
        <?php
    }
    ?>
    <style>

        .task_Right_Div .media .pull-left { position:relative; }

        .task_Right_Div .media .pull-left span {
            background: 
                #ccc;
            width: 16px;
            height: 16px;
            position: absolute;
            border-radius: 15px;
            left: 66px;
            border: 2px solid
                #f6f8fa;
        }
        .task_Right_Div .media .pull-left span .green{
            background: 
                #34c635;
            width: 16px;
            height: 16px;
            position: absolute;
            border-radius: 15px;
            left: 66px;
            border: 2px solid
                #34c635;
        }
        #mproposal_details_modal .to-close p,
        #mproposal_details_modal .black_color{
            color: #000;
        }

    </style>

    <!--==========================
        ConterDiv Section
      ============================-->

    <section id="postDiv">
        <div class="container">
            {task_info}      
            <div class="row">
                <div class="col-lg-8">
                    <div class="task_Left">
                        <!--<nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php /*echo base_url(); */?>dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Job Details</li>
                            </ol>
                        </nav>-->
                        <?php 
                            $datetime1 = new DateTime();
                            $datetime2 = new DateTime($interval);
                            $interval = $datetime1->diff($datetime2);
                            $interval_year=$interval->format('%y');
                            $interval_month=$interval->format('%m');
                            $interval_day=$interval->format('%a');
                            $interval_hour=$interval->format('%h');
                            $interval_min=$interval->format('%i');
                            $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                        ?>
                        <div class="task_Left_Div">
                            <h2>Posted 
                                <?php 
                                    if($interval_hour>0){
                                        echo $interval->format('%h hours');
                                    }else if($interval_day>0){
                                        echo $interval->format('%a days');
                                    }
                                    else if($interval_month>0){
                                        echo $interval->format(' %m months');
                                    }
                                    else if($interval_year>0){
                                        echo $interval->format('%y years');
                                    }
                                    else if($interval_min>0){
                                        echo $interval->format('%i minutes');
                                    }
                                    else{
                                        echo $interval->format('%s seconds');
                                    }

                                ?>
                             ago</h2>
                            <h3>{task_title}</h3>
                            <a href="<?= base_url() . 'edit-task-step-1/' . $this->uri->segment(2) ?>" class="EdBtn"><i class="fa fa-pencil" aria-hidden="true"></i></a> <span> 
                                {task_requirements}
                                <a href="#">{skill_name}</a>
                                {/task_requirements}
                            </span>
                            <h4>{task_country}, {task_continent}</h4>
                            <p>{task_details}</p>
                            <div class="task_info"> <span>
                                    <h5>Budget</h5>
                                    <em><i class="fa fa-dollar"></i>{task_total_budget}</em> </span> <span>
                                    <h5>Duration</h5>
                                    <em><i class="fa fa-calendar" aria-hidden="true"></i> {taskDuration}</em> </span> <span>
                                    <h5>Hired</h5>
                                    <em><i class="fa fa-user" aria-hidden="true"></i> {task_freelancer_hire} Hired</em> </span>
                                <span>
                                    <h5>Total Proposals</h5>
                                    <?php
                                    if(count($proposals) > 0) {
                                        ?>
                                        <em onclick="javascript:receivedOffers('{user_task_id}');" style="cursor: pointer;"><i class="fa fa-book" aria-hidden="true"></i><?= count($proposals) ?></em>
                                        <?php
                                    } else {
                                        ?>
                                        <em><i class="fa fa-book" aria-hidden="true"></i><?= count($proposals) ?></em>
                                        <?php
                                    }
                                    ?>
                                </span>             
                            </div>
                            <h2 class="Atta">Attachment</h2>
                            {task_attachments}
                                <a href="<?php echo base_url(); ?>download_file/{file_name}"><img style="padding: 10px; width: 84px; height: 84px;" src="{file_ext_type}" alt=""></a>
                            {/task_attachments}

                            <div class="CommentsDiv">
                                <!--<h5>Comments</h5>-->                    
                                <!--<div class="media anaaDiv-top"> <a class="pull-left" href="<?= base_url() . 'public-profile/' ?>{public_id}"> <img class="media-object img-circle" src="{profile_image}" height="40" width="40"></a>
                                  <div class="media-body">
                                <?php
                                if ($this->session->userdata('user_type') == 3) {
                                    ?>
                                            <!--<h2>  <input type="checkbox" class="checkbox make_offer" id="{user_id}" data-id="" name="make_offer" title="Make Offer">   </h2> -->
                                            <!--  <h2><a target="_blank" href="<?= base_url() . 'public-profile/' ?>{public_id}">{name}</a></h2>
                                    <?php
                                } else {
                                    ?>
                                           
                                    <?php
                                }
                                ?>
                                   -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="offerDiv">
                        
                    </div>
                    <div >
                      <div class="card text-center">
                          <div class="card-header">  <?php echo (isset($hire_list) && $hire_list) ? "<h3>Hired Freelancers</h3>" : "<h3>Top Freelancers</h3>";?></div></div>
                        <ul class="RvwLists">
                            <?php
                            $a_freelancers = array();
                            if(isset($hire_list) && $hire_list){
                                $a_freelancers = $hire_list;
                               
                            } else {
                                $a_freelancers = $top_freelancers;
                            }
                           
                            if (isset($a_freelancers) && !empty($a_freelancers)) {
                                foreach ($a_freelancers as $fRow) {
                                   
                                    if (empty($fRow->profile_image)) {
                                        $user_profile_image = base_url('assets/img/no-image.png');
                                    } else {
                                        $user_profile_image = base_url('uploads/user/profile_image/' . $fRow->profile_image);
                                    }
                                    $ss = $this->Hires->get_freelancer_info_by_id($fRow->user_id);
                                    $a_skils = array();
                                   
                                    ?>
                                    <li>
                                        <div class="PflImgHldrWrpr">
                                            <!-- <div class="Imghldr" style="background:url(<?php echo $user_profile_image; ?>) no-repeat center center; background-size:cover;"></div> -->
                                           <!--  <?php if ($fRow->is_login) { ?>
                                                <img src="<?php echo base_url('assets/img/activeIcon.png'); ?>" alt=""></div>
                                            <?php } ?> -->
                                            <div class="card text-center">
                                            <div class="card-header"><div class="Imghldr" style="background:url(<?php echo $user_profile_image; ?>) no-repeat center center; background-size:cover;"></div>
                                                <h5 class="card-title"><?php echo $fRow->name; ?></h5>
                                                <p class="card-text">
                                                <h6><?php echo isset($ss['user_selected_skills'][0]) ? $ss['user_selected_skills'][0]['skill_name'] : ''; ?></h6>
                                                                                        <h6><?php echo $fRow->country;?></h6>
                                                </p>
                                            
                                            </div>
                                            <div class="card-footer text-muted" style="display: flex"> 
                                                <span class="plus" style="flex:1;margin-top: 21px;">+ <?php echo $fRow->total_positive_coins; ?> Coins</span>
                                                                                        <span id="negetive_coin"> <?php echo $fRow->total_negative_coins; ?> Coins</span>
                                                                                    </div>
                                            </div>
                                        <!-- <div class="Txthldr">
                                            <h2></h2>
                                            
                                           
                                        </div> -->
                                    </li>
                                <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                    if(count($proposals) > 0) {
                        ?>
                        <a href="<?php echo base_url()?>received-offers/{user_task_id}" class="eyeBtn"> <i class="fa fa-eye" aria-hidden="true"></i> Received Offers</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            {/task_info}       
        </div>
    </section>
</main>
<style>
.RvwLists li {
    border-bottom: 1px solid lightgray!important;
}
.RvwWrapper {
    border: 3px solid #46b4e7;
}

.RvwLists li {
    padding: 14px 4px 4px 0!important;
}
span#negetive_coin {
    color: #f30e5c !important;
    font: 400 12px/18px 'Muli', sans-serif;
    background: url(<?php echo base_url(); ?>assets/img/coin2.png) no-repeat 4px 4px !important;
    background-color: #fddbe7 !important;
    float: left;
    padding: 10px 15px 10px 38px;
    border-radius: 30px;
    margin: 15px 20px 0 0;
}
</style>

<script>
    function receivedOffers(user_task_id) {
        location.href= "<?php echo base_url()?>received-offers/"+user_task_id;
    }
</script>