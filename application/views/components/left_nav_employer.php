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
                          <span class="text-muted text-xs block">
                          <?php echo $employer ?>
                          </span>
                        </span> </a>
                </div>
                <div class="logo-element">
                  <img alt="image" class="img-circle img-responsive" src="<?php echo UPLOAD.'profile/'.$_login_details['profile_img'] ?>" />
                </div>
            </li>
            <li>
                <a href=""><i class="fa fa-building"></i> <span class="nav-label"> Company Profile</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo DOMAIN; ?>employer/view-profile">View Profile</a></li>
                    <li><a href="<?php echo DOMAIN; ?>employer/edit-profile">Edit Profile</a></li>
                    <li><a href="<?php echo DOMAIN; ?>users/upload-image">Profile Image</a></li>
                </ul>
            </li>
            <li>
                <a href=""><i class="fa fa-group"></i> <span class="nav-label"> Applicant</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo DOMAIN; ?>applicant/filter">Filter Applicant</a></li>
                </ul>
            </li>
            <li>
                <a href=""><i class="fa fa-briefcase"></i> <span class="nav-label"> Vacancy</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo DOMAIN; ?>vacancy/vacancy-list"> Posted Job Vacancy</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
