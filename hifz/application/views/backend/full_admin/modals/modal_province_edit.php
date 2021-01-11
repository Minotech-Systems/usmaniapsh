<?php
$edit_data = $this->db->get_where('province', array('prov_id' => $param2))->result_array();

foreach ($edit_data as $row):
    ?>

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">

                    <div class="panel-title" >

                        <i class="entypo-plus-circled"></i>

                        <?php echo get_phrase('edit_province'); ?>

                    </div>

                </div>

                <div class="panel-body">



                    <?php echo form_open(base_url() . 'index.php?admin/provinces/update/' . $row['prov_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>

                    <div class="form-group">

                        <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="province" value="<?php echo $row['name']; ?>" required=""/>

                        </div>

                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 
                        <div class="col-sm-5">
                            <select name="country_id" class="form-control select" required="">
                                <option value=""><?php echo get_phrase('select_country'); ?></option>
                                <?php
                                $country = $this->crud_model->get_table_data('country');
                                foreach ($country as $country):
                                    ?>
                                <option value="<?php echo $country['country_id']; ?>" <?php if($country['country_id'] == $row['country_id']) echo 'selected';?>><?php echo $country['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div>

                    <div class="form-group">

                        <div class="col-sm-offset-3 col-sm-5">

                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_province'); ?></button>

                        </div>

                    </div>

                    </form>

                </div>

            </div>

        </div>

    </div>



    <?php
endforeach;
?>





