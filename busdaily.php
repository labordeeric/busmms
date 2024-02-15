<?php
session_start();
require 'Utilities/dbcontext.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BMMS | Bus Daily</title>

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
              <h1>BUS DAILY</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">SCHEDULING</a></li>
                <li class="breadcrumb-item active">BUS</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <section class="col">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bus List &emsp; &emsp;&emsp;&emsp;&emsp;
                  <?php
                  if (isset($_SESSION['message'])) {
                    if ($_SESSION['message'] === 'Success') {

                      echo '<span class="badge bg-success">Successfully Added</span>';

                      $_SESSION['message'] = '';
                    } elseif ($_SESSION['message'] === 'Failed') {

                      echo '<span class="badge bg-danger">Failed To Add</span>';
                      $_SESSION['message'] = '';
                    }
                    $_SESSION['message'] = '';
                  }
                  ?></h3>


              </div>
              <!-- <div class="card-body table-responsive p-0" style="height: 520px;width: auto;overflow-x:auto;"> -->
              <!-- <div class="card-body table-responsive p-0" style="height: 520px;overflow:scroll;"> -->
              <div class="card-body table-responsive p-0" style="height: 520px;">
                <table class="table table-head-fixed text-nowrap" id="dtbus">
                  <thead>
                    <tr>
                      <th style="width: 3%">Action</th>
                      <th>Status</th>
                      <th style="width: 1%">Bus Id</th>
                      <th>Registration No</th>
                      <th>Garage</th>
                      <th>Model</th>
                      <th>Make</th>
                      <th hidden>Age</th>
                      <th>Odometer</th>
                      <th style="width: 10%">Date Registered</th>
                      <th style="width: 10%">Fitness Expired</th>
                      <th style="width: 10%">Insurance Expired</th>
                      <th style="width: 10%">Road Tax Expired</th>
                      <th style="width: 10%">Last Maintenance</th>
                      <th>Color</th>
                    </tr>
                  </thead>
                  <?php

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
                        <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="busdailyaction.php?id=<?php echo $row['bus_id']; ?>">
                            <i class="fas fa-bus">
                            </i>
                            Select
                          </a>
                        </td>
                        <td> <span class="<?php
                                          if ($row['status'] == 'Working') {
                                            echo 'badge bg-success';
                                          } elseif ($row['status'] == 'Maintenance') {
                                            echo 'badge bg-warning';
                                          } else {
                                            echo 'badge bg-danger';
                                          }
                                          ?>"><?php echo $row['status']; ?></span> </td>
                        <td><?php echo $row['bus_id']; ?></td>
                        <td><?php echo $row['regno']; ?></td>
                        <td><?php echo $row['garage']; ?></td>
                        <td><?php echo $row['model']; ?></td>
                        <td><?php echo $row['make']; ?></td>
                        <td hidden><?php
                                    $date1 = new DateTime($row['dateregistered']);
                                    $date2 = new DateTime("now");
                                    $interval = $date1->diff($date2);
                                    // echo "difference " . $interval->y . " years, " . $interval->m . " months, " . $interval->d . " days ";
                                    echo $interval->y;

                                    // shows the total amount of days (not divided into years, months and days like above)
                                    // echo "difference " . $interval->days . " days ";
                                    ?></td>
                        <td><?php echo $row['kilometer']; ?></td>
                        <td><?php echo $row['dateregistered']; ?></td>
                        <td><?php echo $row['fitnessexp']; ?></td>
                        <td><?php echo $row['insuranceexp']; ?></td>
                        <td><?php echo $row['roadtaxexp']; ?></td>
                        <td><?php echo $row['last_maintenance']; ?></td>
                        <td><?php echo $row['color']; ?></td>

                      </tr>
                  <?php
                    }
                  } ?>


                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
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
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#dtbus').DataTable({
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "excel"]
      }).buttons().container().appendTo('#dtbus_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>