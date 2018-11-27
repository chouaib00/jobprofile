<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
      <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <span class="pull-right">(<strong>5</strong>) items</span>
                <h5>My Job Feed</h5>
            </div>
            <?php foreach($feed as $job){
            if($job['qualified']){
              ?>
            <div class="ibox-content">
              <div class="table-responsive">
                  <table class="table shoping-cart-table">
                      <tbody>
                      <tr>
                          <td class="desc">
                              <h3>
                              <p class="text-<?php echo ($job['qualified'])? 'navy' : 'muted' ?>"><?php echo $job['jp_title']?></p>
                              </h3>
                              <p class="small"><?php echo date('M d Y h:i A', strtotime($job['jp_date_posted']))?></p>
                              <dl class="small m-b-none">
                                <dt><h4 class="text-info"><i class="fa fa-building-o"> <?php echo $job['employer_name']?></i></h4></dt>
                                <dd>
                                  <a class="view-vacancy-description" onclick="return false;" data-toggle="popover" data-container="body" data-placement="right" type="button" data-html="true" href="" data-jp-id="<?php echo $job['jp_id'] ?>">
                                    <i class="fa fa-briefcase " style="margin:3px 0 0 0"></i> Click here to see full description
                                  </a>
                                </dd>
                              </dl>
                              <div class="m-t-sm">
                                <?php if($job['qualified']){ ?>
                                  <h4 class="text-navy"><b>You are qualified <i class="fa fa-check-circle"></i></b></h4>
                                <?php }?>
                              </div>
                          </td>

                          <td>
                            <h3><a class="text-navy has-tooltip" title="View Vacancy" href="<?php echo DOMAIN.'vacancy/apply-vacancy/'.$job['jp_id'] ?>"><i class="fa fa-external-link"></i></a></h3>
                          </td>
                      </tr>
                      </tbody>
                  </table>
              </div>

            </div>
            <?php
            }
          }?>

          </div>
        </div>
      </div>
    </div>

</div>
<style>
.popover {
  max-width:70vw;
  max-height:15vw;
  overflow-y: auto;
}
</style>

<script src="<?php echo JS_DIR ?>components/vacancy/vacancy_list.js"></script>
