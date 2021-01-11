
<style>
#chartdiv {
  width: 285px;;
  height: 147px;
 margin-right: -57px
}

.amcharts-export-menu-top-right {
  top: 10px;
  right: 0;
}
</style>


<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="tile-stats tile-neon-red">
            <div class="icon"><i class="fa fa-money" style="vertical-align: 0px;"></i></div>
            <div class="num" data-start="0" data-end="1243456789" data-postfix="" data-duration="1400" data-delay="0">0</div>

            <h3>مجموعی واجبی اخراجات</h3>
            <p><?= 'سال نمبر ' . $talimi_saal . ' کے تمام واجبی اخراجات' ?></p>
        </div>	
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="tile-stats tile-neon-red">
            <div class="icon"><i class="fa fa-money" style="vertical-align: 0px;"></i></div>
            <div class="num" data-start="0" data-end="1243456789" data-postfix="" data-duration="1400" data-delay="0">0</div>

            <h3>مجموعی عمومی اخراجات</h3>
            <p><?= 'سال نمبر ' . $talimi_saal . ' کے تمام عمومی اخراجات' ?></p>
        </div>	
    </div>


    <div class="col-md-3 col-sm-6">
        <div class="tile-stats tile-neon-red">
            <div class="icon"><i class="fa fa-money" style="vertical-align: 0px;"></i></div>
            <div class="num" data-start="0" data-end="1243456789" data-postfix="" data-duration="1400" data-delay="0">0</div>

            <h3>مجموعی ترقیاتی اخراجات</h3>
            <p><?= 'سال نمبر ' . $talimi_saal . ' کے تمام ترقیاتی اخراجات' ?></p>
        </div>	
    </div>


    <div class="col-md-3 col-sm-6">
        <div class="col-md-12">
            <div id="chartdiv1" style="width: 300px; height: 160px;"></div>
           <script>
            var chart;

            var chartData = [
                {
                    "country": "Czech Republic",
                    "litres": 156.9,
                    "short": "CZ"
                },
                {
                    "country": "Ireland",
                    "litres": 131.1,
                    "short": "IR"
                },
                {
                    "country": "Germany",
                    "litres": 115.8,
                    "short": "DE"
                },
                {
                    "country": "Australia",
                    "litres": 109.9,
                    "short": "AU"
                },
                {
                    "country": "Austria",
                    "litres": 108.3,
                    "short": "AT"
                },
                {
                    "country": "UK",
                    "litres": 99,
                    "short": "UK"
                },
                {
                    "country": "Belgium",
                    "litres": 93,
                    "short": "BE"
                }
            ];

            AmCharts.ready(function () {
                // SERIAL CHART
                var chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "country";
                chart.startDuration = 2;
                // change balloon text color
                chart.balloon.color = "#000000";

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridAlpha = 0;
                categoryAxis.axisAlpha = 0;
                categoryAxis.labelsEnabled = false;

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.gridAlpha = 0;
                valueAxis.axisAlpha = 0;
                valueAxis.labelsEnabled = false;
                valueAxis.minimum = 0;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.balloonText = "[[category]]: [[value]]";
                graph.valueField = "litres";
                graph.descriptionField = "short";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                graph.fillColors = ["#ffe78e", "#bf1c25"];
                graph.labelText = "[[description]]";
                graph.balloonText = "[[category]]: [[value]] Litres";
                chart.addGraph(graph);

                chart.creditsPosition = "top-right";

                // WRITE
                chart.write("chartdiv1");
            });
        </script>
         
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-md-9">
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



    <div class="col-md-3">
        <div class="tile-stats tile-primary">
            <div class="icon"><i class="entypo-chat"></i></div>
            <div class="num" data-start="0" data-end="124" data-postfix="" data-duration="1400" data-delay="0">0</div>
            <h3>تمام اخراجات</h3>
            <p><?= 'سال نمبر ' . $talimi_saal . ' کے تمام اخراجات' ?></p>

        </div>	

        <br/>

        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-users"></i></div>
            <div class="num" data-start="0" data-end="213" data-postfix="" data-duration="1400" data-delay="0">0</div>

            <h3>تمام امدنی</h3>
            <p><?= 'سال نمبر ' . $talimi_saal . ' کے تمام امدنی' ?></p>
        </div>	


    </div>
</div>



<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


<!-- Imported scripts on this page -->
<script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="assets/js/jquery.sparkline.min.js"></script>

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

