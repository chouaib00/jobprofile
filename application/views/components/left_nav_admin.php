<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle img-responsive" src="<?php echo UPLOAD.'profile/'.$_login_details['profile_img'] ?>" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['current_user']['displayname'] ?></strong>
                        </span> <span class="text-muted text-xs block">Administrator </span> </span> </a>
                </div>
                <div class="logo-element">
                  <img alt="image" class="img-circle img-responsive" src="<?php echo UPLOAD.'profile/'.$_login_details['profile_img'] ?>" />
                </div>
            </li>
            <!--
            <li>
                <a href=""><i class="fa fa-user"></i> <span class="nav-label">Profile</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?php echo ('users/upload-image' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>users/upload-image" class="nav-mapper">Profile Image</a></li>
                </ul>
            </li> -->
            <li>
                <a href=""><i class="fa fa-bars"></i> <span class="nav-label">Reference</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <!--<li class="<?php echo ('reference/country' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>reference/country" class="nav-mapper">Country</a></li>-->
                    <li class="<?php echo ('reference/region' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>reference/region" class="nav-mapper">Region</a></li>
                    <li class="<?php echo ('reference/province' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>reference/province" class="nav-mapper">Province</a></li>
                    <li class="<?php echo ('reference/city' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>reference/city" class="nav-mapper">City</a></li>
                    <li class="<?php echo ('reference/field-of-study' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>reference/field-of-study" class="nav-mapper">Field Of Study</a></li>
                    <li class="<?php echo ('reference/educ-attainment' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>reference/educ-attainment" class="nav-mapper">Educational Attainment</a></li>
                    <li class="<?php echo ('reference/school' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>reference/school" class="nav-mapper">School</a></li>
                    <li class="<?php echo ('reference/skill-tag' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>reference/skill-tag" class="nav-mapper">Skill Tag</a></li>
                </ul>
            </li>
            <li>
                <a href=""><i class="fa fa-user"></i> <span class="nav-label"> Users</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?php echo ('administrator/list' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>administrator/list" class="nav-mapper">Administrator</a></li>
                    <li class="<?php echo ('applicant/list' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>applicant/list" class="nav-mapper">Applicants</a></li>
                    <li class="<?php echo ('employer/list' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>employer/list" class="nav-mapper">Employer</a></li>
                </ul>
            </li>
            <li>
                <a href=""><i class="fa fa-puzzle-piece"></i> <span class="nav-label"> Utilities</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?php echo ('utility/announcement' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>utility/announcement" class="nav-mapper">Announcement</a></li>
                    <li class="<?php echo ('utility/edit-page' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>utility/edit-page/1" class="nav-mapper">About Page</a></li>
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
                    <li class="<?php echo ('vacancy/vacancy-list' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>vacancy/vacancy-list" class="nav-mapper">Vacancy List</a></li>
                </ul>
            </li>
            <li>
                <a href=""><i class="fa fa-bullhorn"></i> <span class="nav-label"> Job Fair</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?php echo ('utility/job-fair' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>utility/job-fair" class="nav-mapper">Setup</a></li>
                    <li class="<?php echo ('jobfair/attendance' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>jobfair/attendance" class="nav-mapper">Attendance</a></li>
                    <li class="<?php echo ('jobfair/summary' == $_page_url)? 'active' : '' ?>"><a href="<?php echo DOMAIN; ?>jobfair/summary" class="nav-mapper">Job Fair Summary</a></li>
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
