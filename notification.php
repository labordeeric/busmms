<?php
session_start();
require 'Utilities/dbcontext.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BMMS | Bus List</title>

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
              <h1>NOTIFICATIONS</h1>
            </div>
            <div class="col-sm-6">

            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-bullhorn"></i>
                  Bus Reached Limit
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                $sql = "SELECT bus.id,bus.regno,bus.kilometer,garage.name as garage,bus.last_maintenance,SUM(dailyservice.diff) as kmmade, bus.status, max(dailyservice.date) as notifdate FROM dailyservice 
                JOIN bus ON bus.id = dailyservice.busid
                JOIN garage ON bus.garageid=garage.id
                WHERE dailyservice.date >= 
                    CASE 
                        WHEN bus.last_maintenance != '' THEN bus.last_maintenance
                        ELSE bus.dateregistered
                    END
                AND dailyservice.date <= CURDATE() 
                GROUP BY bus.id
                HAVING SUM(dailyservice.diff) > 4500";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {

                  while ($row = mysqli_fetch_assoc($result)) { ?>

                    <div class="callout callout-warning">
                      <h5>Registration No. : <?php echo $row['regno']; ?></h5>
                      <div class="row">
                        <div class="col">
                          <p>Garage : <?php echo $row['garage']; ?></p>
                          <p>Notification Date : <?php echo $row['notifdate']; ?></p>
                        </div>
                        <div class="col">
                          <a class="btn btn-info float-right" href="busdailyaction.php?id=<?php echo $row['id']; ?>">
                            <i class="fas fa-bus">
                            </i>
                            Select
                          </a>
                        </div>
                      </div>
                    </div>
                <?php
                  }
                } else {
                  echo "No notification";
                } ?>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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
</body>

</html>