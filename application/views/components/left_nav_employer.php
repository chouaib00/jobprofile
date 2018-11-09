<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                  <img alt="image" class="img-circle img-responsive" src="<?php echo UPLOAD.'profile/'.$_login_details['profile_img'] ?>" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['current_user']['displayname'] ?></strong>
                        </span>
                          <span class="text-muted text-xs block">Employer</span>
                        </span> </a>
                </div>
                <div class="logo-element">
                  <img alt="image" class="img-circle img-responsive" src="<?php echo UPLOAD.'profile/'.$_login_details['profile_img'] ?>" />
                </div>
            </li>
            <li>
                <a href=""><i class="fa fa-building"></i> <span class="nav-label"> Company Profile</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?php echo ('employer/view-profile' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>employer/view-profile" class="nav-mapper">View Profile</a></li>
                    <li class="<?php echo ('employer/edit-profile' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>employer/edit-profile" class="nav-mapper">Edit Profile</a></li>
                    <li class="<?php echo ('users/upload-image' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>users/upload-image" class="nav-mapper">Profile Image</a></li>
                </ul>
            </li>
            <li>
                <a href=""><i class="fa fa-group"></i> <span class="nav-label"> Applicant</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?php echo ('applicant/filter' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>applicant/filter" class="nav-mapper">Filter Applicant</a></li>
                </ul>
            </li>
            <li>
                <a href=""><i class="fa fa-briefcase"></i> <span class="nav-label"> Vacancy</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?php echo ('vacancy/vacancy-list' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>vacancy/vacancy-list" class="nav-mapper"> Posted Job Vacancy</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
<script>
$(document).ready(function(){
  $('.nav-mapper').each(function(i){
    if($(this).parent().hasClass('active')){
      $(this).parent().parent().closest('li').addClass('active');
      return false;
    }
  });
})
</script>
