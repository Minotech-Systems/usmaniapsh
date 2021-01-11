<div class="col-lg-3 mt-5 order-md-2 course_col hidden text-center" id="lesson_list_loader">
    <img src="<?php echo base_url('assets/backend/images/loader.gif'); ?>" alt="" height="50" width="50">
</div>
<div class="col-lg-3  order-md-2 course_col" id = "lesson_list_area">
    <div class="text-center margin-ms">
        <h5><?php echo 'جامعہ عثمانیہ یوٹیوب وڈیوز'; ?></h5>
    </div>
    <div class="row m-10-1">
        <div class="col-12">
            <ul class="nav nav-tabs" id="lessonTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="section_and_lessons-tab" data-toggle="tab" href="#section_and_lessons" role="tab" aria-controls="section_and_lessons" aria-selected="true"><?php echo get_phrase('videos') ?></a>
                </li>
            </ul>
            <div class="tab-content" id="lessonTabContent">
                <div class="tab-pane fade show active" id="section_and_lessons" role="tabpanel" aria-labelledby="section_and_lessons-tab">
                    <!-- Lesson Content starts from here -->
                    <div class="accordion" id="accordionExample">
                        <?php
                        $sections = $this->db->get_where('video_section', array('id' => $section_id))->result_array();
                        $opened_section_id = $section_id;
                        foreach ($sections as $key => $section):
                            $videos = $this->db->get_where('video_lectures', array('section_id' => $section_id))->result_array();

//                            $lessons = $this->lms_model->get_lessons('section', $section['id'])->result_array();
                            ?>
                            <div class="card m-0">
                                <div class="card-header course_card" id="<?php echo 'heading-' . $section['id']; ?>">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left button-stk" type="button" data-toggle="collapse" data-target="<?php echo '#collapse-' . $section['id']; ?>" <?php if ($opened_section_id == $section['id']): ?> aria-expanded="true" <?php else: ?> aria-expanded="false" <?php endif; ?> aria-controls="<?php echo 'collapse-' . $section['id']; ?>" onclick = "toggleAccordionIcon(this, '<?php echo $section['id']; ?>')">
                                            <h6 class="h-fc">
                                                <?php echo get_phrase('section') . ' ' . ($key + 1); ?>
                                                <span class="accordion_icon icon-st" id="accordion_icon_<?php echo $section['id']; ?>">
                                                    <?php if ($opened_section_id == $section['id']): ?>
                                                        <i class="mdi mdi-minus"></i>
                                                    <?php else: ?>
                                                        <i class="mdi mdi-plus"></i>
                                                    <?php endif; ?>
                                                </span>
                                            </h6>
                                            <?php echo $section['title']; ?>
                                        </button>
                                    </h5>
                                </div>

                                <div id="<?php echo 'collapse-' . $section['id']; ?>" class="collapse <?php if ($section_id == $section['id']) echo 'show'; ?>" aria-labelledby="<?php echo 'heading-' . $section['id']; ?>" data-parent="#accordionExample">
                                    <div class="card-body p-0">
                                        <table class="w-100">
                                            <?php
                                            $key = 1;
                                            foreach ($videos as $lesson):
                                                ?>

                                                <tr class="course-sidebar-td" style="background-color: <?php
                                                if ($lesson_id == $lesson['id'])
                                                    echo '#E6F2F5';
                                                else
                                                    echo '#fff';
                                                ?>;">
                                                    <td  dir="rtl" class="course-sidebar-td"  style="text-align:right; padding-right: 20px;border-bottom: 1px solid #e7e7e7">


                                                        <a href="<?php echo site_url('videos/play/' . $section['title'] . '/' . $section_id . '/' . $lesson['id']); ?>" id = "<?php echo $lesson['id']; ?>" class="lst">
                                                            
                                                            <?php echo $key++ . ' : ' . $lesson['title']; ?>
                                                        </a>

                                                        <div class="lesson_duration">
                                                            <?php if ($lesson['video_type'] == 'video' || $lesson['video_type'] == '' || $lesson['video_type'] == NULL): ?>
                                                                <i class="mdi mdi-play-circle-outline"></i>
                                                                <?php echo readable_time_for_humans($lesson['duration']); ?>


                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Lesson Content ends from here -->
                </div>
            </div>
        </div>
    </div>
</div>