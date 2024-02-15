<?php
session_start();
include "Utilities/dbcontext.php";
$imagePath = "dist/img/photo4.png";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BMMS | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <style>
    /* Override existing CSS for body background */
    body {
      background-image: url('<?php echo $imagePath; ?>') !important;
      background-size: cover !important;
      background-position: center !important;
      background-repeat: no-repeat !important;
    }
  </style>

</head>

<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b></b></a>

  
    </div>
    <!-- /.login-logo -->
    <div class="card shadow-lg">
     <div class="card">
      <div class="card-body login-card-body">

        <?php

        if (isset($_GET['login'])) { ?>
          <p class="text-danger text-center"><?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 'Error On login';
                                              echo $message; ?> </p>

        <?php }
        if (isset($_GET['logout'])) {
          if (str_contains($_GET['logout'], 'success') === true) {
            echo '<p style="color: green;" class="text-center">Successfully logged out.</p>';
          } else {
            echo '<p style="color: red;" class="text-center">' . $_GET['logout'] . '</p>';
          }
        }
        ?>

        <p class="login-box-msg" style="font-size: 24px;">
        <i class="fas fa-sign-in-alt"></i>    Sign in
        </p>

        <form action="Utilities/login.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row text-center">
            <!-- /.col -->
            <div class="col">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password
        <i class="fas fa-question-circle ml-1"></i>
          </a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
      </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>