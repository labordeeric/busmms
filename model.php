<?php
session_start();
require 'Utilities/dbcontext.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BMMS | Model List</title>

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
    <!-- Left-side -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>MODEL</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">LIST</a></li>
                <li class="breadcrumb-item active">MODEL</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Model List &emsp; &emsp;&emsp;&emsp;&emsp;
              <?php
              if (isset($_SESSION['message'])) {
                if ($_SESSION['message'] == 'Success') {

                  echo '<span class="badge bg-success">Successfully Added</span>';

                  $_SESSION['message'] = '';
                } elseif ($_SESSION['message'] == 'Failed') {
                  if (isset($_Get['error'])) {
                    if ($_Get['error'] == 'createfailed') {
                      echo '<span class="badge bg-danger">Failed To Add</span>';
                    } elseif ($_Get['error'] == 'norequest') {
                      echo '<span class="badge bg-danger">No Request</span>';
                    }
                  }
                  $_SESSION['message'] = '';
                }
                $_SESSION['message'] = '';
              }
              ?></h3>

            <div class="card-tools">

              <a href="model-add.php" type="button" class="btn btn-success" title="New">
                ADD
              </a>
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 1%">#</th>
                  <th style="width: 1%">Model Id</th>
                  <th>Name</th>
                  <th>Make</th>
                  <th style="width: 15%">Action</th>
                </tr>
              </thead>
              <?php
              $I = 0;
              $sql = "SELECT model.id as modelid, model.name as modelname, make.name as makename FROM model JOIN make ON model.makeid = make.id";

              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>

                    <td><?php echo $I + 1; ?></td>
                    <td><?php echo $row['modelid']; ?></td>
                    <td><?php echo $row['modelname']; ?></td>
                    <td><?php echo $row['makename']; ?></td>
                    <td class="project-actions text-right">
                      <a class="btn btn-info btn-sm" href="model-edit.php?id=<?php echo $row['modelid']; ?>">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                      </a>
                      <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                      </a>
                    </td>
                  </tr>
              <?php $I++;
                }
              } ?>


              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

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
</body>

</html>