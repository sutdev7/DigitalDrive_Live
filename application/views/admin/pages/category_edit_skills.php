<!-- Content Wrapper. Contains page content -->
    
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Category Skills Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url().'admin/dashboard'?>">Home</a></li>
              <li class="breadcrumb-item active">Add Category Skills</li>
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
		<form action="<?= base_url().'admin/category_skills_update' ?>" method="post">
		<input type="hidden" name="row_id" value="">
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-info card-outline">
					<div class="card-header">Details</div>
					<div class="card-body">
						<div class="form-group row">
							<label for="name" class="col-sm-2 col-form-label">Selct Category</label>
							<div class="col-sm-8">
							  
							  <select class="form-control" name="parent_id">
							  	<option vaue="0">Parent Catgory</option>
							  	<?php foreach($skill_catgory_data as $row){?>
							  	
							  	<option value="<?=$row->category_id;?>" <?php if($row->category_id == $catgory_data->parent_id) echo 'selected="selected"'; ?> > <?php echo $row->category_name; ?></option>
							  <?php }?>
							  </select>
							</div>
						</div>

						<div class="form-group row">
							<label for="detail" class="col-sm-2 col-form-label">Category Name</label>
							<div class="col-sm-8">
							  <input type="text" name="category_name" class="form-control" value="<?=$catgory_data->category_name?>" placeholder="Enter ...">
							   <input type="hidden" name="category_id" class="form-control" value="<?=$catgory_data->category_id?>" placeholder="Enter ...">
							</div>
						</div>
						
						<div class="col-md-6 offset-md-2">
							<input type="submit" name="submit" value="Update Catgory" class="btn btn-success">
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
  
  
  