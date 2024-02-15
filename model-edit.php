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
  <title>BMMS | Mode Edit</title>

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
              <h1>Model Edit <?php
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
                <li class="breadcrumb-item"><a href="model.php">MODEL</a></li>
                <li class="breadcrumb-item active">Model Edit</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <form action="Utilities/model-edit-func.php?id=<?php echo $id; ?>" method="POST" id="frm1">
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

                  $sql = "SELECT model.id as modelid, model.name as modelname,make.id as makeid, make.name as makename 
                  FROM model JOIN make ON model.makeid = make.id WHERE model.id = $id";
                  $rowEntity = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                  ?>
                  <div class="form-group">
                    <label for="inputId">Model ID</label>
                    <input type="number" id="inputId" class="form-control" name="createid" value="<?php echo $rowEntity['modelid']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="inputName" class="form-control" name="name" value="<?php echo $rowEntity['modelname']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputMake">Make</label>
                    <select id="inputMake" class="form-control custom-select" name="makeid">
                      <option disabled>Select one</option>
                      <?php
                      $sql = "SELECT * FROM make";
                      $result = mysqli_query($conn, $sql);
                      if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                          // echo "<option value='" . $row['id'] . "'" . $row['id'] === $rowEntity['make_id'] ? 'selected' : '' . ">" . $row['name'] . "</option>";
                          if ($row['id'] === $rowEntity['makeid']) {

                            echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                          } else {

                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
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
            <a href="model.php" class="btn btn-secondary">Cancel</a>
            <input type="button" value="Update Model" class="btn btn-success float-right" id="btnUpdate">
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