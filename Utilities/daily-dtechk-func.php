<?php
session_start();
include "dbcontext.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $busId = $_POST['busId'];

    $query = "SELECT * FROM dailyservice WHERE date = '$date' AND busid = '$busId'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo 'exist';
    } else {
        echo 'not exist';
    }
} else {
    echo 'no request';
}
