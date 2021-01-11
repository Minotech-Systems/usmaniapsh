<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/jameel/font.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/amiri/font.css">
        <style>

            .marker{ font-family: 'amiri'; text-align: justify}
            body{
                font-weight: normal;
                font-style: normal;
                font-family: "jameelnoori", "Helvetica Neue", Helvetica, Arial, sans-serif;
            }
            #top tr td{ padding-right: 10px;}
            p{
                font-size: 18px; font-weight: bold;
            }

            @page { 
                margin: 120pt 0pt 120pt;

            }

        </style>
    </head>
    <body>

        <table id="top" width="100%"  align="center"  dir="rtl" style="text-align: center;" >
            <tr>
                <td width="50%" dir="rtl"><?= 'سوال نمبر'.' : '.$question_data->question_no ?></td>
                <td width="50%" style="padding-right:50px"><span dir="ltr"><?= date('d/m/Y', strtotime($question_data->date_added)) ?></span></td>
            </tr>
        </table>
        <table dir="rtl"  align="center"  width="80%" style="margin-top: 20px">
            <tr>
                <td align="center"><h2 style="margin-bottom:0px"><?= $question_data->title ?></h2></td>
            </tr>
            <tr>
                <td align="right">
                    <p style="font-size:18px; font-weight: bold; text-align: justify; line-height: 1.5">
                        <span style="margin-right:20px"><?= 'سوال' ?>:</span><?= $question_data->question ?>
                    </p>
                </td>
            </tr>
        </table>
    </body>
</html>