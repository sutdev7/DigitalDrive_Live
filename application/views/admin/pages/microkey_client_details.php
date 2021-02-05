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
            <h1 class="m-0 text-dark"><?= ucwords($page_title) ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= ucwords($page_title) ?></li>
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
          <div class="task_Left_Div">
              <h2>Posted <?php echo timeAgo($created);?></h2>
              <h3><?=$title?></h3>
             
               <span> 
                <?php foreach(array_filter(explode(',',$skills)) as $skillset){ echo '<a href="javascript:void(0);">'.$skillset.'</a>'; }?>
             
                
              </span>
              <h4><?=$country.', '.$continent?></h4>
              <p><?=$description?></p>
              <div class="task_info"> <span>
                <h5>Budget</h5>
                <em><i class="fa fa-dollar"></i><?=$budget?></em> </span> <span>
                <h5>Duration</h5>
                <em><i class="fa fa-calendar" aria-hidden="true"></i> <?=$duration?></em> </span> <span>
                
                <span>
                  <h5>Proposals</h5>

                  <em><i class="fa fa-book" aria-hidden="true"></i><?=$commentArr?></em>
              </span>       
        </div>
       
              <h2 class="Atta"><strong>Attachments</strong></h2>

                 <a href="{file_name}" target="_blank">
                  <?php $fileArr = explode(".",$file_name); 
                    $fileType = $fileArr[count($fileArr)-1];
                    if($fileType == "docx" || $fileType == "doc"){
                      echo '<img style="padding: 10px;width: 100px;" src="'.base_url('assets/image/MicrosoftOffice2007.png').'" alt="Download Doc file" >';
                    }else if($fileType == "pdf"){
                      echo '<img style="padding: 10px;width: 100px;" src="'.base_url('assets/image/Pdf_File_Type.png').'" alt="Download pdf file" >';
                    }else if($fileType == "xls" || $fileType == "xlsx"){
                  
              echo '<img style="padding: 10px;width: 100px;" src="'.base_url('assets/image/xlss.png').'" alt="Download xls file" >';
                    }
            else if($fileType == "jpg" || $fileType == "png"){
                     
              echo '<img style="padding: 10px;width: 100px;" src="'.base_url('assets/image/File_Image.png').'" alt="Download Image file" >';
                    }else{
                      ?>
                      <i class="fa fa-download"></i> Click Here To Download
                    <?php 
                    }
                  ?>
                 </a>
                 
           <?php if($addon_file_url !='' || $addon_file_url != Null || $addon_file_url!='0'){ ?>
           <h2 class="Atta"><strong>Additional Files</strong></h2>
           <h2><strong><a href="<?=$addon_file_url?>" target="_blank"><i class="fa fa-download"></i> Click Here To Download</a></strong></h2>
       <?php } ?>
        
        <div class="CommentsDiv">
        
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
  

  
  