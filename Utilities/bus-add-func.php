<?php
session_start();
// Path: Utilities/login.php
include "dbcontext.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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




    $sql = "INSERT INTO bus (makeid,kilometer,last_maintenance,
    status,garageid,vehicletype,regno,seatingcapacity,standingcapacity,
    enginecapacity,dateregistered,age,fitnessexp,insuranceexp,roadtaxexp,
    modelid,chassisno,engineno,color) VALUES 
    (
        '$makeid',
        '$kilometer',
        '$last_maintenance',
        '$status',
        '$garageid',
        '$inputvtype',
        '$regno',
        '$seatcty',
        '$standcty',
        '$engcty',
        '$dtereg',
        '$age',
        '$dtefit',
        '$dteinsexp',
        '$dtertexp',
        '$modelid',
        '$chassno',
        '$engno',
        '$color'
    )";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        $message = 'Success';
        $_SESSION['message'] = $message;
        header("Location: ../bus.php");
    } else {
        $message = 'Failed';
        $_SESSION['message'] = $message;
        header("Location: ../bus.php?error=createfailed");
    }
} else {
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../bus.php?error=norequest");
}
