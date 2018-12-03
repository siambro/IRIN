
<?php 
   include 'Master/before_login_header.php';
   protect_page_redirect();
?>
<?php
if(isset($_GET['error'])){
?>
<div class="alert alert-danger">
  <strong>Error!</strong> Invalid user email or password.
</div>
<?php
 } 
?>
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Buy</b>From<b>Abroad</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg"><b>Log in to continue</b></p>

      <form action="Page_manager/login_manager.php" method="post" data-parsley-validate>
        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="email" placeholder="Email" data-parsley-required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password" data-parsley-required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
               <!--<label>
                <input type="checkbox"> Remember Me
              </label> -->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
          Facebook</a>
        <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
          Google+</a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <a href="#">I forgot my password</a><br> -->
      <a href="register.php" class="text-center">Register a new membership</a>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

<?php
 include 'Master/before_login_footer.php';
?>