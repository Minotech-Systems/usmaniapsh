<?php
$pages = $this->crud_model->get_income_pages($month,$d_year);
foreach ($pages as $page) {
    $page_number = $page['page_num'];
    $page_num_prev = $page['page_num']-1;
    $total_expenses = 0;
    ?>
<div class="row">
    <div class="col-md-12"><h4><?= get_phrase('page_no').' : '. $page_number;?></h4></div>
</div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table width="95%" align="center" border="1" style="border-collapse: collapse; text-align: center; line-height: 2">
                <thead>
                    <tr style="background: #464646; color: white;">
                        <td><?= get_phrase('date') ?></td>
                        <td><?= 'نام معاونین' ?></td>
                        <td><?= 'رسید نمبر' ?></td>
                        <?php   
                                          $this->db->order_by('id','asc');  
                        $all_income_cat = $this->db->get('income_category')->result();
                         
                        foreach($all_income_cat as $rowCat):
                            echo '<td>'.$rowCat->name.'</td>';
                        endforeach;
                         
                         ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $income_data = $this->crud_model->get_income_history($page_number,$month,$d_year);
                    
                   
                    
                    foreach ($income_data as $in_data){?>
                    <tr>
                        <td><?= date('d-m-Y', strtotime($in_data['date']));?></td>
                        <td><?= $in_data['assistant']?></td>
                        <td><?= $in_data['bill_no']?></td>
                         <?php 
                         
                         
                                            $this->db->order_by('id','asc');  
                        $all_income_cat = $this->db->get_where('income_category')->result();
                         
                           foreach($all_income_cat as $rowCat):
                               $where_in = array(
                                 'id'                   => $in_data['id'],
                                 'income_category_id'   => $rowCat->id  
                               );

                        $all_income_cat = $this->db->get_where('income',$where_in)->row();
                            $income_amount = '';
                        if(empty($all_income_cat)):
                                   $income_amount = '';
                                   else:
                                   $income_amount = $all_income_cat->amount;
                               endif;
                               
                            echo '<td>'.$income_amount.'</td>';
                        endforeach;
                          ?>
                    </tr>
                    <?php }?>
                </tbody>
            </table>  
        </div>
    </div>
<hr>

<?php } ?>