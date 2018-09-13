<?php
  if(isset($_SESSION['alert_message'])){
    ?>
    <div class="m-sm alert alert-<?php echo $_SESSION['alert_message']['type']; ?> alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?php echo $_SESSION['alert_message']['message']; ?>
        <?php if(isset($_SESSION['alert_message']['link'])){ ?>
          <a class="alert-link" href="<?php echo $_SESSION['alert_message']['link']['href']; ?>"><?php echo $_SESSION['alert_message']['link']['text']; ?></a>.
        <?php  } ?>
    </div>
    <?php
    unset($_SESSION['alert_message']);
  }
?>
