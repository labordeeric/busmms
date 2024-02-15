<?php
session_start();
include "dbcontext.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password2']) ? $_POST['password2'] : '';
    $level = isset($_POST['level']) ? $_POST['level'] : '';

    $sql = "INSERT INTO users (Name, Email,Username,Password,Level) 
    VALUES ('$name', '$email', '$username','$password','$level')";

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        $message = 'Success';
        $_SESSION['message'] = $message;
        header("Location: ../user.php");
    } else {
        $message = 'Failed';
        $_SESSION['message'] = $message;
        header("Location: ../user.php?error=createfailed");
    }
} else {
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../user.php?error=norequest");
}
