<link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
<style>
    body{font-family: 'Noto Nastaliq Urdu Draft', serif;}
    h1, h2, h3, h4, h5, h6{ font-family:'Noto Nastaliq Urdu Draft', serif; }
    @media print
    {
        * {-webkit-print-color-adjust:exact;}
        .pagebreak{page-break-after: always;display: block;}
    }
</style>
<div id="print">
    <script src="assets/js/jquery-1.11.0.min.js"></script>

    <?php
    $branch = $this->crud_model->get_system_branch($branch_id);
    $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
    
    
    $no = 1;
    foreach ($students as $row) {
        $student_id = $row;
        $student_data = $this->db->get_where('student', array('student_id' => $row))->row();
        $student_enroll_data = $this->db->get_where('enroll', array('student_id' => $row))->row();
        
        $section = $this->db->get_where('section', array('section_id' => $student_enroll_data->section_id))->row()->name;
        ?>
        <table style="width:95%; margin-left:10px; <?php if(($no % 5) == 1) echo 'margin-top:8px'?>; transform:rotateY(180deg); " cellspacing="0" align="center">
            <tr>

                <td>
                    <div style="width:335px;" align="center">
                        <div style="width: 100%;height: 194px;border-radius: 10px;border:2px solid #bddd448a;
                             padding-bottom: 10px;margin-bottom:9px; float:left;
                             background-color: #bddd448a; background-image: url('uploads/bg2.png');
                             background-size: 300px 200px;
                             background-repeat: no-repeat; background-position: center;background-position-y: 10px; ">

                            <div style="width: 100%;float: right;height: 128px;">
                                <div>
                                    <h5 style="margin-top: 0px; margin-bottom: -5px;"><?php echo $branch; ?></h5>
                                </div>
                                <table  style="margin-bottom: 1px; font-size: 12px; line-height: 17px; padding-right: 15px; padding-left: 10px;"  width="100%" dir="rtl">
                                    <tbody>

                                        <tr>
                                            <td style=" padding: 1px; padding-left: 5px;" colspan="3" >
                                                <strong>
                                                    <?php
                                                    echo get_phrase('name') . ' : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $student_data->name;
                                                    ?>
                                                </strong>
                                            </td>


                                            <td rowspan="4" align="left">
                                                <img src="<?php echo $this->crud_model->get_image_url('student', $student_data->image); ?>" width="55" height="63"/>
                                                <br>
                                                <p style="font-size: 9px; margin:0px; padding-left: 3px;" dir="ltr">
                                                    <?php echo $student_data->reg_no; ?>
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="padding-left: 5px;" colspan="2">
                                                <strong>
                                                    <?php
                                                    echo get_phrase('parent') . ' : &nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $student_data->father_name;
                                                    ?>
                                                </strong>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="padding-left: 5px;" colspan="2">
                                                <strong><?php
                                                    echo get_phrase('class') . ' : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $this->crud_model->get_class_name($student_enroll_data->class_id) . ' (' . $section . ')';
                                                    ?>
                                                </strong>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="padding-left: 5px;" colspan="2">
                                                <strong><?php
                                                $nic_num = $student_data->father_nic;
                                                    $nic = explode('-', $nic_num);
                                                    if ($nic_num == '00000-0000000-0' || empty($nic_num)) {
                                                        
                                                    } else {
                                                        echo 'ولدیت  '.get_phrase('nic') . ' : ' . $nic[2] . '-' . $nic[1] . '-' . $nic[0];
                                                    }
                                                    ?>
                                                </strong>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="padding-left: 5px; font-size: 8px;" colspan="4">
                                                <?php
                                                echo '<strong>' . get_phrase('current_address') . '</strong>' . ' : ' . $student_data->c_address;
                                                ?>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="padding-left: 5px; font-size: 8px;" colspan="4">
                                                <?php
                                                echo '<strong>' . get_phrase('permanent_address') . '</strong>' . ' : ' . $student_data->p_address;
                                                ?>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <strong><?php
                                                    echo get_phrase('dob') . ' : &nbsp;&nbsp;&nbsp;' . $student_data->dob;
                                                    ?>
                                                </strong>
                                            </td>
                                            <td align="center" style="border-bottom: 1px solid black;"><image src="uploads/signs/sign2.png" width="40" height="20"/></td>
                                            <td align="center" colspan="2" style="border-bottom: 1px solid black;"><image src="uploads/signs/sign3.gif" width="40" height="20"/></td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                            <td align="left" style="font-size: 9px;">دستخط ناظم تعلیمات</td>
                                            <td align="left" colspan="2" style="font-size: 9px;">دستخط مہتمم</td>
                                        </tr>


                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>


                </td>

                <!---STUDENT ID CARD BACKEND --->
                <td>
                    <div style="width:335px;" align="center">
                        <div style="width: 100%;height: 194px;border-radius: 10px;border:2px solid #bddd448a;
                             padding-bottom: 10px;margin-bottom:9px; float:left;
                             background-color: #bddd448a; background-image: url('uploads/bg2.png');
                             background-size: 300px 200px;
                             background-repeat: no-repeat; background-position: center;background-position-y: 26px; ">

                            <div style="width: 100%;float: right;height: 128px;">
                                <div style="width:93%;">
                                    <h4 style="margin-top: 0px; margin-bottom: -5px;  font-size: 12px; color: white; background-color: #42ac51; width: 100%; box-shadow: 4px 4px 2px #065311;">
                                        <i class="fa fa-star"></i>
                                        <?php echo $system_name; ?>
                                        <i class="fa fa-star"></i>
                                    </h4>
                                </div>
                                <table  style="font-size:10px; margin-top: 4px; line-height: 2.4;"  width="90%" dir="rtl">
                                    <tbody>
                                        <tr>
                                            <td><u style="border-bottom: 3px solid black;"><?php echo 'تاریخ اجراء' ?></u></td>
                                            <td><span style="border-bottom: 2px solid black;" dir="ltr"><?php echo date('d-M-Y') ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><u style="border-bottom: 3px solid black;"><?php echo 'تاریخ تنسیخ' ?></u></td>
                                            <td><span style="border-bottom: 2px solid black;" dir="ltr">30-Aug-<?php echo $ex_year ?></span></td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="2"><u><?php
                                                    echo get_phrase('phone') . ' : ' .
                                                    '<span dir="ltr">' . $student_data->phone . '</span>';
                                                    ?></u></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="font-size:10px;  line-height: 1;"  width="90%" dir="rtl">
                                    <tr>
                                        <td align="center"><?php echo 'تاریخ اختتام کے بعدیہ کارڈکارآمدمتصورنہ ہوگا۔' ?></td>
                                        <td align="center"><image src="uploads/signs/sign1.jpg" width="40" height="30"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><?php echo 'گم شدہ کارڈملنے پرقریبی لیٹربکس میں ڈال دیں۔'; ?></td>
                                        <td><u style="border-bottom: 3px solid black;"><?php echo 'دستخط جاری کنندہ' ?></u></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <div style="background-color: #5e5e12; width:100%; height: 20px; margin-top: 13px; padding-top: 4px; text-align: center; color: white; box-shadow: 3px -3px 5px 0px black;">
                                                Jamia Usmania Nothia Road P.O Box 1209 Peshawar
                                            </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>


                </td>
            </tr>
        </table>

        <?php
        $no++;
        //if(($no% $no) == 0){
        if (($no % 5) == 1) {
            echo '<span class="pagebreak"></span>';
        }
    }
    ?>
</div>




