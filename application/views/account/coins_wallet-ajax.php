          <!-- Display posts list -->
        <?php if(!empty($posts)){ foreach($posts as $row){ ?>
          <tr>
            <td> <?php  echo date('Y-m-d',strtotime($row["review_doc"])); ?></td>
            <td><?php  echo $row["task_name"]; ?></td>
            
            <td><?php echo $row["coins"]; ?></td>
            <td><?php echo $row["provided_email"]; ?></td>
            <td>
            <!-- <a data-toggle="tooltip" data-placement="top" title="withdraw">
            <i class="fa fa-money" style="font-size:24px;"></i></a>  -->
            <a data-toggle="tooltip" data-placement="top" title="Details" href="<?php echo base_url() ;?>hired-job-details/<?php echo $row['user_task_id'] ;?>">
                  <i class="fa fa-eye" style="font-size:24px;" aria-hidden="true"></i>
                  </a>
          </td>
            
          </tr>
          <!-- <tr>
            <td><img src="img/cal-img.png" alt=""> 10/12/2019 </td>
            <td>UI Design</td>
            
            <td>$50</td>
          </tr> -->
        <?php } }else{ ?>
            <tr><td  colspan="5"><p>Records not found...</p></td></tr>
        <?php } ?>
              <!-- Render pagination links -->
            <tr>
            <td  colspan="5">
              <?php  echo ($this->ajax_pagination->create_links() !== "") ? $this->ajax_pagination->create_links():""; ?>
              
            </td>
            </tr>