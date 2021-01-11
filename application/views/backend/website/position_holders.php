<style>
    li{text-align: right}
</style>
<script src="<?= base_url() ?>assets/js/urdutextbox.js"></script>

<script>
    window.onload = myOnload;

    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txtname);
        MakeTextBoxUrduEnabled(txtfather_name);

    }

</script>
<div class="row">
    <div class="col-md-12">
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('position_holders'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_position_holders'); ?>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('image') ?></th>
                            <th><?php echo get_phrase('father_name') ?></th>
                            <th><?php echo get_phrase('district') ?></th>
                            <th><?php echo get_phrase('roll_no') ?></th>
                            <th><?php echo get_phrase('obt_marks') ?></th>
                            <th><?php echo get_phrase('positions'); ?></th>
                            <th><?php echo 'ملکی /صوبا ئی' ?></th>
                            <th><?php echo get_phrase('class'); ?></th>
                            <th><?php echo get_phrase('session'); ?></th>
                            <th><?= get_phrase('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $this->db->order_by('session');
                        $position_holders = $this->db->get('web_position_holders')->result();
                        foreach ($position_holders as $pos) {
                            ?>
                            <tr>
                                <td></td>
                                <td><?= $pos->name ?></td>
                                <td><?= $pos->father_name ?></td>
                                <td><?= $pos->roll_no ?></td>
                                <td><?= $pos->marks ?></td>
                                <td><?= $pos->position ?></td>
                                <td><?= $pos->position_type ?></td>
                                <td><?= $this->db->get_where('main_classes', array('id' => $pos->class_id))->row()->name; ?></td>
                                <td><?= $pos->session ?></td>
                                <td>
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>     
                                                <a href="#" onclick="showAjaxModal('<?= base_url('modal/popup/modals/edit_position_holders/'.$pos->id) ?>')">          
                                                    <i class="entypo-pencil"></i>    
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!--.-->
            <div class="tab-pane box" id="add">
                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                        <form class="form-horizontal" method="post" action="<?= base_url('add_position_holder') ?>" enctype="multipart/form-data">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" name="name"  id="txtname" class="form-control" placeholder="<?= 'نام طالب علم' ?>" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" name="father_name"  id="txtfather_name" class="form-control" placeholder="<?= 'نام ولدیت' ?>" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" name="roll_no"  id="roll" class="form-control" placeholder="<?= 'رولنمبر' ?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" name="marks"  id="marks" class="form-control" placeholder="<?= 'حاصل کردہ نمبرات' ?>" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" name="position"  id="position" class="form-control" placeholder="<?= 'پوزیشن' ?>" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" name="position_type"  id="position" class="form-control" placeholder="<?= 'ملکی/صوبائی' ?>" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" name="session"  id="session" class="form-control" placeholder="<?= 'سیشن اور تعلیمی سال' ?>" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <select class="form-control" name="district_id" placeholder="<?= 'ضلع' ?>" >
                                            <?php
                                            $dsitricts = $this->db->get('district')->result();
                                            foreach ($dsitricts as $dist) {
                                                ?>
                                                <option value="<?= $dist->dist_id ?>"><?= $dist->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <select class="form-control" name="class_id" placeholder="<?= 'درجہ' ?>" required="">
                                            <?php
                                            $classes = $this->db->get('main_classes')->result();
                                            foreach ($classes as $class) {
                                                ?>
                                                <option value="<?= $class->id ?>"><?= $class->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success"><?= 'پوزیشن ہولڈر شامل کریں' ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="fileinput fileinput-new col-md-12" data-provides="fileinput">								
                                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">									
                                        <img src="http://placehold.it/200x200" alt="...">								
                                    </div>							
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>								
                                    <div>									
                                        <span class="btn btn-white btn-file">										
                                            <span class="fileinput-new"><?php echo get_phrase('select_image') ?></span>										
                                            <span class="fileinput-exists">تبدیل کریں</span>										
                                            <input type="file" name="student_image" accept="image/*" required="">									
                                        </span>									
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">ختم کریں</a>								
                                    </div>							
                                </div>
                            </div>


                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>