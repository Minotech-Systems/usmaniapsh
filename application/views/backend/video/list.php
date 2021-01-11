<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#videos" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('videos'); ?>
                </a>
            </li>
            <li>
                <a href="#videos_section" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('video_sections'); ?>
                </a>
            </li>
            <li>
                <a href="#add_section" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'add video section'; ?>
                </a>
            </li>
            <li>
                <a href="#add_video" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_video'); ?>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="videos">
                <table class="table table-bordered datatable" id="table-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?= get_phrase('title') ?></th>
                            <th><?= get_phrase('description') ?></th>
                            <th><?= get_phrase('section') ?></th>
                            <th><?= get_phrase('time') ?></th>
                            <th><?= get_phrase('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $videos = $this->db->get('video_lectures')->result();
                        foreach ($videos as $video) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $video->title ?></td>
                                <td><?= $video->description ?></td>
                                <td><?= $this->db->get_where('video_section', array('id' => $video->section_id))->row()->title; ?></td>
                                <td><?= $video->duration ?></td>
                                <td>
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>     
                                                <a href="<?php echo base_url(); ?>videos/edit_video/<?= $video->id ?>" >          
                                                    <i class="entypo-pencil"></i>    
                                                    <?php echo get_phrase('edit') ?>   
                                                </a>  
                                            </li>
                                            <li>     
                                                <a href="<?php echo base_url(); ?>videos/delete/<?= $video->id ?>" >          
                                                    <i class="entypo-pencil"></i>    
                                                    <?php echo get_phrase('edit') ?>   
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
            <div class="tab-pane box " id="videos_section">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?= get_phrase('title') ?></th>
                            <th><?= get_phrase('description') ?></th>
                            <th><?= get_phrase('date') ?></th>
                            <th><?= get_phrase('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sec = 1;
                        $vide_sectons = $this->db->get('video_section')->result();
                        foreach ($vide_sectons as $section) {
                            ?>
                            <tr>
                                <td><?= $sec++ ?></td>
                                <td><?= $section->title ?></td>
                                <td><?= $section->description ?></td>
                                <td><?= date('d-m-Y', strtotime($section->title)) ?></td>
                                <td>
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>     
                                                <a href="<?php echo base_url(); ?>videos/edit_video_sectiion/<?= $section->id ?>" >          
                                                    <i class="entypo-pencil"></i>    
                                                    <?php echo get_phrase('edit') ?>   
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
            <div class="tab-pane box " id="add_section">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-2">
                        <form class="form-horizontal" enctype="multipart/form-data" action="<?= base_url('videos/add_section') ?>" method="post">
                            <div class="form-group">
                                <label class="control-label" for="full_name"><?= get_phrase('title') ?></label>
                                <input type="text" class="form-control" name="section_title" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="full_name"><?= get_phrase('description') ?></label>
                                <textarea class="form-control" rows="3" name="section_description"> <?= $data->description ?></textarea>
                            </div>

                            <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 300px; height: 180px;" data-trigger="fileinput">
                                        <img src="<?= base_url('uploads/section_thumbnail/' . $data->thumbnail) ?>" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 180px"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>
                                            <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                            <input type="file" name="section_thumbnail" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><?= get_phrase('edit') ?></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <!--.-->
            <div class="tab-pane box " id="add_video">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-2">
                        <form class="form-horizontal" enctype="multipart/form-data" action="<?= base_url('videos/index/create') ?>" method="post">
                            <div class="form-group">
                                <label class="control-label" for="full_name"><?= get_phrase('video_title') ?></label>
                                <input type="text" class="form-control" name="title" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="full_name"><?= get_phrase('video_description') ?></label>
                                <textarea class="form-control" rows="3" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="full_name"><?= get_phrase('video_section') ?></label>
                                <select class="form-control" name="section_id">
                                    <?php
                                    $video_sections = $this->db->get('video_section')->result();
                                    foreach ($video_sections as $section) {
                                        ?>
                                        <option value="<?= $section->id ?>"><?= $section->title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="full_name"><?= get_phrase('video_type') ?></label>
                                <select class="form-control"  name="video_type" >
                                    <option value="youtube"><?php echo get_phrase('youtube'); ?></option>
                                    <option value="vimeo"><?php echo get_phrase('vimeo'); ?></option>
                                    <option value="html5"><?php echo get_phrase('HTML5'); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="full_name"><?= get_phrase('video_url') ?></label>
                                <input type="text" class="form-control" name="video_url"  placeholder="E.g: https://www.youtube.com/watch?v=oBtf8Yglw2w" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="full_name"><?= get_phrase('time') ?></label>
                                <input type="text" class="form-control" name="video_time"  placeholder="E.g: hh:mintues:seconds like 0:5:10" required>
                            </div>
                            <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 300px; height: 180px;" data-trigger="fileinput">
                                        <img src="" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 180px"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>
                                            <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                            <input type="file" name="video_thumbnail" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><?= get_phrase('submit') ?></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>