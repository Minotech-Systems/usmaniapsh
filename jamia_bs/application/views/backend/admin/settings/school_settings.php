<?php $data = $this->settings_model->get_settings_data(); ?>
<div class="row justify-content-md-center">
    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"><?php echo get_phrase('settings'); ?></h4>
                <form method="POST" class="col-12 schoolForm" action="<?php echo route('settings/update'); ?>" id = "schoolForm">
                    <div class="col-12">
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="name">System Name</label>
                            <div class="col-md-9">
                                <input type="text" id="school_name" name="name" class="form-control"  value="<?php echo $data['system_name']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="phone"><?php echo get_phrase('phone'); ?></label>
                            <div class="col-md-9">
                                <input type="text" id="phone" name="phone" class="form-control"  value="<?php echo $data['phone']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="address"> <?php echo get_phrase('address'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="address" name = "address" rows="5" required><?php echo $data['address']; ?></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-secondary col-xl-4 col-lg-4 col-md-12 col-sm-12" onclick="updateSchoolInfo()"><?php echo get_phrase('update_settings'); ?></button>
                        </div>
                    </div>
                </form>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div>
</div>
