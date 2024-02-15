<?php
session_start();
// Path: Utilities/login.php
include "dbcontext.php";
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['createid']) && $_POST['createid'] != '' ? $_POST['createid'] : 0;
    $modelid = isset($_POST['inputmodelid']) && $_POST['inputmodelid'] != '' ? $_POST['inputmodelid'] : '';
    $makeid = isset($_POST['inputmakeid']) && $_POST['inputmakeid'] != '' ? $_POST['inputmakeid'] : '';
    $garageid = isset($_POST['inputgarage']) && $_POST['inputgarage'] != '' ? $_POST['inputgarage'] : '';
    $inputvtype = isset($_POST['inputvtype']) && $_POST['inputvtype'] != '' ? $_POST['inputvtype'] : '';
    $color = isset($_POST['color']) && $_POST['color'] != '' ? $_POST['color'] : '';
    $regno = isset($_POST['regno']) && $_POST['regno'] != '' ? $_POST['regno'] : '';
    $age = isset($_POST['age']) && $_POST['age'] != '' ? $_POST['age'] : 0;
    $kilometer = isset($_POST['kilometer']) && $_POST['kilometer'] != '' ? $_POST['kilometer'] : 0;
    $chassno = isset($_POST['chassno']) && $_POST['chassno'] != '' ? $_POST['chassno'] : '';
    $engno = isset($_POST['engno']) && $_POST['engno'] != '' ? $_POST['engno'] : '';
    $seatcty = isset($_POST['seatcty']) && $_POST['seatcty'] != '' ? $_POST['seatcty'] : 0;
    $standcty = isset($_POST['standcty']) && $_POST['standcty'] != '' ? $_POST['standcty'] : 0;
    $engcty = isset($_POST['engcty']) && $_POST['engcty'] != '' ? $_POST['engcty'] : 0;
    $dtereg = isset($_POST['dtereg']) && $_POST['dtereg'] != '' ? $_POST['dtereg'] : '';
    $dtefit = isset($_POST['dtefit']) && $_POST['dtefit'] != '' ? $_POST['dtefit'] : '';
    $dteinsexp = isset($_POST['dteinsexp']) && $_POST['dteinsexp'] != '' ? $_POST['dteinsexp'] : '';
    $dtertexp = isset($_POST['dtertexp']) && $_POST['dtertexp'] != '' ? $_POST['dtertexp'] : '';
    $last_maintenance = isset($_POST['last_maintenance']) && $_POST['last_maintenance'] != '' ? $_POST['last_maintenance'] : '';
    $status = isset($_POST['status']) && $_POST['status'] != '' ? $_POST['status'] : 'Working';

    $sql = "UPDATE bus SET makeid = '$makeid',kilometer = '$kilometer',last_maintenance = '$last_maintenance',
    status = '$status',garageid = '$garageid',vehicletype = '$inputvtype',regno = '$regno',seatingcapacity = '$seatcty',standingcapacity = '$standcty',
    enginecapacity = '$engcty',dateregistered = '$dtereg',age = '$age',fitnessexp = '$dtefit',insuranceexp = '$dteinsexp',roadtaxexp = '$dtertexp',
    modelid = '$modelid',chassisno = '$chassno',engineno = '$engno',color = '$color' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $message = 'Success';
        $_SESSION['message'] = $message;
        header("Location: ../bus-edit.php?id=$id&edit=success");
    } else {
        $message = 'Failed';
        $_SESSION['message'] = $message;
        header("Location: ../bus-edit.php?id=$id&edit=failed");
    }
} else {
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../bus-edit.php?id=$id&edit=norequest");
}
