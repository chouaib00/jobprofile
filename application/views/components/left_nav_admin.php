<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle img-responsive" src="<?php echo IMG_DIR ?>emp_img_default.png" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Administrator</strong>
                         </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                  <img alt="image" class="img-circle img-responsive" src="<?php echo IMG_DIR ?>emp_img_default.png" />
                </div>
            </li>
            <li>
                <a href=""><i class="fa fa-bars"></i> <span class="nav-label">Reference</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo DOMAIN; ?>reference/country">Country</a></li>
                    <li><a href="<?php echo DOMAIN; ?>reference/region">Region</a></li>
                    <li><a href="<?php echo DOMAIN; ?>reference/province">Province</a></li>
                    <li><a href="<?php echo DOMAIN; ?>reference/city">City</a></li>
                    <li><a href="<?php echo DOMAIN; ?>reference/field-of-study">Field Of Study</a></li>
                </ul>
            </li>
            <li>
                <a href=""><i class="fa fa-user"></i> <span class="nav-label"> Users</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo DOMAIN; ?>administrator/list">Administrator</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
