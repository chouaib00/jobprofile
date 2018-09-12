<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle img-responsive" src="<?php echo UPLOAD ?>profile/emp_img_default.png" />
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
                  <img alt="image" class="img-circle img-responsive" src="<?php echo IMG_DIR ?>emp_img_default.png" />
                </div>
            </li>
            <li>
                <a href=""><i class="fa fa-user"></i> <span class="nav-label">My Profile</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo DOMAIN; ?>applicant/update_profile">Edit Profile</a></li>
                    <li><a href="<?php echo DOMAIN; ?>applicant/my-skills">My Skills</a></li>
                    <li><a href="<?php echo DOMAIN; ?>applicant/file-attachment">File Attachments</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
