<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
      <div class="col-lg-12">
              <div class="ibox float-e-margins">
                  <div class="ibox-title">
                      <h5>Applicant List</h5>
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
                    <button id="generate-excel" type="button" class="btn btn-outline btn-success dim has-tooltip" title="Generate Excel List"><i class="fa fa-file-excel-o"></i> Generate Excel List</button>

                    <div class="table-responsive">
                      <table id="employer-list" class="table table-striped table-bordered table-hover" data-config="{}">
                        <thead>
                          <tr>
                            <th class="col-md-3 text-center">Applicant</th>
                            <th class="col-md-2 text-center">Gender / Age</th>
                            <th class="col-md-1 text-center">Email</th>
                            <th class="col-md-1 text-center">Category</th>
                            <th class="col-md-2 text-center">Contact</th>
                            <th class="col-md-2 text-center">Address</th>
                            <th class="col-md-1 text-center no-sort">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
          </div>
    </div>

</div>

<script src="<?php echo JS_DIR ?>components/applicant/applicant_list.js"></script>
