<?php
session_start();
include "dbcontext.php";

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['createid']) ? $_POST['createid'] : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $level = isset($_POST['level']) ? $_POST['level'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';


    $sql = "UPDATE roles SET Name = '$name', Level = '$level',Description='$description' 
    WHERE RoleId = $id";
    if (mysqli_query($conn, $sql)) {
        $message = 'Success';
        $_SESSION['message'] = $message;
        header("Location: ../role-edit.php?id=$id&edit=success");
    } else {
        $message = 'Failed';
        $_SESSION['message'] = $message;
        header("Location: ../role-edit.php?id=$id&edit=failed");
    }
} else {
    $message = 'Failed';
    $_SESSION['message'] = $message;
    header("Location: ../role-edit.php?id=$id&edit=norequest");
}
