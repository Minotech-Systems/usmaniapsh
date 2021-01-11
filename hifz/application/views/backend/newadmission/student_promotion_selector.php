<hr />
<div class="row" style="text-align: center;">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="tile-stats tile-gray">
            <div class="icon"><i class="entypo-users"></i></div>

            <h3 style="color: #696969;">
                <?php echo get_phrase('students'); ?> 
                <?php echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name; ?>
            </h3>
            <h4 style="color: #696969;">
                <?php echo get_phrase('branch'); ?>
                <span dir="ltr"><?php echo $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name; ?></span>
            </h4>
        </div>
    </div>
    <div class="col-sm-4"></div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead align="center">
                <tr>
                    <td align="center"><?php echo get_phrase('image'); ?></td>
                    <td align="center"><?php echo get_phrase('name'); ?></td>
                    <td align="center"><?php echo get_phrase('parent'); ?></td>
                    <td align="center"><?php echo get_phrase('reg_no'); ?></td>
                    <td align="center"><?php echo get_phrase('select') ?></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $students = $this->db->get_where('enroll', array(
                            'branch_id' => $branch_id,
                            'teacher_id' => $teacher_id,
                            'year' => $prev_year,
                            'status' => 1
                        ))->result_array();

                foreach ($students as $row):

                    $image = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->image;

                    $query = $this->db->get_where('enroll', array(
                        'student_id' => $row['student_id'],
                        'year' => $running_year
                    ));
                    $std_data = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
                    ?>
                    <tr>
                        <td align="center">
                            <img src="<?php echo $this->crud_model->get_image_url('student', $image); ?>" class="img-circle" width="30" />
                        </td>

                        <td align="center">
                            <?php echo $std_data->name; ?>
                        </td>
                        <td align="center">
                            <?php
                            echo $std_data->father_name
                            ?>
                        </td>
                        <td align="center" dir="ltr">
                            <?php echo $std_data->reg_no; ?>
                        </td>
                        <?php if ($query->num_rows() < 1): ?>
                            <td align="center">
                                <input type="checkbox" name="check_list[]" value="<?php echo $row['student_id'] ?>"/>
                                <input type="hidden" value="<?php echo $row['student_id'] ?>" id="student_id" >
                            </td>
                        <?php endif; ?>
                        <?php if ($query->num_rows() > 0): ?>
                            <td align="center">
                                <button class="btn btn-success" disabled="">
                                    <i class="entypo-check"></i> <?php echo 'تجدید کیا گیا ہے' ?>
                                </button> 
                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?newadmission/delete_promotion/<?php echo $row['student_id']; ?>');">   
                                    <i class="entypo-trash"></i>     
                                    <?php echo 'تبدیل کریں'; ?>        
                                </a>  



                            </td>

                        <?php endif; ?>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<br>

<div class="row">
    <center>
        <button type="submit"  class="btn btn-success">
            <i class="entypo-check"></i> <?php echo get_phrase('promote_slelected_students'); ?>
        </button>
    </center>
</div>
<div id="responses">

</div>

<script type="text/javascript">

    $(document).ready(function () {
        if ($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function (i, el)
            {
                var $this = $(el),
                        opts = {
                            showFirstOption: attrDefault($this, 'first-option', true),
                            'native': attrDefault($this, 'native', false),
                            defaultText: attrDefault($this, 'text', ''),
                        };

                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }
    });
</script>