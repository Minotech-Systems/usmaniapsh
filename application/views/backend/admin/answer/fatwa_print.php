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
                font-size: 18px; font-weight: bold; text-align: justify;
            }

            @page { 
                margin: 120pt 0pt 120pt;

            }
            #question p{display: inline}

        </style>
    </head>
    <body >
        <div id="print">



            <?php
            foreach ($fatwa as $data) {
                $questioner_detail = $this->db->get_where('ifta_questioner', array('questioner_id' => $data->questioner_id))->row();
                $mujeeb_detail = $this->db->get_where('ifta_user_question', array('question_id' => $data->question_id))->row();
                ?>
                <table id="top" width="100%"  align="center"  dir="rtl" style="text-align: center;" >
                    <tr>
                        <td width="33.3%" dir="rtl"><?= $data->selsela_num ?></td>
                        <td width="33.3%"  dir="rtl"><?= $data->fatwa_num ?></td>
                        <td width="33.3%" style="padding-right:50px"><span dir="ltr"><?= date('d/m/Y', strtotime($data->q_date)) ?></span></td>
                    </tr>
                </table>



                <table dir="rtl"  align="center"  width="80%" style="margin-top: 20px" id="question">
                    <tr>
                        <td align="center"><h2 style="margin-bottom:0px"><?= $data->title ?></h2></td>
                    </tr>
                    <tr>
                        <td align="right">
                            <p style="font-size:18px; font-weight: bold; text-align: justify; line-height: 1.5; display: inline">
                                <span style="margin-right:20px"><?= 'سوال' ?>:</span><?= $data->question ?>
                            </p>
                        </td>
                    </tr>
                    <?php if ($data->show_mustafti == 1) { ?>
                        <tr>
                            <td align="left">
                                <p>
                                    <?= 'مستفتی: ' . ' ' . $this->db->get_where('ifta_questioner', array('questioner_id' => $data->questioner_id))->row()->name ?>
                                </p>

                            </td>
                        </tr>
                    <?php } ?>َ
                </table>
                <table dir="rtl"  align="center"  width="80%">
                    <tr>
                        <td align="center">
                            <h2 class="marker" style="text-align:center; margin-bottom: 0px;"><?= 'الجواب وباللہ التوفیق' ?></h2>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <p style="font-size:18px; font-weight: bold; text-align: justify;">
                                <?= $data->answer ?>
                            </p>
                        </td>
                    </tr>
                </table>


                <table align="center" dir="rtl" style="margin-top: 10px; width: 80%" >
                    <tr>
                        <td>
                            <p>
                                <?= 'کتبہ : ' ?><?= $this->db->get_where('ifta_users', array('user_id' => $mujeeb_detail->user_id))->row()->name ?>
                            </p>
                        </td>
                        <?php
                        $editors = json_decode($data->editors);
                        foreach ($editors as $edit) {
                            ?>
                            <td>
                                <p class="marker" style="font-size: 14px;">
                                    <?php
                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . 'الجواب صحیح' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                    ?>
                                </p>
                            </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><p><?= 'شریک تخصص فی الفقہ الاسلامی' ?></p></td>

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

    </body>
</html>