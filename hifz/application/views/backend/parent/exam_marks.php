<style>
    .exam_chart {
        width           : 100%;
        height      : 265px;
        font-size   : 11px;
    }
    @media (max-width: 768px) 
    { 
        .table-bordered > thead > tr > td{font-size: 9px;}
    }
</style>
<?php
$student_data = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
foreach ($student_data as $data) {
    ?>
    <style>
        .panel-primary > .panel-heading{background: #4e6e7c; color: #ebebeb; border-color: #4e6e7c;}
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary panel-shadow" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title"><?php echo '' . ' / ' . get_phrase('marksheet') . ' / ' . $data['name']; ?></div>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td style="text-align: center;"><?php echo get_phrase('subject') ?></td>
                                    <td style="text-align: center;"><?php echo get_phrase('total_marks'); ?></td>
                                    <td style="text-align: center;"><?php echo get_phrase('obtained_marks') ?></td>
                                    <td align="center"><?= 'پوزیشن' ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $paper_total_marks = 0;
                                $total_marks = 0;
                                foreach ($exams as $row3) {
                                    $mark_data = $this->db->get_where('mark', array('exam_id' => $row3['exam_id'], 'student_id' => $student_id, 'year' => $year))->row();
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $row3['name']; ?></td>
                                        <td style="text-align: center;"><?=  $mark_data->mark_total      ?></td>
                                        <td style="text-align: center;"><?= $mark_data->mark_obtained ?></td>
                                        <td><?php
                                            $posit = $this->db->get_where('parent_mark_summery', array(
                                                        'teacher_id' => $teacher_id,
                                                        'exam_id' => $row3['exam_id'],
                                                        'student_id' => $student_id,
                                                        'year' => $year
                                                    ))->row()->class_position;
                                            echo $AdminP = & get_instance();
                                            $position = $AdminP->get_position($posit);
                                            echo '<span dir="">' . 'کلاس پوزیشن' . ' = ' . $posit . $position . '</span>';
                                            ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <div id="chartdiv" class="exam_chart"></div>
                        <script type="text/javascript">
                            var chart = AmCharts.makeChart("chartdiv", {
                                "theme": "none",
                                "type": "serial",
                                "dataProvider": [
    <?php
    foreach ($exams as $exam) {
        ?>
                                        {
                                            "subject": "<?php echo $exam['name']; ?>",
                                            "mark_obtained":
        <?php
        $obt_mark = $this->db->get_where('mark', array('exam_id' => $exam['exam_id'], 'student_id' => $student_id, 'year' => $year))->row()->mark_obtained;
        if (!empty($obt_mark)) {
            echo $obt_mark;
        } else {
            echo '0';
        }
        ?>,
                                            "mark_highest":<?= $highest_mark = $this->exam_model->get_highest_marks($exam['exam_id'], $teacher_id); ?>
                                        },
    <?php } ?>

                                ],
                                "valueAxes": [{
                                        "stackType": "3d",
                                        "unit": "",
                                        "position": "left",
                                        "title": "حاصل کردہ اور  ذیادہ حاصل کردہ نمبرات کا موازنہ"
                                    }],
                                "startDuration": 1,
                                "graphs": [{
                                        "balloonText": "حاصل کردہ نمبرات  [[category]]: <b>[[value]]</b>",
                                        "fillAlphas": 0.9,
                                        "lineAlpha": 0.2,
                                        "title": "2004",
                                        "type": "column",
                                        "fillColors": "#7f8c8d",
                                        "valueField": "mark_obtained"
                                    }, {
                                        "balloonText": " ذیادہ حاصل کردہ نمبرات [[category]]: <b>[[value]]</b>",
                                        "fillAlphas": 0.9,
                                        "lineAlpha": 0.2,
                                        "title": "2005",
                                        "type": "column",
                                        "fillColors": "#34495e",
                                        "valueField": "mark_highest"
                                    }],
                                "plotAreaFillAlphas": 0.1,
                                "depth3D": 20,
                                "angle": 45,
                                "categoryField": "subject",
                                "categoryAxis": {
                                    "gridPosition": "start"
                                },
                                "exportConfig": {
                                    "menuTop": "20px",
                                    "menuRight": "20px",
                                    "menuItems": [{
                                            "format": 'png'
                                        }]
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php } ?>
