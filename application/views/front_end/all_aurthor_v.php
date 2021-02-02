<?php include 'alasr_header.php'; ?>
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
                    <a href=""><input type="submit" dir="rtl" name="submit" class="btn btn-info btn-md" value="All records"></a>
                    
                     
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered datatable">
                        <tr>
                            <td>#</td>
                            <td><?php echo get_phrase('name'); ?></td>
                            <td><?php echo get_phrase('address'); ?></td>
                            <td><?php echo get_phrase('phone'); ?></td>
                            <td><?php echo get_phrase('options'); ?></td>
                            
                        </tr>
                    <?php
                        if(!empty($Query)):
                            $sn = '';
                            foreach ($Query as $row):
                                $sn++;
                            
                            ?>
                                
                        <tr>
                            <td><?php echo $sn?></td>
                            <td><?php echo $row->name?></td>
                            <td><?php echo $row->address?></td>
                            <td><?php echo $row->phone?></td>
                            <td>
                                <div class="btn-group">      
                                    <button style="text-align: right;" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>  
                                    
                                    <ul class="dropdown-menu dropdown-default pull-right"  role="menu">


                                            <!-- STUDENT PROFILE LINK -->    
                                           <!-- <li style="text-align: right;">  
                                                <a href="#" onclick="">       
                                                    <i class="entypo-user"></i>     
                                                    <?php echo get_phrase('profile'); ?>   
                                                </a>  
                                            </li>  -->
                                           
                                            <!-- STUDENT EDIT LINK -->    
                                            <li style="text-align: right;">  
                                                <a href="<?php echo base_url('index.php?/LibraryController/edit_aurther/'.$row->autr_id); ?>">       
                                                    <i class="entypo-pencil"></i>     
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>
                                            <li class="divider"></li>
                                            <!-- STUDENT EDIT LINK -->    
                                            <li style="text-align: right;">   
                                                 <a href="<?php echo base_url('index.php?/LibraryController/delete_aurther/'.$row->autr_id); ?>" >       
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