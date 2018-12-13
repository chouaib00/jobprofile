<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
      <div class="col-lg-12">
              <div class="ibox float-e-margins">
                  <div class="ibox-title">
                      <h5>Summary</h5>
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
                    <div class="row">
                      <div class="col-md-12 text-right">
                        <a href="<?php echo DOMAIN?>utility/add-job-fair" class="btn btn-info btn-outline"><i class="fa fa-plus"></i> ADD JOB FAIR</a>
                      </div>
                      <div class="col-md-12">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover datatable-basic" data-config="{}">
                              <thead>
                                <tr>
                                    <th class="col-md-11 text-center">Employer</th>
                                    <th class="col-md-1 text-center no-sort">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php foreach($employee_list as $employee){ ?>
                                  <tr>
                                      <td><?php echo $employee['employer_name'] ?></td>
                                      <td>
                                          <div class="text-center">
                                            <a class="btn btn-info has-tooltip" target="_blank" href="<?php echo DOMAIN.'jobfair/print-summary/'.$employee['jfa_jf_id'].'/'.$employee['employer_id'] ?>" title="Print Summary"><i class="fa fa-file-pdf-o"></i></a>
                                          </div>
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
    </div>

</div>

<script src="<?php echo JS_DIR ?>components/jobfair/summary.js"></script>
