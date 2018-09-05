<div id="wrapper">
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
        <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <i class="fa fa-reorder"></i>
                </button>
                <a href="#" class="navbar-brand">Inspinia</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a aria-expanded="false" role="button" href="layouts.html"> Back to main Layout page</a>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                        </ul>
                    </li>

                </ul>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="<?php echo DOMAIN?>login">
                            <i class="fa fa-sign-in"></i> Log in
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        </div>
        <div class="wrapper wrapper-content">
            <div class="container white-bg">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Register</h2>
                        <hr class="hr-line-solid">
                        <form id="main-form" action="" method="POST">
                            <div class="form-group col-md-12">
                                <label>Email</label>
                                <input type="email" name="reg-email" placeholder="Enter Email" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Username</label>
                                <input type="username" name="reg-username" placeholder="Enter Username" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Password</label>
                                <input type="password" name="reg-password" placeholder="Enter Password" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Retype Password</label>
                                <input type="password" name="reg-re-password" placeholder="Reenter Password" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                              <input type="checkbox" > I am not a robot</input>
                            </div>
                        </form>

                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                          <div class="col-sm-4 col-sm-offset-4">
                              <button class="btn btn-primary form-submit col-sm-12 btn-outline" data-form="main-form">
                                <h3 class="font-bold"><i class="fa fa-user-o"></i> Register</h3>
                              </button>
                          </div>
                      </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
