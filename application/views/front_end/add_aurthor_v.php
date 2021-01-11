<?php include 'ifta_header.php'; ?>
<style>
    .listing-bok .list-question li a.ans-done {
        min-width: 100px;
        min-height: 30px;
        padding: 6px 0 6px;
        background: #3ab226;
        text-align: center;
        display: inline-block;
        top: 0;
        bottom: 0;
        height: 30px;
        color: #fff;
        font-size: 12px;
        text-decoration: none;
        margin: auto 0;
    }
    .listing-bok .list-question li a.not-done{
        min-width: 100px;
        min-height: 30px;
        padding: 6px 0 6px;
        background: #bc2626;
        text-align: center;
        display: inline-block;
        top: 0;
        bottom: 0;
        height: 30px;
        color: #fff;
        font-size: 12px;
        text-decoration: none;
        margin: auto 0;
    }
</style>
<section class="inner-section" >
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 listing-bok">
                <div class="col-md-12">
                    <h3 class="text-red"></h3>
                </div>
                <div class="col-md-12">
                    
                    <form id=""  class="form" method="post">
                                <h3 class="text-center text-info"><?php echo "مصنف کا اندراج کریں"?></h3>
                                <hr/>
                                <div class="form-group" style="text-align:right">
                                    <label for="username" class="text-info"><?php echo "مصنف کا ںام"?></label><br>
                                  <input type="text" name="name" id="username" class="form-control eng_input">
                                </div>
                                
                                <div class="form-group" style="text-align:center">
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="محفوظ کریں">
                                </div>
                            </form>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered datatable">
                        <tr>
                            <td>#</td>
                            <td><?php echo get_phrase('name'); ?></td>
                            <td><?php echo get_phrase('admission_date'); ?></td>
                            <td><?php echo get_phrase('options'); ?></td>
                            
                        </tr>
                    <?php
                        if(!empty($result)):
                            $sn = '';
                            foreach ($result as $row):
                                $sn++;
                            
                            ?>
                                
                        <tr>
                            <td><?php echo $sn?></td>
                            <td><?php echo $row->name?></td>
                            <td><?php echo date('d-m-Y',strtotime($row->create_datetime))?></td>
                            <td>
                                    <div class="btn-group"r="rtl">      
                                        <button type="button"  class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">


                                            <!-- STUDENT PROFILE LINK -->    
                                            <li>  
                                                <a href="#" onclick="">       
                                                    <i class="entypo-user"></i>     
                                                    <?php echo get_phrase('profile'); ?>   
                                                </a>  
                                            </li>
                                            <!-- STUDENT EDIT LINK -->    
                                            <li>  
                                                <a href="">       
                                                    <i class="entypo-pencil"></i>     
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>
                                            <li class="divider"></li>
                                            <!-- STUDENT EDIT LINK -->    
                                            <li>  
                                                 <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?LibraryController/delete_aurther/<?php echo $row->autr_id ?>');" >       
                                                    <i class="entypo-trash"></i>     
                                                    <?php echo get_phrase('delete'); ?>   
                                                </a>    
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </td>
                            
                        </tr>
                                
                                
                                <?php
                            endforeach;
                        endif;
                     
                     ?>
                        </table>
                </div>
            </div>
            <?php include 'user_right_widgets.php'; ?>
        </div>
    </div>
</div>
</section><a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>