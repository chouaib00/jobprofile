
<div class="wrapper wrapper-content animated fadeInLeft">
        <div class="row">
          <div class="col-lg-12 text-right">
            <?php if(empty($form_data['applicant_application'])){ ?>
              <button class="btn btn-success dim form-submit" data-form="main-form"><i class="fa fa-briefcase"></i> Apply on this JOB</button>
            <?php }?>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
              <div class="ibox float-e-margins">
                <div class="ibox-content">
                  <form id="main-form" action="?" method="POST" class="form-horizontal">
                    <div class="form-group">
                      <div class="col-lg-12">
                        <h5>Cover Letter</h5>
                        <?php if(empty($form_data['applicant_application'])){ ?>
                          <textarea class="form-control" name="cover-letter" maxlength="2048" placeholder="Introduce yourself in this job application. Write something about yourself/skill/etc. that will give you an edge over other applicants."></textarea>
                        <?php }
                        else{ ?>
                          <p>Applied</p>
                          <p class="well"><?php echo $form_data['applicant_application']['aa_cover_letter']?></p>
                        <?php }?>
                      </div>
                    </div>
                  </form>
                </div>
              </div>


            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
              <div class="ibox float-e-margins">
                <div class="ibox-content">
                  <div class="form-horizontal">

                      <div class="form-group">
                        <div class="col-md-12">
                          <h3 class="text-success"><?php echo $form_data['jp_title'] ?> <?php echo ($form_data['jp_open'] == '1')? '' : '[CLOSED]' ?></h3>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12">
                          <h4><?php echo $form_data['employer']['employer_name'] ?></h4>
                        </div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <h4 class="text-danger">*Qualification/s</h4>
                          </div>
                        </div>
                        <?php if(!empty($form_data['educ_qualification'])){ ?>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <h5>Educational Attainment</h5>
                            <p>
                              <?php
                                foreach($form_data['educ_qualification'] as $educ_qualification){ ?>
                                  <span class="label label-primary"><?php echo $educ_qualification['ea_name'] ?></span>
                                <?php
                                }
                              ?>
                            </p>

                          </div>
                        </div>
                        <?php }?>

                        <div class="form-group">
                          <div class="col-sm-12">
                            <h5>Age Range</h5>
                            <p><span class="label label-primary"><?php echo (!empty($form_data['agefrom_qualification']))? $form_data['agefrom_qualification']['jpq_value'] : '10'  ?> yrs. old to <?php echo (!empty($form_data['ageto_qualification']))? $form_data['ageto_qualification']['jpq_value'] : '90'  ?> yrs. old</span></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <?php if(!empty($form_data['region_qualification'])){ ?>
                          <div class="col-sm-12 m-t-sm">
                            <h5>Region <span class="label label-primary"><?php echo $form_data['region_qualification'][0]['region_desc'] ?></span></h5>
                          </div>
                          <?php } ?>
                          <?php if(!empty($form_data['province_qualification'])){ ?>
                          <div class="col-sm-12 m-t-sm">
                            <h5>Province <span class="label label-primary"><?php echo $form_data['province_qualification'][0]['province_name'] ?></span></h5>
                          </div>
                          <?php } ?>
                          <?php if(!empty($form_data['city_qualification'])){ ?>
                          <div class="col-sm-12 m-t-sm">
                            <h5>City <span class="label label-primary"><?php echo $form_data['city_qualification'][0]['city_name'] ?></span></h5>
                          </div>
                          <?php } ?>
                        </div>

                        <?php if(!empty($form_data['skill_qualification'])){ ?>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <h5>Skills</h5>
                            <p>
                              <?php
                                foreach($form_data['skill_qualification'] as $skill_qualification){ ?>
                                  <span class="label label-primary"><?php echo $skill_qualification['st_name'] ?></span>
                                <?php
                                }
                               ?>
                            </p>
                          </div>
                        </div>
                        <?php }?>
                        <?php if(!empty($form_data['gender_qualification'])){ ?>
                        <div class="form-group">
                          <div class="col-sm-12 m-t-sm">
                            <h5>Gender <span class="label label-primary"><?php echo $form_data['gender_qualification'][0]['jpq_value'] ?></span></h5>
                          </div>
                        </div>
                        <?php } ?>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group">
                        <div class="col-md-12">
                          <h5>Job Vacancy Description</h5>
                          <div class="well"><?php echo $form_data['jp_description'] ?></div>
                        </div>
                      </div>
                      <div class="hr-line-dashed"></div>
                  </div>
                </div>
              </div>


            </div>

        </div>



</div>
<script src="<?php echo JS_DIR ?>components/vacancy/apply_vacancy.js"></script>
