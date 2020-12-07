<!-- Main Wrapper -->
<div class="main-wrapper">
  <div class="account-content">
    <div class="container">
      <!-- Account Logo -->
      <div class="account-logo">
        <a href="index.html"><img src="<?php echo base_url()?>assets/img/logo2.png" alt="Dreamguy's Technologies" /></a>
      </div>
      <!-- /Account Logo -->

      <div class="account-box">
        <div class="account-wrapper">
          <h3 class="account-title">Si Jempol </h3>
          <p class="account-subtitle">Access to your dashboard </p>

          <!-- alert error -->
          <?php if (!empty($alert)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error! </strong> <p> <?php echo $alert ?> </p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times; </span>
              </button>
            </div>
          <?php } ?>
          <!-- alert error -->

          <!-- Account Form -->
          <form class="form" action="<?php echo base_url()?>authentication/login" method="post">
            <div class="form-group">
              <label>Username </label>
              <input class="form-control" type="text" name="username" placeholder="Isi dengan NIP" />
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label>Password </label>
                </div>
                <!-- <div class="col-auto">
                  <a class="text-muted" href="forgot-password.html">
                   Forgot password?
                  </a>
                </div> -->
              </div>
              <input class="form-control" type="password" name="password" placeholder="Isi Password-mu disini"/>
            </div>
            <div class="form-group text-center">
              <button class="btn btn-primary account-btn" type="submit">Login </button>
            </div>
            <div class="account-footer">
              <!-- <p>Don't have an account ___?  <a href="register.html">Register </a></p> -->
            </div>
          </form>
          <!-- /Account Form -->

        </div>
      </div>

    </div>
  </div>
</div>
<!-- /Main Wrapper -->
