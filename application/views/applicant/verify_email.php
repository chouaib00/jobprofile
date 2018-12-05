<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="wrapper wrapper-content animated fadeInLeft container">
  <div class="row">
    <div class="col-md-12">
      <div class="ibox">
        <div class="ibox-title">Verify Email</div>
        <div class="ibox-content">
          <form class="form-horizontal text-center" method="POST" action="?">
            <p>An email verification has been sent on your email <b><?php echo $user_email ?></b></p>
            <?php if($show_resend){ ?>
            <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LcAc3EUAAAAAFH489r8o8RhDeQ_xRCfR8IHeD0F"></div>
            <button disabled class="btn btn-info dim btn-outline btn-md" type="submit" name="resend" value="send"><i class="fa fa-envelope"></i> Resend Verification Mail</button>
            <?php }
            else{ ?>
              <div class="alert alert-success"><i class="fa fa-check"></i> Verification email has been resent</div>
            <?php }?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function recaptchaCallback() {
    $('[name=resend]').removeAttr('disabled');
};
</script>
