<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbbusms";

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception('Connection failed: ' . $conn->connect_error);
    }
    // echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'> </script> ";
    // echo "<script>
    // Swal.fire({
    //     title: 'Success!',
    //     text: 'Connection Successful!',
    //     icon: 'success',
    //     confirmButtonText: 'Close'
    // })
    // </script>";
    echo "";
} catch (Exception $e) {
    echo "failed";
}
