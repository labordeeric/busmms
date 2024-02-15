<?php
session_start();
require 'Utilities/dbcontext.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Garage Alpha | User Add</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <?php include 'Layouts/Navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Left-side -->
    <?php include 'Layouts/Left-side.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>User Add</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="user.php">USERS</a></li>
                <li class="breadcrumb-item active">User Add</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <form action="Utilities/user-add-func.php" method="POST" id="frm1">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">General</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputId">User ID</label>
                    <input type="number" id="inputId" class="form-control" name="createid" readonly>
                  </div>
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="inputName" class="form-control" name="name" required>
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control" name="username" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" name="email" required>
                  </div>
                  <div class="form-group">
                    <label for="password1">Password</label>
                    <input type="password" id="password1" class="form-control" name="password1">
                  </div>
                  <div class="form-group">
                    <label for="password2"> Repeat Password</label>
                    <input type="password" id="password2" class="form-control" name="password2" onkeyup="checkPassword()" onchange="checkPassword()" required>
                  </div>
                  <div class="form-group">
                    <label for="level">Select Role Level</label>
                    <select id="level" class="form-control" name="level">
                      <?php
                      $sql = "SELECT * FROM roles";
                      $result = mysqli_query($conn, $sql);
                      if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo "<option value='" . $row['Level'] . "'>" . $row['Name'] . "</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>

          </div>

        </form>

        <div class="row">
          <div class="col-12">
            <a href="user.php" class="btn btn-secondary">Cancel</a>
            <input type="button" value="Create new User" class="btn btn-success float-right" id="btnCreate">
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include 'Layouts/Footer.php'; ?>

    <?php include 'Layouts/Right-side.php'; ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#btnCreate").click(function() {
        $("#frm1").submit();
      });


      // $('#password2').on('keyup', function() {
      //   var pass1 = $('#password1').val();
      //   var pass2 = $('#password2').val();
      //   if (pass1 != pass2) {
      //     $('#password2').css('border', '1px solid red');
      //   } else {
      //     $('#password2').css('border', '1px solid green');
      //   }
      // });

      // $('#password2').on('change', function() {
      //   var pass1 = $('#password1').val();
      //   var pass2 = $('#password2').val();
      //   if (pass1 != pass2) {
      //     $('#password2').css('border', '1px solid red');
      //   } else {
      //     $('#password2').css('border', '1px solid green');
      //   }
      // });

    });

    function checkPassword() {
      var pass1 = $('#password1').val();
      var pass2 = $('#password2').val();
      if (pass1 != pass2) {
        $('#password2').css('border', '1px solid red');
      } else {
        $('#password2').css('border', '1px solid green');
      }
    }
  </script>
</body>

</html>