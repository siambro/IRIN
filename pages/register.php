
<?php 
 include 'Master/before_login_header.php';
 protect_page_redirect();
?>

<script type="text/javascript" src="../dist/js/jquery1.js"></script>

<?php
if(isset($_GET['error'])){
?>
<div class="alert alert-danger">
  <strong>Error!</strong> Password should be same.
</div>
<?php
 } 
?>

<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Buy</b>From<b>Abroad</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="Page_manager/signup_manager.php" method="post" data-parsley-validate id="user_form">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="name" placeholder="Full name" data-parsley-trigger="keyup" data-parsley-required data-parsley-pattern="^[a-zA-Z]+$" minlength="4">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-parsley-trigger="keyup" data-parsley-required>
        

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <div id="error_email"></div>
      </div>
      

      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" data-parsley-trigger="keyup" data-parsley-length="[5, 10]" data-parsley-required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="cpass" placeholder="Retype password" data-parsley-equalto="#pass" data-parsley-trigger="keyup" data-parsley-length="[5, 10]" data-parsley-required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      
      <div class="form-group">
        <input type="radio" class="flat-red" name="type" value="shopper" checked> Shopper
        <input type="radio" class="flat-red" name="type" value="traveller"> Traveller
      </div>
        
      
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="checkbox" required> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="signup" id="btnReg" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div> -->

    <a href="login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
<script type="text/javascript">

    $(document).ready(function(){

     $('#email').bind('keyup',function(){
      var error_email = '';
      var email = $(this).val();
      
       $.ajax({
        
        url:'Page_manager/checkmail.php?email='+email,
        method:"get",
        data:{email:email},
        success:function(data)
        {
         if(data == "200")
         {
            $('#error_email').show();
            $('#error_email').html('<p class="text-danger">Email Exist!</p>');
            $("#btnReg").hide();         
         }
         else
         {
            $('#error_email').hide();
            $("#btnReg").show(); 
         }

        }
       })
      
     });
    });

</script>

<?php 
 include 'Master/before_login_footer.php';
?>