<?php

//echo "<pre>";print_r($content['user_info'][0]['msghistory']);die;

if(isset($content['user_info'][0])) {

    foreach ($content['user_info'][0]['msghistory'] as $k => $value) {
        ?>

        <div class="chat-rht-sec <?php echo $value['className']?> chat_message_<?php echo $value['id'] ?> <?php echo (!empty($value['attachement']) || $value['deleted'] == 1) ? "chat-rht-file-deleted" : ""?>" id="res" rel="<?php echo $value['id'] ?>">

            <div class="chat-back-img"> <!--<span style="background:url(<?php echo $value['profileImage']?>) no-repeat center top; background-size:cover;"></span>-->
			<a href="<?php echo base_url() ?>public-profile/<?php echo $value['profile_id'] ?>">
			 <img src="<?php echo $value['profileImage']?>" class="profile_image"/></a>
             
                <div class="chat-back-sec">
                    <div class="action-option deleted_dots<?php echo $value['deleted'] ?>">
                        <i></i>
                        <i></i>
                        <i></i>
                    </div>
					<p class="single_name"><?php echo $value['name']?></p>
					<span class='single_date' style='display:none'><?php echo $value['date_time']?></span>
                    <div class="cap <?php echo ($value['deleted'] == 1) ? "deleted_message1" : "deleted_message0" ?>" rel="<?php echo "message-".$value['id']; ?>">

                        <?php if($value['deleted'] == 0) : ?>
						<!--<p><?php echo $value['message_content']?></p><a href="<?php base_url().'uploads/messages/'.$value['attachement']?>"><?php echo $value['attachFile'] . $value['download']?></a>-->
						<p class="message_content"><?php echo $value['message_content']?></p>
						<?php if(!empty($value['attachement'])) : ?>
						<a class="attachement-uploded" href="<?php echo base_url().'User/download_file/'.$value['code'] ?>"><?php echo $value['download']?><i class="<?php echo ($row->attachment_download_status == 1) ? "hide-check" : "show-check" ?> downlaod fa fa-arrow-down"></i> <i class="<?php echo ($row->attachment_download_status == 1) ? "show-check" : "hide-check" ?> downloaded fa fa-check"></i></a>
						<?php endif; ?>
						<?php else : ?>
					     <p>Message deleted</p>	
						<?php endif; ?>

                    </div>

                    <div class="cap2 remove_date<?php echo $value['deleted'] ?>"><?php echo $value['date_time'].$value['readicon']?></div>

                </div>

            </div>

        </div>

        <?php

    }

}

?>