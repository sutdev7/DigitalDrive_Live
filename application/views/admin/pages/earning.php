<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= ucwords(str_replace('_',' ',$this->uri->segment(2))) ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= ucwords(str_replace('_',' ',$this->uri->segment(2))) ?></li>
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
					  <h3 class="card-title"><?= ucwords(str_replace('-list',' ',$this->uri->segment(2))) ?></h3>
					  <?php 
						if($this->uri->segment(2) =='client-list'){
							$user_type_val = 'c';
						}else{
							$user_type_val = 'f';
						}
					  ?>
					  <!-- <a class="btn btn-info float-right btn-sm" href="<?= base_url().'admin/user/add/'.base64_encode($user_type_val) ?>"><i class="fa fa-plus"></i> Add</a> -->
					</div>

					<!-- /.card-header -->

					<div class="card-body"><?php echo $this->session->userdata('msg'); ?>
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
                            <tr>         
                                <th>Date</th>
                                <th>Project Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
						</thead>
						<tbody>
						<?php

						
						if(!empty($inescrowdata)){ $count = 1;
							foreach($inescrowdata as $row){
							?>
							<tr>
                                <td> <?php  echo date('Y-m-d',strtotime($row["created_date"])); ?></td>
                                <td><?php  echo $row["task_name"]; ?></td>
                                
                                <td><?php echo $row["amount"]; ?></td>
                                <td><?php echo $row["payment_status"]; ?></td>
                                <td><a data-toggle="tooltip" data-placement="top" title="withdraw" 
                                href="<?php echo base_url(); ?>razorpay/refund/<?php echo $row['id'] ;?>"><i class="fa fa-money" style="font-size:24px;"></i></a> 
                                    <a data-toggle="tooltip" data-placement="top" title="Details" 
                                    href="<?php echo base_url() ;?>hired-job-details/<?php echo $row['user_task_id'] ;?>">
                                    <i class="fa fa-eye" style="font-size:24px;" aria-hidden="true"></i>
                                    </a>
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
						<td>Sl No.</td>
                        <th>Project Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
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

	$('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

	$('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
  });

  </script>

  

  