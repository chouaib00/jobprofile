<div class="wrapper wrapper-content animated fadeInLeft">
  <input type="hidden" id="employer-id" value="<?php echo $employer_id ?>">
  <div class="row">
      <div class="col-lg-12">
              <div class="ibox float-e-margins">
                  <div class="ibox-title">
                      <h5>Posted Job Vacancy</h5>
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

                    <div class="table-responsive">
                      <table id="vacancy-list" class="table table-striped table-bordered table-hover" data-config="{}">
                        <thead>
                          <tr>
                            <th class="col-md-2 text-center">Date Posted</th>
                            <th class="col-md-6 text-center">Vacancy</th>
                            <th class="col-md-2 text-center">Status</th>
                            <th class="col-md-2 text-center no-sort">Action</th>
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

<script src="<?php echo JS_DIR ?>components/vacancy/posted_vacancy_list.js"></script>
