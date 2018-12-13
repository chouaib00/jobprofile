<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
      <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <span class="pull-right"></span>
                <h5>My Application</h5>
            </div>
            <?php foreach($application_list as $applicant){ ?>
            <div class="ibox-content">
              <div class="table-responsive">
                  <table class="table shoping-cart-table">
                      <tbody>
                      <tr>
                          <td class="desc">
                              <h3>
                              <p class="text-navy"><?php echo $applicant['jp_title']?></p>
                              </h3>
                              <dl class="small m-b-none">
                                  <dt>Job Posted</dt>
                                  <dd><?php echo date('M d Y h:i A', strtotime($applicant['jp_date_posted']))?></dd>
                                  <dt>Application Date</dt>
                                  <dd class="text-success"><?php echo date('M d Y h:i A', strtotime($applicant['aa_application_date']))?></dd>
                                  <?php /* ?><dd>A description list is perfect for defining terms.</dd><?php */ ?>
                              </dl>
                              <div class="m-t-sm">
                                  <blockquote class="text-muted"><?php echo (strlen($applicant['aa_cover_letter']) > 150)? substr($applicant['aa_cover_letter'], 0, 150).'...': $applicant['aa_cover_letter'];?></blockquote>
                              </div>
                          </td>

                          <td>
                            <h3><a class="text-navy has-tooltip" title="View Vacancy" href="<?php echo DOMAIN.'vacancy/apply-vacancy/'.$applicant['jp_id'] ?>"><i class="fa fa-external-link"></i></a></h3>
                          </td>
                      </tr>
                      </tbody>
                  </table>
              </div>

            </div>
            <?php }?>

          </div>
        </div>
      </div>
    </div>

</div>

<script src="<?php echo JS_DIR ?>components/vacancy/vacancy_list.js"></script>
