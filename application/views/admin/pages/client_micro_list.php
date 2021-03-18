<!-- Content Wrapper. Contains page content -->
 <style>


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
					<!-- <div class="card-header">
					  <h3 class="card-title"><?= ucwords(str_replace('-list',' ',$this->uri->segment(2))) ?> Details</h3>
					  <?php 
						if($this->uri->segment(2) =='client-list'){
							$user_type_val = 'c';
						}else{
							$user_type_val = 'f';
						}
					  ?>
					  <a class="btn btn-info float-right btn-sm" href="<?= base_url().'admin/user/add/'.base64_encode($user_type_val) ?>"><i class="fa fa-plus"></i> Add</a>
					</div> -->
					<!-- /.card-header -->
					<div class="card-body"><?php echo $this->session->userdata('msg'); ?>
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr >
						  <td>Sl No.</td>
						   <th>Title</th>
						  <th>Client</th>
						 
						  <th>Skills</th>
						  <th>Budget</th>
						  <th>Duration</th>
						  
						  <th>Status</th>
						
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						
						if(!empty($categorylist)){ $count = 1;
							foreach($categorylist as $row){
							?>
							<tr >
							  <td><?= $count++ ?></td>
							  <td><?= $row->title ?></td>
							  <td><?= $row->name ?></td>
							  
							  <td><?php 
							  if(!empty($row->skills)) {
							  $r=strlen($row->skills);
							  	for($i=0;$i<$r;$i++){
							  		$skills_id = $row->skills[$i];
							  		if($skills_id !=','){
							  			$row->skills[$i];
							  			//$skils_name = $this->Admimodel->skills_name($skills_id);
							  			$skils_name =$this->db->get_where('area_of_interest',array('area_of_interest_id'=>$skills_id))->row();
							  			echo $skils_name->name.'<br>';
							  		}
							  		//
							  	}
							  }
							  ?></td>
							  <td>$ <?= $row->budget ?> </td>
							  <td><?= $row->duration ?><?= $row->duration_type ?></td>
							  
							  <td><div class="btn-group">
									 <label class="switch">
	                              <input class="switch-input" type="checkbox" 
								  <?php echo ($row->status == '1') ?  'checked="checked"' : '' ?>/>
	                              <span class="switch-label" data-id =<?= $row->id ?> data-off="deactive" 
	                              data-on="Active" ></span>
	                              <span class="switch-handle"></span> 
	                              </label>
								</div></td>
							 
							<  <td>
								<div class="btn-group">
									<a type="button" class="btn btn-info" title="details Info" href="<?= base_url().'admin/microkey_client_details_page_details/'.($row->id).'/'.($row->user_id) ?>"><i class="fa fa-info"></i></a>
								</div>
								
							  </td> 
							</tr>
							<?php
							}
						}else{
							?>
							<tr><td colspan="">No Data Found</td></tr>
							<?php
						}
						
						?>
						
						</tbody>
						<tfoot>
						<tr>
						  <td>Sl No.</td>
						   <th>Title</th>
						  <th>Client</th>
						 
						  <th>Skills</th>
						  <th>Budget</th>
						  <th>Duration</th>
						  
						  <th>Status</th>
						
						  <th>Action</th>
						</tr>
						</tfoot>
					  </table>
					</div>
					<!-- /.card-body -->
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
  
  <script>
  $(function () {
  	 $('.switch-input').on('change', function() {
	   	
      var isChecked = $(this).is(':checked');
      var selectedData;
      var $switchLabel = $('.switch-label');
     
      var id = $(this).next('.switch-label').attr('data-id');
     
      if(isChecked) {
        selectedData = $switchLabel.attr('data-on');
        selectedData = 1;
      } else {
        valdData = $switchLabel.attr('data-off');
        selectedData = 0;
      }
      
      $.ajax({
			url: "<?= base_url()?>admin/change_status_micro_client/"+id+"/"+selectedData,
			type: "POST",
		
			data: {
				id: id,
				selectedData : selectedData,
				
			},
			
			success: function (data) {
				
				if(data == 1)
				$('.statusmsg').html('<div class="alert alert-success alert-dismissible"> Freelancer status update successfully.</div>');
                                window.location.reload();
			}
		});
    }); 
    $("#example1").DataTable();
	
  });
  </script>
  
  