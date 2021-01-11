<html lang="en" dir="rtl"> 
    <head>
        <title><?= $page_title ?></title>
        <link rel="stylesheet" href="assets/fonts/nastaleeq/font.css">
        <link rel="stylesheet" href="assets/fonts/jameel/font.css">
        <link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/neon-rtl.css">
        <meta charset="utf-8">     


        <style>
            body{font-family: jameelnoori; color: black;}
            h3,h4,h5{ display: inline;}
            h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6{font-family:Noto Nastaliq Urdu Draft; }
            #page_no{font-family: cursive; font-size: 12px}
            h5{ font-size: 16px;}
            h3{font-size: 24px;}
            #comment{border-bottom: 1px solid white;}
            @media print
            {
                * {-webkit-print-color-adjust:exact;}
                .pagebreak{page-break-after: always;display: block;}
                #m_total{background-color: #dedede !important;}
            }  
        </style>
    </head>
    <body>
        <?php
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        $pages = $this->crud_model->get_pages_expenses($month, $d_year);
        foreach ($pages as $page) {
            $page_number = $page['page_num'];
            $page_num_prev = $page['page_num'] - 1;
            $total_expenses = 0;
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <table width="99%" dir="rtl"  align="center" >
                        <tr>
                            <td width="30%" style="font-size:12px;">
                                <?= 'بابت ماہ ' . ' : ' . '<u>' . $this->crud_model->get_month_name($month) . ' ' .'<span dir="ltr">'. $d_year.'</span>' . '</u>'; ?>
                                <br>
                                <?= '_____________' ?>
                            </td>
                            <td align="center">
                                <h5><?= 'تفصیل خرچ' ?></h5>&nbsp;&nbsp;&nbsp;<h3><?= $system_name ?></h3>
                                <br><span id="page_no"><?= $page_number ?></span>
                            </td>
                            <td width="30%" align="left"><image src="uploads/logo.png" height="80"/></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" dir="">
                <div class="col-xs-5" style="padding-left:0px;">
                    <table width="99%" align="center" border="1" style="border-collapse: collapse; border: 1px solid black; text-align: center; line-height: 1.6; font-size: 16px;">
                        <thead>
                            <tr style="background: #464646; color: white; font-size: 9px;">
                                <td height="40"><?= get_phrase('date') ?></td>
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
                                    <td style="font-size:12px;"><?= $this->db->get_where('sub_child_expense_category', array('id' => $data['sub_child_expense_id']))->row()->name; ?></td>
                                    <td><?= $data['bill_no'] ?></td>
                                    <td><?= $toal_ex = $data['amount'] ?></td>

                                </tr>
                                <?php
                                $total_expenses += $toal_ex;
                            }
                            ?>
                            <?php
                            if ($num_rows < 27) {
                                $extra = 27 - $num_rows;

                                for ($i = 1; $i <= $extra; $i++) {
                                    ?>
                                    <tr>
                                        <td>-</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="2"><?= 'مجموعہ صفحہ ہذا' ?></td>
                                <td colspan="2" align="left" style="padding-left: 20px;"><?= $total_expenses ?></td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
                <div class="col-xs-7" style="padding-right:0px;">
                    <table width="99%" align="center" border="1" style="border-collapse: collapse; border: 1px solid black;  margin-right: 0px; border-right:1px solid white; text-align: center; line-height: 1.6; font-size: 16px;">
                        <thead>
                            <tr style="background: #464646; color: white; font-size: 9px;">
                                <td width="220" height="40" style="font-size:16px;"><?= get_phrase('مد') ?></td>
                                <td width="140"><?= 'اخراجات صفحہ ہذا' ?></td>
                                <td width="140"><?= 'اخراجات گزشتہ صفحات' ?></td>
                                <td width="140"><?= 'کل اخراجات' ?></td>
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
                                    <td><?= ${"wajbi$page_number"} = $this->crud_model->get_sum_mad_expenses($m_data['id'], $month, $page_number, $d_year); ?></td>
                                    <td><?= ${"wajbi$page_num_prev"} = $this->crud_model->get_sum_orevious($m_data['id'], $month, $page_number, $d_year); ?></td>
                                    <td><?= ${"wajbi$page_number"} + ${"wajbi$page_num_prev"} ?></td>
                                    <td id="comment"></td>
                                </tr>
                                <?php
                                ${"total_wajbi$page_number"} += ${"wajbi$page_number"};
                                ${"total_wajbi_pre$page_num_prev"} += ${"wajbi$page_num_prev"};
                                ${"total_wajbi_cp"} = ${"total_wajbi$page_number"} + ${"total_wajbi_pre$page_num_prev"};
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td colspan="3" align="center" style=" background: #dedede" id="m_total">مجموعی واجبی اخراجات 
                                    <span><?= ' : ' . ${"total_wajbi_cp"}; ?></span>
                                </td>
                                <td id="comment"></td>
                            </tr>

                            <!---Umommi Akharajat--->
                            <?php
                            $mad_2 = $this->db->get_where('child_expense_category', array('expenses_category_id' => 2))->result_array();
                            foreach ($mad_2 as $m_data2) {
                                ?>
                                <tr>
                                    <td><?= $m_data2['name'] ?></td>
                                    <td><?= ${"umomi$page_number"} = $this->crud_model->get_sum_mad_expenses($m_data2['id'], $month, $page_number, $d_year); ?></td>
                                    <td><?= ${"umomi$page_num_prev"} = $this->crud_model->get_sum_orevious($m_data2['id'], $month, $page_number, $d_year); ?></td>
                                    <td><?= ${"umomi$page_number"} + ${"umomi$page_num_prev"} ?></td>
                                    <td id="comment"></td>
                                </tr>
                                <?php
                                ${"total_umomi$page_number"} += ${"umomi$page_number"};
                                ${"total_umomi_pre$page_num_prev"} += ${"umomi$page_num_prev"};
                                ${"total_umomi_cp"} = ${"total_umomi$page_number"} + ${"total_umomi_pre$page_num_prev"};
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td  colspan="3" align="center" style=" background: #dedede" id="m_total">مجموعی عمومی اخراجات  
                                    <span><?= ' : ' . ${"total_umomi_cp"}; ?></span>
                                </td>
                                <td id="comment"></td>
                            </tr>

                            <!---Tarqyati Akharajat--->
                            <?php
                            $mad_3 = $this->db->get_where('child_expense_category', array('expenses_category_id' => 3))->result_array();
                            foreach ($mad_3 as $m_data3) {
                                ?>
                                <tr>
                                    <td><?= $m_data3['name'] ?></td>
                                    <td><?= ${"tarqi$page_number"} = $this->crud_model->get_sum_mad_expenses($m_data3['id'], $month, $page_number, $d_year); ?></td>
                                    <td><?= ${"tarqi$page_num_prev"} = $this->crud_model->get_sum_orevious($m_data3['id'], $month, $page_number, $d_year); ?></td>
                                    <td><?= ${"tarqi$page_number"} + ${"tarqi$page_num_prev"} ?></td>
                                    <td id="comment"></td>
                                </tr>
                                <?php
                                ${"total_tarqi$page_number"} += ${"tarqi$page_number"};
                                ${"total_tarqi_pre$page_num_prev"} += ${"tarqi$page_num_prev"};
                                ${"total_tarqi_cp"} = ${"total_tarqi$page_number"} + ${"total_tarqi_pre$page_num_prev"};
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td colspan="3" align="center" style=" background: #dedede" id="m_total">مجموعی ترقیاتی اخراجات
                                    <span><?= ' : ' . ${"total_tarqi_cp"}; ?></span>
                                </td>
                                <td ></td>
                            </tr>
                            <tr>
                                <td><?= 'مجموعہ صفحہ ہذا' ?></td>
                                <td><?= $total_expenses ?></td>
                                <td colspan="3"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 ">
                    <table width="30%"  align="center" style="margin-top:30px;">
                        <tr>
                            <td>کل مجموعہ خرچ</td>
                            <td width="70%">
                                <div style="text-align: center;border: 1px solid;box-shadow: 0px 0px 2px 0px;">
                                    <?= $this->crud_model->get_all_page_expenses($page_number, $d_year) ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        <table width="90%" align="center" style="margin-top:10px; line-height: 2.5;">
            <tr>
                <td colspan="2">دستخط پڑتال کنندہ۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔</td>
            </tr>
            <tr>
                <td>دستخط ناظم تعلیمات۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔</td>
                <td align="left">دستخط مہتمم۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔</td>
            </tr>
        </table>
        <hr>
            <span class="pagebreak"></span>
        <?php } ?>
    </body>
</html>
