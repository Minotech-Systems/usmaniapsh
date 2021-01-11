
<?php echo form_open(base_url() . 'index.php?parents/attendance_report/' ); ?>
<div class="row">
    <div class="col-md-2 col-md-offset-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            <select name="month" class="form-control ">
                <?php
                for ($i = 1; $i <= 12; $i++):
                    if ($i == 1)
                        $m = 'جنوری';
                    else if ($i == 2)
                        $m = 'فروری';
                    else if ($i == 3)
                        $m = 'مارچ ';
                    else if ($i == 4)
                        $m = 'اپریل ';
                    else if ($i == 5)
                        $m = 'مئی ';
                    else if ($i == 6)
                        $m = 'جون ';
                    else if ($i == 7)
                        $m = 'جولائی ';
                    else if ($i == 8)
                        $m = 'اگست ';
                    else if ($i == 9)
                        $m = 'ستمبر ';
                    else if ($i == 10)
                        $m = 'اکتوبر ';
                    else if ($i == 11)
                        $m = 'نومبر ';
                    else if ($i == 12)
                        $m = 'دسمبر ';
                    ?>
                    <option value="<?php echo $i; ?>"
                            <?php if ($month == $i) echo 'selected'; ?>  >
                                <?php echo get_phrase($m); ?>
                    </option>
                    <?php
                endfor;
                ?>
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('year'); ?></label>
            <select name="year" class="form-control">		  	
                <?php $date_year = date('Y') ?>		  	
                <option value=""><?php echo get_phrase('select_year'); ?></option>		  	
                <?php for ($i = 0; $i < 30; $i++): ?>		      	
                    <option value="<?php echo 2016 + $i ?>"<?php if ($date_year == 2016 + $i) echo 'selected'; ?>>		          	
                        <?php echo 2016 + $i ?>		      	
                    </option>		  
                <?php endfor; ?>		
            </select>
        </div>
    </div>

    <div class="col-md-2" style="margin-top: 20px;">
        <button type="submit" class="btn btn-info"><?php echo get_phrase('show_report'); ?></button>
    </div>
</div>


<?php echo form_close(); ?>

