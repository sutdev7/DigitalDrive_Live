<!-- Content Wrapper. Contains page content -->
 <style>
span a {
    background: #46b4e7;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
    color: #ffffff;
}

.switch {
  position: relative;
  display: block;
  vertical-align: top;
  width: 100px;
  height: 30px;
  padding: 3px;
  margin: 0 10px 10px 0;
  background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
  background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
  border-radius: 18px;
  box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
  cursor: pointer;
}
.switch-input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
.switch-label {
  position: relative;
  display: block;
  height: inherit;
  font-size: 10px;
  text-transform: uppercase;
  background: #eceeef;
  border-radius: inherit;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
}
.switch-label:before, .switch-label:after {
  position: absolute;
  top: 50%;
  margin-top: -.5em;
  line-height: 1;
  -webkit-transition: inherit;
  -moz-transition: inherit;
  -o-transition: inherit;
  transition: inherit;
}
.switch-label:before {
  content: attr(data-off);
  right: 11px;
  color: #aaaaaa;
  text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
  content: attr(data-on);
  left: 11px;
  color: #FFFFFF;
  text-shadow: 0 1px rgba(0, 0, 0, 0.2);
  opacity: 0;
}
.switch-input:checked ~ .switch-label {
  background: #6dc183;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
  opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
  opacity: 1;
}
.switch-handle {
  position: absolute;
  top: 4px;
  left: 4px;
  width: 28px;
  height: 28px;
  background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
  background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
  border-radius: 100%;
  box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-handle:before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -6px 0 0 -6px;
  width: 12px;
  height: 12px;
  background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
  background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
  border-radius: 6px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
}
.switch-input:checked ~ .switch-handle {
  left: 74px;
  box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
 
/* Transition
========================== */
.switch-label, .switch-handle {
  transition: All 0.3s ease;
  -webkit-transition: All 0.3s ease;
  -moz-transition: All 0.3s ease;
  -o-transition: All 0.3s ease;
}
.main_class{
  margin-top: 17px;
}

</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= ucwords(str_replace('-',' ',$this->uri->segment(2))) ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= ucwords(str_replace('-',' ',$this->uri->segment(2))) ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
      <div class="col-12">
        <div class="card">
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
 <section id="postDiv">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="task_Left">
            <div class="task_Left_Div">
              
              <h3 class="mt-0" style="margin-left: 38px;"><?=$title?></h3>

        <p class="mb-3" style="margin-left: 38px;"><?=$microkey_freelicer_name?></p>
                       <span style="margin-left: 38px;"><?=$microkey_skills1?>  </span>
        <div class="mb-3 main_class" style="">
          <ul class="Portfolio_img">
                <li class="w-100 mb-4">
                  <div class="Portfolio_box w-auto h-100"> 
                    <img src="<?=$microkey_image?>" class="w-100 h-100" alt="" style="">
                   <!--  <div class="Por_overlay"> <a href="img/banner.jpg" class="venobox" data-gall="gallery-carousel"> 
                      <img src="{microkey_image}" alt="">
                    </a> <a href="#" class="download"> <img src="img/down.png" alt=""style="width:650px;height:284px;"></a> </div>
                  </div> -->
              <div style="background: url('img/about-us-big-img1.jpg'); background-size: cover; border: 1px solid #dfdfdf; border-radius: 0.25rem ; margin-bottom: 15px">
                    
                  </div>
               <p><?=$microkey_description?></p>
                </li>
                <li class="w-100 mb-4" style="display:flex;">
                  <div class="Portfolio_box" style="flex: 1;margin-left: -28px;">
                  <div class="col-sm-4" > <img style="width:250px" src="<?=$portfolio_img1?>" alt=""></div>
                  
                  </div>
                  <div class="col-sm-8" > 
                    <p><?=$portfolio_desc1?></p>
                    <a href="<?=$portfolio_link1?>">View My Project</a>
                  </div>
                   
                   <hr>
                </li>
                
                <li class="w-100 mb-4" style="display:flex;">

                  <div class="Portfolio_box" style="flex: 1;margin-left: -28px;"><div class="col-sm-4" >  <img style="width:250px" src="<?=$portfolio_img2?>" alt=""></div></div>
                  <div class="col-sm-8" > 
                    <p><?=$portfolio_desc2?></p>
                    <a href="<?=$portfolio_link2?>">View My Project</a>
                  </div>
                  <hr>
                </li>
                
                <li class="w-100 mb-4" style="display:flex;">
                  <div class="Portfolio_box" style="flex: 1;margin-left: -28px;"><div class="col-sm-4 " >  <img style="width:250px" src="<?=$portfolio_img3?>" alt=""></div></div>
                  <div class="col-sm-8" > 
                    <p><?=$portfolio_desc3?></p>
                    <a href="{portfolio_link3}">View My Project</a>
                  </div>
                  <hr>
                </li>
               
                <li class="w-100 mb-4" style="display:flex;">
                  <div class="Portfolio_box" style="flex: 1;margin-left: -28px;"><div class="col-sm-4" >  <img style="width:250px" src="<?=$portfolio_img4?>" alt=""></div></div>
                   <div class="col-sm-8" > 
                    <p><?=$portfolio_desc1?></p>
                    <a href="<?=$portfolio_link1?>">View My Project</a>
                  </div>
                  <hr>
                </li>
                
              </ul>
          <div class="clearfix"></div>
        </div>
              
          
            </div>
            
            
            <div class="task_Left_Div mt-3" style="display:none;">
          <h3 class="mt-0 small">Order Details</h3>
          <h5 class="mb-2 mt-4">I need a UI designer for my Mobile app</h5>
          <small> Posted on 24th January </small>
          <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. <a href="#"> More </a> </p>

          <div class="task_info"> 
        <div class="row">
        <span class="col-sm-4"><h5> Hours to be determined</h5>
                <em> Hourly</em></span>
                <span class="col-sm-4">
                <h5>Project length</h5>
                <em>1 month</em> </span> 
        <span class="col-sm-4">
                <h5>Level</h5>
                <em>Intermediate</em> </span>
      </div>
        </div>
                <button type="submit" class="btn big-btn mt-3 float-right">Confirm this order</button>
              
        </div>
      
          </div>
        </div>
        
       
        
      </div>
    </div>
  </section>
</main>
        </div>
          </div>
        </div>
        <div class="row"></div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  
  