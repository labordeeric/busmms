<?php
session_start();
include "dbcontext.php";

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_autocommit($conn, FALSE);
if ($status == 'Working') {
    $sql = "UPDATE bus SET status = '$status',last_maintenance = '" . date("Y-m-d") . "' WHERE id = '$id'";
} else {
    $sql = "UPDATE bus SET status = '$status' WHERE id = '$id'";
}
if (mysqli_query($conn, $sql)) {
    if ($status == 'Working') {
        $sqlrec = "INSERT INTO maintenancerec (busid,last_maintenance) VALUES ('$id','" . date("Y-m-d") . "')";
    } else {
        $sqlrec = "";
    }
    if ($sqlrec != '') {
        if (!mysqli_query($conn, $sqlrec)) {
            mysqli_rollback($conn);
            $message = 'Failed';
            $_SESSION['message'] = $message;
            header("Location: ../busdailyaction.php?id=$id&change=0");
        }
    }
    mysqli_commit($conn);
    $message = 'Success';
    $_SESSION['message'] = $message;
    header("Location: ../busdailyaction.php?id=$id&change=1");
} else {
    mysqli_rollback($conn);
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../busdailyaction.php?id=$id&change=0");
}
