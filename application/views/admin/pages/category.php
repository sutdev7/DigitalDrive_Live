<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Skills Category List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Skills Category List</li>
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
					  <h3 class="card-title">List of Skills Category</h3>
					  <a class="btn btn-info float-right btn-sm" href="<?= base_url().'admin/category_add_skills'?>"><i class="fa fa-plus"></i> Add</a> 
					</div>
					<!-- /.card-header -->
					<div class="card-body"><?php echo $this->session->userdata('msg'); ?>
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <td width="10%">Sl No.</td>
						  <th width="30%">Category Name</th>
						  <!-- <th>Sub Category</th> -->
						 <!--  <th width="10%" align="center">Details Sub Category </th> -->
						  <th width="10%">Action</th> 
						</tr>
						</thead>
						<tbody>
						<?php
						
						if(!empty($categorylist)){ $count = 1;
							foreach($categorylist as $row){
							?>
							<tr>
							  <td><?= $count++ ?></td>
							  <td><?php  
							  if($row->parent_id==0){
							  	echo $row->category_name ;
								}else{
									$cat = $row->parent_id;
									 //$subcategorylist = $this->Admimodel->get_sub_category($cat_name);
									 $subcategorylist = $this->Admimodel->get_sub_category($cat);
									echo $row->category_name.'('.$subcategorylist->category_name.')' ;
								}
							  ?></td>
							 <!--  <td><?php 
							 $cat_name=$row->category_id;
							  $subcategorylist = $this->Admimodel->get_sub_category($cat_name);
							  foreach ($subcategorylist as $key => $value) {
							  	echo $value->category_name.",";
							  }
							  ?></td> -->
							 
							  <td>
								
								

								<div class="btn-group">
									<a type="button" class="btn btn-info" title="Edit" href="<?= base_url().'admin/category_edit_skills/'.$row->category_id ?>"><i class="fa fa-edit"></i></a>
								</div>
								<div class="btn-group">
									<a type="button" class="btn btn-danger" title="Delete" href="<?= base_url().'admin/delete_catgory/'.$row->category_id ?>" onClick="return confirm('Do you want to delete ?');"><i class="fa fa-trash"></i></a>
								</div>
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
						  <!-- <th>Sub Category</th> -->
						  
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
			url: "<?= base_url()?>admin/change_status",
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
  
/*  
$('#example1').DataTable({
	"order": [[0, "asc"]],
	
	"fnDrawCallback": function() {
		$('.catstatus').bootstrapSwitch({
			onText: 'ON',
			offText: 'OFF',
			onColor: 'success',
			offColor: 'danger',
			onSwitchChange: function (event, state) {

				$(this).val(state ? '0' : '1');

				var pk = $(this).data('key');
				
				var action = $(this).val(); alert(action)
				$.ajax({
					url: "<?= base_url()?>admin/change_status",
					type: "POST",
					data: {
						pk: pk,
						action: action,
						_token: '{{csrf_token()}}',
						_method: 'POST'
					},
					beforeSend: function() { $('#wait').show(); },
					complete: function() { $('#wait').hide(); }
					success: function (data) {
						
						toastr.success(data);
					}
				});
			}
		});
	}
});
  
 */ 
  
  
  
  </script>
  
  