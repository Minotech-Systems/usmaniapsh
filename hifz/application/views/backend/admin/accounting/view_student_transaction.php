<style>
    .btn-default{background: #737881; color: white}
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
        background-color: #57b1d5;
        border: 1px solid #57b1d5;
        color: white;
    }
    .nav-tabs{border-bottom: 1px solid  #57b1d5;}

</style>
<?php
$student_data = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
foreach ($student_data as $row) {
    $parent = $row['father_name'];
    $class_id = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $running_year))->row()->class_id;
    $section_id = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $running_year))->row()->section_id;
    $branch_id = $this->session->userdata('branch_id');
    $payment_info = $this->db->get_where('student_transaction', array('student_id' => $student_id, 'year' => $running_year))->result_array();
     $monthly_fee = $this->db->get_where('monthly_fee', array('branch_id' => $branch_id))->row();
    $student_fee = $this->db->get_where('student_fee', array('student_id' => $student_id, 'year' => $running_year))->row();
    ?>
    <div class="profile-env">
        <div class="row">
            <div class="col-md-3">
                <center>
                    <a href="#">
                        <image style="box-shadow: 7px 6px 11px" src="<?php echo $this->crud_model->get_image_url('student', $row['image']); ?>" class="img-circle" width="40%"/>
                        <br>
                        <h3><?php echo $name = $row['name'] ?></h3>
                        <br>
                        <span><?php echo get_phrase('parent') . ' : ' . $parent ?></span>
                        <br>
                        <span><?php
                            echo $class = $this->db->get_where('class', array('class_id' => $class_id))->row()->name . ' ( ' .
                            $this->db->get_where('section', array('section_id' => $section_id))->row()->name . ')'
                            ?>
                        </span>
                    </a>
                </center>
            </div>
            <div class="col-md-9">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#pro1" data-toggle="tab" class="btn btn-default" aria-expanded="false">
                            <span class="visible-xs" >
                                <i class="entypo-home"></i>
                            </span>
                            <span class="hidden-xs">طالب فیس ادایئگی معلومات</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="pro1">
                        <table width="100%" style="line-height:3">
                            <tr>
                                <td>
                                    <a onClick="PrintElem('#print_tran')" class="btn btn-success btn-icon icon-left hidden-print pull-right">
                                        Print  Payment  Detail 
                                        <i class="entypo-print"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <diV id="print_tran">
                            <table width="100%" style="line-height:3" class="table table-bordered" dir="rtl">
                                <thead>
                                    <tr>
                                        <td colspan="6" align="center">
                                            <?= 'ماہانہ فیس: ' . $monthly_fee->amount . '   ' ?>
                                            <?= 'ذاتی تعاون: ' . $student_fee->amount . '   ' ?>
                                            <?php
                                            if ($student_fee->amount < $monthly_fee->amount) {
                                                echo 'تعاون ازادارہ: ' . ($monthly_fee->amount - $student_fee->amount);
                                            }
                                            ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th><?php echo get_phrase('serial_no'); ?></th>    
                                        <th><?php echo get_phrase('paid_payment'); ?></th>
                                        <th><?= 'تعاون ازادارہ' ?></th> 
                                        <th><?php echo get_phrase('date'); ?></th> 
                                        <th><?php echo get_phrase('month'); ?></th>
                                        <th class="hidden-print"><?php echo get_phrase('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    $count = 1;
                                    $due_payment = 0;
                                    foreach ($payment_info as $payment) {
                                        ?>
                                        <tr>
                                            <td> <?php echo $count++; ?></td>
                                            <td> <?php
                                                echo $payment ['amount'];
                                                $total += $payment ['amount'];
                                                ?> 
                                            </td>
                                            <td>
                                                <?php
                                                $where1 = array();
                                                $where1['student_id'] = $student_id;
                                                $where1['year'] = $running_year;
                                                $where1['month'] = $payment['month'];
                                                echo $this->studentfee_model->get_transactions_sum('scholorship_transaction', $where1, 'amount');
                                                ?>
                                            </td>
                                            <td> <?php echo date("d-m-Y", strtotime($payment ['date'])) ?>       </td>
                                            <td> <?php echo $this->studentfee_model->get_month_name($payment['month']); ?>       </td>
                                            

                                            <td class="hidden-print">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <?php echo get_phrase('action') ?><span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                                        <!-- EDITING LINK -->
                                                        <li>
                                                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/accounting/modal_edit_student_transaction/<?php echo $payment['student_transaction_id']; ?>');">
                                                                <i class="entypo-pencil"></i>
                                                                <?php echo get_phrase('edit'); ?>
                                                            </a>
                                                        </li>
                                                        <li class="divider"></li>

                                                        <!-- DELETION LINK -->
                                                        <li>
                                                            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?student_fee/view_student_transaction/delete/<?php echo $payment['student_transaction_id']; ?>');">
                                                                <i class="entypo-trash"></i>
                                                                <?php echo get_phrase('delete'); ?>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table> 
                            <?php
                            $student_fee = $this->db->get_where('student_fee', array('student_id' => $student_id, 'year' => $running_year))->row()->amount;
                            $monthly_fee = $this->db->get_where('monthly_fee', array('branch_id' => $branch_id, 'year' => $running_year))->row()->amount;
                            if ($student_fee > $monthly_fee) {
                                ?>
                                <table width="100%" style="line-height:3" class="table table-bordered" dir="rtl">
                                    <thead>
                                        <tr>
                                            <td colspan="5" align="center"><?= 'اضافی فیس' ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo get_phrase('serial_no'); ?></th>    
                                            <th><?php echo get_phrase('paid_payment'); ?></th> 
                                            
                                            <th><?php echo get_phrase('date'); ?></th> 
                                            <th><?php echo get_phrase('month'); ?></th>
                                            <th class="hidden-print"><?php echo get_phrase('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $a_no = 1;
                                        $std_addtional_fee = $this->db->get_where('additional_student_fee', array('student_id' => $student_id, 'year' => $running_year))->result();
                                        foreach ($std_addtional_fee as $ad_fee) {
                                            ?>
                                            <tr>
                                                <td><?= $a_no++ ?></td>
                                                <td>
                                                    <?php
                                                    echo $ad_fee->amount;
                                                    $total_add_fee += $ad_fee->amount;
                                                    ?>
                                                </td>
                                                <td> <?php echo date("d-m-Y", strtotime($ad_fee->date)) ?></td>
                                                <td> <?php echo $this->studentfee_model->get_month_name($ad_fee->month); ?> </td>
                                                <td class="hidden-print">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <?php echo get_phrase('action') ?><span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                                            <!-- EDITING LINK -->
                                                            <li>
                                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/accounting/modal_edit_additional_transaction/<?php echo $ad_fee->id; ?>');">
                                                                    <i class="entypo-pencil"></i>
                                                                    <?php echo get_phrase('edit'); ?>
                                                                </a>
                                                            </li>
                                                            <li class="divider"></li>

                                                            <!-- DELETION LINK -->
                                                            <li>
                                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?student_fee/view_student_transaction/delete_additional/<?php echo $ad_fee->id; ?>');">
                                                                    <i class="entypo-trash"></i>
                                                                    <?php echo get_phrase('delete'); ?>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            <?php } ?>
                        </diV>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
?>
<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'Student Transaction', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body style="color:black; font-family:Noto Nastaliq Urdu Draft;"><table dir="rtl" style="width:80%; text-align:center;" align="center">\n\
            <tr><td><?php echo $name . ' ولد' . ' ' . $parent . '  ' . $class . ' / ' . 'سیشن ' . ' : ' . '<span dir="ltr">' . $running_year . '</span>'; ?></td></tr></table>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        setInterval(function () {
            mywindow.document.close();
            mywindow.focus();
            mywindow.print();
            mywindow.close();
        }, 100);

        return true;
    }

</script>