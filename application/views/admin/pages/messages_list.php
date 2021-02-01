
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Problem Ticket List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Problem Ticket</li>
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
                            <h3 class="card-title">List of Problem</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body"><?php echo $this->session->userdata('msg'); ?>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="3%" align="center">Sl No.</td>
                                        <th width="5%" align="center">User Type</th>
                                        <th width="5%" align="center">Username</th>
                                        <th width="2%" align="center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ( isset($user_message) && !empty($user_message)) { ?>
                                        <?php $count = 1;
                                        foreach ($user_message as $key => $row) { ?>
                                            <tr>
                                                <td><?php echo $count; ?>
                                                </td>
                                                <td>
                                                <?php if ($row->user_type == 3) {
                                                        echo 'client';
                                                    } else if ($row->user_type == 4) {
                                                        echo 'freelancer';
                                                    }
                                                ?>
                                                </td>
                                                <td><?= $row->name ?></td>
                                                <td><a href="<?= base_url() ?>admin/view-messages/<?php echo $row->user_id; ?>" title="View Details"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    } else {
                                        ?>
                                        <tr><td colspan="8">No Data Found</td></tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="3%" align="center">Sl No.</td>
                                        <th width="5%" align="center">User Type</th>
                                        <th width="5%" align="center">Username</th>
                                        <th width="2%" align="center">Actions</th>
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
<style>
    table.table-bordered.dataTable tbody td span.online-dot {
    background: #34c635;
    width: 14px;
    height: 14px;
    border-radius: 50px;
    display: inline-flex;
    position: relative;
    float: right;
    top: 7px;
    font-size: 11px;
    color: #fff;
    justify-content: center;
    align-items: center;
    padding: 0 0 2px 2px;
    font-weight: 600;
}
</style>
<script>
  
    (function() {
        $(document).ready(function() {
            
        });

    })();

  	
    $(function () {
        $("#example1").DataTable();
        
    });
	
	  var message_ajax_call = function(user_id=0) {
      $.ajax({
          method: "POST",
          url: "<?php echo base_url(); ?>admin/user-messages-ajax/",
          data: {}
      }).done(function(msg) {
	    $("tbody").html(msg);
      });
  };
  
  setInterval(message_ajax_call, 1000, '');
</script>

