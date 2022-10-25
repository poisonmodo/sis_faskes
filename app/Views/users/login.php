<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $site_name ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo site_url("plugins/fontawesome-free/css/all.min.css") ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo site_url("plugins/icheck-bootstrap/icheck-bootstrap.min.css") ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo site_url("assets/css/adminlte.min.css") ?>">
  <link rel="stylesheet" href="<?php echo site_url("assets/css/custom.css") ?>">
</head>
<body class="hold-transition login-page backgroud">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?php echo site_url("index2.html") ?>" class="h1"><?php echo $site_name ?></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
<?php $err = session()->getFlashdata('error_message');
      $err2 = session()->getFlashdata('errors');
      $msg= session()->getFlashdata('success');
       
      if($err) { ?>
      <div class="alert alert-danger">
<?php echo $err; ?>        
      </div>  
<?php } 
      if(!$msg) { ?> 
      <form action="<?php echo site_url("/login") ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" id="username" value="<?php echo set_value('username') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?php echo (isset($err2["username"])) ? '<span class="error-invalid-feedback">' . $err2["username"] . '</span>' : "" ?>
        
        <div class="input-group mb-3"> 
          <input type="password" class="form-control" placeholder="Password" name="userpass" id="userpass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php echo (isset($err2["userpass"])) ? '<span class="error-invalid-feedback">' . $err2["userpass"] . '</span>' : "" ?>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-primary btn-block" name="loginbtn" id="loginbtn"  value="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
    </form>
<?php } 
      else { ?>      
    <div class="alert alert-success">
<?php echo $msg; ?>             
    </div> 
    <script type="text/javascript">
        setTimeout('location.href="<?php echo site_url('home') ?>"',3000);
    </script>
<?php } ?>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo site_url("plugins/jquery/jquery.min.js") ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo site_url("plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo site_url("assets/js/adminlte.min.js") ?>"></script>
</body>
</html>
