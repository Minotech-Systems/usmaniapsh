<div class="row">
    <div class="col-md-12">
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('daily_student_report'); ?>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="row">

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('month'); ?></label>
                                <div class="col-sm-9">
                                    <select name="month" class="form-control" id="month">
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
                            <input type="hidden" name="student_id"  id="student_id" value="<?= $student_id?>">
                            <div class="form-group">
                                <div class="col-sm-9 col-md-offset-3" style="margin-top: 10px; text-align: center;">
                                    <a  class="btn btn-success" onclick="get_student_daily_report_view()"><?= get_phrase('submit') ?></a>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!--.-->
                    <div class="col-sm-8  col-md-8" style="padding: 30px;">
                        <div id="daily_report_view"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function get_student_daily_report_view() {
        var student_id = $('#student_id').val();
        var month = $('#month').val();
        if (student_id  && month) {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?parents/load_daily_report_view/' + student_id +  '/' + month,
                success: function (response)
                {
                    jQuery('#daily_report_view').html(response);
                }
            });
        } else {
            alert('Select All field...')
            return false;
        }
    }
</script>
