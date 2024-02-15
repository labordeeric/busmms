<?php
session_start();
// Path: Utilities/login.php
include "dbcontext.php";
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['createid']) ? $_POST['createid'] : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $makeid = isset($_POST['makeid']) ? $_POST['makeid'] : 0;


    $sql = "UPDATE model SET name = '$name', makeid = $makeid WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $message = 'Success';
        $_SESSION['message'] = $message;
        header("Location: ../model-edit.php?id=$id&edit=success");
    } else {
        $message = 'Failed';
        $_SESSION['message'] = $message;
        header("Location: ../model-edit.php?id=$id&edit=failed");
    }
} else {
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../model-edit.php?id=$id&edit=norequest");
}
