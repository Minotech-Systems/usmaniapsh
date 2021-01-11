
<style>
    .panel-heading{ padding: 20px;}
    .tile-stats{padding: 0px; padding-right: 10px;}
    .fa{color:#f5f5f5}
    .tile-stats .icon i{color:#f5f5f5; }



    @media (min-width: 768px){


        #scrol {
            position: relative;
            overflow-y: scroll;
            width: 25%;
        }
    }


    #scrol {
        height:100%;
        background-color: #4FC1E9;
        text-align: center;
    }
    .slimScrollBar{ background: rgb(39, 145, 191);}

    .table > thead > tr > th, 
    .table > tbody > tr > th, 
    .table > tfoot > tr > th, 
    .table > thead > tr > td, 
    .table > tbody > tr > td, 
    .table > tfoot > tr > td
    {
        border-top: 1px solid #ffffff;
    }
    .calendar-env .calendar-body .fc-header .fc-header-right{
        text-align: right;
    }
</style>


<div class="row">
    <div class="col-sm-7">
        <div class="panel panel-primary " data-collapsed="0">        
            <div class="panel-heading">                 
                <div class="panel-title">             
                    <i class="fa fa-calendar"></i>       
                    <?php echo get_phrase('event_schedule'); ?>     
                </div>            
            </div>               
            <div class="panel-body" style="padding:0px;">       
                <div class="calendar-env">                  
                    <div class="calendar-body">        
                        <div id="notice_calendar" dir="ltr"></div>      
                    </div>                   
                </div>               
            </div>             
        </div> 
    </div>
    <?php foreach ($children_of_parent as $row1) { ?>

        <div class="col-sm-5">
            <span class="btn btn-success"><i class="fa fa-user"></i><?php echo $row1['name'] ?></span>
            <div id="chartdiv<?php echo $row1['student_id'] ?>" style="height: 300px"></div>
            <div style="text-align: center">امتحانی رپورٹ</div>
        </div>
        <script type="text/javascript">
            var chart1 = AmCharts.makeChart("chartdiv<?php echo $row1['student_id'] ?>", {
            "theme": "none",
                    "type": "serial",
                    "dataProvider": [
    <?php
    $exams = $this->db->get_where('exam', array('status' => 1))->result_array();
    foreach ($exams as $exam) {
        ?>
                        {
                        "subject": "<?php echo $exam['name'] ?>",
                        "mark_obtained":"<?php echo $this->exam_model->get_each_exam_sum('mark_obtained', $exam['exam_id'], $row1['student_id'], $year); ?>",
                        "mark_highest":"<?php echo $this->exam_model->get_each_exam_sum('mark_total', $exam['exam_id'], $row1['student_id'], $year); ?>"
                        },
    <?php } ?>

                    ],
                    "valueAxes": [{
                    "stackType": "3d",
                            "unit": "",
                            "position": "left",
                            "title": "حاصل کردہ اور مجموعی نبرات کا جائیزہ"
                    }],
                    "startDuration": 1,
                    "graphs": [{
                    "balloonText": " حاصل کردہ نمبرات [[category]]: <b>[[value]]</b>",
                            "fillAlphas": 0.9,
                            "lineAlpha": 0.2,
                            "title": "2004",
                            "type": "column",
                            "fillColors": "#7f8c8d",
                            "valueField": "mark_obtained"
                    }, {
                    "balloonText": "مجموعی نمبرات   [[category]]: <b>[[value]]</b>",
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
    <?php } ?>
</div>



<script>
    $(document).ready(function () {
    var calendar = $('#notice_calendar');
    $('#notice_calendar').fullCalendar({
    header: {
    left: 'title',
            right: 'today prev,next'
    },
            editable: false,
            firstDay: 1,
            height: 530,
            droppable: false,
            events: [
<?php
$notices = $this->db->get('noticeboard')->result_array();
foreach ($notices as $row):
    ?>
                {
                title: "<?php echo $row['notice_title']; ?>",
                        start: new Date(<?php echo date('Y', $row['create_timestamp']); ?>,
    <?php echo date('m', $row['create_timestamp']) - 1; ?>,
    <?php echo date('d', $row['create_timestamp']); ?>),
                        end:
                        new Date(<?php echo date('Y', $row['create_timestamp']); ?>,
    <?php echo date('m', $row['create_timestamp']) - 1; ?>,
    <?php echo date('d', $row['create_timestamp']); ?>)
                },
    <?php
endforeach
?>
            ]
    });
    });




</script>  

