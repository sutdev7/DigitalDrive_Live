<!-- Content Wrapper. Contains page content -->
  
  
  <?php 
	//echo "<pre>"; print_r($info); exit(); 
	if(!empty($info) && count((array)$info)>0){
		$user_type = $info->user_type;
		$name = $info->name;
		$gender = trim($info->gender);
		$date_of_birth =$info->date_of_birth;
		$bio = $info->bio;
		$mobile = $info->mobile;
		$country = $info->country;
		$state =$info->state;
		$city = $info->city;
		$address = $info->address;
		$email = $info->email;
		$profile_title = $info->profile_title;
		$profile_title_skill = $info->profile_title_skill;
		$status = $info->status;
		$profile_status = $info->profile_status;


	} else{
		$user_type=$name=$gender=$date_of_birth=$bio=$mobile=$country=$state=$city=$address="";
		$email=$profile_title=$profile_title_skill=$status =$profile_status="";
	}
?>
  
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url().'admin/dashboard'?>">Home</a></li>
			  <li class="breadcrumb-item active">Edit User</li>
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
		<form action="<?= base_url().'admin/edit_user_info' ?>" method="post">
		<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
		<input type="hidden" name="user_type" value="<?php echo $user_type; ?>">
        <div class="row">
			<div class="col-lg-6">
				<div class="card card-info card-outline">
					<div class="card-header">Basic Info</div>
					<div class="card-body">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $name; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="gender" class="col-sm-4 col-form-label">Gender</label>
							<label class="radio-inline">
							  <input type="radio" id="gender" name="gender" value="F" <?php if($gender=='F'){ echo 'checked';} ?> > Female
							</label>
							<label class="radio-inline">
							  <input type="radio" id="gender" name="gender" value="M" <?php if($gender=='M'){ echo 'checked';} ?> > Male
							</label>
							<label class="radio-inline">
							  <input type="radio" id="gender" name="gender" value="O"  <?php if($gender=='O') { echo 'checked';} ?> > Other
							</label>
						</div>
						<div class="form-group row">
							<label for="date_of_birth" class="col-sm-4 col-form-label">Date of Birth</label>
							<div class="col-sm-8">
							  <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="<?php echo $date_of_birth; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="bio" class="col-sm-4 col-form-label">Bio</label>
							<div class="col-sm-8">
							  <textarea class="form-control" rows="2" placeholder="Enter ..." name="bio"><?php echo $bio; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="mobile" class="col-sm-4 col-form-label">Mobile</label>
							<div class="col-sm-8">
								<input type="number" class="form-control" id="mobile" placeholder="Mobile" name="mobile" value="<?php echo $mobile; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="card card-info card-outline">
					<div class="card-header">Location</div>
					<div class="card-body">
						
						<div class="form-group row">
							<label for="country_id" class="col-sm-4 col-form-label">Country</label>
							<div class="col-sm-8"> 
								<select class="form-control select2" id="country_id" name="country">
									<option value="">-Select-</option>
								<?php 
									
									if(!empty($countrylist)){
										foreach($countrylist as $row){ ?>

										<option value="<?= $row->country_id ?>" <?= ($country == $row->country_id ) ? 'selected' : '' ?> ><?= $row->name ?></option>
										<?php	
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="state" class="col-sm-4 col-form-label">State</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="state" placeholder="State" name="state" value="<?php echo $state; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="city" class="col-sm-4 col-form-label">City</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="city" rows="3" placeholder="Enter city" name="city" value="<?php echo $city; ?>" />
							</div>
						</div>
						<div class="form-group row">
							<label for="address" class="col-sm-4 col-form-label">Address</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="address" rows="2" placeholder="Enter ..." name="address"><?php echo  $address; ?></textarea>
							</div>
						</div>
						
					</div>
				</div>
			</div>

			<!-- <div class="col-lg-6">
				<div class="card card-info card-outline">
					<div class="card-header">Profile Pic</div>
					<div class="card-body">
						<div class="form-group row">
							<label for="exampleInputFile">Image</label>
							<input type="file" id="exampleInputFile">
							<p class="help-block">Only .png,.jpeg,.jpg file allows</p>
						</div>
					</div>
				</div>
			</div> -->
			<div class="col-lg-6">
				<div class="card card-info card-outline">
					<div class="card-header">Login Credentials</div>
					<div class="card-body">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword3" class="col-sm-4 col-form-label">Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
							</div>
						</div>
					    <div class="form-group row">
							<label for="inputPassword3" class="col-sm-4 col-form-label">Confirm Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="inputPassword4" placeholder="Confirm Password" name="cpassword">
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card card-info card-outline">
					<div class="card-header">Other Details</div>
					<div class="card-body">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Title</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="profile_title" placeholder="Profile Title" name="profile_title" value="<?php echo $profile_title; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="task_keywords" class="col-sm-4 col-form-label">Skills</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="profile_title_skill" placeholder="Task Keywords" name="profile_title_skill" value="<?php echo $profile_title_skill; ?>" >
							</div>						
						</div>
						
					</div>
				</div>
			</div>

		</div>
		<div class="row">
			
			
			<div class="col-lg-6">
				<?php 
					//echo "<pre>"; print_r($bankinfo); exit(); 
					if(!empty($bankinfo) && count((array)$bankinfo)>0){
						$account_number = $bankinfo->account_number;
						$account_name = $bankinfo->account_name;
						$bank_name = $bankinfo->bank_name;
						$ifsc_code = $bankinfo->ifsc_code;
					} else{
						$account_number=$account_name=$bank_name=$ifsc_code="";
					}
				?>
				<div class="card card-info card-outline">
					<div class="card-header">Bank Information</div>
					<div class="card-body">
						<div class="form-group row">
							<label for="account_number" class="col-sm-4 col-form-label">Account Number</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="account_number" placeholder="Account Number" name="account_number" value="<?php echo $account_number ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="account_name" class="col-sm-4 col-form-label">Account Holder Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="account_name" placeholder="Account Holder Name" name="account_name" value="<?php echo $account_name; ?>">
							</div>							
						</div>
						<div class="form-group row">
							<label for="bank_name" class="col-sm-4 col-form-label">Bank Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="bank_name" placeholder="Bank Name" name="bank_name" value="<?php  echo $bank_name;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="ifsc_code" class="col-sm-4 col-form-label">IFSC CODE</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="ifsc_code" placeholder="IFSC CODE" name="ifsc_code" value="<?php echo $ifsc_code; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			
		</div>
		<div class="row">
		<?php $i=1;
		//echo "<pre>"; print_r($portfolioData); exit();
		if(!empty($portfolioData) && count($portfolioData)>0){

			foreach($portfolioData as $row){ ?>
				<div class="col-lg-6">
					<div class="card card-info card-outline">
						<div class="card-header">Portfolio <?php echo $i;?></div>
						<div class="card-body">
							<div class="form-group row">
								<label for="portfolio_name" class="col-sm-4 col-form-label">Profile Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="portfolio_name" placeholder="Portfolio name" name="portfolio_name[<?php echo $row->id;?>]" value="<?php echo $row->portfolio_name;?>" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="portfolio_url" class="col-sm-4 col-form-label">Profile Url</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="portfolio_url" placeholder="Portfolio url" name="portfolio_url[<?php echo $row->id;?>]" value="<?php echo $row->portfolio_url;?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="portfolio_desc" class="col-sm-4 col-form-label">Profile Description</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo $row->portfolio_desc;?>" id="portfolio_desc" placeholder="Portfolio Desc" name="portfolio_desc[<?php echo $row->id;?>]">
								</div>
							</div>	
							<?php if($row->portfolio_image !=""){ $portfolio_image = $row->portfolio_image;  ?>
							<div class="form-group row" id="<?php echo $row->id; ?>" >
								<label for="portfolio_image" class="col-sm-4 col-form-label">Portfolio Images</label>
								<div class="col-sm-8">
									<img src="<?php echo base_url() ?>/uploads/user/portfolio_image/<?php echo $portfolio_image; ?>" alt="portfolio_image" width="300" height="150">
									<p><i class="fa fa-trash delPortfolioimg" data-imgid="<?php echo $row->id; ?>"></i></p>
								
								</div>
							</div>	
							<?php } ?>
						


						</div>
					</div>
				</div>
		<?php 
			$i++;
			} 
		}
		?>
			</div>
			
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-info card-outline">
					<div class="card-footer">
						<div class="icheck-success d-inline" style="margin-right: 132px;">
							<input type="checkbox" id="checkboxSuccess1" name="status" <?php echo ($status==1) ? 'checked' : '' ?> value="1">
							<label for="checkboxSuccess1">Click to actived user</label>
						</div>

						<?php if($user_type == 4){?>
							<div class="icheck-success d-inline">
								<input type="checkbox" id="checkboxSuccess2" name="profile_status" <?php echo ($profile_status==1) ? 'checked' : '' ?> value="1">
								<label for="checkboxSuccess2">Click to profile actived user</label>
							</div>
                        <?php } ?>


						<input type="submit" name="submit" value="submit" class="btn btn-success float-right">
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
<script type="text/javascript">
	var URL = "<?php echo base_url();?>";
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
	
  });

  $(".delPortfolioimg").click(function(){
  		$imgId = $(this).attr('data-imgid');
  		if(confirm("Are you sure want to delete")){
  			$.ajax({
	          url:URL+'admin/deleteProtfolioImg', 
	          method:'POST',
	          dataType:'json',
	          data : {'imgId':$imgId},		          
	          success: function(res){ 
	            if(res['status'] == 'Success'){
	            	alert(res['msg']);
	              $("#"+$imgId).hide();
	            } 
	          }
	        });
        }
  });
</script> 
  
  
  