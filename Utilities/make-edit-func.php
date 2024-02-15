<?php
session_start();
include "dbcontext.php";
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['createid']) ? $_POST['createid'] : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';


    $sql = "UPDATE make SET name = '$name' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $message = 'Success';
        $_SESSION['message'] = $message;
        header("Location: ../make-edit.php?id=$id&edit=success");
    } else {
        $message = 'Failed';
        $_SESSION['message'] = $message;
        header("Location: ../make-edit.php?id=$id&edit=failed");
    }
} else {
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../make-edit.php?id=$id&edit=norequest");
}
