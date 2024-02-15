<?php
session_start();
include "dbcontext.php";
$id = $_GET['id'];
//import the total variable from daily-sumchck-func.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = isset($_POST['inputdate']) && $_POST['inputdate'] != '' ? $_POST['inputdate'] : date('Y-m-d');
    $actualkm = isset($_POST['actualkm']) && ($_POST['actualkm'] != '' || $_POST['actualkm'] != 0) ? $_POST['actualkm'] : 0;
    $newkm = isset($_POST['newkm']) && ($_POST['newkm'] != '' || $_POST['newkm'] != 0) ? $_POST['newkm'] : 0;
    $diff = isset($_POST['diff']) && ($_POST['diff'] != '' || $_POST['diff'] != 0) ? $_POST['diff'] : 0;

    //begin transaction
    /* disable autocommit */
    mysqli_autocommit($conn, FALSE);

    $sql = "INSERT INTO dailyservice (date,diff,newkm,lastkm,busid) VALUES (
        '$date',
        '$diff',
        '$newkm',
        '$actualkm',
        '$id'
    )";
    $sqlbus = "UPDATE bus SET kilometer = '$newkm' WHERE id = '$id'";
    $sqlbusstatus = "UPDATE bus SET status = 'Maintenance' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        include "daily-sumchck-func.php";
        if ($total > 4500) {
            if (!mysqli_query($conn, $sqlbusstatus)) {
                mysqli_rollback($conn);
                $message = 'Failed';
                $_SESSION['message'] = $message;
                header("Location: ../busdailyaction.php?id=$id&error=updatefailed");
            }
            if (!mysqli_query($conn, $sqlbus)) {
                mysqli_rollback($conn);
                $message = 'Failed';
                $_SESSION['message'] = $message;
                header("Location: ../busdailyaction.php?id=$id&error=updatefailed");
            }
        } else {
            if (!mysqli_query($conn, $sqlbus)) {
                mysqli_rollback($conn);
                $message = 'Failed';
                $_SESSION['message'] = $message;
                header("Location: ../busdailyaction.php?id=$id&error=updatefailed");
            }
        }
        mysqli_commit($conn);
        $message = 'Success';
        $_SESSION['message'] = $message;
        header("Location: ../busdailyaction.php?id=$id");
    } else {
        mysqli_rollback($conn);
        $message = 'Failed';
        $_SESSION['message'] = $message;
        header("Location: ../busdailyaction.php?id=$id&error=createfailed");
    }
} else {
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../busdailyaction.php?id=$id&error=norequest");
}
