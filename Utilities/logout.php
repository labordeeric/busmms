<?php
// Path: Utilities/logout.php
session_start();

try {
    // Destroy the session
    session_destroy();
    header("Location: ../index.php?logout=success");
} catch (Exception $e) {
    header("Location: ../index.php?logout=" . $e->getMessage());
}
