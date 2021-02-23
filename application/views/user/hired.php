<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
  .ongoing-task .table tbody td p {
    font-size: 18px !important;
    margin-bottom: 0;
}
</style>

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
            <li class="breadcrumb-item active" aria-current="page">Hired</li>
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
          ?>
    <div class="full" style="width:100%; float:left; position:relative;">
      <?php $this->load->view('user/molivi-section.php') ?>
      <div class="ongoing-task">
        <!-- <div class="ongoing-task-lft">
            <label>Sort by Status</label>
            <div class="select-style">
              <select>
                <option>All</option>
                <option>Save proposal</option>
                <option>recent Proposal</option>
                <option>Previous Freelancer</option>
                <option>Agency</option>
                <option>Freelancer</option>
              </select>
            </div>
          </div>
        <div class="ongoing-task-rht">
          <div class="input-group-sec">
            <div class="input-group">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit"> <img src="<?php echo base_url(); ?>assets/img/search.png" alt="img"></button>
              </div>
              <input type="text" class="form-control" placeholder="Seacrh by title, Skill or any key word" name="search">
            </div>
          </div>
          <span> <a href="#TaskFilter" data-toggle="modal" class="Filter-open"> <img src="<?php echo base_url(); ?>assets/img/filter-img.png" alt="img">Filter</a></span> </div> -->
        <div class="clearfix"></div>
          <h3>Hired</h3>
        <div class="mbl-table">
          <table class="table">
            <thead>
              <tr>
                <th>Freelancer</th>
                <th>Title</th>
                <th>Due Date</th>
                <th>Budget</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              {jobs}              
              <tr>
                <td>
                  <div class="annadiv"> 
                    <span> <img src="{user_image}" alt="{freelancer_name}" style="width:45px;height:45px;"> </span>
                    {is_online}
                   <h3><p> {freelancer_name}</p> </h3>
                    <p> <img style="height: 18px;" src="<?php  echo base_url('assets/img/round-img1.png'); ?>" alt=""/> {freelancer_country} </p>
                  </div>
                </td>
                <td><h3><p>{task_name}</p></h3></td>
                <td><h3><p>{task_due_date}</p></h3></td>
                <td><h3><p> ${task_total_budget}</p></h3></td>
                <td><a href="<?php echo base_url().'view-contract/' ?>{hired_id}" class="btn btn-primary"> View Contract </a></td>
              </tr>
              {/jobs}
            </tbody>
          </table>
        </div>
        <div class="pag">
          {links}
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
</main>

<!-- The Modal -->
<div class="modal CmnModal FliterModal" id="TaskFilter">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <!-- Modal Header -->
      <div class="modal-header"> 
        <!--<h2>Budget</h2> -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="filterdiv">
          <h3>Filter</h3>
          <div class="row">
            <div class="col-md-4">
              <div class="filterdiv-sec"> <span>
                <label>By Title</label>
                <input class="form-control" type="text" placeholder="By Title">
                </span> </div>
            </div>
            <div class="col-md-4">
              <div class="filterdiv-sec"> <span>
                <label>By Skill</label>
                <input class="form-control" type="text" placeholder="Skill">
                </span> </div>
            </div>
            <div class="col-md-4">
              <div class="filterdiv-sec">
                <div class="radiodiv" style="padding-top:0;"> <span>
                  <label> By Freelancer type </label>
                  <ul>
                    <li>
                      <label class="containerdiv">Key
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span> </label>
                    </li>
                    <li>
                      <label class="containerdiv">Agency
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span> </label>
                    </li>
                  </ul>
                  </span> </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="filterdiv-sec"> <span>
                <label>By Date Created</label>
                <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                  <input class="form-control" type="text" value="" readonly="">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span> </div>
                </span> </div>
            </div>
            <div class="col-md-4">
              <div class="filterdiv-sec"> <span>
                <label>By Freelancer Name</label>
                <input class="form-control" type="text" placeholder="Enter Name">
                </span> </div>
            </div>
            <div class="col-md-4">
              <div class="filterdiv-sec"> <span>
                <label>By Budget ($)</label>
                <input class="PriceRange" type="text" min="0" max="100" value="0,50" name="points" step="1" />
                </span> </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer"> <a href="#" class="Terms_Btn" data-dismiss="modal">Show Result</a> <a href="#" class="">Clear All</a> </div>
    </div>
  </div>
</div>

<script src="<?php  echo base_url('assets/js/jquery-asRange.js'); ?>"></script> 
<script>
$(document).ready(function() {
  $(".PriceRange").asRange({
  range: true,
  limit: false
  });
});
</script>
