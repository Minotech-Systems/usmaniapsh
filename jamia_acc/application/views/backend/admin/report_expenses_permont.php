<?php
$pages = $this->crud_model->get_pages_expenses($month,$d_year);
//$pages = $this->db->get_where('page_lock', array('year' => $running_year))->result_array();
foreach ($pages as $page) {
    $page_number = $page['page_num'];
    $page_num_prev = $page['page_num']-1;
    $total_expenses = 0;
    ?>
<div class="row">
    <div class="col-md-12"><h4><?= get_phrase('page_no').' : '. $page_number;?></h4></div>
</div>
    <div class="row">
        <div class="col-md-5">
            <table width="95%" align="center" border="1" style="border-collapse: collapse; text-align: center; line-height: 2">
                <thead>
                    <tr style="background: #464646; color: white;">
                        <td><?= get_phrase('date') ?></td>
                        <td><?= get_phrase('khata_banam') ?></td>
                        <td><?= get_phrase('bill_no') ?></td>
                        <td><?= get_phrase('amount') ?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = $this->db->get_where('jamia_expenses', array('arabic_month' => $month, 'page_num' => $page['page_num']));
                    $num_rows = $query->num_rows();
                    $expenses = $query->result_array();
                    $total_expenses = 0;
                    foreach ($expenses as $data) {
                        ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($data['date'])); ?></td>
                            <td><?= $this->db->get_where('sub_child_expense_category', array('id' => $data['sub_child_expense_id']))->row()->name; ?></td>
                            <td><?= $data['bill_no'] ?></td>
                            <td><?= $toal_ex = $data['amount'] ?></td>

                        </tr>
                        <?php $total_expenses += $toal_ex;
                    } ?>
                    <?php if ($num_rows < 27) {
                        $extra = 27 - $num_rows;

                        for ($i = 1; $i <= $extra; $i++) {
                            ?>
                            <tr>
                                <td>-</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
        <?php }
    } ?>
                            <tr>
                                <td colspan="2"><?= 'مجموعہ صفحہ ہذا'?></td>
                                <td colspan="2" align="left" style="padding-left: 20px;"><?= $total_expenses?></td>
                            </tr>
                </tbody>
            </table>  
        </div>
        <div class="col-md-7">
            <table width="90%" align="center" border="1" style="border-collapse: collapse; text-align: center; line-height: 2">
                <thead>
                    <tr style="background: #464646; color: white;">
                        <td width="220"><?= get_phrase('مد') ?></td>
                        <td width="140"><?= 'اخراجات صفحہ ہزا'?></td>
                        <td width="140"><?= 'اخراجات گزشتہ صفحات'?></td>
                        <td width="140"><?= 'کل اخراجات'?></td>
                        <td width="200"><?= get_phrase('comment') ?></td>
                    </tr>
                </thead>
                <tbody>
                     <!---Wajbi Akharajat--->
                    <?php
                    $mad_1 = $this->db->get_where('child_expense_category', array('expenses_category_id' => 1))->result_array();
                    foreach ($mad_1 as $m_data) {
                        ?>
                        <tr>
                            <td><?= $m_data['name'] ?></td>
                            <td><?= ${"wajbi$page_number"} = $this->crud_model->get_sum_mad_expenses($m_data['id'], $month, $page_number,$d_year); ?></td>
                            <td><?= ${"wajbi$page_num_prev"} = $this->crud_model->get_sum_orevious($m_data['id'], $month, $page_number,$d_year); ?></td>
                            <td><?= ${"wajbi$page_number"} + ${"wajbi$page_num_prev"}?></td>
                            <td></td>
                        </tr>
                        <?php ${"total_wajbi$page_number"} += ${"wajbi$page_number"};
                               ${"total_wajbi_pre$page_num_prev"} += ${"wajbi$page_num_prev"};
                               ${"total_wajbi_cp"} = ${"total_wajbi$page_number"}+${"total_wajbi_pre$page_num_prev"};
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td colspan="3" align="center" style=" background: #dedede">مجموعی واجبی اخراجات 
                            <span><?=  ' : ' . ${"total_wajbi_cp"} ; ?></span>
                        </td>
                        <td></td>
                    </tr>
                    
                     <!---Umommi Akharajat--->
                    <?php
                    $mad_2 = $this->db->get_where('child_expense_category', array('expenses_category_id' => 2))->result_array();
                    foreach ($mad_2 as $m_data2) {
                        ?>
                        <tr>
                            <td><?= $m_data2['name'] ?></td>
                            <td><?= ${"umomi$page_number"} = $this->crud_model->get_sum_mad_expenses($m_data2['id'], $month, $page_number,$d_year); ?></td>
                            <td><?= ${"umomi$page_num_prev"} = $this->crud_model->get_sum_orevious($m_data2['id'], $month, $page_number,$d_year); ?></td>
                            <td><?= ${"umomi$page_number"} + ${"umomi$page_num_prev"}?></td>
                            <td></td>
                        </tr>
                        <?php ${"total_umomi$page_number"} += ${"umomi$page_number"};
                            ${"total_umomi_pre$page_num_prev"} += ${"umomi$page_num_prev"};
                            ${"total_umomi_cp"} = ${"total_umomi$page_number"}+ ${"total_umomi_pre$page_num_prev"};
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td  colspan="3" align="center" style="padding-right: 20px; background: #dedede">مجموعی عمومی اخراجات  
                            <span><?= ' : ' . ${"total_umomi_cp"}; ?></span>
                        </td>
                        <td></td>
                    </tr>
                    
                    <!---Tarqyati Akharajat--->
                    <?php
                    $mad_3 = $this->db->get_where('child_expense_category', array('expenses_category_id' => 3))->result_array();
                    foreach ($mad_3 as $m_data3) {
                        ?>
                        <tr>
                            <td><?= $m_data3['name'] ?></td>
                            <td><?= ${"tarqi$page_number"} = $this->crud_model->get_sum_mad_expenses($m_data3['id'], $month, $page_number,$d_year); ?></td>
                            <td><?= ${"tarqi$page_num_prev"} = $this->crud_model->get_sum_orevious($m_data3['id'], $month, $page_number,$d_year); ?></td>
                            <td><?= ${"tarqi$page_number"} + ${"tarqi$page_num_prev"}?></td>
                            <td></td>
                        </tr>
                        <?php ${"total_tarqi$page_number"} += ${"tarqi$page_number"};
                            ${"total_tarqi_pre$page_num_prev"} += ${"tarqi$page_num_prev"};
                            ${"total_tarqi_cp"} = ${"total_tarqi$page_number"}+ ${"total_tarqi_pre$page_num_prev"};
                    } ?>
                    <tr>
                        <td></td>
                        <td colspan="3" align="center" style="padding-right: 20px; background: #dedede">مجموعی ترقیاتی اخراجات
                            <span><?= ' : ' . ${"total_tarqi_cp"}; ?></span>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><?='مجموعہ صفحہ ہذا'?></td>
                        <td><?= $total_expenses?></td>
                        <td colspan="3"></td>
                    </tr>
                </tbody>
            </table>  
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
        <center>
            <table width="25%"style="border-collapse: collapse; margin-top: 20px; text-align: center;">
                <tr>
                    <td><?= 'کل مجموعہ خرچ'?></td>
                    <td width="30%"><div style="border: 1px solid"><?= $this->crud_model->get_all_page_expenses($page_number,$d_year)?></div></td>
                </tr>
            </table>
        </center>
    </div>
</div>
    <hr>


<?php
}?>