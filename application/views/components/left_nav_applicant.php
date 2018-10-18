<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle img-responsive" src="<?php echo UPLOAD.'profile/'.$_login_details['profile_img'] ?>" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['current_user']['displayname'] ?></strong>
                        </span> <span class="text-muted text-xs block"><?php
                        switch($_SESSION['current_user']['type']){
                          case '1':
                            echo "Administrator";
                          break;
                          case '2':
                            echo "Applicant";
                          break;
                          case '3':
                            echo "Employer";
                          break;
                        }

                        ?> </span> </span> </a>
                </div>
                <div class="logo-element">
                  <img alt="image" class="img-circle img-responsive" src="<?php echo UPLOAD.'profile/'.$_login_details['profile_img'] ?>" />
                </div>
            </li>
            <li>
                <a href=""><i class="fa fa-user"></i> <span class="nav-label">My Profile</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo DOMAIN; ?>applicant/view-profile">View Profile</a></li>
                    <li><a href="<?php echo DOMAIN; ?>applicant/update-profile">Edit Profile</a></li>
                    <li><a href="<?php echo DOMAIN; ?>applicant/file-attachment">File Attachments</a></li>
                    <li><a href="<?php echo DOMAIN; ?>users/upload-image">Profile Image</a></li>
                </ul>
            </li>
            <li>
                <a href=""><i class="fa fa-briefcase"></i> <span class="nav-label"> Job Vacancy</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo DOMAIN; ?>vacancy/job-feed"> My Job Feed</a></li>
                    <li><a href="<?php echo DOMAIN; ?>vacancy/my-application"> My Application</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
