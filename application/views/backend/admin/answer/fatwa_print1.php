<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/jameel/font.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/amiri/font.css">
        <style>
            #border{
                border: solid black 1px;
                -moz-border-radius: 6px;
                -webkit-border-radius: 6px;
                border-radius: 6px;
                -webkit-box-shadow: 0 1px 1px #ccc;
                -moz-box-shadow: 0 1px 1px #ccc;
                box-shadow: 0 1px 1px #ccc;
                text-align: center;
                margin-top: 20px;
                line-height: 2;
            }
            .marker{ font-family: 'amiri'}
            body{
                font-weight: normal;
                font-style: normal;
                font-family: "jameelnoori", "Helvetica Neue", Helvetica, Arial, sans-serif;
            }
        </style>
    </head>
    <body >
        <div id="print">
            <table width="90%" align="center" dir="rtl">
                <tr>
                    <td align="center">
                        <img src="<?= base_url('uploads/header.png') ?>" width="30%">
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <?= 'جامعہ عثمانیہ پشاور ' . ' - ' . 'پوسٹ بکس نمبر۱۲۰۹ نوتھیہ روڈ پشاور' . ' - ' . 'jamiausmania1992@gmail.com' ?>
                    </td>
                </tr>
                <tr>
                    <td><hr></td>
                </tr>
            </table>

            <?php
            foreach ($fatwa as $data) {
                $questioner_detail = $this->db->get_where('ifta_questioner', array('questioner_id' => $data->questioner_id))->row();
                $mujeeb_detail = $this->db->get_where('ifta_user_question', array('question_id' => $data->question_id))->row();
                ?>
                <table dir="rtl"  align="right" >
                    <tr>
                        <td align="right"><?= 'سوال' ?>:<?= $data->question ?></td>
                    </tr>
                </table>
                <table width="100%"   dir="rtl">
                    <tr>
                        <td width="70%" align="right">
                            <table   width="60%" align="left" id="border" dir="rtl">
                                <tr>
                                    <td colspan="2"><?= 'دارلافتاء جامعہ عثمانیہ پشاور' ?></td>
                                </tr>
                                <tr>
                                    <td><?= 'سلسلہ نمبر' ?>&nbsp;:&nbsp; <?= $data->selsela_num ?></td>
                                    <td><?= 'بنام' ?> &nbsp;:&nbsp; <?= $questioner_detail->name ?></td>
                                </tr>
                                <tr>
                                    <td><?= 'تاریخ آمد' ?>&nbsp;: &nbsp;<?= $data->q_date ?></td>
                                    <td><?= 'واپسی' ?>&nbsp; : &nbsp;<?= $data->an_date ?></td>
                                </tr>
                                <tr>
                                    <td><?= 'فتویٰ نمبر' ?>&nbsp; : &nbsp;<?= $data->fatwa_num ?></td>
                                    <td><?= 'دستخط' ?>&nbsp; : &nbsp;<?= '__________' ?></td>
                                </tr>

                            </table>
                        </td>
                        <td style="font-size:12px" align="center">
                            <?= 'بینواتوجروا' ?><br>
                            <?= 'مستفتی' . ' : ' . $questioner_detail->name ?>
                        </td>
                    </tr>
                </table>

                <table align="right" dir="rtl" style="margin-top: 30px; " width="100%">
                    <tr>
                        <td><?= 'الجواب وباللہ التوفیق:' ?></td>
                    </tr>
                    <tr>
                        <td style="padding-right: 30px;"><?= $data->answer ?></td>
                    </tr>
                </table>
                <table align="right" dir="rtl" style="margin-top: 10px; width:95%" >
                    <tr>
                        <td>
                            <?= 'کتبہ : ' ?><?= $this->db->get_where('ifta_users', array('user_id' => $mujeeb_detail->user_id))->row()->name ?>
                            
                        </td>
                    </tr>
                    <tr>
                        <?php $editors = json_decode($data->editors) ?>
                        <td><p><?= 'شریک تخصص فی الفقہ الاسلامی' ?></p></td>
                        <?php foreach ($editors as $edit) { ?>
                            <td>
                                <p>
                                    <?php
                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . 'الجواب صحیح' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                    ?>
                                </p>
                            </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td align="right">
                            <p>
                                <?= 'جامعہ عثمانیہ پشاور' ?>
                            </p>
                        </td>
                    </tr>
                </table>
            <?php } ?>
        </div>
        <!--
        
                <script type="text/javascript">
                    jQuery(document).ready(function ($)
                    {
                        var elem = $('#print');
                        PrintElem(elem);
                        Popup(data);
        
                    });
        
        
                    function PrintElem(elem)
                    {
                        Popup($(elem).html());
                    }
        
                    function Popup(data)
                    {
                        var mywindow = window.open('', '', 'height=400,width=600');
                        mywindow.document.write('<html><head><title>certificate</title>');
        
                        mywindow.document.write('<link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />');
                        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
                        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-forms.css" type="text/css" />');
                        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
                        mywindow.document.write('</head><body>');
                        mywindow.document.write(data);
                        mywindow.document.write('</body></html>');
        
                        setInterval(function () {
                            mywindow.document.close();
                            mywindow.focus();
                            mywindow.print();
                            mywindow.close();
                        }, 100);
                    }
                </script>-->
    </body>
</html>