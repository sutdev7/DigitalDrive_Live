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
						<tr >
						  <td>Sl No.</td>
						  <th>Transaction id</th>
						  <th>Task name</th>
						  <th>Payment Type</th>
						  <th>Payment status</th>
						  <th>Total Amount</th>
						  <!-- <th>Currency</th> -->
						  <th>Freelancer id</th>
						  <th>Freelancer email</th> 
						  <!-- <th>Task Duration</th> -->
						  <!-- <th>Action</th> -->
						</tr>
						</thead>
						<tbody>
						<?php

						
						if(!empty($txnlist)){ $count = 1;
							foreach($txnlist as $row){
							?>
							<tr class=<?= ($row->profile_status==0 && $row->user_type ==4) ? 'notactive' : 'active' ?>>
							  <td><?= $count++ ?></td>
							  <td><?= $row->txn_id ?></td>
							  <td><?= $row->task_name ?></td>
							  <td><?= $row->payment_type ?></td>
							  <td><?= $row->payment_status ?></td>
							  <td><?= $row->amount." ".$row->currency_code ?></td>
							  <!-- <td><?= $row->currency_code ?></td> -->
							  <td><?= $row->unique_id ?></td>
							  <td><?= $row->email ?></td>
							  <!-- <td><?= $row->task_duration_type ?></td> -->
							  <!-- <td>
								<div class="btn-group">
									 <a type="button" class="btn btn-info" title="Edit Info" href="<?= base_url().'admin/transaction/edit/'.base64_encode($row->user_id) ?>"><i class="fa fa-edit"></i></a> -->
								<!-- </div>
								<div class="btn-group">
									 <a type="button" class="btn btn-danger" title="Delete" href="<?= base_url().'admin/transaction/delete/'.base64_encode($row->user_id) ?>" onClick="return confirm('Do you want to delete ?');"><i class="fa fa-trash"></i></a> -->
								<!-- </div> --> 
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
						  <th>Transaction id</th>
						  <th>Task name</th>
						  <th>Payment Type</th>
						  <th>Payment status</th>
						  <th>Total Amount</th>
						  <!-- <th>Currency</th> -->
						  <th>Freelancer id</th>
						  <th>Freelancer email</th> 
						  <!-- <th>Task Duration</th> -->
						  <!-- <th>Action</th> -->
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

  

  