<?php
session_start();
require 'Utilities/dbcontext.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BBMS | Bus Add</title>

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
              <h1>Bus Add</h1>
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
        <form action="Utilities/bus-add-func.php" method="POST" id="frm1">
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
                  <div class="form-group row">
                    <div class="col">
                      <label for="inputId">Bus ID</label>
                      <input type="number" id="inputId" class="form-control" name="createid" readonly>

                    </div>
                    <div class="col">
                      <label for="regno">Bus Registration No</label>
                      <input type="text" id="regno" class="form-control" name="regno" required>

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="age">Bus Age</label>
                      <input type="number" id="age" class="form-control" name="age">

                    </div>
                    <div class="col">
                      <label for="kilometer">Odometer(Km)</label>
                      <input type="number" id="kilometer" class="form-control" name="kilometer">

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="chassno">Chassis No</label>
                      <input type="text" id="chassno" class="form-control" name="chassno">

                    </div>
                    <div class="col">
                      <label for="engno">Engine No</label>
                      <input type="text" id="engno" class="form-control" name="engno">

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="seatcty">Seating Capacity</label>
                      <input type="number" id="seatcty" class="form-control" name="seatcty">

                    </div>
                    <div class="col">
                      <label for="standcty">Standing Capacity</label>
                      <input type="number" id="standcty" class="form-control" name="standcty">

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="engcty">Engine Capacity</label>
                      <input type="number" id="engcty" class="form-control" name="engcty">

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
                        <input type="date" id="dtereg" class="form-control datetimepicker-input" name="dtereg" />
                      </div>
                    </div>
                    <div class="col">
                      <label for="dtefit">Fitness Expired:</label>
                      <div class="input-group date">
                        <input type="date" id="dtefit" class="form-control datetimepicker-input" name="dtefit" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="dteinsexp">Insurance Expired:</label>
                      <div class="input-group date">
                        <input type="date" id="dteinsexp" class="form-control datetimepicker-input" name="dteinsexp" />
                      </div>
                    </div>
                    <div class="col">
                      <label for="dtertexp">Road Tax Expired:</label>
                      <div class="input-group date">
                        <input type="date" id="dtertexp" class="form-control datetimepicker-input" name="dtertexp" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="dtePicker">Last Maintenance:</label>
                    <div class="input-group date">
                      <input type="date" id="dtePicker" class="form-control datetimepicker-input" name="last_maintenance" />
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
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col">
                      <label for="inputvtype">Vehicle Type</label>
                      <select id="inputvtype" class="form-control custom-select" name="inputvtype">
                        <option selected disabled>Select one</option>
                        <option value="Fleet">Fleet</option>

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
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col">
                      <label for="inputmodelid">Select Model</label>
                      <select id="inputmodelid" class="form-control" name="inputmodelid" hidden>
                        <?php
                        $sql = "SELECT * FROM model";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
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
                        <option value="BLUE" selected>BLUE</option>
                        <option value="WHITE">WHITE</option>
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
            <input type="button" value="Create new Bus" class="btn btn-success float-right" id="btnCreate">
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
      $("#btnCreate").click(function() {
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

      $('#inputmodelid').on('change', function() {
        // var modelval = ;
        console.log($('#inputmodelid').val());

      });
    });
  </script>
</body>

</html>