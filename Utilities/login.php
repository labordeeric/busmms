<?php
session_start();
// Path: Utilities/login.php
include "dbcontext.php";
// Validate the username and password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE Username = '$username' AND Password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Successful login
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['username'] = $row['Username'];
            $_SESSION['userid'] = $row['UserId'];
            $_SESSION['level'] = $row['Level'];
            $_SESSION['email'] = $row['Email'];
        }

        $message = 'Login Successful';
        $_SESSION['loggedin'] = 'Yes';
        $_SESSION['message'] = $message;
        header("Location: ../home.php");
    } elseif (mysqli_num_rows($result) === 0) {
        // Invalid credentials
        $message = 'Error Invalid username or password';
        $_SESSION['message'] = $message;

        header("Location: ../index.php?login=error");
    }
}
