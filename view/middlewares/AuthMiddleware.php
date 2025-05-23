<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['userID'])) {
    echo "<script>window.location.href = '?page=login';</script>";
    exit();
}