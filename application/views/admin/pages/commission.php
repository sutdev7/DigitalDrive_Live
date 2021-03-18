<!-- Content Wrapper. Contains page content -->
  
  <?php //echo"<pre>";print_r($chargesDetails);exit;?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Commission Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add User</li>
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
		<form action="<?= base_url().'admin/commissionUpdate' ?>" method="post">
		<input type="hidden" name="portal_charge_id" value="<?php echo $chargesDetails[0]['id'];?>">
        <div class="row">
        	<div class="col-lg-12">
        		<?php echo $msg = $this->session->flashdata('msg');?>
			</div>
        </div>
        <div class="row">
        	<div class="col-lg-12">
				<div class="card card-info card-outline">
					<div class="card-header">Basic Info</div>
					<div class="card-body">
						<div class="form-group row">
							<label for="portal_charge" class="col-sm-2 col-form-label">Portal Charge</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" name="portal_charge" id="portal_charge" placeholder="Portal Charge" value="<?php echo $chargesDetails[0]['portal_charge'];?>" required>
							</div>
						</div>

						<div class="form-group row">
							<label for="paypal_charge" class="col-sm-2 col-form-label">Paypal Charge</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" name="paypal_charge" id="paypal_charge" placeholder="Paypal Charge" value="<?php echo $chargesDetails[0]['paypal_charge'];?>" required>
							</div>
						</div>

						<div class="form-group row">
							<label for="razor_charge" class="col-sm-2 col-form-label">Razor Charge</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" name="razorpay_charge" id="razorpay_charge" placeholder="Razor Charge" value="<?php echo $chargesDetails[0]['razorpay_charge'];?>" required>
							</div>
						</div>

						<div class="form-group row">
							<label for="stripe_charge" class="col-sm-2 col-form-label">Stripe Charge</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" name="stripe_charge" id="stripe_charge" placeholder="Stripe Charge" value="<?php echo $chargesDetails[0]['stripe_charge'];?>" required>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<input type="submit" name="submit" value="Update" class="btn btn-success float-center" style="margin-left: 580px;">
			</div>
        </div>
		</form>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  