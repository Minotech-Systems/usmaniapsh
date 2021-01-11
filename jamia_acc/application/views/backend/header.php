<style>
    .panel-heading{ padding: 23px;}
    h1,h2,h3,h4,h5,h6{font-family: 'Noto Nastaliq Urdu Draft', serif;}
    .navbar-inner{height:50px;}
    .navbar navbar-fixed-top{height:50px;}
    .navbar-nav{height:50px;}
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">
        <h2 style="font-weight:200; margin:0px;"><?php echo $system_name; ?></h2> 
    </div>
    <!-- Raw Links -->
    <div class="col-md-12 col-sm-12 clearfix ">

        <ul class="list-inline links-list pull-left">
            <!-- Language Selector -->
            <div id="session_static">			
                <li>
                    <h4>
                        <a href="#" style="color: #696969; "
                        <?php if ($account_type == 'admin'): ?> 
                               onclick="get_session_changer()"
                           <?php endif; ?> >
                            <table>
                                <tr>
                                    <td dir="ltr"><?php echo get_phrase('session'); ?> </td><td><?php echo ' : ' . $running_year; ?></td>
                                    <td><?php echo '  ' . 'تعلیمی سال' . ':' . $talimi_saal ?></td>
                                </tr>
                            </table>

                        </a>

                    </h4>
                </li>
            </div>
        </ul>


        <ul class="list-inline links-list pull-right">

            <?php if ($account_type != 'parent'): ?>
                <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        <img src="<?php echo $this->crud_model->get_image_url($account_type, $this->session->userdata('login_user_id')); ?>" class="img-circle" width="40" />
                        <?php
                        echo $this->session->userdata('name');
                        ;
                        ?>
                    </a>
                    <ul class="dropdown-menu <?php
                    if ($text_align == 'right-to-left')
                        echo 'pull-right';
                    else
                        echo 'pull-left';
                    ?>">
                        <li>
                            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_profile">
                                <i class="entypo-info"></i>
                                <span><?php echo get_phrase('edit_profile'); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_profile">
                                <i class="entypo-key"></i>
                                <span><?php echo get_phrase('change_password'); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

<?php if ($account_type == 'parent'): ?>
                <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        <img src="<?php echo $this->crud_model->get_image_url($account_type, $this->session->userdata('login_user_id')); ?>" class="img-circle" width="40" />
                        <?php
                        echo $this->session->userdata('name');
                        ;
                        ?>
                    </a>
                    <ul class="dropdown-menu <?php
                        if ($text_align == 'right-to-left')
                            echo 'pull-right';
                        else
                            echo 'pull-left';
                        ?>">
                        <li>
                            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type . 's'; ?>/manage_profile">
                                <i class="entypo-info"></i>
                                <span><?php echo get_phrase('edit_profile'); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type . 's'; ?>/manage_profile">
                                <i class="entypo-key"></i>
                                <span><?php echo get_phrase('change_password'); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
<?php endif; ?>




            <li>
                <?php if ($this->session->userdata('login_type') == 'parent') { ?>
                    <a href="<?php echo base_url(); ?>index.php?parent_login/logout">
                        <?php echo get_phrase('logout'); ?><i class="entypo-logout right"></i>
                    </a>
                <?php } else { ?>
                    <a href="<?php echo base_url(); ?>index.php?login/logout">
                <?php echo get_phrase('logout'); ?><i class="entypo-logout right"></i>
                    </a>
                <?php } ?>

            </li>
        </ul>
    </div>

</div>



<script type="text/javascript">
    function get_session_changer()
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_session_changer/',
            success: function (response)
            {
                jQuery('#session_static').html(response);
            }
        });
    }
</script>