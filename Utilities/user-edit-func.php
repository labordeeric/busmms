<?php
session_start();
// Path: Utilities/login.php
include "dbcontext.php";
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['createid']) ? $_POST['createid'] : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password2']) ? $_POST['password2'] : '';
    $level = isset($_POST['level']) ? $_POST['level'] : '';


    $sql = "UPDATE users SET Name='$name', Email='$email',Username='$username',Password='$password',Level='$level'
     WHERE UserId = $id";
    if (mysqli_query($conn, $sql)) {
        $message = 'Success';
        $_SESSION['message'] = $message;
        header("Location: ../user-edit.php?id=$id&edit=success");
    } else {
        $message = 'Failed';
        $_SESSION['message'] = $message;
        header("Location: ../user-edit.php?id=$id&edit=failed");
    }
} else {
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../user-edit.php?id=$id&edit=norequest");
}
