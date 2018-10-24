<input type="hidden" id="user-id" value="<?php echo $user_id ?>">
<div class="wrapper wrapper-content">
  <div class="row">
    <div class="col-lg-4">
      <div id="reg-app" class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">As of Today</span>
                <a href="<?php echo DOMAIN ?>applicant/list"><h5><i class="fa fa-user"></i> Registered Applicant</h5></a>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-center content-value"></h1>
                <small>No. of Registered Applicants</small>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
      <div id="reg-emp" class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">As of Today</span>
                <a href="<?php echo DOMAIN ?>employer/list"><h5><i class="fa fa-user"></i> Registered Employer</h5></a>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-center content-value"></h1>
                <small>No. of Registered Employer</small>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
      <div id="jobposted" class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">As of Today</span>
                <a href="<?php echo DOMAIN ?>vacancy/vacancy-list"><h5><i class="fa fa-briefcase"></i> Job Posted</h5></a>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-center content-value"></h1>
                <small>Total Job Posted</small>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Applicant Registration
              </h5>
          </div>
          <div class="ibox-content">
              <div>
                  <canvas id="applicant-registration-linegraph" height="150"></canvas>
              </div>
          </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="ibox">
          <div class="ibox-content">
              <h5>Top 10 used skillset</h5>
              <table id="top-skill" class="table table-stripped small m-t-md">
                  <tbody>
                    
                  </tbody>
              </table>
          </div>
      </div>
  </div>

  </div>
</div>
<script src="<?php echo THEME ?>js/plugins/chartJs/Chart.min.js"></script>
<script src="<?php echo THEME ?>js/demo/chartjs-demo.js"></script>
<script src="<?php echo JS_DIR ?>components/home/dashboard_admin.js"></script>
