<?php
session_start();
include "dbcontext.php";

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$row = array();
$sql = "SELECT * FROM model WHERE makeid = '$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $message = 'Success';
    $_SESSION['message'] = $message;
    while ($line = mysqli_fetch_assoc($result)) {
        array_push(
            $row,
            array(
                "id" => $line["id"],
                "name" => $line["name"]
            )
        );
    }
    echo json_encode($row);
} else {


    $message = 'Error';
    $_SESSION['message'] = $message;
    array_push(
        $row,
        array(
            "id" => 0,
            "name" => ""
        )
    );

    echo json_encode($row);
}