<?php if ($month != '' && $year != '') { ?>
    <div class="row">
        <div class="col-md-12 hidden-sm hidden-xs">
            <table class="table table-bordered" id="my_table">
                <thead>
                    <tr>
                        <td style="text-align: center;">
                            <?php echo get_phrase('students'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
                        </td>
                        <td><?php echo get_phrase('parent'); ?></td>
                        <?php
                        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                        for ($i = 1; $i <= $days; $i++) {
                            ?>
                            <td style="text-align: center;"><?php echo $i; ?></td>
                        <?php } ?>
                        <td align="center" style="width: 80px"><?php echo 'مجموعی' . '"حاضری"' ?></td>
                        <td align="center" style="width: 80px"><?php echo 'مجموعی' . '"غیرحاضری"' ?></td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = array();
                    $student_row = 0;
                    $students = $this->db->get_where('enroll', array('student_id' => $student_id, 'status' => 1, 'year' => $running_year))->result_array();

                    foreach ($students as $row):
                        $student_row++;
                        ?>
                        <tr>
                            <td style="text-align: center;">
                                <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                            </td>
                            <td><?php echo $this->db->get_where('student', array('student_id' => $student_id))->row()->father_name; ?></td>
                            <?php
                            $status = 0;
                            for ($i = 1; $i <= $days; $i++) {
                                $timestamp = ($year . '-' . $month . '-' . $i);
                                $get_name = date('l', strtotime($timestamp)); //get week day
                                $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

                                if ($day_name == 'Fri') {
                                    if ($student_row == 1) {
                                        ?>
                                        <td style="vertical-align: middle; background: #ff7070;" rowspan="1" class="weekendtr" width="20">
                                            <i class="entypo-star-empty"></i><br/>
                                            <br/>F<br/> <br/>R<br/> <br/>I<br/><br/> D<br/><br/> A<br/><br/> Y<br/><br/>
                                            <i class="entypo-star-empty"></i> <br/><br/><br/><br/>
                                        </td>
                                        <?php
                                    }
                                } else {

                                    $this->db->group_by('timestamp');
                                    $attendance = $this->db->get_where('attendance', array('student_id' => $row['student_id'], 'year' => $running_year, 'timestamp' => $timestamp))->result_array();


                                    foreach ($attendance as $row1):
                                        $status = $row1['status'];
                                    endforeach;
                                    ?>
                                    <td style="text-align: center;">
                                        <?php if ($status == 1) { ?>
                                            <i class="entypo-record" style="color: #00a651;"></i>
                                        <?php } if ($status == 2) { ?>
                                            <i class="entypo-record" style="color: #ee4749;"></i>
                                        <?php } if ($status == 3) { ?>
                                            <i class="entypo-record" style="color: #e89420;"></i>
                                        <?php } $status = 0; ?>


                                    </td>

                                    <?php
                                }
                            }
                            ?>
                            <td align="center">
                                <?php
                                $current_att = $this->db->get_where('attendance_count', array(
                                            'student_id' => $row['student_id'],
                                            'year' => $running_year,
                                            'month' => $month,
                                        ))->row()->total_atd;

                                echo $current_att;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $current_abs = $this->db->get_where('attendance_count', array(
                                            'student_id' => $row['student_id'],
                                            'year' => $running_year,
                                            'month' => $month,
                                        ))->row()->total_absent;

                                echo $current_abs;
                                ?>
                            </td>
                        <?php endforeach; ?>


                    </tr>

                </tbody>

            </table>
        </div>
    </div>
    <div class="row">
        <style>
            .days {
                padding: 10px 0;
                background: #eee;
                margin: 0;
            }

            .days li {
                list-style-type: none;
                display: inline-block;
                width: 13.6%;
                text-align: center;
                margin-bottom: 5px;
                font-size:12px;
                color: #777;
            }

            .days li .active {
                padding: 5px;
                background: #1abc9c;
                color: white !important
            }

            /* Add media queries for smaller screens */
            @media screen and (max-width:720px) {
                .weekdays li, .days li {width: 13.1%;}
            }

            @media screen and (max-width: 420px) {
                .weekdays li, .days li {width: 12.5%;}
                .days li .active {padding: 2px;}
            }

            @media screen and (max-width: 290px) {
                .weekdays li, .days li {width: 12.2%;}
            }
        </style>
        <div class="col-sm-12 col-xs-12 hidden-md hidden-lg" style="text-align:center">
            <table width="100%" align="center">
                <tr>
                    <td><?= ' حاضر' . ':' ?></td>
                    <td align="right"> <i class="fa fa-circle" style="color:#00a651; margin: 10px;"></i></td>
                    <td><?= 'غائب' . ':' ?></td>
                    <td align="right"> <i class="fa fa-circle" style="color:#ee4749; margin: 10px;"></i></td>
                    <td><?= 'رخصت' . ':' ?></td>
                    <td align="right"> <i class="fa fa-circle" style="color:#e89420; margin: 10px;"></i></td>
                    <td><?= 'مبہم' . ':' ?></td>
                    <td align="right"> <i class="fa fa-circle" style="color:#272727; margin: 10px;"></i></td>
                    <td><?= 'جمعہ' . ':' ?></td>
                    <td align="right"> <i class="fa fa-circle" style="color:#b7b7b7; margin: 10px;"></i></td>
                    
                </tr>
            </table>

        </div>
        <div class="col-sm-12 col-xs-12 hidden-md hidden-lg">
            <ul class="days">
                <?php
                $status = 0;
                for ($i = 1; $i <= $days; $i++) {
                    $timestamp = ($year . '-' . $month . '-' . $i);
                    $get_name = date('l', strtotime($timestamp)); //get week day
                    $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

                    if ($day_name == 'Fri') {
                        if ($student_row == 1) {
                            ?>
                            <li><span style="color:#b7b7b7"><?= $i ?></span></li>
                            <?php
                        }
                    } else {

                        $this->db->group_by('timestamp');
                        $attendance = $this->db->get_where('attendance', array('student_id' => $row['student_id'], 'year' => $running_year, 'timestamp' => $timestamp))->result_array();


                        foreach ($attendance as $row2):
                            $status2 = $row2['status'];
                        endforeach;
                        ?>

                        <?php if ($status2 == 1) { ?>
                            <li style="color: #00a651;"><?= $i ?></li>
                        <?php } elseif ($status2 == 2) { ?>
                            <li style="color: #ee4749;"><?= $i ?></li>
                        <?php } elseif ($status2 == 3) { ?>
                            <li style="color: #e89420;"><?= $i ?></li>
                        <?php } elseif ($status2 == 0) { ?>
                            <li style="color: #272727;"><?= $i ?></li>    
                                <?php
                            } $status2 = 0;
                            ?>

                        <?php
                    }
                }
                ?>


            </ul>
        </div>
        <div class="col-sm-12 col-xs-12 hidden-md hidden-lg">
            <p><?=' حاضری'.' : '. $current_att?> &nbsp;&nbsp;&nbsp; <?= 'غیر حاضری'.' : '.$current_abs?></p>
        </div>
    </div>
<?php } ?>