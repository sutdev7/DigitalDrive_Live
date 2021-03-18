<!-- Content Wrapper. Contains page content -->
  
  <?php
	$user_type = $problem_type = $fid = $status = '';
	
	if(!empty($info)){ //echo '<pre>'; print_r($info); die; 
		$name = $info->user_type;
		$problem_type = $info->problem_type;
		$rowid = $info->fid;
		$status = $info->status;
		
		
	}
  ?>
  
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Issue Category Details<?echo $status;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url().'admin/dashboard'?>">Home</a></li>
              <li class="breadcrumb-item active">Edit ISsue Category</li>
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
		<form action="<?= base_url().'admin/issuecategory_edit' ?>" method="post">
		<input type="hidden" name="row_id" value="<?=$rowid?>">
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-info card-outline">
					<div class="card-header">Details</div>
					<div class="card-body">
						<div class="form-group row">
							<label for="status" class="col-sm-2 col-form-label">User Type</label>
							<div class="col-sm-8">
							  <select class="form-control" name="user_type" id="user_type">
								<option value="3" <?= ($name ==3) ? 'selected' : '' ?> >Client</option>
								<option value="4" <?= ($name ==4) ? 'selected' : '' ?> >Freelincer</option>
							  </select>
							</div>
						</div>
						<div class="form-group row">
							<label for="detail" class="col-sm-2 col-form-label">Detail</label>
							<div class="col-sm-8">
							 
							  <input type="text" class="form-control" id="problem_type" value="<?=$problem_type?>" placeholder="Problem Type" name="problem_type"  required="required">
							</div>
						</div>
						
						
						
						
						
						<div class="col-md-6 offset-md-2">
							<input type="submit" name="submit" value="Update" class="btn btn-success">
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
  $(function () {
    //$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
	$('#dob').datepicker();
	
    $("#example1").DataTable();
	//Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
	
	$('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
	
	$('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
	
  })
</script> 
  
  
  