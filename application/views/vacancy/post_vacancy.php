
<div class="wrapper wrapper-content animated fadeInLeft">
        <div class="row">
            <div class="col-lg-12">
              <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Post Job Vacancy</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                  <form id="main-form" class="form-horizontal" action="" method="POST">
                    <input type="hidden" name="age-range" value="[]">
                      <div class="form-group">
                        <div class="col-md-12">
                          <label>Employer</label>
                          <select name="employer" class="filter-field form-control" data-placeholder="Select Employer" <?php echo (empty($employer))? '' : 'disabled' ?>>
                              <option></option>
                              <?php if(!empty($employer)){ ?>
                              <option value="<?php echo $employer['employer_id'] ?>" selected><?php echo $employer['employer_name'] ?></option>
                              <?php } ?>
                              <?php if($form_data['employer']['employer_id']){ ?>
                              <option value="<?php echo $form_data['employer']['employer_id'] ?>" selected><?php echo $form_data['employer']['employer_name'] ?></option>
                              <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12">
                          <label>Job Vacancy Title</label>
                          <input type="text" name="vacancy-title" placeholder="Enter Job Vacancy Title" class="form-control" value="<?php echo $form_data['jp_title'] ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12">
                          <label class="checkbox-inline i-checks"> <input type="checkbox" value="open" name="is-open" <?php echo ($form_data['jp_open'] == '1')? 'checked' : '' ?>> <i></i> Open Job Vacancy </label>
                        </div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <div class="well well-info"><b>*Note: </b>Leave empty to disregard qualification</div>
                          </div>
                          <div class="col-sm-3">
                            <h5>Educational Attainment</h5>
                            <select name="applicant-educ-attainment[]" class="filter-field form-control select2-educ-attainment" data-placeholder="Select Highest Educational Attainment" multiple="multiple">
                                <option></option>
                                <?php if(!empty($form_data['educ_qualification'])){
                                  foreach($form_data['educ_qualification'] as $educ_qualification){ ?>
                                    <option value="<?php echo $educ_qualification['jpq_value']?>" selected><?php echo $educ_qualification['ea_name'] ?></option>
                                  <?php
                                  }
                                } ?>
                            </select>
                          </div>
                          <div class="col-sm-9">
                            <h5>Age Range</h5>
                            <div id="age-range" data-default="<?php echo (!empty($form_data['agefrom_qualification']))? $form_data['agefrom_qualification']['jpq_value'] : '10'  ?>;<?php echo (!empty($form_data['ageto_qualification']))? $form_data['ageto_qualification']['jpq_value'] : '90'  ?>"></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <h5>Address</h5>
                          </div>
                            <div class="col-sm-4 m-t-sm">
                              <select class="filter-field form-control select2-region" name="add-region" data-placeholder="Select Region" >
                                  <option></option>
                                  <?php if(!empty($form_data['region_qualification'])){ ?>
                                    <option value="<?php echo $form_data['region_qualification'][0]['jpq_value'] ?>" selected><?php echo $form_data['region_qualification'][0]['region_desc'] ?></option>
                                  <?php
                                  } ?>
                              </select>
                            </div>
                            <div class="col-sm-4 m-t-sm">
                              <select class="filter-field form-control select2-province" name="add-province" data-placeholder="Select Province" >
                                  <option></option>
                                  <?php if(!empty($form_data['province_qualification'])){ ?>
                                    <option value="<?php echo $form_data['province_qualification'][0]['jpq_value'] ?>" selected><?php echo $form_data['province_qualification'][0]['province_name'] ?></option>
                                  <?php
                                  } ?>
                              </select>
                            </div>
                            <div class="col-sm-4 m-t-sm">
                              <select class="filter-field form-control select2-city" name="add-city" data-placeholder="Select City" <?php echo ($form_data['present_add_city']['city_id'])? '': 'disabled' ?> >
                                  <option></option>
                                  <?php if(!empty($form_data['city_qualification'])){ ?>
                                    <option value="<?php echo $form_data['city_qualification'][0]['jpq_value'] ?>" selected><?php echo $form_data['city_qualification'][0]['city_name'] ?></option>
                                  <?php
                                  } ?>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <h5>Skills</h5>
                            <select class="select2-skill form-control filter-field" name="applicant-skills[]" data-placeholder="Select Skills" multiple="multiple">
                              <option></option>
                              <?php if(!empty($form_data['skill_qualification'])){
                                foreach($form_data['skill_qualification'] as $skill_qualification){ ?>
                                  <option value="<?php echo $skill_qualification['jpq_value']?>" selected><?php echo $skill_qualification['st_name'] ?></option>
                                <?php
                                }
                              } ?>
                            </select>
                          </div>

                        </div>
                        <div class="form-group">
                          <div class="col-sm-2">
                            <h5>Gender</h5>
                            <select class="select2-basic form-control filter-field" name="applicant-gender" data-placeholder="Select Gender">
                              <option></option>
                              <?php if(!empty($form_data['gender_qualification'])){ ?>
                                <option value="male" <?php echo ($form_data['gender_qualification'][0]['jpq_value'] == 'male')? 'selected' : '' ?>>Male</option>
                                <option value="female" <?php echo ($form_data['gender_qualification'][0]['jpq_value'] == 'female')? 'selected' : '' ?>>Female</option>
                              <?php
                              }
                              else{ ?>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                              <?php
                              }?>

                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group">
                        <div class="col-md-12">
                          <label>Job Vacancy Description</label>
                          <textarea type="text" name="vacancy-description" class="form-control text-editor" placeholder="Enter Job Description" ><?php echo $form_data['jp_description'] ?></textarea>
                        </div>
                      </div>

                  </form>
                </div>
              </div>


            </div>
            <div class="col-lg-12">
              <div class="form-group">
                  <div class="col-sm-4 col-sm-offset-4">
                      <button id="post-job-vacancy" class="btn btn-primary col-sm-12">
                        <h3 class="font-bold"><i class="fa fa-thumb-tack"></i> Post Job Vacancy</h3>
                      </button>
                  </div>
              </div>
            </div>

        </div>



</div>
<script src="<?php echo JS_DIR ?>components/vacancy/post_vacancy.js"></script>
