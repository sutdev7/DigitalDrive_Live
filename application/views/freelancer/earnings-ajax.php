<!-- Display posts list -->

<?php if(!empty($posts)){ foreach($posts as $row){ ?>

<tr>

<td> <?php  echo date('Y-m-d',strtotime($row["created_date"])); ?></td>
<td><?php  echo $row["task_name"]; ?></td>

<td><?php echo $row["amount"]; ?></td>
<td><?php echo $row["payment_status"]; ?></td>
<td><?php echo isset($row["withdrawal_status"]) ? $row["withdrawal_status"] : ''; ?></td>
<td>
<a data-toggle="tooltip" onclick="confirmreq('<?php echo base_url(); ?>razorpay/refund_request/<?php echo $row['id'] ;?>')" data-placement="top" title="request for withdraw" 
href="javascript:void(0);">
<i class="fa fa-money" style="font-size:24px;"></i>
</a>
<a data-toggle="tooltip" data-placement="top" title="Details" 
href="<?php echo base_url() ;?>hired-job-details/<?php echo $row['user_task_id'] ;?>">
    <i class="fa fa-eye" style="font-size:24px;" aria-hidden="true"></i>
    </a>
</td>



</tr>

<?php } }else{ ?>

<tr><td  colspan="4"><p>Records not found...</p></td></tr>

<?php } ?>



<!-- Render pagination links -->

<tr>

<td  colspan="4">

    <?php echo $this->ajax_pagination->create_links(); ?>

</td>

</tr>