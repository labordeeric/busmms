<?php
session_start();
require 'Utilities/dbcontext.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Garage Alpha | Spare Parts Edit</title>

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
              <h1>Spare Parts Edit <?php
                            if (isset($_SESSION['message'])) {
                              if ($_SESSION['message'] == 'Success') {
                                echo '<span class="badge bg-success">Successfully Added</span>';
                                $_SESSION['message'] = '';
                              } elseif ($_SESSION['message'] == 'Failed') {
                                echo '<span class="badge bg-danger">Failed To Add : ' . $_SESSION['message'] . '</span>';
                                $_SESSION['message'] = '';
                              }
                            }
                            ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="bus.php">BUS</a></li>
                <li class="breadcrumb-item active">Bus Add</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <form action="Utilities/bus-edit-func.php" method="POST" id="frm1">
          <div class="row">
            <div class="col-md-6">
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
                  $sql = "SELECT bus.id as bus_id, bus.model, make.name as make, make.id as make_id,bus.kilometer, bus.year,bus.last_maintenance,bus.status, spares.spare_parts
                      FROM bus
                      LEFT JOIN make ON bus.make_id = make.id
                      LEFT JOIN (
                          SELECT bus_id, GROUP_CONCAT(spare_parts.id) as spare_parts
                          FROM bus_spare_parts
                          JOIN spare_parts ON bus_spare_parts.spare_part_id = spare_parts.id
                          GROUP BY bus_id
                      ) as spares ON bus.id = spares.bus_id WHERE bus.id = $id;
                      ";
                  // $sql = "SELECT * FROM bus WHERE id = $id";
                  $rowEntity = mysqli_fetch_assoc(mysqli_query($conn, $sql));

                  // Explode the string by commas
                  if ($rowEntity['spare_parts'] == null) {
                    $spare_parts = [];
                  } else {
                    $spare_parts = explode(",", $rowEntity['spare_parts']);
                  }
                  ?>
                  <div class="form-group">
                    <label for="inputId">Bus ID</label>
                    <input type="number" id="inputId" class="form-control" name="createid" value="<?php echo $rowEntity['bus_id']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="inputModel">Model</label>
                    <input type="text" id="inputModel" class="form-control" name="model" value="<?php echo $rowEntity['model']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputYear">Year</label>
                    <input type="number" id="inputYear" class="form-control" name="year" value="<?php echo $rowEntity['year']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="dtePicker">Last Maintenance:</label>
                    <div class="input-group date">
                      <input type="date" id="dtePicker" class="form-control datetimepicker-input" name="last_maintenance" value="<?php echo $rowEntity['last_maintenance']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="kilometer">Kilometer(Km)</label>
                    <input type="number" id="kilometer" class="form-control" name="kilometer" value="<?php echo $rowEntity['kilometer']; ?>">
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-6">
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Selection</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputMake">Make</label>
                    <select id="inputMake" class="form-control custom-select" name="make_id">
                      <option disabled>Select one</option>
                      <?php
                      $sql = "SELECT * FROM make";
                      $result = mysqli_query($conn, $sql);
                      if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                          // echo "<option value='" . $row['id'] . "'" . $row['id'] === $rowEntity['make_id'] ? 'selected' : '' . ">" . $row['name'] . "</option>";
                          if ($row['id'] === $rowEntity['make_id']) {

                            echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                          } else {

                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="spare">Select Spare Parts (Select multiple with ctrl+click or drag select)</label>
                    <select id="spare" multiple class="form-control" name="spare[]">
                      <?php
                      $sql = "SELECT * FROM spare_parts";
                      $result = mysqli_query($conn, $sql);
                      $J = 0;
                      if (mysqli_num_rows($result) > 0) {
                        // Loop through each element and output it as a list item
                        while ($row = mysqli_fetch_assoc($result)) {
                          if ($row['id'] === $spare_parts[$J]) {
                            echo "<option value='" . $row['id'] . "' selected>" . $row['part_name'] . "</option>";
                          } else {
                            echo "<option value='" . $row['id'] . "'>" . $row['part_name'] . "</option>";
                          }
                          $J++;
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputStatus">Status</label>
                    <select id="inputStatus" class="form-control custom-select" name="status">
                      <option value="Working">Working</option>
                      <option value="Maintenance">Maintenance</option>
                      <option value="BreakDown">Break Down</option>
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
            <a href="bus.php" class="btn btn-secondary">Cancel</a>
            <input type="button" value="Update Bus" class="btn btn-success float-right" id="btnUpdate">
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