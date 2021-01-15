
<main id="main"> 
  <!--==========================
      ConterDiv Section
    ============================-->
  <section id="postDiv">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
          <div class="task_Left">
            <div class="uiDiv">
              <h2>Earnings <?php echo ' - '. $this->uri->segment(2) ?></h2>

          <div class="mbl-table-nine">
            <div class="mbldiv-scroll">
              <table class="table">
                <thead>
                  <tr>
                    
                    <th>Date</th>
                    <th>Project Name</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="dataList">
                <!-- Display posts list -->
			            <?php if(!empty($posts)){ foreach($posts as $row){ ?>
                  <tr>
                  	<td> <?php   echo date('Y-m-d',strtotime($row["created_date"])); ?></td>
                    <td><?php  echo $row["task_name"]; ?></td>
                    
                    <td><?php  echo $row["amount"]; ?></td>
                    <td><a data-toggle="tooltip" data-placement="top" title="withdraw"><i class="fa fa-money" style="font-size:24px;"></i></a> 
                        <a data-toggle="tooltip" data-placement="top" title="Details" href="<?php echo base_url() ;?>hired-job-details/<?php  echo $row['user_task_id'] ;?>">
                          <i class="fa fa-eye" style="font-size:24px;" aria-hidden="true"></i>
                          </a>
                  </td>
                    
                  </tr>
                  <!-- <tr>
                    <td><img src="img/cal-img.png" alt=""> 10/12/2019 </td>
                    <td>UI Design</td>
                    
                    <td>$50</td>
                  </tr> -->
                    <?php } }else{ ?>
                    <tr><td  colspan="4"><p>Records not found...</p></td></tr>
                  <?php } ?>
                     
                  
                </tbody>
              </table>
              
            </div>
            
          </div>
          
        </div>
        
      </div>
    </div>
    </div>
  </section>
</main>
<div class="myModal-newdiv">
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content"> 
        
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Raise Problem</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="bod-sec">
            <h2> Frelancer </h2>
            <div class="img2-ses"> <span> <img src="img/view-all-offers-img.jpg" alt="img">
              <div class="round"></div>
              </span>
              <div class="caption">
                <h3> Bob Frapples </h3>
                <p> Sydney, NSW, Australia </p>
                <small>+ 2 Coins </small> 
                <small>- 2 Coins </small> 
                
                </div>
            </div>
            <div class="radiodiv">
              <ul>
                <li>
                  <label class="containerdiv"> I am not happy with the freelancer
                    <input type="radio" checked="checked" name="radio">
                    <span class="checkmark"></span> </label>
                </li>
                <li>
                  <label class="containerdiv"> Other reason
                    <input type="radio" checked="checked" name="radio">
                    <span class="checkmark"></span> </label>
                </li>
              </ul>
              <textarea rows="" cols="" placeholder="Describe your  problem here"></textarea>
              <div class="attach">
                <ul id="media-list" class="clearfix">
                  <li> <img src="img/add-plus-img2.jpg" alt="img"> </li>
                  <li class="myupload"> <span><i class="fa fa-plus" aria-hidden="true"></i>
                    <input type="file" click-type="type2" id="picupload" class="picupload" multiple="">
                    </span> </li>
                </ul>
              </div>
            </div>
            <div class="note"> <span> <img src="img/img-sec2.png" alt="img"> </span>
              <p> Note: Nlauncer support team will fix the problem through
                call or chat with both buddy with in 4 to 5 days </p>
            </div>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal"> Send it to Hire-n-Work </button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="myModal-newdiv2">
  <div class="modal" id="myModal6">
    <div class="modal-dialog">
      <div class="modal-content"> 
        
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add milestone</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="add-mileston">
            <li class="row">
              <div class="col-lg-4 col-md-12 col-xs-12">
                <label>Title</label>
                <input type="text" class="form-control" placeholder="Wire Frame Design">
              </div>
              <div class="col-lg-4 col-md-12 col-xs-12">
                <label>Due Date</label>
                <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                  <input class="form-control" type="text" value="2012-12-12" readonly="">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span> </div>
              </div>
              <div class="col-lg-4 col-md-12 col-xs-12">
                <label>Amount</label>
                <div class="input-group amt"> <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                  <input class="form-control" type="text" placeholder="250" style="border:none; padding-left:0;">
                </div>
              </div>
              <div> </div>
            </li>
            <div class="radiodiv">
              <ul>
                <li>
                  <label class="containerdiv"> Deposit the fund later
                    <input type="radio" checked="checked" name="radio">
                    <span class="checkmark"></span> </label>
                </li>
                <li>
                  <label class="containerdiv"> Deposit the fund Now
                    <input type="radio" checked="checked" name="radio">
                    <span class="checkmark"></span> </label>
                </li>
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal"> Add </button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="myModal-newdiv3">
  <div class="modal" id="myModal7">
    <div class="modal-dialog">
      <div class="modal-content"> 
        
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Date</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="add-mileston">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <label>Select Date</label>
                <div id="ChangeDatePicker" class="input-group date" data-date-format="dd-mm-yyyy">
                  <input class="form-control" type="text" value="" readonly="">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span> </div>
              </div>
              <div> </div>
            </div>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal"> Save </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- jQuery library -->
<!-- <script src="<?php //echo base_url('assets/js/jquery.min.js'); ?>"></script> -->
	
<!-- 
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script> -->