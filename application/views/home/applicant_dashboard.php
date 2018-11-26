<input type="hidden" id="user-id" value="<?php echo $user_id ?>">
<div class="wrapper wrapper-content">
  <div class="row">
    <div class="col-lg-4">
      <div id="job-fit" class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">As of Today</span>
                <a href="<?php echo DOMAIN ?>vacancy/job-feed"><h5><i class="fa fa-briefcase"></i> Posted Job</h5></a>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-center content-value"></h1>
                <small>Job Vacancy</small>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
      <div id="applied-job" class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">As of Today</span>
                <a href="<?php echo DOMAIN ?>vacancy/my-application"><h5><i class="fa fa-briefcase"></i> Applied Jobs</h5></a>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-center content-value"></h1>
                <small>Total Applied Jobs</small>
            </div>
        </div>
    </div>


  </div>
</div>
<script src="<?php echo JS_DIR ?>components/home/dashboard_applicant.js"></script>
