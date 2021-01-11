<?php
$edit_data = $this->db->get_where('district', array('dist_id' => $param2))->result_array();

foreach ($edit_data as $row):
    ?>

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">

                    <div class="panel-title" >

                        <i class="entypo-plus-circled"></i>

                        <?php echo get_phrase('edit_district'); ?>

                    </div>

                </div>

                <div class="panel-body">



                    <?php echo form_open(base_url() . 'index.php?admin/districts/update/' . $row['dist_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>

                    <div class="form-group">

                        <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="district" value="<?php echo $row['name']; ?>"/>

                        </div>

                    </div>
             

                    <div class="form-group">
                        <label  class="col-sm-3 control-label"><?php echo get_phrase('province'); ?></label> 
                        <div class="col-sm-5">
                            <select name="prov_id" class="form-control ">
                                <option value=""><?php echo get_phrase('select_province'); ?></option>
                                <?php
                                $prov = $this->db->get('province')->result_array();
                                foreach ($prov as $row2):
                                    ?>
                                    <option value="<?php echo $row2['prov_id']; ?>"
                                            <?php if ($row['prov_id'] == $row2['prov_id']) echo 'selected'; ?>><?php echo $row2['name']; ?></option>
                                        <?php endforeach; ?>
                            </select>
                        </div> 
                    </div>

                    <div class="form-group">

                        <div class="col-sm-offset-3 col-sm-5">

                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_district'); ?></button>

                        </div>

                    </div>

                    <?php echo form_close();?>

                </div>

            </div>

        </div>

    </div>



    <?php
endforeach;
?>





