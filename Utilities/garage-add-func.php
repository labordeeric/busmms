<?php
session_start();
include "dbcontext.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';

    $sql = "INSERT INTO garage (name) VALUES ('$name')";

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        $message = 'Success';
        $_SESSION['message'] = $message;
        header("Location: ../garage.php");
    } else {
        $message = 'Failed';
        $_SESSION['message'] = $message;
        header("Location: ../garage.php?error=createfailed");
    }
} else {
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../garage.php?error=norequest");
}
