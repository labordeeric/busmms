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
  <title>BMMS | Bus Edit</title>

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
              <h1>Bus Edit <?php
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
                <li class="breadcrumb-item"><a href="bus.php">BUS</a></li>
                <li class="breadcrumb-item active">Bus Edit</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <form action="Utilities/bus-edit-func.php?id=<?php echo $id; ?>" method="POST" id="frm1">
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
                  $sql = "SELECT bus.id as bus_id, model.name as model_name,model.id as model_id, make.name as make_name,make.id as make_id,
                      bus.kilometer, bus.age,bus.last_maintenance,bus.status,
                      bus.chassisno,bus.engineno,bus.dateregistered,bus.fitnessexp,bus.insuranceexp,bus.roadtaxexp,bus.seatingcapacity,
                      bus.vehicletype,
                      bus.standingcapacity,bus.enginecapacity,bus.color,bus.regno,garage.name as garage_name,garage.id as garage_id
                      FROM bus
                      LEFT JOIN make ON bus.makeid = make.id
                      LEFT JOIN model ON bus.modelid = model.id
                      LEFT JOIN garage ON bus.garageid = garage.id
                      WHERE bus.id=$id";
                  // $sql = "SELECT * FROM bus WHERE id = $id";
                  $rowEntity = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                  ?>
                  <div class="form-group row">
                    <div class="col">
                      <label for="inputId">Bus ID</label>
                      <input type="number" id="inputId" class="form-control" name="createid" value="<?php echo $rowEntity['bus_id']; ?>" readonly>

                    </div>
                    <div class="col">
                      <label for="regno">Bus Registration No</label>
                      <input type="text" id="regno" class="form-control" name="regno" value="<?php echo $rowEntity['regno']; ?>" required>

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="age">Bus Age</label>
                      <input type="number" id="age" class="form-control" name="age" value="<?php echo $rowEntity['age']; ?>">

                    </div>
                    <div class="col">
                      <label for="kilometer">Odometer(Km)</label>
                      <input type="number" id="kilometer" class="form-control" name="kilometer" value="<?php echo $rowEntity['kilometer']; ?>">

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="chassno">Chassis No</label>
                      <input type="text" id="chassno" class="form-control" name="chassno" value="<?php echo $rowEntity['chassisno']; ?>">

                    </div>
                    <div class="col">
                      <label for="engno">Engine No</label>
                      <input type="text" id="engno" class="form-control" name="engno" value="<?php echo $rowEntity['engineno']; ?>">

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="seatcty">Seating Capacity</label>
                      <input type="number" id="seatcty" class="form-control" name="seatcty" value="<?php echo $rowEntity['seatingcapacity']; ?>">

                    </div>
                    <div class="col">
                      <label for="standcty">Standing Capacity</label>
                      <input type="number" id="standcty" class="form-control" name="standcty" value="<?php echo $rowEntity['standingcapacity']; ?>">

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="engcty">Engine Capacity</label>
                      <input type="number" id="engcty" class="form-control" name="engcty" value="<?php echo $rowEntity['enginecapacity']; ?>">

                    </div>
                    <div class="col">

                    </div>
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
                  <div class="form-group row">
                    <div class="col">
                      <label for="dtereg">Date Registered:</label>
                      <div class="input-group date">
                        <input type="date" id="dtereg" class="form-control datetimepicker-input" name="dtereg" value="<?php echo $rowEntity['dateregistered']; ?>" />
                      </div>
                    </div>
                    <div class="col">
                      <label for="dtefit">Fitness Expired:</label>
                      <div class="input-group date">
                        <input type="date" id="dtefit" class="form-control datetimepicker-input" name="dtefit" value="<?php echo $rowEntity['fitnessexp']; ?>" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="dteinsexp">Insurance Expired:</label>
                      <div class="input-group date">
                        <input type="date" id="dteinsexp" class="form-control datetimepicker-input" name="dteinsexp" value="<?php echo $rowEntity['insuranceexp']; ?>" />
                      </div>
                    </div>
                    <div class="col">
                      <label for="dtertexp">Road Tax Expired:</label>
                      <div class="input-group date">
                        <input type="date" id="dtertexp" class="form-control datetimepicker-input" name="dtertexp" value="<?php echo $rowEntity['roadtaxexp']; ?>" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="dtePicker">Last Maintenance:</label>
                    <div class="input-group date">
                      <input type="date" id="dtePicker" class="form-control datetimepicker-input" name="last_maintenance" value="<?php echo $rowEntity['last_maintenance']; ?>" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="inputgarage">Garage</label>
                      <select id="inputgarage" class="form-control custom-select" name="inputgarage">
                        <option selected disabled>Select one</option>
                        <?php
                        $sql = "SELECT * FROM garage";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['id'] == $rowEntity['garage_id']) {
                              echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                            } else {
                              echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col">
                      <label for="inputvtype">Vehicle Type</label>
                      <select id="inputvtype" class="form-control custom-select" name="inputvtype">
                        <option disabled>Select one</option>
                        <option value="Fleet" <?php echo $rowEntity['vehicletype'] != '' ? '' : 'Selected'; ?>>Fleet</option>

                      </select>
                    </div>

                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="inputmakeid">Make</label>
                      <select id="inputmakeid" class="form-control custom-select" name="inputmakeid">
                        <option selected disabled>Select one</option>
                        <?php
                        $sql = "SELECT * FROM make";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['id'] == $rowEntity['make_id']) {
                              echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                            } else {
                              echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col">
                      <label for="inputmodelid">Select Model</label>
                      <select id="inputmodelid" class="form-control" name="inputmodelid">
                        <?php
                        $sql = "SELECT * FROM model";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['id'] == $rowEntity['model_id']) {
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
                  <div class="form-group row">
                    <div class="col">
                      <label for="color">Color</label>
                      <select id="color" class="form-control custom-select" name="color">
                        <option value="BLUE" <?php echo $rowEntity['color'] == 'BLUE' ? 'selected' : ''; ?>>BLUE</option>
                        <option value="WHITE" <?php echo $rowEntity['color'] == 'WHITE' ? 'selected' : ''; ?>>WHITE</option>
                      </select>
                    </div>
                    <div class="col">
                      <label for="inputStatus">Status</label>
                      <select id="inputStatus" class="form-control custom-select" name="status">
                        <option value="Working" selected>Working</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="BreakDown">Break Down</option>
                      </select>

                    </div>
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

      $('#inputmakeid').on('change', function() {
        $.ajax({
          type: 'GET',
          url: 'Utilities/model-list-make.php?id=' + $('#inputmakeid').val(),
          success: function(data) {
            // anyname should be the id of the dropdown
            // $('#anyname').append(data);
            // for json 
            var sessmessage = '<?php echo $_SESSION['message']; ?>';

            $json = JSON.parse(data);
            // console.log($json);
            // console.log(sessmessage);
            // empty your dropdown 
            $('#inputmodelid').empty();
            if (sessmessage == 'Error') {
              $.each($json, function(key, value) {

                if (value.id == 0) {


                }

              });
              <?php $_SESSION['message'] = ""; ?>
            } else {
              $.each($json, function(key, value) {

                $('#inputmodelid').append('<option value="' + value.id + '">' + value.name + '</option>');

              });
              <?php $_SESSION['message'] = ""; ?>
              $('#inputmodelid').removeAttr('hidden');
            }

          }
        });
      });

    });
  </script>
</body>

</html>