
<hr />
<div class="row">
    <div class="col-md-12 ">
        <?php echo form_open(base_url() . 'index.php?exam/exam_subject_report/'); ?>
        <div class="col-md-3 col-md-offset-2">
            <div class="form-group">
                <label class="control-label"><?php echo get_phrase('teacher'); ?></label>
                <select name="teacher_id" class="form-control" required="">
                    <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                    <?php
                    $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();
                    foreach ($teachers as $row) {
                        ?>
                        <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?></option>

                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label"><?php echo get_phrase('session'); ?></label>
                <select name="year" class="form-control" required="">		  	
                    <?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>		  	
                    <option value=""><?php echo get_phrase('select_running_session'); ?></option>		  	
                    <?php for ($i = 0; $i < 30; $i++): ?>		      	
                        <option value="<?php echo (1437 + $i); ?>-<?php echo (1437 + $i + 1); ?>"		        
                                <?php if ($running_year == (1437 + $i) . '-' . (1437 + $i + 1)) echo 'selected'; ?>>		          	
                            <?php echo (1437 + $i); ?>-<?php echo (1437 + $i + 1); ?>		      	
                        </option>		  
                    <?php endfor; ?>		
                </select>
            </div>
        </div>
        <div class="col-md-3" style="margin-top: 20px;">
            <button type="submit" class="btn btn-info"><?php echo get_phrase('submit'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php
if ($teacher_id != '' && $year != '') {
    ?>
    <div class="row">
        <hr/>
        <span class="pull-right">
            <a onClick="PrintElem('#print')" class="btn btn-default btn-icon icon-left hidden-print pull-right" style="margin-left: 50px;">
                پرنٹ رپورٹ
                <i class="entypo-print"></i>
            </a>
        </span>
    </div>
    <div id="print">
        <div class="row">
            <div class="col-md-12">
                <table width="90%" align="center" dir="rtl">
                    <tr>
                        <td width="20%"><img src="uploads/header.png" width="200" /></td>
                        <td align="center">
                            <h3><?= 'طلباء فہرست' . ' ' . '<span dir="ltr">' . $branch_name . '</span>' ?></h3>
                            <?= 'محترم جناب۔۔۔۔' . $this->crud_model->get_type_name_by_id('teacher', $teacher_id) ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span dir="ltr"><?= $running_year ?></span>
                        </td>
                        <td align="left"><img src="uploads/logo.png" height="80"/></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table  dir="rtl" width="95%" align="center" border="1" style="font-size: 11px; border-collapse: collapse; border: 1px solid black; text-align: center; line-height: 2.5">
                    <thead>
                        <tr>
                            <td width="3%">#</td>
                            <td><?= get_phrase('name') ?></td>
                            <td><?= get_phrase('parent') ?></td>
                            <td><?= get_phrase('exam_roll') ?></td>
                            <?php foreach ($exams as $exam) { ?>
                                <td width="8%"><?= $exam->name ?></td>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $students = $this->exam_model->get_students_signle_tabulation_sheet($teacher_id, $year);
                        foreach ($students as $data) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->name ?></td>
                                <td><?= $data->father_name ?></td>
                                <td><?= $data->roll_no ?></td>
                                <?php foreach ($exams as $exam) { ?>
                                    <td></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php } ?>
<script type="text/javascript">
    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'award list', 'height=600,width=800');
        mywindow.document.write('<html><head><title>Award List</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/fonts/nastaleeq/font.css">');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-forms.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body style="font-family:Noto Nastaliq Urdu Draft; font-size:11px;">');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        setInterval(function () {
            mywindow.document.close();
            mywindow.focus();
            mywindow.print();
            mywindow.close();
        }, 100);
    }
</script>