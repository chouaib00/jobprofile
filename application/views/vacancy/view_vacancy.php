
<div class="wrapper wrapper-content animated fadeInLeft">
        <div class="row">
            <div class="col-lg-12">
              <div class="cc">
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
            <div class="col-lg-12">
              <div class="ibox float-e-margins">
                <div class="ibox-title blue-bg clearfix">
                  <h4 class="panel-title pull-left">Pending Candidates for the Job Vacancy</h4>
                  <div class="pull-right">
                    <div class="ibox-tools">
                      <a id="generate-excel" type="button" class=" has-tooltip" title="Generate Excel List" style="display:none"><i class="fa fa-file-excel-o"></i></a>

                        <a class="collapse-link text-white">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                  </div>


                </div>
                <div class="ibox-content" style="max-height: 70vh; overflow-y: auto">
                  <div class="table-responsive">
                    <table id="applicant-list" class="table shoping-cart-table">
                        <tbody>
                          <?php foreach($form_data['applicant_application'] as $aa){
                            $contact = $aa['bc_phone_num1'];
                            if($aa['bc_phone_num2']){
                                $contact .= ' / '.$aa['bc_phone_num2'];
                            }
                            if($aa['bc_phone_num3']){
                                $contact .= ' / '.$aa['bc_phone_num3'];
                            }

                            ?>
                              <tr class="applicant-info hidden-last" data-aa-id="<?php echo $aa['aa_id']?>">
                                <td width="90">
                                    <div>
                                      <img class="img-circle img-responsive" src="<?php echo UPLOAD.'profile/'.(($aa['fm_encypted_name'])? $aa['fm_encypted_name'] : 'emp_img_default.png' )?>">
                                    </div>
                                </td>
                                <td class="desc">
                                    <h3>
                                    <a href="<?php echo DOMAIN.'applicant/view_profile/'.$aa['user_name']?>" class="text-navy">
                                      <?php echo $aa['bc_first_name'].' '.$aa['bc_middle_name'].' '.$aa['bc_middle_name'].' '.$aa['bc_name_ext'];?>
                                    </a>
                                    </h3>
                                    <p class="small">
                                        <?php echo $aa['applicant_summary'];?>
                                    </p>
                                    <dl class="small m-b-none">
                                        <dt>Current Address</dt>
                                        <dd>  <?php echo $aa['address_desc'].', '.$aa['city_name'].' City '.$aa['province_name'] ;?></dd>
                                    </dl>
                                    <dl class="small m-b-none">
                                        <dt>Contact</dt>
                                        <dd><?php echo $contact ?></dd>
                                    </dl>
                                </td>
                                <td width="200">
                                  <select class="select2-basic form-control" name="current-status">
                                    <option value="1" <?php echo ($aa['aa_applicantion_status'] == '1')? 'selected': '' ?>>Select Action</option>
                                    <option value="2" <?php echo ($aa['aa_applicantion_status'] == '2')? 'selected': '' ?>>Reject Application</option>
                                    <option value="3" <?php echo ($aa['aa_applicantion_status'] == '3')? 'selected': '' ?>>For Review</option>
                                    <option value="4" <?php echo ($aa['aa_applicantion_status'] == '4')? 'selected': '' ?>>Mark as Hired</option>
                                  </select>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <blockquote>
                                  <p>"<?php echo $aa['aa_cover_letter'] ?>"</p>
                                  <small><emp><?php echo $aa['bc_first_name'].' '.$aa['bc_middle_name'].' '.$aa['bc_middle_name'].' '.$aa['bc_name_ext'];?></emp></small>
                                </blockquote>
                              </td>
                            </tr>
                          <?php }?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="ibox float-e-margins">
                <div class="ibox-title blue-bg clearfix">
                  <h4 class="panel-title pull-left">Other Candidates Qualified for the Position</h4>
                  <div class="pull-right">
                    <div class="ibox-tools">
                      <a id="generate-excel" type="button" class=" has-tooltip" title="Generate Excel List" style="display:none"><i class="fa fa-file-excel-o"></i></a>

                        <a class="collapse-link text-white">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                  </div>


                </div>
                <div class="ibox-content" style="max-height: 70vh; overflow-y: auto">
                  <div class="table-responsive">
                    <table id="applicant-list" class="table shoping-cart-table">
                        <tbody>
                          <?php foreach($form_data['applicant_other_qualify'] as $aoq){
                            $contact = $aoq['bc_phone_num1'];
                            if($aoq['bc_phone_num2']){
                                $contact .= ' / '.$aoq['bc_phone_num2'];
                            }
                            if($aoq['bc_phone_num3']){
                                $contact .= ' / '.$aoq['bc_phone_num3'];
                            }

                            ?>
                              <tr class="applicant-info hidden-last" data-applicant-id="<?php echo $aoq['applicant_id'] ?>" data-jd-id="<?php echo $form_data['jp_id'] ?>">
                                <td width="90">
                                    <div>
                                      <img class="img-circle img-responsive" src="<?php echo UPLOAD.'profile/'.(($aoq['fm_encypted_name'])? $aoq['fm_encypted_name'] : 'emp_img_default.png' )?>">
                                    </div>
                                </td>
                                <td class="desc">
                                    <h3>
                                    <a href="<?php echo DOMAIN.'applicant/view_profile/'.$aoq['user_name']?>" class="text-navy">
                                      <?php echo $aoq['bc_first_name'].' '.$aoq['bc_middle_name'].' '.$aoq['bc_middle_name'].' '.$aoq['bc_name_ext'];?>
                                    </a>
                                    </h3>
                                    <p class="small">
                                        <?php echo $aoq['applicant_summary'];?>
                                    </p>
                                    <dl class="small m-b-none">
                                        <dt>Current Address</dt>
                                        <dd>  <?php echo $aoq['address_desc'].', '.$aoq['city_name'].' City '.$aoq['province_name'] ;?></dd>
                                    </dl>
                                    <dl class="small m-b-none">
                                        <dt>Contact</dt>
                                        <dd><?php echo $contact ?></dd>
                                    </dl>
                                </td>
                                <td width="200">
                                  <select class="select2-basic form-control" name="add-applicant-status">
                                    <option value="1">Select Action</option>
                                    <option value="2">Reject Application</option>
                                    <option value="3">For Review</option>
                                    <option value="4">Mark as Hired</option>
                                  </select>
                                </td>
                                <td>
                                </td>
                            </tr>
                          <?php }?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

        </div>



</div>
<script src="<?php echo JS_DIR ?>components/vacancy/view_vacancy.js"></script>
