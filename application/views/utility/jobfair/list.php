<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
      <div class="col-lg-12">
              <div class="ibox float-e-margins">
                  <div class="ibox-title">
                      <h5>Job Fair</h5>
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
                    </div>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover datatable-basic" data-config="{}">
                        <thead>
                          <tr>
                              <th class="col-md-4 text-center">Title</th>
                              <th class="col-md-2 text-center">From</th>
                              <th class="col-md-2 text-center">To</th>
                              <th class="col-md-2 text-center">Status</th>
                              <th class="col-md-1 text-center">Active</th>
                              <th class="col-md-1 text-center no-sort">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($job_fair_list as $job_fair){ ?>
                          <tr class="<?php echo ($job_fair['js_is_current'])? 'success' : '' ?>">
                            <td><?php echo $job_fair['js_title'] ?></td>
                            <td class="text-center"><?php echo date('F j, Y', strtotime($job_fair['js_date_from'])) ?></td>
                            <td class="text-center"><?php echo date('F j, Y', strtotime($job_fair['js_date_to'])) ?></td>
                            <td><?php echo $job_fair['jf_is_status'] ?></td>
                            <td class="text-center"><?php echo ($job_fair['js_is_current'])? 'Active' : '' ?></td>
                            <td class="text-center">
                              <div >
                                <a class="btn btn-info has-tooltip" href="<?php echo DOMAIN.'utility/edit-job-fair/'.$job_fair['jf_id'] ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-primary has-tooltip" href="<?php echo DOMAIN.'jobfair/summary/'.$job_fair['jf_id'] ?>" title="Job Fair SUmmary"><i class="fa fa-tasks"></i></a>
                              </div>
                            </td>

                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>

                  </div>
              </div>
          </div>
    </div>

</div>

<script src="<?php echo JS_DIR ?>components/utility/jobfair_list.js"></script>
