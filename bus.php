<?php
session_start();
require 'Utilities/dbcontext.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BMMS| Bus List</title>

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
              <h1>BUS</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">LIST</a></li>
                <li class="breadcrumb-item active">BUS</li>
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
            <h3 class="card-title">Bus List &emsp; &emsp;&emsp;&emsp;&emsp;
              <?php
              if (isset($_SESSION['message'])) {
                if ($_SESSION['message'] == 'Success') {

                  echo '<span class="badge bg-success">Successfully Added</span>';

                  $_SESSION['message'] = '';
                } elseif ($_SESSION['message'] == 'Failed') {

                  echo '<span class="badge bg-danger">Failed To Add</span>';
                  $_SESSION['message'] = '';
                } else {
                  echo $_SESSION['message'];
                  $_SESSION['message'] = '';
                }
                $_SESSION['message'] = '';
              }
              ?></h3>

            <div class="card-tools">

              <a href="bus-add.php" type="button" class="btn btn-success" title="New">
                ADD
              </a>
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body table-responsive p-0" style="height: 520px;">
            <table class="table table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th style="width: 1%">#</th>
                  <th style="width: 1%">Bus Id</th>
                  <th>Registration No</th>
                  <th>Garage</th>
                  <th>Vehicle Type</th>
                  <th>Age</th>
                  <th>Model</th>
                  <th>Make</th>
                  <th>Chassis No</th>
                  <th>Engine No</th>
                  <th>Odometer</th>
                  <th style="width: 10%">Date Registered</th>
                  <th style="width: 10%">Fitness Expired</th>
                  <th style="width: 10%">Insurance Expired</th>
                  <th style="width: 10%">Road Tax Expired</th>
                  <th style="width: 10%">Last Maintenance</th>
                  <th>Seating Capacity</th>
                  <th>Standing Capacity</th>
                  <th>Engine Capacity</th>
                  <th>Color</th>
                  <th>Status</th>
                  <th style="width: 10%">Action</th>
                </tr>
              </thead>
              <?php
              $I = 0;

              $sql = "SELECT bus.id as bus_id, model.name as model, make.name as make,bus.kilometer, bus.age,bus.last_maintenance,bus.status,
                      bus.chassisno,bus.engineno,bus.dateregistered,bus.fitnessexp,bus.insuranceexp,bus.roadtaxexp,bus.seatingcapacity,
                      bus.vehicletype,
                      bus.standingcapacity,bus.enginecapacity,bus.color,bus.regno,garage.name as garage
                      FROM bus
                      LEFT JOIN make ON bus.makeid = make.id
                      LEFT JOIN model ON bus.modelid = model.id
                      LEFT JOIN garage ON bus.garageid = garage.id
                      ";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>

                    <td><?php echo $I + 1; ?></td>
                    <td><?php echo $row['bus_id']; ?></td>
                    <td><?php echo $row['regno']; ?></td>
                    <td><?php echo $row['garage']; ?></td>
                    <td><?php echo $row['vehicletype']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['model']; ?></td>
                    <td><?php echo $row['make']; ?></td>
                    <td><?php echo $row['chassisno']; ?></td>
                    <td><?php echo $row['engineno']; ?></td>
                    <td><?php echo $row['kilometer']; ?></td>
                    <td><?php echo $row['dateregistered']; ?></td>
                    <td><?php echo $row['fitnessexp']; ?></td>
                    <td><?php echo $row['insuranceexp']; ?></td>
                    <td><?php echo $row['roadtaxexp']; ?></td>
                    <td><?php echo $row['last_maintenance']; ?></td>
                    <td><?php echo $row['seatingcapacity']; ?></td>
                    <td><?php echo $row['standingcapacity']; ?></td>
                    <td><?php echo $row['enginecapacity']; ?></td>
                    <td><?php echo $row['color']; ?></td>
                    <td> <span class="<?php
                                      if ($row['status'] == 'Working') {
                                        echo 'badge bg-success';
                                      } elseif ($row['status'] == 'Maintenance') {
                                        echo 'badge bg-warning';
                                      } else {
                                        echo 'badge bg-danger';
                                      }
                                      ?>"><?php echo $row['status']; ?></span> </td>
                    <td class="project-actions text-right">
                      <a class="btn btn-info btn-sm" href="bus-edit.php?id=<?php echo $row['bus_id']; ?>">
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