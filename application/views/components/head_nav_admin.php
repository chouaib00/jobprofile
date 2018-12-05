<div class="row border-bottom">
  <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
  <div class="navbar-header">
      <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
  </div>
      <ul class="nav navbar-top-links navbar-right">
          <li>
              <a class="has-tooltip" title="Dashboard" href="<?php echo DOMAIN?>dashboard">
                  <i class="fa fa-home"></i> Dashboard
              </a>
          </li>
          <li id="notification" class="dropdown">
              <a class="dropdown-toggle count-info has-tooltip" title="Notification" data-toggle="dropdown" href="#">
                  <i class="fa fa-bell"></i>  <span id="no-notif" class="label label-danger"></span>
              </a>
              <ul class="dropdown-menu dropdown-alerts" style="max-height:40vh; overflow-y: auto;">
              </ul>
          </li>
          <li>
              <a class="has-tooltip" title="Log out" href="<?php echo DOMAIN?>logout">
                  <i class="fa fa-sign-out"></i> Log out
              </a>
          </li>
      </ul>

  </nav>
</div>
