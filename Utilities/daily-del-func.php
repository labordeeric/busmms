<?php
session_start();
include "dbcontext.php";
$dailyid = $_GET['id'];
$sql = "SELECT * FROM dailyservice WHERE id = '$dailyid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$kilometer = $row['lastkm'];
$busid = $row['busid'];
$sql = "SELECT status FROM bus WHERE id = '$busid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$status = $row['status'];
$id = $busid;
//begin transaction
/* disable autocommit */
mysqli_autocommit($conn, FALSE);
// include "daily-sumchck-func.php";
$sql = "DELETE FROM dailyservice WHERE id = '$dailyid'";
$sqlbus = "UPDATE bus SET kilometer = $kilometer WHERE id = '$busid'";

if (mysqli_query($conn, $sql)) {
    include "daily-sumchck-func.php";
    if ($total > 4500) {
        $sqlbusstatus = "UPDATE bus SET status = 'Maintenance' WHERE id = '$busid'";
        if (!mysqli_query($conn, $sqlbusstatus)) {
            mysqli_rollback($conn);
            $message = 'Failed';
            $_SESSION['message'] = $message;
            header("Location: ../busdailyaction.php?id=$busid&deleted=0");
        }
        if (!mysqli_query($conn, $sqlbus)) {
            mysqli_rollback($conn);
            $message = 'Failed';
            $_SESSION['message'] = $message;
            header("Location: ../busdailyaction.php?id=$busid&deleted=0");
        }
    } else {
        $sqlbusstatus = "UPDATE bus SET status = 'Working' WHERE id = '$busid'";
        if (!mysqli_query($conn, $sqlbusstatus)) {
            mysqli_rollback($conn);
            $message = 'Failed';
            $_SESSION['message'] = $message;
            header("Location: ../busdailyaction.php?id=$busid&deleted=0");
        }
        if (!mysqli_query($conn, $sqlbus)) {
            mysqli_rollback($conn);
            $message = 'Failed';
            $_SESSION['message'] = $message;
            header("Location: ../busdailyaction.php?id=$busid&deleted=0");
        }
    }
    mysqli_commit($conn);
    $message = 'Success';
    $_SESSION['message'] = $message;
    header("Location: ../busdailyaction.php?id=$busid&deleted=1");
} else {
    mysqli_rollback($conn);
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../busdailyaction.php?id=$busid&deleted=0");
}
