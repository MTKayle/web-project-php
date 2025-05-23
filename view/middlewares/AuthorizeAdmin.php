<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// if (!isset($_SESSION['userID'])) {
//     echo "<script>window.location.href = 'http://localhost/web-project-php/public?page=login';</script>";
//     exit();
// }

if($_SESSION['role'] === 2) {
    echo "<script>window.location.href = 'http://localhost/web-project-php/public';</script>";
    exit();
}
?>