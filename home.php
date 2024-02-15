<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.php');
  exit;
}
require 'Utilities/dbcontext.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BBMS | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="Garage Logo" height="60" width="60">
    </div>


    <?php include 'Layouts/Navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Left-side -->
    <?php include 'Layouts/Left-side.php'; ?>
    <!-- Left-side -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php
                      $sql = "SELECT COUNT(*) AS BusCount FROM bus";
                      $result = mysqli_query($conn, $sql);
                      $row = mysqli_fetch_assoc($result);
                      $busCount = $row['BusCount'];
                      echo $busCount;
                      ?></h3>

                  <p>TOTAL BUS</p>
                </div>
                <div class="icon">
                  <i class="fa fa-bus"></i>
                </div>
                <a href="bus.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php
                      $sql = "SELECT COUNT(*) AS TotalBusCount FROM bus";
                      $result = mysqli_query($conn, $sql);
                      $row = mysqli_fetch_assoc($result);
                      $totalBusCount = $row['TotalBusCount'];
                      $sql = "SELECT COUNT(*) AS WorkingBusCount FROM bus WHERE status = 'Working'";
                      $result = mysqli_query($conn, $sql);
                      $row = mysqli_fetch_assoc($result);
                      $WorkingBusCount = $row['WorkingBusCount'];
                      $busCount = ($WorkingBusCount / $totalBusCount) * 100;
                      echo number_format((float)$busCount, 0, '.', ',');
                      ?><sup style="font-size: 20px">%</sup></h3>

                  <p>WORKING BUS</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer"> <i class="fas fa-info"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col" <?php
                              //If not admin
                              if ($_SESSION['level'] != 0) {
                                echo 'hidden';
                              } ?>>
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php
                      $sql = "SELECT COUNT(*) AS TotalUserCount FROM users";
                      $result = mysqli_query($conn, $sql);
                      $row = mysqli_fetch_assoc($result);
                      $TotalUserCount = $row['TotalUserCount'];
                      echo $TotalUserCount;
                      ?></h3>

                  <p>USER REGISTRED</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php
                      $sql = "SELECT COUNT(*) AS totalcount
                      FROM (
                          SELECT bus.id
                          FROM dailyservice 
                          JOIN bus ON bus.id = dailyservice.busid 
                          WHERE dailyservice.date >= 
                              CASE 
                                  WHEN bus.last_maintenance != '' THEN bus.last_maintenance
                                  ELSE bus.dateregistered
                              END
                          AND dailyservice.date <= CURDATE() 
                          GROUP BY bus.id
                          HAVING SUM(dailyservice.diff) > 4500
                      ) AS subquery
                      ";
                      $result = mysqli_query($conn, $sql);
                      $row = mysqli_fetch_assoc($result);
                      $TotalCount = $row['totalcount'];
                      echo $TotalCount;
                      ?></h3>

                  <p>KILOMETER REACHED(5000)</p>
                </div>
                <div class="icon">
                  <i class="fa fa-road"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-9 connectedSortable">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Bus List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
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
                <div class="card-footer clearfix" hidden>
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-3 connectedSortable">

              <!-- Map card -->
              <div class="card bg-gradient-primary" hidden>
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Visitors
                  </h3>
                  <!-- card tools -->
                  <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                      <i class="far fa-calendar-alt"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <div class="card-body">
                  <div id="world-map" style="height: 250px; width: 100%;"></div>
                </div>
                <!-- /.card-body-->
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <div id="sparkline-1"></div>
                      <div class="text-white">Visitors</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-2"></div>
                      <div class="text-white">Online</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-3"></div>
                      <div class="text-white">Sales</div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.card -->

              <!-- solid sales graph -->
              <div class="card bg-gradient-info" hidden>
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-th mr-1"></i>
                    Sales Graph
                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">

                      <div class="text-white">Mail-Orders</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">

                      <div class="text-white">Online</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">

                      <div class="text-white">In-Store</div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->

              <!-- Calendar -->
              <div class="card bg-gradient-success">
                <div class="card-header border-0">

                  <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                  </h3>
                  <!-- tools card -->
                  <div class="card-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                        <i class="fas fa-bars"></i>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a href="#" class="dropdown-item">Add new event</a>
                        <a href="#" class="dropdown-item">Clear events</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">View calendar</a>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-0">
                  <!--The calendar -->
                  <div id="calendar" style="height: 250px;width: 100%;"></div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>
          </div>

          <!-- /.row (main row) -->

        </div><!-- /.container-fluid -->
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
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="dist/js/demo.js"></script> -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>