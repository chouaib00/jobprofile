<div class="middle-box text-center loginscreen">
    <div>
        <div>

            <h1 class="logo-name">JOB</h1>

        </div>
        <h3>Looking for a job?<br>Looking for workers?</h3>

        <form class="m-t" role="form" method="POST" action="<?php echo $action_url ?>">
            <div class="form-group">
                <input type="text" name="user_email" class="form-control" placeholder="Email / Username" required="">
            </div>
            <div class="form-group">
                <input type="password" name="user_password" class="form-control" placeholder="Password" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a href="#"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
              <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
        </form>
    </div>
</div>
