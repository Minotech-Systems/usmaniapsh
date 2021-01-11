<html>
    <head>
        <title><?= 'جامعہ عثمانیہ پشاور' ?></title>
        <link rel="stylesheet" href="assets/fonts/nastaleeq/font.css">
        <link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.min.css">
        <script src="assets/js/jquery-1.11.0.min.js"></script>
        <style>
            body{margin: 0px; padding: 0px; font-family:'Noto Nastaliq Urdu Draft', serif;}
            h3, h4, h5 {margin-bottom: 0px;}
            #print_btn{
                background-color: #00BCD4;
                border: none;
                color: white;
                padding: 0px 35px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 12px;
                border-radius: 5px;
                margin-top: 10px;
            }
        </style>
    </head>
    <body dir="rtl">
        <?php foreach ($student_data as $data) { ?>
            <div style="text-align:center">
                <a align="center" onClick="PrintElem('#print')"  id="print_btn" href="#" >
                    <i class="fa fa-print"></i>        
                    <?= 'پرنٹ فارم' ?>

                </a>
            </div>

            <div class="body" id="print">
                <img src="<?php echo $this->crud_model->get_image_url('new_admission', $data->image); ?>" width="80" style="margin-right: 30px;">
                <h4 style="text-align: left; margin-top: 45px; margin-left: 20px;"><?= $tamlimi_saal ?></h4>
                <table width="100%">
                    <tr>
                        <td width="40%">
                            <h4 style="margin-right: 75px; margin-top: 20px;"><?= $data->name ?></h4>
                        </td>
                        <td>
                            <h4 style="margin-top: 20px;" dir="rtl">
                                <?php
                                $dob = explode('-', $data->dob);
                                echo $dob[0] . '&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;' . $dob[1] . '&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;' . $dob[2];
                                ?> 
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td><h4 style="margin-right: 70px; margin-top: 10px;"><?= $data->father_name ?></h4></td>

                    </tr>
                </table>
                <table width="75%" style="margin-top: 80px; margin-right: 170px; font-size: 12px;">
                    <tr>
                        <td>
                            <h4><?= $data->c_address ?></h4>
                        </td>
                    </tr>
                </table>


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
                var mywindow = window.open('body', 'certificate', 'height=1200,width=1000');
                mywindow.document.write('<html><head><title>certificate</title>');
                mywindow.document.write('<link rel="stylesheet" href="assets/fonts/nastaleeq/font.css" type="text/css" />');
                mywindow.document.write('<link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />');
                mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
                mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-forms.css" type="text/css" />');
                mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
                mywindow.document.write('</head><body dir="rtl" style="font-family:Noto Nastaliq Urdu Draft">');
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
    </body>
</html>