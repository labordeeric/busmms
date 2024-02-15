<?php
session_start();
include "dbcontext.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $level = isset($_POST['level']) ? $_POST['level'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    $sql = "INSERT INTO roles (Level, Name,Description) VALUES ('$name', '$level', '$description)";

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        $message = 'Success';
        $_SESSION['message'] = $message;
        header("Location: ../role.php");
    } else {
        $message = 'Failed';
        $_SESSION['message'] = $message;
        header("Location: ../role.php?error=createfailed");
    }
} else {
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../role.php?error=norequest");
}
