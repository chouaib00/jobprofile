<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">

    <div class="col-lg-10">
    </div>

    <div class="col-lg-2 text-right">
      <a href="<?php echo DOMAIN?>applicant/print_resume  " class="btn btn-success has-tooltip form-submit" name="save" title="Add Resident" data-form="main-form"><i class="fa fa-print"></i> VIEW PDF</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <form method="POST" action="?" enctype="multipart/form-data">
          <div class="ibox">
              <div class="ibox-title">
                  <h5>Personal Information</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                          <i class="fa fa-chevron-up"></i>
                      </a>
                      <a class="fullscreen-link">
                          <i class="fa fa-expand"></i>
                      </a>
                  </div>
              </div>
              <div class="ibox-content">
                <div class="form-horizontal">

                    <input type="hidden" name="applicant-username" value="<?php echo $form_data['applicant_username'] ?>">
                    <h5>First Name, Middle Name, Last Name, Name Extension</h5>
                    <div class="form-group">
                        <div class="col-sm-3"><input name="applicant-first-name" type="text" class="form-control" readonly value="<?php echo $form_data['applicant_first_name'] ?>"></div>
                        <div class="col-sm-3"><input name="applicant-middle-name" type="text" class="form-control" readonly value="<?php echo $form_data['applicant_middle_name'] ?>"></div>
                        <div class="col-sm-3"><input name="applicant-last-name" type="text" class="form-control" readonly value="<?php echo $form_data['applicant_last_name'] ?>"></div>
                        <div class="col-sm-3"><input name="applicant-name-ext" type="text" class="form-control" readonly value="<?php echo $form_data['applicant_name_ext'] ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <h5>Present Address</h5>
                    <div class="form-group">
                        <div class="col-sm-12"><input type="text" class="form-control" readonly value="<?php echo $form_data['present_add_desc'] ?>"></div>
                        <div class="col-sm-3 m-t-sm">
                          <input type="text" class="form-control" readonly value="<?php echo $form_data['present_add_country']['country_name'] ?>">
                        </div>
                        <div class="col-sm-3 m-t-sm">
                          <input type="text" class="form-control" readonly value="<?php echo $form_data['present_add_region']['region_code'].' - '.$form_data['present_add_region']['region_desc'] ?>">
                        </div>
                        <div class="col-sm-3 m-t-sm">
                          <input type="text" class="form-control" readonly value="<?php echo $form_data['present_add_province']['province_name'] ?>">
                        </div>
                        <div class="col-sm-3 m-t-sm">
                          <input type="text" class="form-control" readonly value="<?php echo $form_data['present_add_city']['city_name'] ?>">
                        </div>
                    </div>
                    <h5>Permanent Address</h5>
                    <div class="form-group">
                        <div class="col-sm-12"><input type="text" class="form-control" readonly value="<?php echo $form_data['permanent_add_desc'] ?>"></div>
                        <div class="col-sm-3 m-t-sm">
                          <input type="text" class="form-control" readonly value="<?php echo $form_data['permanent_add_country']['country_name'] ?>">
                        </div>
                        <div class="col-sm-3 m-t-sm">
                          <input type="text" class="form-control" readonly value="<?php echo $form_data['permanent_add_region']['region_code'].' - '.$form_data['permanent_add_region']['region_desc'] ?>">
                        </div>
                        <div class="col-sm-3 m-t-sm">
                          <input type="text" class="form-control" readonly value="<?php echo $form_data['permanent_add_province']['province_name'] ?>">
                        </div>
                        <div class="col-sm-3 m-t-sm">
                          <input type="text" class="form-control" readonly value="<?php echo $form_data['permanent_add_city']['city_name'] ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                      <div class="col-sm-3">
                        <h5>Gender</h5>
                        <input type="text" class="form-control" readonly value="<?php echo ucwords($form_data['applicant_gender']) ?>">
                      </div>
                      <div class="col-sm-3">
                        <h5>Birthday</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input readonly type="text" class="form-control" value="<?php echo $form_data['applicant_birthday'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-3">
                        <h5>Civil Status</h5>
                        <input type="text" class="form-control" readonly value="<?php echo ucwords($form_data['applicant_civil_status']) ?>">
                      </div>
                      <div class="col-sm-3">
                        <h5>Nationality</h5>
                        <input type="text" class="form-control" readonly value="<?php echo $form_data['applicant_nationality'] ?>">
                      </div>
                      <div class="col-sm-3">
                        <h5>Citizenship</h5>
                        <input type="text" class="form-control" readonly value="<?php echo $form_data['applicant_citizenship'] ?>">
                      </div>
                      <div class="col-sm-3">
                        <h5>Highest Educational Attainment</h5>
                        <input type="text" class="form-control" readonly value="<?php echo $form_data['applicant_educ_attainment']['ea_name'] ?>">
                      </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <h4>Contact Details</h4>
                    <div class="form-group">
                      <div class="col-sm-4">
                        <h5>Main Contact Number</h5>
                        <input type="text" class="form-control" readonly value="<?php echo $form_data['phone_number_1'] ?>">
                      </div>
                      <div class="col-sm-4">
                        <h5>Mobile Number</h5>
                        <input type="text" class="form-control" readonly value="<?php echo $form_data['phone_number_2'] ?>">
                      </div>
                      <div class="col-sm-4">
                        <h5>Home Number</h5>
                        <input type="text" class="form-control" readonly value="<?php echo $form_data['phone_number_3'] ?>">
                      </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <h4>Education</h4>
                    <div class="form-group">
                      <div class="table-responsive col-md-12">
                        <table id="education-list" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th class="col-md-1 text-center no-sort">Action</th>
                              <th class="col-md-3 text-center">Type</th>
                              <th class="col-md-2 text-center">Field of Study</th>
                              <th class="col-md-6 text-center">School</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($form_data['education_table'] as $education){ ?>
                              <tr class="educ-row" data-no="<?php echo $education['no'] ?>" data-summary="<?php echo $education['data'] ?>">
                                  <td>
                                      <div class="text-center"><button type="button" disabled class="btn btn-info has-tooltip edit-row" title="Edit"><i class="fa fa-pencil"></i></button>
                                      <button type="button" disabled class="btn btn-danger has-tooltip delete-row" title="Delete" value=""><i class="fa fa-trash"></i></button></div>
                                  </td>
                                  <td><?php echo $education['educ_type_desc'] ?></td>
                                  <td><?php echo $education['field_of_study_desc'] ?></td>
                                  <td><?php echo $education['school_desc'] ?></td>
                              </tr>
                              <?php }?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <hr class="hr-line-solid"></hr>
                    <h4>Work Experience</h4>
                    <div class="form-group">
                      <div class="table-responsive col-md-12">
                        <table id="work-experience-list" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th class="col-md-1 text-center no-sort">Action</th>
                              <th class="col-md-3 text-center">Work Period</th>
                              <th class="col-md-2 text-center">Field of Work</th>
                              <th class="col-md-6 text-center">Company</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($form_data['work_table'] as $work){ ?>
                              <tr class="work-row" data-no="<?php echo $work['no'] ?>" data-summary="<?php echo $work['data'] ?>">
                                <td>
                                  <div class="text-center"><button type="button" disabled class="btn btn-info has-tooltip edit-row" title="Edit"><i class="fa fa-pencil"></i></button>
                                  <button type="button" disabled class="btn btn-danger has-tooltip delete-row" title="Delete" value=""><i class="fa fa-trash"></i></button></div>
                                </td>
                                <td><?php echo date('F-Y', strtotime($work['start_date'])).' - '.($work['end_date_current']? date('F-Y', strtotime($work['end_date'])) : 'Present') ?></td>
                                <td><?php echo $work['field_of_study_desc'] ?></td>
                                <td><?php echo $work['company_name'] ?></td>
                              </tr>
                              <?php }?>
                          </tbody>
                        </table>
                      </div>
                    </div>


                  </div>
              </div>
          </div>
          <div class="ibox">
            <div class="ibox-title">
              <h5>Skill Tag</h5>
              <div class="ibox-tools">
                  <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="fullscreen-link">
                      <i class="fa fa-expand"></i>
                  </a>
              </div>
            </div>
            <div class="ibox-content form-horizontal">
              <div class="form-group">
                  <div class="col-sm-12">
                      <h4>Skills</h4>
                      <p>
                        <?php foreach($form_data['skill_tag'] as $skill){ ?>
                          <span class="label label-success"><?php echo $skill['st_name'] ?></span>
                        <?php }?>
                      <p>
                  </div>
              </div>
            </div>
          </div>

        </form>
    </div>
  </div>
</div>
<?php $this->load->view('applicant/education_modal_view') ?>
<?php $this->load->view('applicant/work_modal_view') ?>


<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
