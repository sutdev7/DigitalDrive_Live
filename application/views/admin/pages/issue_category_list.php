<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Issue Category List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Issue Category List</li>
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
					<div class="card-header">
					  <h3 class="card-title">List of Issue Category</h3>
					  <a class="btn btn-info float-right btn-sm" href="<?= base_url().'admin/issue_category_add'?>"><i class="fa fa-plus"></i> Add</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body"><?php echo $this->session->userdata('msg'); ?>
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <td width="10%">Sl No.</td>
						  <th width="30%">User Type</th>
						  <th>problem_type</th>
						  <th width="10%" align="center">Active/Inactive</th>
						  <th width="10%">Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						
						if(!empty($issuecategorylist)){ $count = 1;
							foreach($issuecategorylist as $row){
							?>
							<tr>
							  <td><?= $count++ ?></td>
							  <td><?php 
							  if($row->user_type==3){
							  	echo "CLient";
							  }else{
							  	echo "Freelincer";
							  }
							   
							    ?></td>
							  <td><?= $row->problem_type ?></td>
							  <td>
								<div class="custom-control custom-switch">
								  <input type="checkbox" name="status" class="custom-control-input activebtn" data-id="<?=$row->fid?>" id="customSwitch<?=$row->fid?>" <?= ($row->status == 1) ? 'checked': '' ?> value="<?= ($row->status == 1) ? '0': '1' ?>" >
								  <label class="custom-control-label" for="customSwitch<?=$row->fid?>"></label>
								  <i class="fa ion-android-sync fa-spin" id="wait<?=$row->fid?>" style="display:none;"></i>
								</div>
							  </td>
							  <td>
								<a type="button" class="btn btn-info" title="Edit" href="<?= base_url().'admin/issuecategory_edit/'.$row->fid?>"><i class="fa fa-edit"></i></a>
							  </td>
							</tr>
							<?php
							}
						}else{
							?>
							<tr><td colspan="5">No Data Found</td></tr>
							<?php
						}
						?>
						</tbody>
						<tfoot>
						<tr>
						  <td>Sl No.</td>
						  <th>Category Name</th>
						  <th>Details</th>
						  <th>Active/Iactive</th>
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
    $("#example1").DataTable();
	$('.activebtn').on('click', function(){
		var pk = $(this).data('id');
		var action = $(this).val(); 
		$.ajax({
			url: "<?= base_url()?>admin/issue_change_status",
			type: "POST",
			data: {
				pk: pk,
				action: action,
				_token: '{{csrf_token()}}',
				_method: 'POST'
			},
			beforeSend: function() { $('#wait'+pk).show(); },
			complete: function() { $('#wait'+pk).hide(); },
			success: function (data) {
				$('#customSwitch'+pk).val(data);
			}
		});
	});
  });

  </script>
  
  