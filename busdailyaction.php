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
  <title>Garage Alpha | Bus Daily Action</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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

              <h1>BUS DAILY ACTION</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">SCHEDULING</a></li>
                <li class="breadcrumb-item active">BUS ACTION</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- ./row -->
      <div class="row">
        <div class="col">
          <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Daily Action</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-one-add-tab" data-toggle="pill" href="#custom-tabs-one-add" role="tab" aria-controls="custom-tabs-one-add" aria-selected="false">Add</a>
                </li>
                <li class="nav-item" hidden>
                  <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Messages</a>
                </li>
                <li class="nav-item" hidden>
                  <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Settings</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                  <div class="card-body table-responsive p-0" style="height: 520px;">
                    <div class="row">

                      <h5 class="col-3">Status : <span class="<?php
                                                              $sql = "SELECT bus.*,garage.name as garagename FROM bus JOIN garage ON bus.garageid=garage.id WHERE bus.id=$id";
                                                              $rowEntity = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                                              $status = $rowEntity['status'];
                                                              $kilometer = $rowEntity['kilometer'];
                                                              $regno = $rowEntity['regno'];
                                                              $last_maintenance = $rowEntity['last_maintenance'];
                                                              $garagename = $rowEntity['garagename'];
                                                              if ($status == 'Working') {
                                                                echo 'badge bg-success';
                                                              } elseif ($status == 'Maintenance') {
                                                                echo 'badge bg-warning';
                                                              } else {
                                                                echo 'badge bg-danger';
                                                              }
                                                              ?>"><?php echo $status; ?></span>
                        <a href="#" id="changeStatus" class="btn <?php if ($status == 'Working') {
                                                                    echo 'btn-warning';
                                                                  } elseif ($status == 'Maintenance') {
                                                                    echo 'btn-success';
                                                                  } else {
                                                                    echo 'btn-danger';
                                                                  } ?>"><?php if ($status == 'Working') {
                                                                          echo 'Set Maintenance';
                                                                        } elseif ($status == 'Maintenance') {
                                                                          echo 'Finish Maintenance';
                                                                        } else {
                                                                          echo 'Set Working';
                                                                        } ?></a>
                      </h5>
                      <h5 class="col">
                        Registration No : <span class="badge"><?php echo $rowEntity['regno']; ?></span>
                      </h5>
                      <h5 class="col">
                        Last Maintenance : <span class="badge"><?php echo $rowEntity['last_maintenance']; ?></span>
                      </h5>
                      <h5 class="col">
                        Actual Odometer : <span class="badge"><?php echo $rowEntity['kilometer']; ?></span>
                      </h5>
                      <h5 class="col">
                        Garage : <span class="badge"><?php echo $rowEntity['garagename']; ?></span>
                      </h5>
                    </div>
                    <div class="row">
                      <h3 class="col-3"><?php
                                        if (isset($_SESSION['message'])) {
                                          if ($_SESSION['message'] == 'Success') {
                                            if (isset($_GET['deleted'])) {
                                              if ($_GET['deleted'] == 1) {
                                                echo '<span class="badge bg-success">Successfully Deleted</span>';
                                              }
                                            } else if (isset($_GET['changed'])) {
                                              if ($_GET['changed'] == 1) {
                                                echo '<span class="badge bg-success">Successfully Changed</span>';
                                              }
                                            } else {
                                              echo '<span class="badge bg-success">Successfully Added</span>';
                                            }
                                            $_SESSION['message'] = '';
                                          } elseif ($_SESSION['message'] == 'Failed') {
                                            if (isset($_Get['error'])) {
                                              if ($_Get['error'] == 'createfailed') {
                                                echo '<span class="badge bg-danger">Failed To Add</span>';
                                              } elseif ($_Get['error'] == 'norequest') {
                                                echo '<span class="badge bg-danger">No Request</span>';
                                              }
                                            } else if (isset($_GET['deleted'])) {
                                              if ($_GET['deleted'] == 0) {
                                                echo '<span class="badge bg-danger">Failed To Delete</span>';
                                              }
                                            } else if (isset($_GET['changed'])) {
                                              if ($_GET['changed'] == 0) {
                                                echo '<span class="badge bg-success">Failed to Change</span>';
                                              }
                                            }
                                            $_SESSION['message'] = '';
                                          }
                                          $_SESSION['message'] = '';
                                        }
                                        ?></h3>
                    </div>
                    <table class="table table-head-fixed text-nowrap" id="dtbus">
                      <thead>
                        <tr>

                          <th style="width: 1%">#</th>
                          <th>Action</th>
                          <th>Date</th>
                          <th>kilometer Made</th>
                          <th>New Odometer(Km)</th>
                          <th>Previous Odometer(Km)</th>
                        </tr>
                      </thead>
                      <?php

                      $I = 1;
                      $sql = "SELECT dailyservice.id as daily_id,dailyservice.date as dateservice,dailyservice.diff as km_made,
                      dailyservice.newkm,dailyservice.lastkm as previouskm,bus.id as bus_id,bus.kilometer as actualkm,bus.last_maintenance,bus.status,
                      bus.dateregistered,bus.fitnessexp,bus.insuranceexp,bus.roadtaxexp,
                      bus.vehicletype,bus.regno,garage.name as garage
                      FROM dailyservice
                      JOIN bus ON bus.id = dailyservice.busid
                      JOIN garage ON dailyservice.busid = garage.id
                      WHERE dailyservice.busid= $id ORDER BY dailyservice.date DESC
                      ";
                      $result = mysqli_query($conn, $sql);
                      if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) { ?>
                          <tr>

                            <td><?php echo $I; ?></td>
                            <td class="project-actions">
                              <a class="btn btn-danger btn-sm <?php if ($row['dateservice'] != date("Y-m-d")) {
                                                                echo 'disabled';
                                                              } else {
                                                                echo '';
                                                              } ?>" href="#" onclick="confirmAction('<?php echo $row['dateservice']; ?>','<?php echo $row['daily_id']; ?>');">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                              </a>
                            </td>
                            <td><?php echo $row['dateservice']; ?></td>
                            <td><?php echo $row['km_made']; ?></td>
                            <td><?php echo $row['newkm']; ?></td>
                            <td><?php echo $row['previouskm']; ?></td>
                          </tr>
                      <?php
                          $I++;
                        }
                      } ?>


                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-add" role="tabpanel" aria-labelledby="custom-tabs-one-add-tab">

                  <form action="Utilities/daily-add-func.php?id=<?php echo $id; ?>" method="POST" id="frm1">
                    <div class="row">

                      <h5 class="col-3">Status : <span class="<?php
                                                              if ($status == 'Working') {
                                                                echo 'badge bg-success';
                                                              } elseif ($status == 'Maintenance') {
                                                                echo 'badge bg-warning';
                                                              } else {
                                                                echo 'badge bg-danger';
                                                              }
                                                              ?>"><?php echo $status; ?></span>
                        <a href="#" id="changeStatusAdd" class="btn <?php if ($status == 'Working') {
                                                                      echo 'btn-warning';
                                                                    } elseif ($status == 'Maintenance') {
                                                                      echo 'btn-success';
                                                                    } else {
                                                                      echo 'btn-danger';
                                                                    } ?>"><?php if ($status == 'Working') {
                                                                            echo 'Set Maintenance';
                                                                          } elseif ($status == 'Maintenance') {
                                                                            echo 'Finish Maintenance';
                                                                          } else {
                                                                            echo 'Set Working';
                                                                          } ?></a>
                      </h5>
                      <h5 class="col">
                        Registration No : <span class="badge"><?php echo $regno; ?></span>
                      </h5>
                      <h5 class="col">
                        Last Maintenance : <span class="badge"><?php echo $last_maintenance; ?></span>
                      </h5>
                      <h5 class="col">
                        Actual Odometer : <span class="badge"><?php echo $kilometer; ?></span>
                      </h5>
                      <h5 class="col">
                        Garage : <span class="badge"><?php echo $garagename; ?></span>
                      </h5>
                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="card card-primary">

                          <div class="card-body">

                            <div class="form-group row">
                              <div class="col">
                                <label for="inputdate">Date</label>
                                <input type="date" id="inputdate" class="form-control" name="inputdate" value="<?php echo date('Y-m-d'); ?>" required>
                              </div>
                              <div class="col">
                                <label for="actualkm"> Actual Odometer</label>
                                <input type="number" id="actualkm" class="form-control" name="actualkm" value="<?php echo $kilometer; ?>">
                              </div>
                              <div class="col">
                                <label for="newkm">New Odometer</label>
                                <input type="number" id="newkm" class="form-control" name="newkm" required>
                              </div>
                              <div class="col">
                                <label for="diff">Kilometer Made</label>
                                <input type="number" id="diff" class="form-control" name="diff" readonly>
                              </div>

                            </div>

                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>

                    </div>
                    <div class="row">
                      <div class="col">
                        <a href="#" id="returnButton" class="btn btn-secondary">Return</a>
                        <input type="button" value="Add new Odometer" class="btn btn-success float-right" id="btnCreate">
                      </div>
                    </div>

                  </form>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                  Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                  Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
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
  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function() {

      $("#changeStatus").click(function() {
        var status = "<?php echo $status; ?>";
        var busId = <?php echo $id; ?>;
        if (status == 'Working') {
          Swal.fire({
            title: 'Are you sure?',
            text: "The Status will be set to Maintenance!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {

              window.location.href = 'Utilities/daily-statuschange-func.php?id=' + busId + '&status=Maintenance';
            }
          });
        } else if (status == 'Maintenance') {
          Swal.fire({
            title: 'Are you sure?',
            text: "The Status will be changed to Working!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {

              window.location.href = 'Utilities/daily-statuschange-func.php?id=' + busId + '&status=Working';
            }
          });
        } else {
          Swal.fire({
            title: 'Are you sure?',
            text: "The Status will be changed !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {

              window.location.href = 'Utilities/daily-statuschange-func.php?id=' + busId + '&status=Working';
            }
          });
        }


      });
      $("#changeStatusAdd").click(function() {
        var status = "<?php echo $status; ?>";
        var busId = <?php echo $id; ?>;
        if (status == 'Working') {
          Swal.fire({
            title: 'Are you sure?',
            text: "The Status will be set to Maintenance!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {

              window.location.href = 'Utilities/daily-statuschange-func.php?id=' + busId + '&status=Maintenance';
            }
          });
        } else if (status == 'Maintenance') {
          Swal.fire({
            title: 'Are you sure?',
            text: "The Status will be changed to Working!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {

              window.location.href = 'Utilities/daily-statuschange-func.php?id=' + busId + '&status=Working';
            }
          });
        } else {
          Swal.fire({
            title: 'Are you sure?',
            text: "The Status will be changed !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {

              window.location.href = 'Utilities/daily-statuschange-func.php?id=' + busId + '&status=Working';
            }
          });
        }


      });

      document.querySelector("#btnCreate").addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var date = document.querySelector('#inputdate').value;
        var busId = <?php echo $id; ?>;
        var status = "<?php echo $status; ?>";

        fetch('Utilities/daily-dtechk-func.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
              date: date,
              busId: busId
            })
          })
          .then(response => response.text())
          .then(response => {
            if (response == 'exist') {
              Swal.fire({
                icon: 'error',
                title: 'Already Exist',
                text: 'There is already a record for this date'
              });

            } else if (response == 'no request') {
              Swal.fire({
                icon: 'error',
                title: 'No Request Sent',
                text: 'There was no request sent to the server'
              });
            } else {
              Swal.fire({
                title: 'Are you sure to save?',
                text: "You will save a new record!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if (result.isConfirmed) {
                  // Perform the action here
                  if (document.querySelector('#actualkm').value > document.querySelector('#newkm').value) {
                    Swal.fire({
                      icon: 'error',
                      title: 'Data Error',
                      text: 'The new odometer cannot be less than the actual odometer'
                    });
                    return;
                  } else if (status != 'Working') {
                    Swal.fire({
                      icon: 'error',
                      title: 'Status Error',
                      text: 'Cannot add new odometer when the bus is not working'
                    });
                    return;
                  } else {
                    document.querySelector("#frm1").submit();
                  }
                }
              });
            }
          })
          .catch((error) => {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Unexpected Error'
            });
            console.error('Error:', error);
          });
      });


      $("#btnCreta").click(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var date = $('#inputdate').val();
        var busId = <?php echo $id; ?>; // Replace 'yourBusIdInput' with the ID of your bus ID input field
        var status = "<?php echo $status; ?>";

        $.ajax({
          url: 'Utilities/daily-dtechk-func.php', // Replace with the path to your PHP script
          type: 'POST',
          data: {
            date: date,
            busId: busId
          },
          success: function(response) {
            if (response == 'exist') {
              Swal.fire({
                icon: 'error',
                title: 'Already Exist',
                text: 'There is already a record for this date'
              });

            } else if (response == 'no request') {
              Swal.fire({
                icon: 'error',
                title: 'No Request Sent',
                text: 'There was no request sent to the server'
              });
            } else {
              Swal.fire({
                title: 'Are you sure to save?',
                text: "You will save a new record!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if (result.isConfirmed) {
                  // Perform the action here
                  if ($('#actualkm').val() > $('#newkm').val()) {
                    Swal.fire({
                      icon: 'error',
                      title: 'Data Error',
                      text: 'The new odometer cannot be less than the actual odometer'
                    });
                    return;
                  } else if (status != 'Working') {
                    Swal.fire({
                      icon: 'error',
                      title: 'Status Error',
                      text: 'Cannot add new odometer when the bus is not working'
                    });
                    return;
                  } else {

                    $("#frm1").submit();
                  }
                }
              });
            }
          }
        });
      });

      $('#returnButton').click(function() {
        $('#custom-tabs-one-home-tab').click();
      });

      $('#newkm').on('change', function() {
        var newkm = $('#newkm').val();
        var actualkm = $('#actualkm').val();
        $('#diff').val((newkm - actualkm).toFixed(2));

      });

      $('#newkm').on('keyup', function() {
        var newkm = $('#newkm').val();
        var actualkm = $('#actualkm').val();
        $('#diff').val((newkm - actualkm).toFixed(2));

      });

    });

    function confirmAction(date, dailyid) {
      Swal.fire({
        title: 'Are you sure?',
        text: "The record for the date " + date + " will be deleted \t You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
          // Redirect to a new page

          window.location.href = 'Utilities/daily-del-func.php?id=' + dailyid;
        }
      });
    }
  </script>
</body>

</html>