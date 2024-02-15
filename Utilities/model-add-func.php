<?php
session_start();
include "dbcontext.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $makeid = isset($_POST['makeid']) ? $_POST['makeid'] : 0;

    $sql = "INSERT INTO model (name, makeid) VALUES ('$name', $makeid)";

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        $message = 'Success';
        $_SESSION['message'] = $message;
        header("Location: ../model.php");
    } else {
        $message = 'Failed';
        $_SESSION['message'] = $message;
        header("Location: ../model.php?error=createfailed");
    }
} else {
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../model.php?error=norequest");
}
