<?php
session_start();
require 'Utilities/dbcontext.php';

$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Garage Alpha | User Edit</title>

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
              <h1>User Edit <?php
                            if (isset($_SESSION['message'])) {
                              if ($_SESSION['message'] == 'Success') {
                                if (isset($_GET['edit'])) {
                                  if ($_GET['edit'] == 'success') {
                                    echo '<span class="badge bg-success">Successfully Edited</span>';
                                  }
                                }
                                $_SESSION['message'] = '';
                              } elseif ($_SESSION['message'] == 'Failed') {
                                if (isset($_GET['edit'])) {
                                  if ($_GET['edit'] == 'failed') {
                                    echo '<span class="badge bg-danger">Failed To Edit</span>';
                                  } elseif ($_GET['edit'] == 'norequest') {
                                    echo '<span class="badge bg-success">No request sent</span>';
                                  }
                                }
                                $_SESSION['message'] = '';
                              }
                            }
                            ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="user.php">USER</a></li>
                <li class="breadcrumb-item active">User Edit</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <form action="Utilities/user-edit-func.php?id=<?php echo $id; ?>" method="POST" id="frm1">
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
                  <?php

                  $sql = "SELECT UserId,Name,Email,Username,Password,Level FROM users WHERE UserId = $id";
                  $rowEntity = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                  ?>
                  <div class="form-group">
                    <label for="inputId">User ID</label>
                    <input type="number" id="inputId" class="form-control" name="createid" value="<?php echo $rowEntity['UserId']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="inputName" class="form-control" name="name" value="<?php echo $rowEntity['Name']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control" name="username" value="<?php echo $rowEntity['Username']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" name="email" value="<?php echo $rowEntity['Email']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="password1">Password</label>
                    <input type="password" id="password1" class="form-control" name="password1" value="<?php echo $rowEntity['Password']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="password2"> Repeat Password</label>
                    <input type="password" id="password2" class="form-control" name="password2" onkeyup="checkPassword()" onchange="checkPassword()" value="<?php echo $rowEntity['Password']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="level">Select Role Level</label>
                    <select id="level" class="form-control" name="level">
                      <?php
                      $sql = "SELECT * FROM roles";
                      $result = mysqli_query($conn, $sql);
                      if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                          if ($row['Level'] === $rowEntity['Level']) {

                            echo "<option value='" . $row['Level'] . "' selected>" . $row['Name'] . "</option>";
                          } else {

                            echo "<option value='" . $row['Level'] . "'>" . $row['Name'] . "</option>";
                          }
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
            <input type="button" value="Update User" class="btn btn-success float-right" id="btnUpdate">
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
      $("#btnUpdate").click(function() {
        $("#frm1").submit();
      });


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