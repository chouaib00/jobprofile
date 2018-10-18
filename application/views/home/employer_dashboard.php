<input type="hidden" id="user-id" value="<?php echo $user_id ?>">
<div class="wrapper wrapper-content">
  <div class="row">
    <div class="col-lg-4">
      <div id="my-posted-job" class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">As of Today</span>
                <a href="<?php echo DOMAIN ?>vacancy/job-feed"><h5><i class="fa fa-briefcase"></i> My Posted Job</h5></a>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-center content-value"></h1>
                <small>No. Of my Posted Jobs</small>
            </div>
        </div>
    </div>


  </div>
</div>
<script src="<?php echo JS_DIR ?>components/home/dashboard_employer.js"></script>
