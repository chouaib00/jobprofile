<div class="wrapper wrapper-content animated fadeInLeft">
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
                        <div class="col-sm-3"><input name="applicant-first-name" type="text" class="form-control" placeholder="First Name" value="<?php echo $form_data['applicant_first_name'] ?>"></div>
                        <div class="col-sm-3"><input name="applicant-middle-name" type="text" class="form-control" placeholder="Middle Name" value="<?php echo $form_data['applicant_middle_name'] ?>"></div>
                        <div class="col-sm-3"><input name="applicant-last-name" type="text" class="form-control" placeholder="Last Name" value="<?php echo $form_data['applicant_last_name'] ?>"></div>
                        <div class="col-sm-3"><input name="applicant-name-ext" type="text" class="form-control" placeholder="Name Extension" value="<?php echo $form_data['applicant_name_ext'] ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <h5>Present Address</h5>
                    <div class="form-group">
                        <div class="col-sm-12"><input type="text" name="present-add-desc" class="form-control" placeholder="(House/Unit No., Floor & Bldg./Street, Lot / Blk, Brgy / Village)" value="<?php echo $form_data['present_add_desc'] ?>"></div>
                        <div class="col-sm-3 m-t-sm" style="display:none">
                          <select class="form-control select2-country" name="present-add-country" data-placeholder="Select Country">
                              <option></option>
                              <option value="178" selected>Philippines</option>
                              <?php /*if($form_data['present_add_country']['country_id']){ ?>
                              <option value="<?php echo $form_data['present_add_country']['country_id'] ?>" selected><?php echo $form_data['present_add_country']['country_name'] ?></option>
                            <?php } */ ?>
                          </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-region" name="present-add-region" data-placeholder="Select Region" >
                              <option></option>
                              <?php if($form_data['present_add_region']['region_id']){ ?>
                              <option value="<?php echo $form_data['present_add_region']['region_id'] ?>" selected><?php echo $form_data['present_add_region']['region_code'].' - '.$form_data['present_add_region']['region_desc'] ?></option>
                              <?php } ?>
                          </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-province" name="present-add-province" data-placeholder="Select Province" <?php echo ($form_data['present_add_province']['province_id'])? '': 'disabled' ?>>
                              <option></option>
                              <?php if($form_data['present_add_province']['province_id']){ ?>
                              <option value="<?php echo $form_data['present_add_province']['province_id'] ?>" selected><?php echo $form_data['present_add_province']['province_name'] ?></option>
                              <?php } ?>

                          </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-city" name="present-add-city" data-placeholder="Select City" <?php echo ($form_data['present_add_city']['city_id'])? '': 'disabled' ?>>
                              <option></option>
                              <?php if($form_data['present_add_city']['city_id']){ ?>
                              <option value="<?php echo $form_data['present_add_city']['city_id'] ?>" selected><?php echo $form_data['present_add_city']['city_name'] ?></option>
                              <?php } ?>
                          </select>
                        </div>
                    </div>
                    <h5>Permanent Address</h5>

                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="text" name="permanent-add-desc" class="form-control" placeholder="(House/Unit No., Floor & Bldg./Street, Lot / Blk, Brgy / Village)" value="<?php echo $form_data['permanent_add_desc'] ?>">
                      </div>
                        <div class="col-sm-3 m-t-sm" style="display:none">
                        <select class="form-control select2-country" name="permanent-add-country" data-placeholder="Select Country">
                            <option></option>
                            <option value="178" selected>Philippines</option>
                            <?php /* if($form_data['permanent_add_country']['country_id']){ ?>
                            <option value="<?php echo $form_data['permanent_add_country']['country_id'] ?>" selected><?php echo $form_data['permanent_add_country']['country_name'] ?></option>
                            <?php } */ ?>
                        </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-region" name="permanent-add-region"  data-placeholder="Select Region">
                              <option></option>
                              <?php if($form_data['permanent_add_region']['region_id']){ ?>
                              <option value="<?php echo $form_data['permanent_add_region']['region_id'] ?>" selected><?php echo $form_data['permanent_add_region']['region_code'].' - '.$form_data['permanent_add_region']['region_desc'] ?></option>
                              <?php } ?>
                          </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-province" name="permanent-add-province" data-placeholder="Select Province" <?php echo ($form_data['permanent_add_province']['province_id'])? '': 'disabled' ?>>
                              <option></option>
                              <?php if($form_data['permanent_add_province']['province_id']){ ?>
                              <option value="<?php echo $form_data['permanent_add_province']['province_id'] ?>" selected><?php echo $form_data['permanent_add_province']['province_name'] ?></option>
                              <?php } ?>
                          </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-city" name="permanent-add-city" data-placeholder="Select City" <?php echo ($form_data['permanent_add_city']['city_id'])? '': 'disabled' ?>>
                              <option></option>
                              <?php if($form_data['permanent_add_city']['city_id']){ ?>
                              <option value="<?php echo $form_data['permanent_add_city']['city_id'] ?>" selected><?php echo $form_data['permanent_add_city']['city_name'] ?></option>
                              <?php } ?>
                          </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                      <div class="col-sm-3">
                        <h5>Gender</h5>
                        <label class="checkbox-inline i-checks"> <input type="radio" value="male" name="applicant-gender" checked> <i></i> Male </label>
                        <label class="checkbox-inline i-checks"> <input type="radio" value="female" name="applicant-gender" <?php echo $form_data['applicant_gender'] == 'female'? 'checked': '' ?>> <i></i> Female</label>
                      </div>
                      <div class="col-sm-3">
                        <h5>Birthday</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="applicant-birthday" class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php echo $form_data['applicant_birthday'] ?>">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <h5>Weight (kg)</h5>
                        <input type="number" min="0" max="200" class="form-control" name="applicant-weight" value="<?php echo $form_data['applicant_weight']  ?>"/>
                      </div>
                      <div class="col-sm-3">
                        <h5>Height (cm)</h5>
                        <input type="number" min="0" max="220" class="form-control" name="applicant-height" value="<?php echo $form_data['applicant_height']  ?>"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-4">
                        <h5>Civil Status</h5>
                        <select class="form-control select2-basic" name="applicant-civil-status" data-placeholder="Select Civil Status">
                            <option></option>
                            <option value="single" <?php echo $form_data['applicant_civil_status'] == 'single'? 'selected' : '' ?>>Single</option>
                            <option value="married" <?php echo $form_data['applicant_civil_status'] == 'married'? 'selected' : '' ?>>Married</option>
                            <option value="divorced" <?php echo $form_data['applicant_civil_status'] == 'divorced'? 'selected' : '' ?>>Divorced</option>
                            <option value="separated" <?php echo $form_data['applicant_civil_status'] == 'separated'? 'selected' : '' ?>>Separated</option>
                            <option value="widowed" <?php echo $form_data['applicant_civil_status'] == 'widowed'? 'selected' : '' ?>>Widowed</option>
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <h5>Nationality</h5>
                        <input name="applicant-nationality" type="text" class="form-control" placeholder="Enter Nationality" value="<?php echo $form_data['applicant_nationality'] ?>">
                      </div>
                      <div class="col-sm-4">
                        <h5>Citizenship</h5>
                        <select class="form-control select2-basic" name="applicant-citizenship" data-placeholder="Select Citizenship">
                            <option></option>
                            <option value="Natural Born" <?php echo $form_data['applicant_citizenship'] == 'Natural Born'? 'selected' : '' ?>>Natural Born</option>
                            <option value="Dual Citizenship" <?php echo $form_data['applicant_citizenship'] == 'Dual Citizenship'? 'selected' : '' ?>>Dual Citizenship</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-4">
                        <h5>Religion</h5>
                        <input name="applicant-religion" type="text" class="form-control" placeholder="Enter Religion" value="<?php echo $form_data['applicant_religion'] ?>">
                      </div>
                      <div class="col-sm-4">
                        <h5>Employment Status</h5>
                        <select class="form-control select2-basic" name="applicant-emp-status" data-placeholder="Select Employment Status">
                            <option></option>
                            <option value="employed" <?php echo $form_data['applicant_emp_status'] == 'employed'? 'selected' : '' ?>>Employed</option>
                            <option value="unemployed" <?php echo $form_data['applicant_emp_status'] == 'unemployed'? 'selected' : '' ?>>Unemployed</option>
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <h5>Preferred Occupation</h5>
                        <input name="applicant-preferred-occupation" type="text" class="form-control" placeholder="Enter Preferred Occupation" value="<?php echo $form_data['applicant_preferred_occupation'] ?>">
                      </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <h4>Contact Details</h4>
                    <div class="form-group">
                      <div class="col-sm-4">
                        <h5>Main Contact Number</h5>
                        <input name="phone-number-1" type="text" class="form-control" placeholder="Enter Main Contact Number" value="<?php echo $form_data['phone_number_1'] ?>">
                      </div>
                      <div class="col-sm-4">
                        <h5>Mobile Number</h5>
                        <input name="phone-number-2" type="text" class="form-control" placeholder="Enter Mobile Number" value="<?php echo $form_data['phone_number_2'] ?>">
                      </div>
                      <div class="col-sm-4">
                        <h5>Home Number</h5>
                        <input name="phone-number-3" type="text" class="form-control" placeholder="Enter Home Number" value="<?php echo $form_data['phone_number_3'] ?>">
                      </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                      <div class="col-sm-3">
                        <h5>Highest Educational Attainment</h5>
                        <select name="applicant-educ-attainment" class="form-control select2-educ-attainment" data-placeholder="Select Highest Educational Attainment">
                            <option></option>
                            <option value="<?php echo $form_data['applicant_educ_attainment']['ea_id'] ?>" selected><?php echo $form_data['applicant_educ_attainment']['ea_name'] ?></option>
                        </select>
                      </div>
                    </div>
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
                      <select class="select2-skill form-control" name="applicant-skills[]" data-placeholder="Select Skills" multiple="multiple">
                      <option></option>
                      <?php foreach($form_data['skill_tag'] as $skill){ ?>
                        <option value="<?php echo $skill['st_id'] ?>" selected><?php echo $skill['st_name'] ?></option>
                      <?php }?>
                    </select>
                  </div>
              </div>
            </div>
          </div>
          <div class="ibox">
            <div class="ibox-title">
              <h5>Applicant Summary</h5>
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
                    <textarea class="form-control" name="applicant-summary" maxlength="255"><?php echo $form_data['applicant_summary'] ?></textarea>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <button id="update-profile" class="btn btn-primary col-sm-12 btn-outline" type="button">
                  <h3 class="font-bold"><i class="fa fa-id-card"></i> Update Profile</h3>
                </button>
              </div>
          </div>

        </form>
    </div>
  </div>
</div>


<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
