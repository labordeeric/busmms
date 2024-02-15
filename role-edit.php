<?php
session_start();
require 'Utilities/dbcontext.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Garage Alpha | Role Edit</title>

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
              <h1>Role Edit <?php
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
                <li class="breadcrumb-item"><a href="bus.php">ROLE</a></li>
                <li class="breadcrumb-item active">Role Edit</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <form action="Utilities/role-edit-func.php" method="POST" id="frm1">
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
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM roles WHERE RoleId = $id";
                  // $sql = "SELECT * FROM bus WHERE id = $id";
                  $rowEntity = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                  ?>
                  <div class="form-group">
                    <label for="inputId">Role ID</label>
                    <input type="number" id="inputId" class="form-control" name="createid" value="<?php echo $rowEntity['RoleId']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="inputLevel">Level</label>
                    <input type="number" id="inputLevel" class="form-control" name="level" value="<?php echo $rowEntity['Level']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="inputName" class="form-control" name="name" value="<?php echo $rowEntity['Name']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="number" id="description" class="form-control" name="description" row="4"><?php echo $rowEntity['Description']; ?></textarea>
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
            <a href="role.php" class="btn btn-secondary">Cancel</a>
            <input type="button" value="Update Role" class="btn btn-success float-right" id="btnUpdate">
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

      //Date picker
      // $('#dtePicker').datetimepicker({
      //   format: 'L'
      // });
    });
  </script>
</body>

</html>