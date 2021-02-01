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
                                                <td><?= $row->name ?> <span class="online-dot"><?php echo $row->unread_count ?></span></td>
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