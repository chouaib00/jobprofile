<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
      <div class="col-lg-12">

          <div class="panel white-bg">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-md-3">
                    <h4>Applicant Search</h4>
                  </div>
                  <div class="col-md-2 pull-right text-right" >
                    <div class="input-group">
                      <select class="form-control filter-field" name="filter-type">
                        <option value="most-relevant" selected>Most Relevant</option>
                        <option value="strict-match">Strict Match</option>
                      </select>
                      <span class="input-group-btn">
                        <button id="filter-applicants" class="btn btn-warning btn-outline has-tooltip form-submit" title="Filter"><i class="fa fa-filter"></i></button>
                      </span>
                    </div>


                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <h5 class="text-center">Filter</h5>
                          <div class="ibox-tools">
                              <a class="collapse-link">
                                  <i class="fa fa-chevron-up"></i>
                              </a>
                          </div>
                      </div>
                      <div class="ibox-content">
                        <div id="filter" class="form-horizontal">
                          <div class="well">
                            <strong>Note:</strong> Leave Fields Blank to select all in the category
                          </div>
                          <div class="form-group">
                            <div class="col-sm-3">
                              <h5>Highest Educational Attainment</h5>
                              <select name="applicant-educ-attainment" class="filter-field form-control select2-educ-attainment" data-placeholder="Select Highest Educational Attainment" multiple="multiple">
                                  <option></option>
                              </select>
                            </div>
                            <div class="col-sm-9">
                              <h5>Age Range</h5>
                              <div name="age-range" data-default="10;90"></div>
                            </div>
                          </div>
                          <h5>Address</h5>
                          <div class="form-group">
                              <div class="col-sm-4 m-t-sm">
                                <select class="filter-field form-control select2-region" name="add-region" data-placeholder="Select Region" <?php echo ($form_data['present_add_region']['region_id'])? '': 'disabled' ?>>
                                    <option></option>
                                </select>
                              </div>
                              <div class="col-sm-4 m-t-sm">
                                <select class="filter-field form-control select2-province" name="add-province" data-placeholder="Select Province" <?php echo ($form_data['present_add_province']['province_id'])? '': 'disabled' ?>>
                                    <option></option>

                                </select>
                              </div>
                              <div class="col-sm-4 m-t-sm">
                                <select class="filter-field form-control select2-city" name="add-city" data-placeholder="Select City" <?php echo ($form_data['present_add_city']['city_id'])? '': 'disabled' ?> >
                                    <option></option>
                                </select>
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-sm-12">
                              <h5>Skills</h5>
                              <select class="select2-skill form-control filter-field" name="applicant-skills" data-placeholder="Select Skills" multiple="multiple">
                              </select>
                            </div>

                          </div>
                          <div class="form-group">
                            <div class="col-sm-2">
                              <h5>Gender</h5>
                              <select class="select2-basic form-control filter-field" name="applicant-gender" data-placeholder="Select Gender">
                                <option></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>

                    <div class="ibox float-e-margins">
                      <div class="ibox-title blue-bg">Applicant List</div>
                      <div class="ibox-content">
                        <div class="table-responsive">
                          <!-- <table id="applicant-list" class="table table-striped table-bordered table-hover" data-config="">
                            <thead>
                              <tr>
                                <th class="col-md-2 text-center">Applicant Name</th>
                                <th class="col-md-1 text-center">Gender</th>
                                <th class="col-md-1 text-center">Age</th>
                                <th class="col-md-2 text-center">Contact Info</th>
                                <th class="col-md-1 text-center">Field of Study</th>
                                <th class="col-md-1 text-center">Email</th>
                                <th class="col-md-3 text-center">Present Address</th>
                                <th class="col-md-1 text-center">Skillset</th>
                                <th class="col-md-1 text-center no-sort">Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            </tbody>
                          </table> -->
                          <table id="applicant-list" class="table shoping-cart-table">
                              <tbody>

                              </tbody>
                          </table>
                        </div>
                      </div>
                    </div>


              </div>
          </div>
          </div>
    </div>

</div>

<script src="<?php echo JS_DIR ?>components/applicant/filter.js"></script>
