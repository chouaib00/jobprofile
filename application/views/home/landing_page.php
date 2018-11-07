<div id="wrapper">
  <div id="page-wrapper" class="gray-bg">
    <div class="banner">
      <div class="row">
        <header class="business-header">
          <div class="container-fluid ">
            <div class="row">
              <div class="col-lg-12">
                <nav id="navigation" class="navbar" role="navigation">
                  <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="<?php echo DOMAIN?>about">
                            <i class="fa fa-info"></i> About
                        </a>
                    </li>
                      <li>
                          <a href="<?php echo DOMAIN?>login">
                              <i class="fa fa-sign-in"></i> Log in
                          </a>
                      </li>
                  </ul>
                </nav>
              </div>
              <div class="col-lg-12">
                <h1 id="site-name" class="display-3 text-center mt-4">Public Employment Service Office<br>Batangas City</h1>
              </div>
              <div id="mission" class="col-lg-12">
                <h2 class="mt-4">Mission</h2>
                <blockquote>"To improve the quality of life of the citizens through sustained efforts to attain a balanced agro-industrial development; to generate more employment opportunities; and to adequately provide the basic infrastructure utilities, facilities and social services necessary for robust community."</blockquote>
              </div>
            </div>
          </div>
        </header>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row" style="padding: 50px 0px">
        <div class="col-md-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3>Job Vacancy</h3>
            </div>
            <div class="panel-body"  style="max-height: 70vh; overflow-y: auto">
              <?php foreach($job_post as $job){ ?>
              <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table shoping-cart-table">
                        <tbody>
                        <tr>
                            <td class="desc">
                                <h3>
                                <p class="text-navy"><?php echo $job['jp_title']?></p>
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
              <?php }?>
            </div>
          </div>
        </div>
      </div>
    <div class="row">
      <div class="col-md-8">
        <?php foreach($announcement_list as $announcement){ ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo $announcement['announcement_title'] ?> <small>~</small> </h5>

                <div class="ibox-tools">
                    <label class="label label-primary"><?php echo date('F j, Y - h:i:s A', strtotime($announcement['announcement_date'])) ?></label>
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
                  <div class="col-md-12">
                    <?php echo $announcement['announcement_content'] ?>
                  </div>
              </div>
            </div>
        </div>
        <?php }?>
      </div>
      <div class="col-md-4">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3><i class="fa fa-facebook-square"></i> Social Media Account </h3>
          </div>
          <div class="panel-body text-center">
            <div class="fb-page" data-href="https://www.facebook.com/peso.batangascity/" data-tabs="timeline" data-width="600" data-height="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/peso.batangascity/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/peso.batangascity/">PESO BatangasCity</a></blockquote></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">

    <h2 class="text-center">Contact Us</h2>
    <div class="col-lg-9">
      <address>

        <i class="fa fa-map-marker"></i> P. Dandan st. CCYA bldg.
        <br>Batangas City, Batangas
        <br>
      </address>
    </div>
    <div class="col-lg-3">
      <address>
        <i class="fa fa-phone"></i> 723-8802
        <br>
        <i class="fa fa-envelope"></i> <a href="mailto:#">pesobatangascity@yahoo.com.ph</a>
                <br>
      </address>
    </div>


  </div>
</div>
<footer class="py-5 bg-dark">
  <div class="container">
    <p class="m-0 text-center text-white">Copyright &copy; Public Employment Service Office - Batangas City 2018</p>
  </div>
  <!-- /.container -->
</footer>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>
$(document).ready(function(){

  $('.view-vacancy-description').popover({
    "html": true,
    "content": function(){
        var div_id =  "tmp-id-" + $.now();
        return details_in_popup($(this).data('jp-id'), div_id);
    }
  });

  function details_in_popup(link, div_id){
      $.ajax({
          url: global.site_name + 'vacancy/view-vacancy-ref/' + link,
          success: function(response){
              $('#'+div_id).html(response);
          }
      });
      return '<div id="'+ div_id +'">Loading...</div>';
  }
});
</script>

<style>
.popover {
  max-width:70vw;
  max-height:15vw;
  overflow-y: auto;
}

#navigation ul li{
  font-size: 48px;
  background: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7));
}
#mission{
  position:absolute; bottom:0;
  color: white;
  font-size: 48px;
  background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5));
}
#site-name{
    color: white;
    font-size: 48px;
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5));
}
.business-header {
  position:relative;
  height: 80vh;
  min-height: 200px;
  /* background: #b4ddb4 center center no-repeat scroll; */
  background: linear-gradient(rgba(255,255,255,0.5), rgba(255,255,255,0.5)), url('<?php echo IMG_DIR ?>landing_page.jpg') center center no-repeat scroll;
  transition: background 2s linear;
  -moz-transition: background 2s linear; /* Firefox 4 */
  -webkit-transition: background 2s linear; /* Safari and Chrome */
  -o-transition: background 2s linear; /* Opera */
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
  /* background: linear-gradient(135deg, #b4ddb4 0%,#83c783 17%,#52b152 33%,#008a00 67%,#005700 83%,#002400 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */; */
}

.card {
  height: 100%;
}

</style>
